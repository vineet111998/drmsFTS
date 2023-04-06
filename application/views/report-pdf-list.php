<link href="<?= $asstesPath; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?= $asstesPath; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="<?= $asstesPath; ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="<?= $cssPath; ?>style.css" rel="stylesheet" />
<link href="<?= $cssPath; ?>style_responsive.css" rel="stylesheet" />
<link href="<?= $cssPath; ?>style_default.css" rel="stylesheet" id="style_color" />

  <!-- <div style="page-break-inside: avoid"> -->
  <div style="text-align:center;">
    <h1><?=$donor?></h1>

  </div>

  <table class="table table-bordered">
      <thead>
        <tr>
          <th>School Code</th>
          <th>Acharya Name</th>
          <th>Village</th>
          <th>District</th>
          <th>State</th>
        </tr>
      </thead>
      <?php if($noData){ ?>
        <tbody>
          <?php
          foreach ($rptData as $value) {
            if(!$value["acharya"]){
          ?>
          <tr>
            <td><?php echo $value["schoolcode"] ?></td>
            <td colspan="4" style="text-align:center;">No Data Available</td>
          </tr>
          <?php } } ?>
        </tbody>
      <?php } else { ?>
        <tbody>
          <?php
          $count = 0;
          foreach ($rptData as $value) {
            if($value["acharya"]){
              $count++;
          ?>
          <tr>
            <td><?php echo $value["schoolcode"] ?></td>
            <td><?php echo $value["acharya"] ?></td>
            <td><?php echo $value["village"] ?></td>
            <td><?php echo $value["district"] ?></td>
            <td><?php echo $value["state"] ?></td>
          </tr>
          <?php } } ?>
        </tbody>
      <?php } ?>
    </table>
    <h4>Report Generated for <?=$count?> Schools</h4>
  <!-- </div> -->
