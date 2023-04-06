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
                        Send Bulk Push Notification
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li>
                            <a href="<?=  base_url("universities");?>">Universities</a> <span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Send Bulk Push Notification</a><span class="divider-last">&nbsp;</span></li>
                    </ul>
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
                    <!-- BEGIN SAMPLE FORM widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-plus-sign"></i> Send Bulk Push Notification</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST">
                              <div class="control-group">
                                  <label class="control-label">Students</label>
                                  <div class="controls">
                                      <select class="span6" name="regIDs[]" multiple="multiple">
                                        <?php foreach ($users as $value) {?>
                                        <option value="<?php echo $value["ms_device"] ?>"><?php echo $value["ms_name"] ?></option>
                                        <?php } ?>
                                      </select>
                                      <br/><small>Ctrl + click to choose multiple</small>
                                  </div>
                              </div>

                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input
                                            type="text"
                                            name="data[title]"
                                            id="txt_keyword"
                                            class="span6 "
                                            />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Message</label>
                                    <div class="controls">
                                        <textarea name="data[message]" class="span6"></textarea>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="data[icon]" value="https://firebasestorage.googleapis.com/v0/b/developer-raisahab.appspot.com/o/files%2Fic_doc.png?alt=media&token=d1c7896c-d593-416e-a5fb-de75923ae68e">
                                    <input type="hidden" name="data[email]" value="test@test.com">
                                    <input type="submit" name="submit" id="submit" class="btn btn-success" value="Send">
                                    <a class="btn" href="<?php echo base_url() . "threads/list" ?>">Cancel</a>
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
        $("#rd_attr_yes").click(function () {
            $("#multipleAttr").css("display", "block");
        });
        $("#rd_attr_no").click(function () {
            $("#multipleAttr").css("display", "none");
        });
        var i = $("#add_row").data("start");
        $("#add_row").click(function () {
            var html = '<tr id="addr' + (i + 1) + '">' +
                    '<td>Attribute Name</td>';
            html += '<td><select name="label[]" class="span12">';
            <?php foreach ($attr as $a){?>
                html += '<option value="<?=$a["ma_id"]?>"><?=$a["ma_name"]?></option>';
            <?php } ?>
            html += '</select></td>';
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
