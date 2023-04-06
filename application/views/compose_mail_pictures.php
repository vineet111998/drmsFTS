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
                        Send School Pictures
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?=base_url();?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Send School Pictures</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-envelope"></i> Send Connectapp School Pictures</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="showLoading();">
                              <div class="control-group">
                                  <label class="control-label">Session</label>
                                  <div class="controls">
                                      <select class="span6" name="donorType" id="donorType" onchange="showDonors()">
                                        <option value="">-- SELECT -- </option>
                                        <option value="DPS">DPS</option>
                                        <option value="RMS">RMS</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Choose Donor</label>
                                  <div class="controls">
                                      <select class="span6 chosen" name="donorID" id="donorID">
                                      </select>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Subject</label>
                                  <div class="controls">
                                    <select class="span6 chosen" name="subject">
                                      <?php foreach($subjects as $sub) { ?>
                                        <option value="<?=$sub["mes_sub"]?>"><?=$sub["mes_sub"]?></option>
                                      <?php } ?>
                                    </select>
                                    <!-- <input type="text" name="subject" class="span6"> -->
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Compose Mail</label>
                                  <div class="controls">
                                      <textarea class="ckeditor" name="msgBody" rows="6"></textarea>
                                      <!-- <p class="help-block">
                                        <strong>Type below snippets where you want to put dynamic data like Donor Name, Phone etc.
                                        The snippets will be automatically replaced with the donors info.
                                        Type snippets with braces. The snippets are given below.</strong><br>
                                        <ul>
                                          <li><span style="color:#F00;">{name}</span> = Donor's Name</li>
                                          <li><span style="color:#F00;">{email}</span> = Donor's Email</li>
                                          <li><span style="color:#F00;">{mobile}</span> = Donor's Mobile</li>
                                          <li><span style="color:#F00;">{home}</span> = Donor's Home Phone</li>
                                          <li><span style="color:#F00;">{office}</span> = Donor's Office Phone</li>
                                        </ul>
                                      </p> -->
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Attach Images</label>
                                  <div class="controls">
                                      <table class="table">
                                        <tbody id="attachments">
                                          <tr>
                                            <td id="attachmentsImg" style="text-align:center; display:none;"><img src="<?=$imgPath?>loading.gif"></td>
                                          </tr>
                                        </tbody>
                                      </table>
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
<?php echo $lightboxJS;?>
<script type="text/javascript">
    $(document).ready(function () {
      $("#donorID").change(function(){
        $("#attachmentsImg").css("display","block");
        var donorID = $("#donorID").val();
        $.ajax({
          url: BASE_URL + 'administration/getSchoolImages',
          type: "POST",
          data: "donorID="+donorID,
          success: function (res) {
            $("#attachments").html(res);
          }, error: function (error) {
          }
        });
      });
    });

    function showDonors(){
      $("#showLoading").show();
      $.ajax({
        url: BASE_URL + 'administration/loadDonors/3',
        type: "POST",
        data: "donorType="+$("#donorType").val(),
        success: function (res) {
          $("#donorID").html(res);
          $("#showLoading").hide();
          $("#donorID").trigger("liszt:updated");
          // $("#form_field").trigger("chosen:updated");
        }
      });
    }
</script>
<?php echo $footer; ?>
