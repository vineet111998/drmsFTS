<?php echo $header; ?>

<!-- BEGIN CONTAINER -->
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
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        List of Schools
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?=base_url('drm')?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                        <li><a href="#">List of Schools</a><span class="divider-last">&nbsp;</span></li>
                        <li class="pull-right search-wrap">
                            <form id="form1" name="form1" class="hidden-phone" action="<?=current_url()?>" method="post">
                                <div class="search-input-area">
                                    <input name="search" class="search-query" placeholder="Search School" type="text" value="<?=$searchQuery?>">
                                    <i class="icon-search" onclick="document.form1.submit();"></i>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
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
                    <!-- BEGIN BORDERED TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> List of Schools</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <!--<a href="javascript:;" class="icon-remove"></a>-->
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- <div class="clearfix">
                                <div class="btn-group">
                                    <a id="sample_editable_1_new"
                                       class="btn btn-small btn-primary"
                                       href="<?=  base_url('administration/uploadDonors');?>">
                                        <i class="icon-upload"></i> Upload Donors
                                    </a>
                                </div>
                            </div> -->
                            <!-- <div class="space15"></div> -->
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                      <th>School</th>
                                      <!-- <th>Available Images</th> -->
                                    </tr>
                                </thead>

                                <tbody class="periods">
                                  <?php foreach($res as $val):?>
                                  <tr>
                                    <td><span onclick="checkStatus(<?=$val["connectAppImgCount"]?>,'<?php echo $val["mds_school_code"] ?>')" style="cursor:pointer;color:#1D9BA6;"><?php echo $val["mds_school_code"] ?></span></td>
                                    <!-- <td>
                                      <?php if($val["connectAppImgCount"]){ ?>
                                      <a href="<?=base_url()."drm/showSchool/".$val["mds_school_code"]?>" class="content"><?php echo $val["connectAppImgCount"] ?></a>
                                      <?php } else {
                                        echo $val["connectAppImgCount"];
                                      }?>
                                    </td> -->
                                    <!-- <td><a class="btn btn-small btn-info" href="<?php echo base_url("administration/donorsState")."/".$val["schoolCode"]?>">Show Donors</a></td> -->
                                  </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php if(!$searchQuery): ?>
                            <div style="text-align:right;">
                              <?php echo $this->pagination->create_links();?>
                            </div>
                          <?php endif; ?>
                        </div>
                    </div>
                    <!-- END BORDERED TABLE widget-->
                </div>
            </div>

            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<?php echo $tablesJS;?>
<script type="text/javascript">

function checkStatus(countImg, schoolCode){
  if(parseInt(countImg)){
    var url = 'http://connectapp.net/dev/fts/portal/schools/'+$.trim(schoolCode);
    window.open(url, '_blank');
  } else {
    alert("No school pictures uploaded for this school from Connectapp");
  }
}

</script>
<?php echo $footer; ?>
