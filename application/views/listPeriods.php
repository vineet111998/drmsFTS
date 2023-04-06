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
                        List of Periods
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?=base_url('drm')?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                        <li><a href="<?=base_url('drm/listSchools')?>">List of Associated Schools</a><span class="divider">&nbsp;</span></li>
                        <li><a href="#">List of Periods</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-tasks"></i> List of Periods</h4>
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
                            <table class="table table-bordered table-hover dataTable" id="sample_1">
                                <thead>
                                    <tr>
                                      <th>Periods</th>
                                      <th>#</th>
                                    </tr>
                                </thead>

                                <tbody class="periods">
                                </tbody>
                            </table>
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
<script type="text/javascript">

$(document).ready(function(){
  var schoolCode = '<?=$schoolCode?>';
  viewReport(schoolCode);
});
function viewReport(schoolCode){
    //var oldHtml = $("#"+pos).html();
    //$("#"+pos).text('Retrieving Data ...');
    var  monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];
    $(".periods").html('<tr><td style="text-align:center;" colspan="2"><img src="'+BASE_URL+'assets/img/loading.gif"></td></tr>');
    var html = '';
    $.ajax({
      url: MIS_URL + 'api/getPeriodCodes',
      type: "POST",
      data: "schoolcode="+schoolCode,
      dataType: 'JSON',
      success: function (res) {
        if(res.code == "200"){
          for(var i=0; i<res.data.length;i++){
            var period = res.data[i].periodDate;
            var year = period.substring(0,4);
            var month = parseInt(period.substring(5,7));
            html += "<tr>";
            html += "<td>"+monthNames[month-1]+", "+year+"</td>";
            html += '<td><a href="'+ BASE_URL +'drm/showGkvReport/'+ schoolCode +'/'+res.data[i].rgc_period_code+'" class="btn btn-success">View</a></td>';
            html += "</tr>";
          }
          $(".periods").html(html);
        } else {
          $(".periods").html('<tr><td style="text-align:center;" colspan="2">No data found for this school code.</td></tr>');
        }

      }, error: function (error) {
        alert('Sorry there was an error. Please reload this page.');
        $(".periods").html('<tr><td style="text-align:center;" colspan="2">No data found for this school code.</td></tr>');
      }
    });
  }
</script>
<?php echo $footer; ?>
