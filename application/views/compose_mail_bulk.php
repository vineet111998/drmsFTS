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
                        Send Bulk Email
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?=base_url();?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Send Bulk Email</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-envelope"></i> Send Bulk Email</h4>
                        </div>
                        <div class="widget-body form">
                          <?php echo (!empty($res))?"<h3>Your message will be like this.</h3><br>".$res:""; ?>
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="showLoading();">
                              <div class="control-group">
                                  <label class="control-label">Session</label>
                                  <div class="controls">
                                      <select class="span8" name="donorType" id="donorType" onchange="showDonors()">
                                        <option value="">-- SELECT -- </option>
                                        <option value="DPS">DPS</option>
                                        <option value="RMS">RMS</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Donors</label>
                                  <div class="controls">
                                      <select class="span8" name="donors[]" id="donors" multiple="multiple">
                                      </select>
                                      <br><small id="showLoading" style="font-weight:bold;color:#f00;"></small>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Subject</label>
                                  <div class="controls">
                                    <select class="span8 chosen" name="subject">
                                      <?php foreach($subjects as $sub) { ?>
                                        <option value="<?=$sub["mes_sub"]?>"><?=$sub["mes_sub"]?></option>
                                      <?php } ?>
                                    </select>
                                    <!-- <input type="text" name="subject" id="subject" class="span8"> -->
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Compose Newsletter</label>
                                  <div class="controls">
                                      <textarea class="span12 ckeditor" name="editor1" rows="6"></textarea>
                                      <p class="help-block">
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
                                      </p>
                                      <p>
                                        <strong style="text-decoration: underline;">Example (How to compose email body) :</strong><br/>
                                        Dear {name}, Wishing you a Happy New Year.<br/>
                                        <strong style="text-decoration: underline;">Output (When donor will receive the mail):</strong><br/>
                                        Dear XYZ, Wishing you a Happy New Year.
                                      </p>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Attachment</label>
                                  <div class="controls">
                                      <input type="file" name="userfile" id="userfile">
                                      <p><small>(Filesize should not be exceeded to 10 MB)</small></p>
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
    $(document).ready(function () {
      $(".chosen").chosen({ search_contains: true });
        var i = $("#add_row").data("start");
        $("#add_row").click(function () {
            var html = '<tr id="addr' + (i + 1) + '">';
            html += '<td><input type="text" name="degrees['+(i + 1)+'][md_name]" class="span12"/></td>';
            html += '<td><textarea name="degrees['+(i + 1)+'][md_details]" class="span12" placeholder="Degree Description"></textarea></td>';
            html += '<td><a class="btn btn-small btn-danger" onclick="deleteRow(' + (i + 1) + ');"><i class="icon-trash"></i></a></td>';
            '</tr>';
            $('#tab_logic').append(html);
            i++;
        });
    });

    function showLoading(){
      $("#submit").hide();
      $("#submitLoading").show();
    }

    function deleteRow(id) {
        $("#addr" + id).remove();
    }

    function showDonors(){
      $("#showLoading").text("Loading Donors... Please Wait...");
      $.ajax({
        url: BASE_URL + 'administration/loadDonors/2',
        type: "POST",
        data: "donorType="+$("#donorType").val(),
        success: function (res) {
          $("#donors").html(res);
          $("#showLoading").text("");
        }
      });
    }
</script>
<?php echo $footer; ?>
