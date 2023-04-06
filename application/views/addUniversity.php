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
                        Add University
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?=  base_url("dashboardctrl")?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li>
                            <a href="<?=  base_url("universities");?>">University</a> <span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#"><?php echo ($edit) ? "Edit" : "Add"; ?> University</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-plus-sign"></i> <?php echo ($edit) ? "Edit" : "Add"; ?> University</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST">
                                <div class="control-group">
                                    <label class="control-label">University Name</label>
                                    <div class="controls">
                                        <input type="text" name="UNIV[mu_name]" class="span6" required/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">University Address</label>
                                    <div class="controls">
                                        <input type="text" name="UNIV[mu_address]" class="span6" required/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">About University</label>
                                    <div class="controls">
                                        <textarea name="UNIV[mu_about]" class="span6" required></textarea>
                                    </div>
                                </div>


                                <div id="multipleAttr">
                                        <table class="table table-bordered table-hover" style="width: 57%;">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Add Degree Names (e.g. Under Graduate)</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tab_logic">
                                                <tr id="addr0">
                                                    <td>
                                                        <input type="text" name="degrees[0][md_name]" class="span12" placeholder="Degree Name"required/>
                                                    </td>
                                                    <td>
                                                        <textarea name="degrees[0][md_details]" class="span12" placeholder="Degree Description"required></textarea>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        <a class="btn btn-success" id="add_row" data-start="0">Add Another</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                <div class="form-actions">
                                    <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="<?php echo ($edit) ? "Update" : "Submit" ?>">
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
