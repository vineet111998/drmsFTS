<div class="row-fluid">
  <div class="span12">
    <div class="widget">
      <div class="widget-title">
          <h4><i class="icon-book"></i> List of Associated Schools</h4>
      </div>
      <div class="widget-body form" style="overflow-y:auto;max-height:500px;">
        <form id="frmImprt" action="<?php echo base_url('administration/listSchoolsReport'); ?>" class="form-horizontal" method="POST">
          <table class="table table-striped table-bordered attendance">
            <thead>
              <tr>
                <th style="width:10px;">#</th>
                <th>School Code</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($res as $row) { ?>
              <tr>
                <td><input type="checkbox" name="report[]" id="report[]" value="<?php echo trim($row["mds_school_code"]) ?>"></td>
                <td><?php echo $row["mds_school_code"] ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="form-actions">
            <input type="hidden" name="donorName" value="<?=$donorName?>">
            <input type="button" name="submitThread" id="import" class="btn btn-success" value="Import">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    //$('[name="report[]"]:checked').length();
    $("#import").click(function(){
      var lngth = $('input[type=checkbox]').filter(':checked').length;
      if (lngth == 0 || lngth > 20) {
        alert("Please choose schools between 1 to 20");
      } else {
        $("#frmImprt").submit();
      }
    });
  });
</script>
