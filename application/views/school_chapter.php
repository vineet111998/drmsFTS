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
                        Search School
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href=""><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Search School</a><span class="divider-last">&nbsp;</span></li>
                    </ul>
                </div>
            </div>
            
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-upload"></i>school info</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                              <div class="control-group">
                                  <label class="control-label">Select Funding Chapter</label>
                                  <div class="controls">
                                      <select class="span6 fund">
                                        <option value=""> -- SELECT -- </option>
                                        <?php foreach ($fundlist as $value) { ?>
                                            <option value="<?=$value["mfc_desc"]?>"><?=$value["mfc_desc"]?></option>
                                        <?php } ?>
                                      </select>
                                  </div>
                                  <!-- <input type="text" name="" id="donorID"> -->
                              <!-- <button id="enter" type="button">submit</button> -->
                              </div>
                              
                              <table class="table control-group">
                                <h3>School Details</h3>
                                <thead>
                                  <tr>
                                      <th>State</th>
                                      <th>Region Name</th>
                                      <th>Region Code</th>
                                      <th>Anchal Name</th>
                                      <th>Anchal Code</th>
                                      <th>School Name</th>
                                      <th>School Code</th>
                                      <th>Funding Chapter</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>

                                </table>


                                <div class="form-actions">
                                  <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Close">
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
        var BASE_URL="<?php echo $base_url; ?>";
        
        function showLoading(){
      // $("#submit").hide();
      // $("#submitLoading").show();
    }

    $(".fund").change(function(){
                var fundingchapter=$(this).val();
                // var fundingchapter=xyz.trim().replace(/\s+/g, '_');
                // console.log(fundingchapter);
                $.ajax({
                    url: BASE_URL+"administration/getSchoolByFundingchapter/"+fundingchapter+"/1", 
                    success: function(result){
                   console.log(fundingchapter);
                        $("tbody").html(result);
                    }
                });
            });

       // $("#submit").click(function(){

       //          var donorID=$("#donorID").val();
       //          alert(donorID);
       //              $.ajax({
       //              url: BASE_URL+"administration/getSchoolByDonorCodeFromchmp", 
       //              type: 'GET',
       //              data: {"donorID": donorID},
       //              success: function(result){
       //             console.dir(result);
       //                  // $("#tbody").html(result);
       //              }
       //          });
       //      });


    });
</script>
<?php echo $footer; ?>
