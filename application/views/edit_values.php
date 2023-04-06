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
                            <h4><i class="icon-upload"></i><?php echo $schoolcode; ?> school info</h4>
                        </div>
                        <div class="widget-body form" >
                           <form action="<?php echo base_url()?>administration/uploadSifEditdata" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <!-- BEGIN FORM  <?php echo $schoolcode; ?>-->
                              <?php foreach($schoolList as $school){ ?>
                              <div class="control-group">
                                  <span class="control-label">CSR&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_csr" value="<?php echo $school['msd_csr']; ?>" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">TEACHER NAME&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Teacher" value="<?php echo $school['msd_Teacher']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">TEACHER GENDER&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_teacher_sex" value="<?php echo $school['msd_teacher_sex']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">BOYS&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Boys" value="<?php echo $school['msd_Boys']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">GIRLS&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Girls" value="<?php echo $school['msd_Girls']; ?>" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">TOTAL&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_total" value="<?php echo $school['msd_total']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">DATE OF OPENING&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_date_of_opening" value="<?php echo $school['msd_date_of_opening']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">POPULATION&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_population" value="<?php echo $school['msd_population']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">LITERACY RATE MALE&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Literacy_Rate_Male" value="<?php echo $school['msd_Literacy_Rate_Male']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">LITERACY RATE FEMALE&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Literacy_Rate_Female" value="<?php echo $school['msd_Literacy_Rate_Female']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">VIDYALAYA SAMITY PRAMUKH&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Vidyalaya_Samity_Pramukh" value="<?php echo $school['msd_Vidyalaya_Samity_Pramukh']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">NEAREST RAILWAY STATION&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Nearest_Railway_Station" value="<?php echo $school['msd_Nearest_Railway_Station']; ?>" id="donorID"></span>
                              </div>
                              <div class="control-group">
                                  <span class="control-label">DISTANCE OF VIDYALAYA<br>FROM CLUSTER&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="distanceFromCluster" value="<?php echo $school['msd_Distance_Of_Vidyalaya_From_Cluster']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">DISTANCE OF CLUSTER<br>FROM RAILWAY STATION&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Distance_Cluster_From_Rly_Station" value="<?php echo $school['msd_Distance_Cluster_From_Rly_Station']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">VCF NAME&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_VCF_Name" value="<?php echo $school['msd_VCF_Name']; ?>" id="donorID"></span>
                              
                              </div><div class="control-group">
                                  <span class="control-label">VCF PHONE&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_VCF_Phone" value="<?php echo $school['msd_VCF_Phone']; ?>" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">SCF NAME&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_SCF_Name" value="<?php echo $school['msd_SCF_Name']; ?>" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">SCF EMAIL&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_SCF_Email" value="<?php echo $school['msd_SCF_Email']; ?>" id="donorID"></span>
                              </div>
                              <div class="control-group">
                                  <span class="control-label">SCF PHONE&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_SCF_Phone" value="<?php echo $school['msd_SCF_Phone']; ?>" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">DATE OF UPLOAD&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_Date_Of_Updation" value="<?php echo $school['msd_sif_update']; ?>" id="donorID"></span>
                              
                              </div>
                              <div class="control-group">
                                  <span class="control-label">SIF UPDATION&nbsp;&nbsp;&nbsp;</span>
                                  <span><input type="text" name="msd_sif_update" value="<?php echo $school['msd_Date_Of_Updation']; ?>" id="donorID"></span>
                              </div>
                            <?php }?>
                            <div class="" style="visibility: hidden;">
                                  <!-- <span class="control-label">CSR&nbsp;&nbsp;&nbsp;</span> -->
                                  <span><input type="text" name="msd_school_code" value="<?php echo $schoolcode; ?>" id="donorID"></span>
                              </div>
                              <div class="form-actions">
                                  <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Submit">
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
   
      // document.getElementById("submit").onclick = function (){
      // //             var schoolCode="<?php echo $schoolcode; ?>";
      // //             alert(schoolCode);
      // //             let arr = [];
      // //             let textboxes = document.querySelectorAll("input[type='text']");
      // //             for (let i = 0 ; i < textboxes.length; i++) {
      // //               arr.push(textboxes[i].value)
      // //             }
      // //           var schoolData=JSON.stringify(arr);
      // //           alert(schoolData);
      // //       //     $.ajax({
      // //       //     url: BASE_URL+"administration/uploadSifEditdata",
      // //       //     data: {'schoolData': schoolData, 'schoolCode': schoolCode},
      // //       //     type: 'POST', 
      // //       //     success: function(result){
      // //       //     console.log(result);
      // //       //         // $("#tbody").html(result);
      //       location.href = BASE_URL+"administration/edit_page/"
      //           }
      // //       // });

        $("#submit").click(function() {
        // var fundingchapter =window.fund;
        //  // var anchalcode = window.anchal;
        // // confirm(count (arr));
        // let arr = [];
        // let checkboxes = document.querySelectorAll("input[type='checkbox']:checked");
        //  for (let i = 0 ; i < checkboxes.length; i++) {
        //   arr.push(checkboxes[i].value)
        //  }

        // var schoolData=JSON.stringify(arr);
        // // var checkboxValues = checkedCheckboxes.map(function() {
        // //     return $(this).val();
        // // }).get();
        // // var postData = {
        // //     checkboxes: checkboxValues
        // // };
        // $.ajax({
        //         url: BASE_URL+"administration/uploadFundingChapter",
        //         data: {'schoolData': schoolData, 'fundingchapter': fundingchapter},
        //         type: 'POST', 
        //         success: function(result){
        //         console.log(result);
        //             // $("#tbody").html(result);
        //         }
        //     });
        // // $.ajax({
        // //             url: BASE_URL+"administration/getSchoolByAnchalCodedeallocate/"+anchalcode+"/1", 
        // //             success: function(result){
        // //            // console.log(result);
        // //                 $("tbody").html(result);
        // //             }
        // //         });
        location.href = BASE_URL+"administration/edit_page/"
      });

        };
</script>
<?php echo $footer; ?>
