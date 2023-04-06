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
                                  <label class="control-label">Select Donor Name</label>
                                  <div class="controls">
                                      <select class="span6 donorId" name="donorId">
                                        <option value=""> -- SELECT -- </option>
                                        <?php foreach ($donoridlist as $value) { ?>
                                            <option value="<?=$value["md_code"]?>"><?=$value["md_name"]?></option>
                                        <?php } ?>
                                      </select>
                                      <input type="text" name="donorCode" class="donorCode" placeholder="Donor Code" value="" id="donorID" disabled>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Select Funding Chapter</label>
                                  <div class="controls">
                                      <select class="span6 fund" name="fund">
                                        <option value=""> -- SELECT -- </option>
                                        <?php foreach ($fundlist as $value) { ?>
                                            <option value="<?=$value["mfc_id"]?>"><?=$value["mfc_desc"]?></option>
                                        <?php } ?>
                                      </select>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Region</label>
                                  <div class="controls">
                                      <select class="span6 region" name="region">
                                        <option value=""> -- SELECT -- </option>
                                      </select>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Anchal</label>
                                  <div class="controls">
                                      <select class="span6 anchal" name="anchal" >
                                        <option value=""> -- SELECT -- </option>
                                        </select>
                                  </div>
                              </div>

                              <!-- <table class="table control-group">
                                 
                                <h3>School Details</h3>
                                <thead style="border: 2px solid black;">
                                  <tr>
                                      <th>State&emsp;&emsp;&emsp;</th>
                                      <th>Region Name</th>
                                      <th>Region Code</th>
                                      <th>Anchal Name</th>
                                      <th>Anchal Code</th>
                                      <th>School Name</th>
                                      <th>School Code</th>
                                      <th>Funding Chapter</th>
                                      <th>Select All<input type="checkbox" id="select-all" name="" value=""></th>
                                  </tr>
                                </theade>
                                <tbody>
                                </tbody>
                                    
                                </table> -->

                            

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

    // function showLoading(){
    //   $("#submit").hide();
    //   $("#submitLoading").show();
    // }

    $(".donorId").change(function(){
        var donorId=$(this).val();
        window.donor = donorId;
        $('.donorCode').val(donorId);
        // console.log(donorCode);
        // alert(donorId);
         $.ajax({
                    url: BASE_URL+"administration/getFundingchapterByDonorID/"+window.donor+"/1", 
                    success: function(result){
                   // console.log(fundingchapter);
                        $(".fund").html(result);
                    }
                });
        });

    $(".fund").change(function(){
                var fundingchapter=$(this).val();
                window.fund = fundingchapter;
                // console.log(fundingchapter);
                $.ajax({
                    url: BASE_URL+"administration/getRegionByFundingchapter/"+fundingchapter+"/1", 
                    success: function(result){
                   // console.log(fundingchapter);
                        $(".region").html(result);
                    }
                });
            });

    $(".region").change(function(){
                var regioncode=$(this).val();
                // alert(regioncode);
                $.ajax({
                    url: BASE_URL+"administration/getAnchalByRegionCode/"+regioncode+"/1", 
                    success: function(result){
                   // console.log(result);
                        $(".anchal").html(result);
                    }
                });
            });
    
    $(".anchal").change(function(){
                var anchalcode=$(this).val();
                var fundingchapter=window.fund;
                // alert(fundingchapter);
                $.ajax({
                    url: BASE_URL+"administration/getSchoolByAnchalCodeDonor/"+anchalcode+"/"+fundingchapter+"/1", 
                    success: function(result){
                        $("tbody").html(result);
                        }
                    });
                });
    $("#select-all").click(function() {
        $(".checkbox").prop("checked", $(this).prop("checked"));
        });

    // $("#submit").click(function() {
    //     var donorId =donor;
    //     // alert(donorId);
    //     $.ajax({
    //             url: BASE_URL+"administration/uploadDonorId/"+donorId+"/1", 
    //             success: function(result){
    //             // console.log(result);
    //                 // $("#tbody").html(result);
    //             }
    //         });
    //   });


    const check= [];
    $("#submit").click(function() {
        var donorId =window.donor;
        let arr = [];
        let checkboxes = document.querySelectorAll("input[type='checkbox']:checked");
        for (let i = 0 ; i < checkboxes.length; i++) {
            arr.push(checkboxes[i].value)
        }

        var schoolData=JSON.stringify(arr);

            // var checkboxValues = checkedCheckboxes.map(function() {
            //     return $(this).val();
            // }).get();
            // var postData = {
            //     checkboxes: checkboxValues
            // };
            $.ajax({
                    url: BASE_URL+"administration/uploadDonorId",
                    data: {'schoolData': schoolData, 'donorId': donorId},
                    type: 'POST', 
                    success: function(result){
                    // console.log(result);
                        // $("#tbody").html(result);
                    }
                });
            // location.href = BASE_URL+"administration/donor_allocation/"
          });
    });

    
</script>
<?php echo $footer; ?>
