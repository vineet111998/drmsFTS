<link href="<?= $asstesPath; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?= $asstesPath; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="<?= $asstesPath; ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="<?= $cssPath; ?>style.css" rel="stylesheet" />
<link href="<?= $cssPath; ?>style_responsive.css" rel="stylesheet" />
<link href="<?= $cssPath; ?>style_default.css" rel="stylesheet" id="style_color" />
<div style="text-align:center;">
  <h1><?=$donor?></h1>
  <!-- <h4>Report Generated for <?=count($rptData)?> Schools</h4> -->
</div>
<?php
$count=0;
foreach ($rptData as $value) {
  if(count($value) > 1){
    $count++;
?>
  <div style="page-break-inside: avoid">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td><strong><?php echo $value["SCHOOLCODE"] ?></strong></td>
        </tr>
        <tr>
          <td><?php echo str_replace('|','<br>', $value["SCHOOLADD"]) ?></td>
        </tr>
        <?php if(!empty($value["GKV"])){ ?>
        <tr>
          <td>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Month</th>
                  <th>School Days</th>
                  <th>Boys Present</th>
                  <th>Girls Present</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($value["GKV"] as $val) { ?>
                <tr>
                  <td><?php echo $val["PERIOD"]; ?></td>
                  <td><?php echo $val["SCHOOLDAY"]; ?></td>
                  <td><?php echo $val["PRESENTBOYS"]; ?></td>
                  <td><?php echo $val["PERSENTGIRLS"]; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } } ?>
<h4>Report Generated for <?=$count?> Schools</h4>
