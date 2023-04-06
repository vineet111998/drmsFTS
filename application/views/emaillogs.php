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
                        Email Logs
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?=base_url("drm")?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?=base_url("drm")?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                        <li><a href="#">Email Logs</a><span class="divider-last">&nbsp;</span></li>
                        <!-- <li class="pull-right search-wrap">
                            <form id="form1" name="form1" class="hidden-phone" action="<?=current_url()?>" method="post">
                                <div class="search-input-area">
                                    <input name="search" class="search-query" placeholder="Search Donor" type="text">
                                    <i class="icon-search" onclick="document.form1.submit();"></i>
                                </div>
                            </form>
                        </li> -->
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
                            <h4><i class="icon-tasks"></i> Logs</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <!--<a href="javascript:;" class="icon-remove"></a>-->
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a id="sample_editable_1_new"
                                       class="btn btn-small btn-danger"
                                       href="<?=  base_url('drm/emailLogs/1');?>"
                                       onclick="return confirm('Are you sure you want to clear all email logs?')">
                                        <!-- <i class="icon-trash"></i>  -->
                                        Clear Log
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a id="sample_editable_1_new"
                                       class="btn btn-small btn-info"
                                       href="<?=  base_url('drm/exportLog/'.$type);?>">
                                        <!-- <i class="icon-send"></i>  -->
                                        Export
                                    </a>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-bordered table-hover dataTable" id="sample_1">
                                <thead>
                                    <tr>
                                        <th>Donor ID</th>
                                        <th style="width:20%">Donor Name</th>
                                        <th style="width:20%">Email ID</th>
                                        <th style="width:20%">Mail Type</th>
                                        <th style="width:20%">Sent</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                      foreach($logs as $val):
                                    ?>
                                    <tr>
                                      <td><?php echo $val["md_user_name"]?></td>
                                      <td><?php echo $val["donorname"]?></td>
                                      <td><?php echo $val["tel_email"]?></td>
                                      <td><?php echo $mailType[$val["tel_mailType"]]?></td>
                                      <td><?php echo date("F d, Y h:i A",strtotime($val["tel_timestamp"]))?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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
