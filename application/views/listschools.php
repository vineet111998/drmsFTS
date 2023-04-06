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
                        Schools for <?=$donor;?>
                      <?php } else { echo "List of Associated Schools"; } ?>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?=base_url('drm')?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                        <li><a href="<?=base_url('administration/donors/'.$donorType)?>">Donors</a><span class="divider">&nbsp;</span></li>
                        <li><a href="#">Schools for <?=$donor;?></a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-tasks"></i> Schools for <?=$donor;?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <!--<a href="javascript:;" class="icon-remove"></a>-->
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- <div class="clearfix">
                                <div class="btn-group">
                                    <a id="sample_editable_1_new"
                                       class="btn btn-small btn-primary"
                                       href="<?=  base_url('administration/uploadDonors');?>">
                                        <i class="icon-upload"></i> Upload Donors
                                    </a>
                                </div>
                            </div> -->
                            <!-- <div class="space15"></div> -->
                            <form action="<?=current_url();?>" method="post" target="_blank">
                              <input type="hidden" name="donorID" value="<?=$donorID?>">
                              <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>School</th>
                                        <th>Acharya Name</th>
                                        <th>District</th>
                                        <th>Village</th>
                                        <th>State</th>
                                        <!-- <th>Total Boys</th>
                                        <th>Total Girls</th>
                                        <th>#</th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i=0;foreach($associatedSchools as $val): ?>
                                    <tr id="<?=$i?>">
                                        <td id="schoolCode<?=$i?>">
                                          <?php echo trim($val["mds_school_code"])?>
                                          <input type="hidden" name="DATA[<?=$i?>][schoolcode]" id="" value="<?php echo trim($val["mds_school_code"])?>">
                                          <!-- <i id="refresh<?=$i?>" class="icon icon-refresh"></i> -->
                                          <a id="img<?=$i?>" href="<?=base_url("drm/showSchool")."/".trim($val["mds_school_code"]);?>" class="content" style="display:none;">
                                            <img src="<?=$imgPath?>picture.png" alt="Picture">
                                          </a>
                                          <a id="imgpdf<?=$i?>" href="<?=base_url("drm/downloadPdf")."/".trim($val["mds_school_code"]);?>" style="display:none;">
                                            <img src="<?=$imgPath?>pdf.png" alt="">
                                          </a>
                                        </td>
                                        <td id="acharya<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
                                        <td id="district<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
                                        <td id="village<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
                                        <td id="state<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
                                        <!-- <td id="boys<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
                                        <td id="girls<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
                                        <td id="action<?=$i?>"><a id="actionbtn<?=$i?>" href="<?=base_url('drm/showPeriods/'.trim($val["mds_school_code"]))?>" class="btn btn-small btn-success content" style="display:none;">Attendance</a></td> -->
                                    </tr>
                                    <?php $i++;endforeach;?>
                                </tbody>
                              </table>

                              <div class="space20" style="text-align:right;">
                                <?php echo $this->pagination->create_links(); ?>
                              </div>
                              <div class="space10"></div>
                              <div class="form-actions" style="text-align:center;">
                                <input type="hidden" name="donor" value="<?=$donor?>">
                                <input type="submit" name="submit" id="submit" class="btn btn-success" value="Generate PDF">
                                <input type="submit" name="noData" id="submit" class="btn btn-danger" value="Generate PDF for No Data">
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
$(document).ready(function(){
  $(".table > tbody > tr").each(function(){
    var pos = $(this).attr("id");
    var schoolCode = $("#schoolCode"+pos).text();
    viewReport(schoolCode, pos);
    //countImages(schoolCode, pos);
    // exit(0);
  });
});

function viewReport(schoolCode, pos){
  schoolCode = $.trim(schoolCode);
  $("#acharya"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $("#district"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $("#village"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $("#state"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  // $("#boys"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  // $("#girls"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $.ajax({
    url: BASE_URL + 'drm/retriveConsolidatedGKV',
    type: "POST",
    data: "schoolcode="+schoolCode,
    dataType: 'JSON',
    // async: false,
    success: function (res) {
      var acharya = "<strong style='color:red;'>No Data Available</strong>"+'<input type="hidden" name="DATA['+pos+'][acharya]" id="" value="">';
      var district = "<strong style='color:red;'>No Data Available</strong>"+'<input type="hidden" name="DATA['+pos+'][district]" id="" value="">';
      var village = "<strong style='color:red;'>No Data Available</strong>"+'<input type="hidden" name="DATA['+pos+'][village]" id="" value="">';
      var state = "<strong style='color:red;'>No Data Available</strong>"+'<input type="hidden" name="DATA['+pos+'][state]" id="" value="">';
      // var totalBoys = "<strong style='color:red;'>No Data Available</strong>";
      // var totalGirls = "<strong style='color:red;'>No Data Available</strong>";
      if(res.status){
        acharya = res.details.rsd_Teacher+'<input type="hidden" name="DATA['+pos+'][acharya]" id="" value="'+res.details.rsd_Teacher+'">';
        district = res.details.rsd_District+'<input type="hidden" name="DATA['+pos+'][district]" id="" value="'+res.details.rsd_District+'">';
        village = res.details.rsd_Village+'<input type="hidden" name="DATA['+pos+'][village]" id="" value="'+res.details.rsd_Village+'">';
        state = res.details.rsd_state+'<input type="hidden" name="DATA['+pos+'][state]" id="" value="'+res.details.rsd_state+'">';
        // totalBoys = res.details.rsd_Boys;
        // totalGirls = res.details.rsd_Girls;
        // action = '<a href="#" class="btn btn-small btn-success content">Attendance</a>';
        $("#actionbtn"+pos).show();
        $("#refresh"+pos).hide();
      } else {
        var action = '';
        $("#action"+pos).html(action);
      }
      $("#acharya"+pos).html(acharya);
      $("#district"+pos).html(district);
      $("#village"+pos).html(village);
      $("#state"+pos).html(state);
      // $("#boys"+pos).html(totalBoys);
      // $("#girls"+pos).html(totalGirls);
    }, error: function (error) {
      $("#acharya"+pos).html("<strong style='color:red;'>Error!</strong>");
      $("#district"+pos).html("<strong style='color:red;'>Error!</strong>");
      $("#village"+pos).html("<strong style='color:red;'>Error!</strong>");
      $("#state"+pos).html("<strong style='color:red;'>Error!</strong>");
      // $("#boys"+pos).html("<strong style='color:red;'>Error!</strong>");
      // $("#girls"+pos).html("<strong style='color:red;'>Error!</strong>");
      var html = `<button id="refresh`+pos+`" onclick="viewReport('`+schoolCode+`','`+pos+`')" class="btn btn-small btn-info"><i class="icon-refresh"></i> Refresh</button>`;
      $("#action"+pos).append(html);
    }
  });
}

function countImages(schoolCode, pos){
  $.ajax({
    url: BASE_URL + 'drm/countSchoolData',
    type: "POST",
    data: "schoolcode="+schoolCode,
    // data: "schoolcode=BHAP0734202",
    dataType: 'JSON',
    success: function (res) {
      // console.log(res.pdf);
      $("#refresh"+pos).hide();
      if(parseInt(res.imgs)){
        $("#img"+pos).show();
      }
      if(parseInt(res.pdf) !== 0){
        $("#imgpdf"+pos).show();
      }
    }, error: function (error) {
      $("#refresh"+pos).hide();
    }
  });
}
</script>
<?php echo $footer; ?>
