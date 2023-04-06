<?php echo $header; ?>
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
                    <h3 class="page-title">
                        Settings
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href=""><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Settings</a><span class="divider-last">&nbsp;</span></li>
                    </ul>
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
                    <!-- BEGIN SAMPLE FORM widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-cogs"></i> School Pictures Date Filter</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form name="schoolPicturesFilter" action="<?php echo current_url() ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="showLoading();">
                              <input type="hidden" name="todo" value="datefilter">
                              <div class="control-group">
                                  <label class="control-label">From Date</label>
                                  <div class="controls">
                                      <input type="text" name="fromDate" class="span6 date-picker" required data-date-format="yyyy-mm-dd" value="<?php echo $filter["ef_pic_from_date"] ?>"/>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">To Date</label>
                                  <div class="controls">
                                      <input type="text" name="toDate" id="toDate" class="span6 date-picker" data-date-format="yyyy-mm-dd" <?php echo ($filter["ef_pic_to_date"])?'value="'.$filter["ef_pic_to_date"].'"':'disabled="disabled"' ?> />
                                      <input type="checkbox" id="disableToDate" <?php echo ($filter["ef_pic_to_date"])?'':'checked="checked"' ?>>Use Current Date
                                  </div>
                              </div>

                                <div class="form-actions">
                                  <img id="submitLoading" style="display:none;" src="<?=base_url()."assets/img/loading.gif"?>" alt="">
                                  <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Submit">
                                </div>
                                <div class="space15">

                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM widget-->
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-cog"></i> Donor Board Financial Year Settings</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form name="dbpdf" action="<?php echo current_url() ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="showLoading();">
                              <input type="hidden" name="todo" value="donorboardpdf">
                              <div class="control-group">
                                  <label class="control-label">DPS Donor Board Year</label>
                                  <div class="controls">
                                    <select class="span6" name="dpsyear" id="dpsyear" required="">
                                      <option value=""> -- SELECT -- </option>
                                      <?php
                                      for($i=-2;$i<=0;$i++){
                                        $prevYr = $i.' years';
                                        $from = date('Y', strtotime($prevYr));
                                        $to = $from+1;
                                        $year = $from."-".$to;
                                        ?>
                                        <option value="<?=$year?>" <?php echo ($filter["ef_dps_year"] == $year)?"selected":"" ?>><?=$year?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">RMS Donor Board Year</label>
                                  <div class="controls">
                                    <select class="span6" name="rmsyear" id="rmsyear" required="">
                                      <option value=""> -- SELECT -- </option>
                                      <?php
                                      for($i=-2;$i<=0;$i++){
                                        $prevYr = $i.' years';
                                        $from = date('Y', strtotime($prevYr));
                                        $to = $from+1;
                                        $year = $from."-".$to;
                                        ?>
                                        <option value="<?=$year?>" <?php echo ($filter["ef_rms_year"] == $year)?"selected":"" ?>><?=$year?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                              </div>

                                <div class="form-actions">
                                  <img id="submitLoading2" style="display:none;" src="<?=base_url()."assets/img/loading.gif"?>" alt="">
                                  <input type="submit" name="donorBoardPdfSettings" id="submitLoading2" class="btn btn-success" value="Submit">
                                </div>
                                <div class="space15">

                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM widget-->
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-refresh"></i> Reset Attendance Report Donors</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form name="reportreset" action="<?php echo current_url() ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="showLoading();">
                              <input type="hidden" name="todo" value="resetReport">
                              <div class="control-group">
                                  <label class="control-label">DPS Donors Reset</label>
                                  <div class="controls">
                                        <label class="radio">
                                            <div class="radio" id="uniform-undefined"><span>
                                              <input name="DPSReset" value="1" style="opacity: 0;" type="radio"></span></div>
                                            Yes
                                        </label>
                                        <label class="radio">
                                            <div class="radio" id="uniform-undefined"><span class="checked">
                                              <input name="DPSReset" value="0" checked="" style="opacity: 0;" type="radio"></span></div>
                                            No
                                        </label>
                                    </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">RMS Donors Reset</label>
                                  <div class="controls">
                                        <label class="radio">
                                            <div class="radio" id="uniform-undefined"><span>
                                              <input name="RMSReset" value="1" style="opacity: 0;" type="radio"></span></div>
                                            Yes
                                        </label>
                                        <label class="radio">
                                            <div class="radio" id="uniform-undefined"><span class="checked">
                                              <input name="RMSReset" value="0" checked="" style="opacity: 0;" type="radio"></span></div>
                                            No
                                        </label>
                                    </div>
                              </div>

                                <div class="form-actions">
                                  <img id="submitLoading2" style="display:none;" src="<?=base_url()."assets/img/loading.gif"?>" alt="">
                                  <input type="submit" name="donorBoardPdfSettings" id="submitLoading2" class="btn btn-success" value="Submit">
                                </div>
                                <div class="space15">

                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM widget-->
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<?php echo $forminputJS; ?>
<script type="text/javascript">
    $(document).ready(function () {
      $("#disableToDate").click(function(){
        // alert(curDate);
        if($(this).is(":checked")){
          $("#toDate").val("");
          $("#toDate").attr("disabled","disabled");
        } else {
          $("#toDate").removeAttr("disabled");
        }
      });
      $("form").submit(function(){
        $("input[type=submit]").attr("disabled","disabled");
      });
    });
</script>
<?php echo $footer; ?>
