
<?php echo $header;?>
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
                        Funding Chapter Allocation
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url() ?>drm#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?php echo base_url() ?>fundingChapter/mapFunding/">FC Allocation</a><span class="divider-last">&nbsp;</span></li>
                        <!-- <li><a href="/fts/administration/deallocate_fund/">Deallocate Funding Chapter</a><span class="divider-last ">&nbsp;</span></li> -->
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
                            <!-- <h4><i class="icon-upload"></i>Select Funding Chapter,Region,Anchal to Deallocate School</h4> -->
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url() ?>fundingChapter/mapFundingSchool/" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="">
                                <div class="control-group">
                                  <label class="control-label">Funding Chapter</label>
                                  <div class="controls">
                                      <select class="span6 fundingchapter" name="fundingchapter">
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
                                      <select class="span6 region " name="region">
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
                                      <select class="span6 anchal" name="anchal">
                                        <option value=""> -- SELECT -- </option>
                                       
                                      </select>
                                  </div>
                              </div>
                            
                             <!--  <table class="table control-group">
                                <h3>School Details</h3>
                                <thead style="border: 2px solid black;">
                                  <tr>
                                      <th>State</th>
                                      <th>Region Name</th>
                                      <th>Region Code</th>
                                      <th>Anchal Name</th>
                                      <th>Anchal Code</th>
                                      <th>School Name</th>
                                      <th>School Code</th>
                                      <th>Select All<input type="checkbox" id="select-all" name="" value=""></th>
                                  </tr>
                              </thead>
                                <tbody></tbody>
                                    
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
    $(".fundingchapter").change(function(){
        var fundingchapter=$(this).val();
        window.fund = fundingchapter;
        // alert(fundingchapter);
        });

    $(".region").change(function(){
                var regioncode=$(this).val();
                $.ajax({
                    url: BASE_URL+"administration/getAnchalByRegionCode/"+regioncode+"/1", 
                    success: function(result){
                        $(".anchal").html(result);
                    }
                });
            });
    $(".anchal").change(function(){
                var anchalcode=$(this).val();
                window.anchal=anchalcode;
                $.ajax({
                    url: BASE_URL+"administration/getSchoolByAnchalCode/"+anchalcode+"/1", 
                    success: function(result){
                   // console.log(result);
                        $("tbody").html(result);
                    }
                });
            });
    $("#select-all").click(function() {
        $(".checkbox").prop("checked", $(this).prop("checked"));
        });
    // function showLoading(){
    //   $("#submit").hide();
    //   $("#submitLoading").show();
    //   }
    // $("input[type='checkbox']").change(function(){
    //     $('#abcd').attr('contenteditable', 'true');
    // });
 const check= [];


    $("#submit").click(function() {
        var fundingchapter =window.fund;
         // var anchalcode = window.anchal;
        // confirm(count (arr));
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
                url: BASE_URL+"administration/uploadFundingChapter",
                data: {'schoolData': schoolData, 'fundingchapter': fundingchapter},
                type: 'POST', 
                success: function(result){
                console.log(result);
                    // $("#tbody").html(result);
                }
            });
        location.href = BASE_URL+"administration/map_funding/"
      });    
    });

</script>
<?php echo $footer; ?>
