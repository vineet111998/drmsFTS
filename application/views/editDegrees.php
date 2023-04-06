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
                        Edit Degrees
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href=""><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li>
                            <a href="<?=  base_url("universities");?>">Universities</a> <span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Edit Degrees</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-plus-sign"></i> Edit Degrees</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST">
                                <div class="control-group">
                                    <label class="control-label">Degrees Name</label>
                                    <div class="controls">
                                        <input type="text" name="DEGREES[md_name]" id="name" class="span6" required/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Degrees Description</label>
                                    <div class="controls">
                                        <textarea name="DEGREES[md_details]" id="details" class="span6" required></textarea>
                                    </div>
                                </div>

                                <div class="form-actions">
                                  <input type="hidden" name="did" id="did" value="0">
                                  <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="<?php echo ($edit) ? "Update" : "Submit" ?>">
                                </div>
                            </form>
                            <!-- END FORM-->
                            <div class="space15">

                            </div>
                            <table class="table table-bordered table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Degrees Name</th>
                                        <th>Degrees Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($degrees as $c) { ?>
                                    <tr>
                                      <td><?php echo $c["md_name"] ?></td>
                                      <td><?php echo $c["md_details"] ?></td>
                                      <td>
                                        <a href="#" class="btn btn-primary btn-small" onclick="updateData('<?=$c['md_name']?>','<?=$c['md_details']?>','<?=$c['md_id']?>')"><i class="icon-pencil"></i></a>
                                        <a href="<?=  base_url()."universities/delDegrees/".$c['md_id']."/".$c['md_mu_id']?>" class="btn btn-danger btn-small" onclick="return confirm('Are you sure you want to delete? The courses related to this degree will be deleted too.');"><i class="icon-trash"></i></a>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                            </table>
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

    function updateData(name, details, id){
      $("#name").val(name);
      $("#details").val(details);
      $("#did").val(id);
      $("#submit").val("Update");
    }
</script>
<?php echo $footer; ?>
