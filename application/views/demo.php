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
                        Dummy Page
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Dummy Page</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-tasks"></i> Dummy Page</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <!--<a href="javascript:;" class="icon-remove"></a>-->
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="clearfix">
                                <!-- <div class="btn-group">
                                    <a id="sample_editable_1_new"
                                       class="btn btn-small btn-inverse"
                                       href="<?=  base_url();?>threads/add">
                                        Add New Thread <i class="icon-plus"></i>
                                    </a>
                                </div> -->
                            </div>
                            <div class="space15"></div>
                            <table class="table table-bordered table-hover dataTable" id="sample_1">
                                <thead>
                                    <tr>
                                        <th>Donor ID</th>
                                        <th>Donor Name</th>
                                        <th>Donor Contact</th>
                                        <th>Donor Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php //foreach($donors as $val):?>
                                    <!-- <tr>
                                        <td><?php echo $val["md_user_name"]?></td>
                                        <td><?php echo $val["md_title"]." ".$val["md_fname"]." ".$val["md_lname"]?></td>
                                        <td><a href="tel:<?php echo $val["md_mobile"]?>"><?php echo $val["md_mobile"]?></a></td>
                                        <td><a href="mailto:<?php echo $val["md_email"]?>"><?php echo $val["md_email"]?></a></td>
                                        <td>
                                          <a href="" class="btn btn-info btn-small"><i class="icon-edit"></i> Edit</a>
                                          <a href="" class="btn btn-danger btn-small" onclick="return confirm('Are you sure you want to delete this donor? The supported schools related to this donor will be deleted too.');"><i class="icon-trash"></i> Delete</a>
                                        </td>
                                    </tr> -->
                                    <?php //endforeach;?>
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
<?php echo $footer; ?>
