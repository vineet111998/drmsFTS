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
                        Edit Donor
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?=  base_url("dashboard")?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li>
                            <a href="<?=  base_url("administration/donors");?>">List of Donors</a> <span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Edit Donor</a><span class="divider-last">&nbsp;</span></li>
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
                            <h4><i class="icon-pencil"></i> Edit Donor</h4>
                        </div>
                        <div class="widget-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url() ?>" class="form-horizontal" method="POST">
                                <div class="control-group">
                                    <label class="control-label">Donor ID</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_user_name]" class="span6" value="<?php echo $donor["md_user_name"]?>" disabled=""/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input type="password" name="DONOR[md_password]" class="span6"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Period</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_period]" class="span6" value="<?php echo $donor["md_period"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_title]" class="span6" value="<?php echo $donor["md_title"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">First Name</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_fname]" class="span6" value="<?php echo $donor["md_fname"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Last Name</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_lname]" class="span6" value="<?php echo $donor["md_lname"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Spouse</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_spouse]" class="span6" value="<?php echo $donor["md_spouse"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Region</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_region]" class="span6" value="<?php echo $donor["md_region"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls">
                                      <textarea name="DONOR[md_address]" class="span6"><?php echo $donor["md_address"]?></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">City</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_city]" class="span6" value="<?php echo $donor["md_city"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">State</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_state]" class="span6" value="<?php echo $donor["md_state"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">State Code</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_stateid]" class="span6" value="<?php echo $donor["md_stateid"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Pincode</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_pin]" class="span6" value="<?php echo $donor["md_pin"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Country</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_country]" class="span6" value="<?php echo $donor["md_country"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Home Phone</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_home_phone]" class="span6" value="<?php echo $donor["md_home_phone"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Office Phone</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_office_phone]" class="span6" value="<?php echo $donor["md_office_phone"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Mobile Number</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_mobile]" class="span6" value="<?php echo $donor["md_mobile"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_email]" class="span6" value="<?php echo $donor["md_email"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">In Honour of</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_honour]" class="span6" value="<?php echo $donor["md_honour"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">In Memory of</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_memory]" class="span6" value="<?php echo $donor["md_memory"]?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">In occation of</label>
                                    <div class="controls">
                                        <input type="text" name="DONOR[md_occation]" class="span6" value="<?php echo $donor["md_occation"]?>"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Associated Schools</label>
                                    <div class="controls">
                                        <a href="<?=base_url('administration/editDonorSchool/'.$donor["md_id"])?>">Click to Update</a>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" name="submitThread" id="submit" class="btn btn-success" value="Update">
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
