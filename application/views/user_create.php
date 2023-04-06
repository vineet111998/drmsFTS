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
         <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-upload"></i>school info</h4>
                        </div>
                        <div class="widget-body form" >
            <!-- BEGIN FORM  <?php echo $schoolcode; ?>-->
                        <form action="<?php echo base_url()?>administration/uploadSifEditdata" class="form-horizontal" method="POST" enctype="multipart/form-data">
                              <div class="control-group">
                                  <span class="control-label">USER NAME&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="username" value="" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">PASSWORD&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="password"  id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">MOBILE NO.&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="mobile"  id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">EMAIL ID&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="email" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">TYPE-1&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="checkbox" name="user_roll_A" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">TYPE-2&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="checkbox" name="user_roll_B"  id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">TYPE-3&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="checkbox" name="user_roll_c"  id="donorID"></span>
                              </div>
                              <div class="control-group">
                                  <span class="control-label">TYPE-4&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="checkbox" name="user_roll_D"  id="donorID"></span>
                              </div>
                              <div class="form-actions">
                                  <input type="submit" name="submit" id="submit" class="btn btn-success" value="Submit">
                                </div> 
                        </form>    
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
        
    //     
    // $(".fund").change(function(){
    //             var fundingchapter=$(this).val();
    //             // var fundingchapter=xyz.trim().replace(/\s+/g, '_');
    //             // console.log(fundingchapter);
    //             $.ajax({
    //                 url: BASE_URL+"administration/getSchoolByFundingchapter/"+fundingchapter+"/1", 
    //                 success: function(result){
    //                console.log(fundingchapter);
    //                     $("tbody").html(result);
    //                 }
    //             });
    //         });

      $("#submit").click(function(){
                  var schoolCode="<?php echo $schoolcode; ?>";
                  alert(schoolCode);
                  let arr = [];
                  let checkboxes = document.querySelectorAll("input[type='text']");
                  for (let i = 0 ; i < checkboxes.length; i++) {
                    arr.push(checkboxes[i].value)
                  }
                var schoolData=JSON.stringify(arr);
            //     $.ajax({
            //     url: BASE_URL+"administration/uploadFundingChapter",
            //     // data: {'schoolData': schoolData, 'schoolCode': schoolCode},
            //     type: 'POST', 
            //     success: function(result){
            //     console.log(result);
            //         // $("#tbody").html(result);
            //     }
            // });
        });
</script>
<?php echo $footer; ?>
