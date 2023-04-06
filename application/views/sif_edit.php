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
                        SIF Verification
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/fts/drm#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">SIF Verification</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-upload"></i>Sif Data Edit</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                              
                              <div class="control-group">
                                  <label class="control-label">Region</label>
                                  <div class="controls">
                                      <select class="span6 region" >
                                        <option value=""> -- SELECT -- </option>
                                        <?php foreach ($regionlist as $value) { ?>
                                            <option value="<?=$value["msd_region_code"]?>"><?=$value["msd_region_name"]?></option>
                                        <?php } ?>
                                      </select>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Anchal</label>
                                  <div class="controls">
                                      <select class="span6 anchal" >
                                        <option value=""> -- SELECT -- </option>
                                      </select>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Sanch</label>
                                  <div class="controls">
                                      <select class="span6 sanch" >
                                        <option value=""> -- SELECT -- </option>
                                      </select>
                                  </div>
                              </div>
                              <div></div>
                              <!-- <div class="tablecontainer" style="width: 100%; display: block; overflow: auto;">
                              <table class="control-group table" style="overflow:auto;">
                                  <h3>School Details</h3>
                                  <thead border: 2px solid black;>
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
                                <tbody></tbody>
                                </table>
                              </div> -->

                                <!-- <div class="form-actions">
                                  <img id="submitLoading" style="display:none;" src="<?=base_url()."assets/img/loading.gif"?>" alt="">
                                  <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Submit">
                                </div> -->
                                <button type="button" name="submitThread" id="submit" class="btn btn-success" value="Submit" >submit</button>
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
    $(".region").change(function(){
                var regioncode=$(this).val();
                // alert(regioncode);
                $.ajax({
                    url: BASE_URL+"administration/getAnchalByRegionCodesif/"+regioncode+"/1", 
                    success: function(result){
                   // console.log(result);
                        $(".anchal").html(result);
                    }
                });
            });
    
    $(".anchal").change(function(){
                var anchalcode=$(this).val();
                // alert(anchalcode);
                $.ajax({
                    url: BASE_URL+"administration/getSanchByAnchalCodesif/"+anchalcode+"/1", 
                    success: function(result){
                        $(".sanch").html(result);
                        }
                    });
                });

    $(".sanch").change(function(){
                var sanchcode=$(this).val();
                window.sanch=sanchcode;
                // alert(anchalcode);
                // $.ajax({
                //     url: BASE_URL+"administration/getSchoolBySanchCodesif/"+sanchcode+"/1", 
                //     success: function(result){
                //         $("tbody").html(result);
                //         }
                //     });
                });
    document.getElementById("submit").onclick = function () {
        var sanchcode = window.sanch;
        location.href = BASE_URL+"administration/edit_page/"+sanchcode;
    };
    // $(".test").click(function(){
    //     var schoolCode=$(this).val();
    //         alert(schoolCode);

    // });

    // $("input[type='checkbox']").click(function(){
    //             $('.edit').attr('contenteditable', 'true');
    //             });
    // var contents = $('.edit').html();
    //     $('.edit').change(function() {
    //         if (contents!=$(this).html()){
    //             alert('Handler for .change() called.');
    //             contents = $(this).html();
    //         }
    //     });

    // $("button").click(function(){
    //     var sanchcode=$(this).val();
    //             alert(sanchcode);
    //             });

    });
</script>
<?php echo $footer; ?>
