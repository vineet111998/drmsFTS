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
                        Edit School Data
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/fts/drm#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">School Data</a><span class="divider-last">&nbsp;</span></li>
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
                              <div class="tablecontainer" style="width: 100%; display: block; overflow: auto;">
                              <table class="control-group table" style="overflow:auto;">
                                  <h3>School Details</h3>
                                  <thead style="border: 2px solid black;">
                                  <tr>
                                      <th>Edit</th>
                                      <th>Funding Chapter</th>
                                      <th>CSR</th>
                                      <th>State</th>
                                      <th>Region Name</th>
                                      <th>Region Code</th>
                                      <th>Anchal Name</th>
                                      <th>Anchal Code</th>
                                      <th>Sankul Name</th>
                                      <th>Sankul Code</th>
                                      <th>Sanch Name</th>
                                      <th>Sanch Code</th>
                                      <th>Sanch Date of Opening</th>
                                      <th>Upsanch Name</th>
                                      <th>Upsanch Code</th>
                                      <th>School Code</th>
                                      <th>Donor Name</th>
                                      <th>Donor Code</th>
                                      <th>Village</th>
                                      <th>Teacher</th>
                                      <th>Teacher Gender</th>
                                      <th>Boys</th>
                                      <th>Girls</th>
                                      <th>Total</th>
                                      <th>Date of Opening</th>
                                      <th>Population</th>
                                      <th>Literacy Rate Male</th>
                                      <th>Literacy Rate Male</th>
                                      <th>Vidyalaya Samity Pramuh</th>
                                      <th>Nearest Railway Station</th>
                                      <th>Distance of Vidyalaya from Cluster</th>
                                      <th>Distance of Vidyalaya from RLY Station</th>
                                      <th>VCF Name</th>
                                      <th>VCF Phone</th>
                                      <th>SCF Name</th>
                                      <th>SCF Email</th>
                                      <th>SCF Phone</th>
                                      <th>Date of Updation</th>
                                      <th>SIF Updation</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php foreach($schoolList as $school){ ?>
                                    <tr>
                                        <td><a Class='test' href="/fts/administration/edit_values/<?php echo $school['msd_school_code']?>" style='padding:5px; border: 2px solid red; border-radius: 5px; font-size:20px;'><i class='icon-edit'></i></a></td>

                                        <td><?php echo $school['mfc_desc']; ?></td>
                                        <td><?php echo $school['msd_csr']; ?></td>
                                        <td><?php echo $school['msd_state']; ?></td>
                                        <td><?php echo $school['msd_region_name']; ?></td>
                                        <td><?php echo $school['msd_region_code']; ?></td>
                                        <td><?php echo $school['msd_anchal_name']; ?></td>
                                        <td><?php echo $school['msd_anchal_code']; ?></td>
                                        <td><?php echo $school['msd_sankul_name']; ?></td>
                                        <td><?php echo $school['msd_sankul_code']; ?></td>
                                        <td><?php echo $school['msd_sanch_name']; ?></td>
                                        <td><?php echo $school['msd_sanch_code']; ?></td>
                                        <td><?php echo $school['msd_sanch_opening_date']; ?></td>
                                        <td><?php echo $school['msd_upsanch_name']; ?></td>
                                        <td><?php echo $school['msd_upsanch_code']; ?></td>
                                        <td><?php echo $school['msd_school_code']; ?></td>
                                        <td></td>
                                        <td><?php echo $school['md_macd_name']; ?></td>
                                        <td><?php echo $school['msd_school_name']; ?></td>
                                        <td><?php echo $school['msd_Teacher']; ?></td>
                                        <td><?php echo $school['msd_teacher_sex']; ?></td>
                                        <td><?php echo $school['msd_Boys']; ?></td>
                                        <td><?php echo $school['msd_Girls']; ?></td>
                                        <td><?php echo $school['msd_total']; ?></td>
                                        <td><?php echo $school['msd_date_of_opening']; ?></td>
                                        <td><?php echo $school['msd_population']; ?></td>
                                        <td><?php echo $school['msd_Literacy_Rate_Male']; ?></td>
                                        <td><?php echo $school['msd_Literacy_Rate_Female']; ?></td>
                                        <td><?php echo $school['msd_Vidyalaya_Samity_Pramukh']; ?></td>
                                        <td><?php echo $school['msd_Nearest_Railway_Station']; ?></td>
                                        <td><?php echo $school['msd_Distance_Of_Vidyalaya_From_Cluster']; ?></td>
                                        <td><?php echo $school['msd_Distance_Cluster_From_Rly_Station']; ?></td>
                                        <td><?php echo $school['msd_VCF_Name']; ?></td>
                                        <td><?php echo $school['msd_VCF_Phone']; ?></td>
                                        <td><?php echo $school['msd_SCF_Name']; ?></td>
                                        <td><?php echo $school['msd_SCF_Email']; ?></td>
                                        <td><?php echo $school['msd_SCF_Phone']; ?></td>
                                        <td><?php echo $school['msd_Date_Of_Updation']; ?></td>
                                        <td><?php echo $school['msd_sif_update']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                </table>
                              </div>                          

                                <!-- <div class="form-actions">
                                  <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Submit">
                                </div> -->
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
<!-- <script type="text/javascript">
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
</script> -->
<?php echo $footer; ?>
