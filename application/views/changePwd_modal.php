<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN SAMPLE FORM widget-->
        <div class="widget">
            <div class="widget-title">
                <h4><i class="icon-list"></i> Change Password</h4>

            </div>
            <div class="widget-body form">
                <!-- BEGIN FORM-->
                <form action="<?= current_url(); ?>" class="form-horizontal" id="myfrm" name="myfrm" method="post">

                    <div class="control-group">
                        <label class="control-label">New Password</label>
                        <div class="controls">
                            <input type="password" name="pwd" class="span6">
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-success" name="save" value="Submit"/>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END SAMPLE FORM widget-->
    </div>
</div>
