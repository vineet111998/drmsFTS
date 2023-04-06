<div class="row-fluid">
  <div class="span12">
    <div class="widget">
      <div class="widget-title">
          <h4><i class="icon-book"></i> Attendance for <?=$res[0]["rgc_school_code"]?></h4>
          <input type="hidden" id="schoolCode" value="<?=$res[0]["rgc_school_code"]?>">
      </div>
      <div class="widget-body">
        <table class="table table-striped table-bordered attendance">
          <thead>
            <tr>
              <th>Month</th>
              <th>School Days</th>
              <th>Boys Present</th>
              <th>Girls Present</th>
              <th>Balak Present</th>
              <th>Kishore Present</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;foreach ($res as $row) { ?>
            <tr id="<?=$i?>">
              <td id="periods<?=$i?>">
                <?=date("F, Y",strtotime($row["periodDate"]))?>
                <input type="hidden" id="periodCode<?=$i?>" value="<?=$row["rgc_period_code"]?>">
              </td>
              <td id="schooldays<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
              <td id="totalBoys<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
              <td id="totalGirls<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
              <td id="kishore<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
              <td id="balak<?=$i?>"><img src="<?=$imgPath?>loading.gif" alt=""></td>
            </tr>
            <?php $i++;} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $(".attendance > tbody > tr").each(function(){
    var pos = $(this).attr("id");
    var schoolCode = $("#schoolCode").val();
    var periodCode = $("#periodCode"+pos).val();
    viewReport(schoolCode, periodCode, pos);
  });
});

function viewReport(schoolCode, periodCode, pos){
  $("#schooldays"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $("#totalBoys"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $("#totalGirls"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $("#kishore"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $("#balak"+pos).html('<img src="'+BASE_URL+'assets/img/loading.gif">');
  $.ajax({
    url: BASE_URL + 'drm/retriveGKVbySchool',
    type: "POST",
    data: "schoolcode="+schoolCode+"&periodcode="+periodCode,
    dataType: 'JSON',
    success: function (res) {
      console.log(JSON.stringify(res));
      var schoolDays = "<strong style='color:red;'>No Data Available</strong>";
      var totalBoys = "<strong style='color:red;'>No Data Available</strong>";
      var totalGirls = "<strong style='color:red;'>No Data Available</strong>";
      var totalKishore = "<strong style='color:red;'>No Data Available</strong>";
      var totalBalak = "<strong style='color:red;'>No Data Available</strong>";

      if(res.status){
        schoolDays = res.details[0].mgkvd_sch_day;
        totalBoys = res.details[0].mgkvd_present_boys;
        totalGirls = res.details[0].mgkvd_present_girls;
        totalKishore = res.details[0].mgkvd_kishore;
        totalBalak = res.details[0].mgkvd_balak;
      }
      $("#schooldays"+pos).html(schoolDays);
      $("#totalBoys"+pos).html(totalBoys);
      $("#totalGirls"+pos).html(totalGirls);
      $("#kishore"+pos).html(totalKishore);
      $("#balak"+pos).html(totalBalak);
    }, error: function (error) {
      var errorMsg = `<a style="cursor:pointer;" onclick="viewReport('`+schoolCode+`','`+periodCode+`','`+pos+`')"><i class="icon-refresh" title="Reload"></i> Reload</a>`;
      $("#schooldays"+pos).html(errorMsg);
      $("#totalBoys"+pos).html(errorMsg);
      $("#totalGirls"+pos).html(errorMsg);
      $("#kishore"+pos).html(errorMsg);
      $("#balak"+pos).html(errorMsg);
    }
  });
}
</script>
