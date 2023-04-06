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
                        Upload Donors
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href=""><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Upload Donors</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-upload"></i> Upload Donors</h4>
                        </div>
                        <div class="widget-body form">
                          <!-- <div class="clearfix">
                              <div class="btn-group">
                                  <a id="downloadTemplate"
                                     href="<?=  base_url('administration/uploadDonors');?>">
                                      <img src="<?=$imgPath?>excel.png" title="Excel Template" alt="Excel Template" width="36" height="36">
                                  </a>
                              </div>
                          </div>
                          <div class="space15"></div> -->
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="showLoading();">
                              <div class="control-group">
                                  <label class="control-label">Donor Type</label>
                                  <div class="controls">
                                      <select class="span6" name="donorType" id="donorType" required="required">
                                        <option value=""> -- SELECT -- </option>
                                        <option value="DPS">DPS</option>
                                        <option value="RMS">RMS</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Upload Donors</label>
                                  <div class="controls">
                                      <input type="file" name="userfile" value="">
                                  </div>
                              </div>

                              <div class="control-group">
                                  <!-- <label class="control-label">Download Template </label> -->
                                  <div class="controls">
                                    <a id="downloadTemplate" href="<?=  base_url('administration/uploadDonors');?>" style="text-decoration:none;">
                                        <img src="<?=$imgPath?>excel.png" title="Excel Template" alt="Excel Template" width="36" height="36">
                                        <strong>&#9664; Click to Download Template</strong>
                                    </a>
                                    <br>
                                    <small style="color:#f00;">
                                      <ul>
                                        <li>Do not remove the first row (Row #1) in the excel. Keep it intact</li>
                                        <li>Row #2 contains dummy data for your reference. Remove the Row #2</li>
                                        <li>Make sure <strong>NOT TO KEEP ANY COLUMN BLANK</strong>. If any column doesn't have any data then write <strong style="color:#000;">NA</strong></li>
                                      </ul>
                                    </small>
                                  </div>
                              </div>

                                <div class="form-actions">
                                  <img id="submitLoading" style="display:none;" src="<?=base_url()."assets/img/loading.gif"?>" alt="">
                                  <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Submit">
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
  $(document).ready(function(){
    $("#downloadTemplate").click(function(e){
      e.preventDefault();
      window.location.href = BASE_URL+'assets/template/template.xls';
    });
    // $("#donorType").change(function(){
    //   var donorType = $("#donorType").val();
    //   if(donorType){
    //     $.ajax({
    //       url: BASE_URL + 'administration/checkDonorType',
    //       type: "POST",
    //       data: "donorType=" + donorType,
    //       success: function (res) {
    //         if(parseInt(res) > 0){
    //           alert("There are already "+donorType+" donors available in our system. Please choose you next action.")
    //           $("#action").css("display","block");
    //           $("#actionType").attr("required","required");
    //         } else {
    //           $("#actionType").removeAttr("required");
    //           $("#action").css("display","none");
    //         }
    //       }, error: function (error) {
    //         alert(error);
    //       }
    //     });
    //   } else {
    //     $("#actionType").removeAttr("required");
    //     $("#action").css("display","none");
    //   }
    // });

  });
</script>
<?php echo $footer; ?>
