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
                      GKV Report
                    </h3>
                    <ul class="breadcrumb">
                      <li><a href="<?=base_url('drm')?>">Dashboard</a><span class="divider">&nbsp;</span></li>
                      <li><a href="<?=base_url('drm/listSchools')?>">List of Associated Schools</a><span class="divider">&nbsp;</span></li>
                      <li><a href="<?=base_url('drm/showPeriods/'.base64_encode($schoolCode))?>">List of Periods</a><span class="divider">&nbsp;</span></li>
                      <li><a href="#">GKV Report</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-plus-sign"></i> GKV Report</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST">
                                <div class="control-group">
                                    <label class="control-label">School Days</label>
                                    <div class="controls">
                                        <?=$gkv["mgkvd_sch_day"]?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Boys Present</label>
                                    <div class="controls">
                                        <?=$gkv["mgkvd_present_boys"]?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Girls Present</label>
                                    <div class="controls">
                                        <?=$gkv["mgkvd_present_girls"]?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Balak Present</label>
                                    <div class="controls">
                                        <?=$gkv["mgkvd_balak"]?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Kishore Present</label>
                                    <div class="controls">
                                        <?=$gkv["mgkvd_kishore"]?>
                                    </div>
                                </div>

                                <!-- <div class="form-actions">
                                    <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Submit">
                                </div> -->
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
        var i = $("#add_row").data("start");
        $("#add_row").click(function () {
            var html = '<tr id="addr' + (i + 1) + '">';
            html += '<td><input type="text" name="degrees['+(i + 1)+'][md_name]" class="span12"/></td>';
            html += '<td><textarea name="degrees['+(i + 1)+'][md_details]" class="span12" placeholder="Degree Description"></textarea></td>';
            html += '<td><a class="btn btn-small btn-danger" onclick="deleteRow(' + (i + 1) + ');"><i class="icon-trash"></i></a></td>';
            '</tr>';
            $('#tab_logic').append(html);
            i++;
        });
    });

    function deleteRow(id) {
        $("#addr" + id).remove();
    }
</script>
<?php echo $footer; ?>
