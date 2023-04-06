<?php echo $header; ?>

<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid">
    <!-- BEGIN SIDEBAR -->
    <div id="sidebar" class="nav-collapse collapse">
        <div class="sidebar-toggler hidden-phone"></div>
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
        <div class="navbar-inverse">
            <form class="navbar-search visible-phone">
                <input type="text" class="search-query" placeholder="Search" />
            </form>
        </div>
        <!-- END RESPONSIVE QUICK SEARCH FORM -->
        <!-- BEGIN SIDEBAR MENU -->
        <?php echo $sidebar; ?>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE -->
    <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                      <?php if(empty($fromState)){ ?>
                        Schools for <?=$this->session->userdata("adminName");?>
                      <?php } else { echo "List of Associated Schools"; } ?>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?=base_url('drm')?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                        <li><a href="<?=base_url('administration/donors')?>">Donors</a><span class="divider">&nbsp;</span></li>
                        <li><a href="#">Schools Report</a><span class="divider-last">&nbsp;</span></li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
             <?php if ($this->session->flashdata("success")): ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata("success"); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata("error")): ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata("error") ?>
                </div>
            <?php endif; ?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN BORDERED TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Schools <span id="processStatus"> :: Pulled data <span id="cntProcess" class="badge badge-important"></span> out of <span class="badge badge-success"><?php echo count($schools) ?></span></span></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <!--<a href="javascript:;" class="icon-remove"></a>-->
                            </span>
                        </div>
                        <div class="widget-body form">
                          <form class="formPDF" action="<?=base_url('administration/pdfReport');?>" method="post" target="_blank">
                            <div class="report">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>School</th>
                                          <!-- <th>Acharya Name</th> -->
                                          <!-- <th>#</th> -->
                                      </tr>
                                  </thead>

                                  <tbody>
                                      <?php for($i=0;$i<count($schools);$i++): ?>
                                      <tr class="schools" id="school<?=$i?>" data-pos="<?=$i?>">
                                          <td id="schoolCode<?=$i?>">
                                            <?php echo trim($schools[$i])?>
                                            <input type="hidden" name="RPT[<?=$i?>][SCHOOLCODE]" value="<?php echo trim($schools[$i])?>"/>
                                          </td>
                                          <td id="address<?=$i?>"></td>
                                          <!-- <td id="action<?=$i?>"></td> -->
                                      </tr>
                                      <tr>
                                          <td id="schoolGkv<?=$i?>" colspan="3"><img src="<?=$imgPath?>loading.gif" alt=""></td>
                                      </tr>
                                      <?php endfor;?>
                                  </tbody>
                              </table>
                            </div>
                            <div class="space10"></div>
                            <div class="form-actions">
                              <input type="hidden" name="pdfHtml" id="pdfHtml" value="">
                              <input type="hidden" name="donorCode" value="<?=$donorCode?>">
                              <input type="button" name="" id="generatePdf" class="btn btn-success" value="Generate PDF" onclick="sendPdf()"/>
                            </div>
                          </form>
                        </div>
                    </div>
                    <!-- END BORDERED TABLE widget-->
                </div>
            </div>

            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<?php echo $tablesJS;?>
<?php echo $lightboxJS;?>
<script type="text/javascript">
  var cntProcess;
  var count = 0;
  var imgPath = '<?=$imgPath?>';
  $(document).ready(function(){
    cntProcess = $("#cntProcess");
    cntProcess.text(count);
    $(".schools").each(function(){
      var pos = $(this).data("pos");
      var schoolCode = $("#schoolCode"+pos).text();
      viewReport(schoolCode, pos);
      // exit(0);
    });
  });

  function viewReport(schoolCode, pos){
    $.ajax({
      url: BASE_URL + 'administration/retriveGKVbySchoolWithPeriod',
      type: "POST",
      data: "schoolcode="+$.trim(schoolCode),
      dataType: 'JSON',
      success: function (res) {
        if(res.code == "200"){
          var addHTML = "<strong>Village:</strong> "+res.data[0].mgkvd_village_name+" | <strong>District:</strong> "+res.data[0].rsd_District+" | <strong>State:</strong> "+res.data[0].rsd_state+"";
          addHTML += `<input type="hidden" name="RPT[`+pos+`][SCHOOLADD]" value="`+addHTML+`"/>`;
          $("#schoolGkv"+pos).html(constructHTML(res.data, pos));
          $("#address"+pos).html(addHTML);
        } else {
          $("#schoolGkv"+pos).html("<p style='text-align:center; font-weight:bold; color:red;'>No data found for this school. This school will be removed from the report.</p>");
        }
        count = count+1;
        cntProcess.text(count);
      }, error: function (error) {
        var html = `<button class="btn btn-danger" onclick="viewReport('`+$.trim(schoolCode)+`', '`+pos+`')" type="button"><i class="icon-refresh"></i> Reload</a>`;
        $("#schoolGkv"+pos).html(html).css("text-align","center");;
      }
    });
  }

  function constructHTML(data, pos){
    var html = '<table class="table table-bordered">';
    html += '<thead><tr><th>Month</th><th>School Days</th><th>Boys Present</th><th>Girls Present</th></tr></thead><tbody>';
    for(var i=0;i<data.length;i++){
      html += `<tr>
        <td><input type="hidden" name="RPT[`+pos+`][GKV][`+i+`][PERIOD]" value="`+data[i].period+`">`+data[i].period+`</td>
        <td><input type="text" name="RPT[`+pos+`][GKV][`+i+`][SCHOOLDAY]" class="span6" value="`+data[i].mgkvd_sch_day+`"></td>
        <td><input type="text" name="RPT[`+pos+`][GKV][`+i+`][PRESENTBOYS]" class="span6" value="`+data[i].mgkvd_present_boys+`"></td>
        <td><input type="text" name="RPT[`+pos+`][GKV][`+i+`][PERSENTGIRLS]" class="span6" value="`+data[i].mgkvd_present_girls+`"></td>
      </tr>`;
    }
    html += '</tbody></table>';
    return html;
  }

  function sendPdf(){
    $(".formPDF").submit();
  }
</script>
<?php echo $footer; ?>
