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
                        Donors <?php echo (!empty($fromState))?" (".$fromState.")":""; ?>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?=base_url("drm")?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?=base_url("drm")?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                        <?php if(!empty($fromState)){ ?>
                        <li><a href="<?=base_url("administration/states")?>">States</a><span class="divider">&nbsp;</span></li>
                        <?php } ?>
                        <li><a href="#">Donors</a><span class="divider-last">&nbsp;</span></li>
                        <li class="pull-right search-wrap">
                            <form id="form1" name="form1" class="hidden-phone" action="<?=current_url()?>" method="post">
                                <div class="search-input-area">
                                    <input name="search" class="search-query" placeholder="By Donor ID or Name or Email" type="text">
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
                            <h4><i class="icon-tasks"></i> List</h4>
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
                            <div class="space15"></div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Schools</th>
                                        <th>Email</th>
                                        <th style="min-width:300px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach($donors as $val):
                                      if(!empty($val)){
                                        $contact = ($val["md_mobile"])?$val["md_mobile"]:$val["md_office_phone"];
                                    ?>
                                    <tr>
                                        <td><?php echo $val["md_user_name"]?></td>
                                        <td><?php echo $val["md_title"]." ".$val["md_fname"]." ".$val["md_lname"]?></td>
                                        <td><a href="tel:<?php echo $contact?>"><?php echo $contact?></a></td>
                                        <td><?php echo $val["schoolCount"]; ?></td>
                                        <td><a href="mailto:<?php echo $val["md_email"]?>"><?php echo $val["md_email"]?></a></td>
                                        <td>
                                          <a href="<?php echo base_url('administration/editDonor/'.$val["md_id"])?>" class="btn btn-info btn-small"><i class="icon-edit"></i> Edit</a>
                                          <a href="<?php echo base_url('administration/delDonor/'.$val["md_id"])?>" class="btn btn-danger btn-small" onclick="return confirm('Are you sure you want to delete this donor? The supported schools related to this donor will be deleted too.');"><i class="icon-trash"></i> Delete</a>
                                          <a href="<?php echo base_url('drm/listSchools/'.$val["md_id"])?>" class="btn btn-primary btn-small"><i class="icon-briefcase"></i> Schools</a>
                                          <a href="<?php echo base_url('administration/fetchSchools/'.$val["md_id"].'/'.$val["md_user_name"])?>" class="btn btn-small content"><i class="icon-file"></i> Report</a>
                                        </td>
                                    </tr>
                                    <?php } endforeach;?>
                                </tbody>
                            </table>
                            <?php //if($totalCount > 50): ?>
                              <div style="text-align:right;">
                                <?php echo $this->pagination->create_links();?>
                              </div>
                            <?php //endif; ?>
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
<?php echo $lightboxJS;?>
<?php echo $footer; ?>
