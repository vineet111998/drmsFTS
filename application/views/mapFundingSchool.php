 <style type="text/css">
    .selectedschools tr td {
        padding: 15px 0;
        text-align: center;
        width: 33.33%;
     }
 </style>
 <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="display: flex; justify-content: space-between;">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                   <table style="width: 100%;">
                    <thead class="smodalsheades" style="border-bottom: 1px solid rgba(0,0,0,0.2);">
                       <tr>
                           <th>Funding Chapter:  <?php echo $fundingchapter[0]['mfc_desc']; ?></th>
                           <th>Region:  <?php echo $region; ?></th>
                           <th>Anchal: <?php echo $anchal; ?></th>
                       </tr>
                       </thead>
              

                       <tbody class="selectedschools">
                           
                       </tbody>
                   </table>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                    <button type="button" class="btn btn-primary confirmsubmit">Confirm</button>
                </div>
            </div>
        </div>
    </div>

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
                        <li><a href="<?php echo base_url() ?>fundingChapter/mapFunding/">Deallocate Funding Chapter</a><span class="divider-last ">&nbsp;</span></li>
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
                            <form action="#" class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="">
                            
                             <div class="control-group">
                                  <span class="control-label">Funding Chapter</span>
                                  <span><input type="text" name="fundingChapterDesc" value="<?php echo $fundingchapter[0]['mfc_desc']?>" id="donordesc" disabled>
                                    <input type="text" name="fundingchapter" value="<?php echo $fundingchapter[0]['mfc_id']?>" id="fundingchapterid" disabled>
                                    <input type="text" name="anchal" value="<?php echo $fundingchapter[0]['mfc_id']?>" id="donorID" disabled>
                                  </span>
                              </div>
                              <div class="control-group">
                                  <span class="control-label">Region</span>
                                  <span class="region" style="font-weight: bold;"> <?php echo $region; ?> </span>
                              </div>
                              <div class="control-group">
                                  <span class="control-label">Anchal</span>
                                  <span class="anchal" style="font-weight: bold;"> <?php echo $anchal; ?> </span>
                              </div>
                             <table class="table control-group">
                                <h3>School Details</h3>
                                <thead style="">
                                  <tr>
                                    <th>Select<input type="checkbox" id="select-all" name="" value=""></th>
                                    <th>Sl.No</th>
                                    <th>State</th>
                                    <th>Region Name</th>
                                    <th>Region Code</th>
                                    <th>Anchal Name</th>
                                    <th>Anchal Code</th>
                                    <th>School Name</th>
                                    <th>School Code</th>
                                      
                                  </tr>
                              </thead>
                                <tbody>
                                    <?php $i=1;foreach ($schoolDetails as $key => $value) {?>
                                    <tr>
                                        <td><input type='checkbox' id='checkbox' name='check' value="<?php echo $value['msd_school_code']?>" style="opacity: 1 !important;"></td>
                                        <td><?php echo  $i ?></td>
                                        <td contenteditable='true'><?php echo $value['msd_state']?></td>
                                        <td><?php echo $value['msd_region_name']?></td>
                                        <td><?php echo $value['msd_region_code']?></td>
                                        <td><?php echo $value['msd_anchal_name']?></td>
                                        <td><?php echo $value['msd_anchal_code']?></td>
                                        <td><?php echo $value['msd_school_name']?></td>
                                        <td><?php echo $value['msd_school_code']?></td>
                                        </tr>
                                    <?php $i++;} ?>
                                        <input type="text" id="school" name="schooldata" value="">
                                </tbody>
                                    
                                </table> 
                              
                                <div class="form-actions">
                                  <img id="submitLoading" style="display:none;" src="<?=base_url()."assets/img/loading.gif"?>" alt="">
                                  <input type="button" name="submitThread" id="submit" class="btn btn-success" value="Submit">

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
        console.log($(this).prop("checked"));
        $("input[type='checkbox']").prop("checked", $(this).prop("checked"));
        });

   

    $("#submit").click(function() {

        window.fundingchapter =$('#fundingchapterid').val();
        alert(window.fundingchapter)
         window.arr = [];
         window.htmlStr='<tr>';
        let checkboxes = document.querySelectorAll("input[name='check']:checked");
        console.log(checkboxes);
         for (let i = 1 ; i <= checkboxes.length; i++) {
            // console.log(checkboxes[i-1].value)
          window.arr.push(checkboxes[i-1].value);
          window.htmlStr=window.htmlStr+'<td>'+checkboxes[i-1].value+'</td>';

          if(i % 3 == 0 && i != checkboxes.length)
                window.htmlStr=window.htmlStr+'</tr><tr>';
          if(i == checkboxes.length)
          {
                window.htmlStr=window.htmlStr+'</tr>';
          }

         }
         console.log(window.htmlStr);

        window.schoolData=JSON.stringify(window.arr);

            
        $(".selectedschools").html(window.htmlStr)
          $("#myModal").modal('show');


     
      });    
     $(".confirmsubmit").click(function() {
       $.ajax({
                url: BASE_URL+"fundingChapter/uploadFundingChapter",
                data: {'schoolData': window.schoolData, 'fundingchapter': window.fundingchapter},
                type: 'POST', 
                success: function(result){
                    location.reload(true);
                }
            });
   });


    });

</script>
<?php echo $footer; ?>
