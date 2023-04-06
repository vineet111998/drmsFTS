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
                      Excel Data Preview
                      <small>This is a preview of your excel data</small>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="<?=base_url('drm')?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                        <li><a href="#">Excel Data Preview</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-tasks"></i> Excel Data Preview</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <!--<a href="javascript:;" class="icon-remove"></a>-->
                            </span>
                        </div>
                        <div class="widget-body">
                            <form action="<?=current_url();?>" method="post">
                              <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Donor ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Postal Code</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($donors as $val): ?>
                                    <tr>
                                      <td><?=$val["md_user_name"]?></td>
                                      <td><?=$val["md_title"]," ",$val["md_fname"]," ",$val["md_lname"];?></td>
                                      <td><?=$val["md_email"]?></td>
                                      <td><?=$val["md_address"]?></td>
                                      <td><?=$val["md_city"]?></td>
                                      <td><?=$val["md_state"]?></td>
                                      <td><?=$val["md_pin"]?></td>
                                      <td><?=$val["md_country"]?></td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                              <div class="space10"></div>
                              <div class="form-actions" style="text-align:center;">
                                <input type="submit" name="purge" id="submit" class="btn btn-danger btn-small" value="Purge Existing <?=$donorType?> Data & Upload">
                                <input type="submit" name="append" id="submit" class="btn btn-success btn-small" value="Append with Existing <?=$donorType?> Data">
                                <input type="submit" name="afresh" id="submit" class="btn btn-warning btn-small" value="Cancel">
                              </div>
                            </form>
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
<script type="text/javascript">
$(document).ready(function(){

}
</script>
<?php echo $footer; ?>
