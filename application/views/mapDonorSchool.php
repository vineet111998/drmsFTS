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
                        DRMS Donor Allocation
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/fts/drm#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">DRMS Donor Allocation</a><span class="divider-last">&nbsp;</span></li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-upload"></i> Donor Allocate</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url() ?>donor/mapDonorSchool" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="">

                              <div class="control-group">
                                  <span class="control-label">Donor Name</span>
                                    <input type="text" name="donorName" value="<?php echo $getDonor[0]['md_name'] ?>" id="donordesc" disabled>
                              </div>

                              <div class="control-group">
                                  <span class="control-label">Donor Code</span>
                                    <input type="text" name="donorCode" value="<?php echo $getDonor[0]['md_code']?>" id="donorID" disabled>
                              </div>

                              <table class="table control-group">
                                 
                                <h3>School Details</h3>
                                <thead style="border: 2px solid black;">
                                  <tr>
                                    <th>Select All<input type="checkbox" id="select-all" name="" value=""></th>
                                    <th>Sl.No</th>
                                      <th>State&emsp;&emsp;&emsp;</th>
                                      <th>Region Name</th>
                                      <th>Region Code</th>
                                      <th>Anchal Name</th>
                                      <th>Anchal Code</th>
                                      <th>School Name</th>
                                      <th>School Code</th>
                                      <th>Funding Chapter</th>
                                      
                                  </tr>
                                </theade>
                                <tbody>
                                    <tbody>
                                    <?php $i=1;foreach ($schoolDetails as $key => $value) {?>
                                    <tr>
                                        <td><input type='checkbox' id='checkbox' name='' value="<?php echo $value['msd_school_code']?>" ></td>
                                        <td><?php echo  $i ?></td>
                                        <td contenteditable='true'><?php echo $value['msd_state']?></td>
                                        <td><?php echo $value['msd_region_name']?></td>
                                        <td><?php echo $value['msd_region_code']?></td>
                                        <td><?php echo $value['msd_anchal_name']?></td>
                                        <td><?php echo $value['msd_anchal_code']?></td>
                                        <td><?php echo $value['msd_school_name']?></td>
                                        <td><?php echo $value['msd_school_code']?></td>
                                        <td><?php echo $value['mfc_desc']?></td>
                                        </tr>
                                    <?php $i++;} ?>
                                </tbody>
                                </tbody>
                                    
                                </table>

                            

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
        var BASE_URL="<?php echo $base_url; ?>";

    $("#select-all").click(function() {
        $(".checkbox").prop("checked", $(this).prop("checked"));
        });
    
    
    });

    
</script>
<?php echo $footer; ?>
