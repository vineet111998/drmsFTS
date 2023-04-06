<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-title">
                <h4><i class="icon-picture"></i> Teacher with Donor Board</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
              <div class="row-fluid">
                <?php
                  $countTWDB = count($schoolInfo['teacher_with_donar_board']);
                  $twdb = 0;
                  if($countTWDB > 0){
                    foreach ($schoolInfo['teacher_with_donar_board'] as $value) {
                      $twdb++;
                ?>
                <div class="span2">
                  <div class="thumbnail">
                    <div class="item">
                      <a class="contenttwdb" data-rel="fancybox-button" title="Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?>" href="<?php echo $value['img']; ?>">
                        <div class="zoom">
                          <img rel="twdb" src="<?php echo $value['img']; ?>" alt="Photo"/>
                          <div class="zoom-icon"></div>
                          <small style="color: rgb(255, 255, 255); background: #000; padding: 0px 1%;">Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?></small>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <?php
                  if ($twdb == 6 && $twdb != $countTWDB) {
                    echo '</div>';
                    echo '<div class="row-fluid">';
                  } else if ($twdb == $countTWDB) {
                    echo '</div>';
                  }
                ?>
                <?php } ?>
                <?php } else { ?>
                  <div class="span12">
                    <h2 style="text-align:center;">No Image Found for this Category</h2>
                  </div>
                <?php } ?>
              <!-- </div> -->

            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-title">
                <h4><i class="icon-picture"></i> Teacher with Student</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
              <div class="row-fluid">
                <?php
                  $countTWS = count($schoolInfo['teacher_with_student']);
                  $tws = 0;
                  if($countTWS > 0){
                    foreach ($schoolInfo['teacher_with_student'] as $value) {
                      $tws++;
                ?>
                <div class="span2">
                  <div class="thumbnail">
                    <div class="item">
                      <a class="contenttws" data-rel="fancybox-button" title="Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?>" href="<?php echo $value['img']; ?>">
                        <div class="zoom">
                          <img rel="tws" src="<?php echo $value['img']; ?>" alt="Photo"/>
                          <div class="zoom-icon"></div>
                          <small style="color: rgb(255, 255, 255); background: #000; padding: 0px 1%;">Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?></small>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <?php
                  if ($tws == 6 && $tws != $countTWS) {
                    echo '</div>';
                    echo '<div class="row-fluid">';
                  } else if ($tws == $countTWS) {
                    echo '</div>';
                  }
                ?>
                <?php } ?>
                <?php } else { ?>
                  <div class="span12">
                    <h2 style="text-align:center;">No Image Found for this Category</h2>
                  </div>
                <?php } ?>
              <!-- </div> -->

            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-title">
                <h4><i class="icon-picture"></i> Samity</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
              <div class="row-fluid">
                <?php
                  $countSamity = count($schoolInfo['sammity']);
                  $samity = 0;
                  if($countSamity > 0){
                    foreach ($schoolInfo['sammity'] as $value) {
                      $samity++;
                      // t($value,1);
                ?>
                <div class="span2">
                  <div class="thumbnail">
                    <div class="item">
                      <a class="contentSamity" data-rel="fancybox-button" title="Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?>" href="<?php echo $value['img']; ?>">
                        <div class="zoom">
                          <img rel="samity" src="<?php echo $value['img']; ?>" alt="Photo"/>
                          <div class="zoom-icon"></div>
                          <small style="color: rgb(255, 255, 255); background: #000; padding: 0px 1%;">Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?></small>
                        </div>
                      </a>
                      <!-- <a href="#" style="text-align:center;" class="label label-success">Comment</a> -->
                    </div>
                  </div>
                </div>
                <?php
                  if ($samity == 6 && $samity != $countSamity) {
                    echo '</div>';
                    echo '<div class="row-fluid">';
                  } else if ($samity == $countSamity) {
                    echo '</div>';
                  }
                ?>
                <?php } ?>
                <?php } else { ?>
                  <div class="span12">
                    <h2 style="text-align:center;">No Image Found for this Category</h2>
                  </div>
                <?php } ?>
              <!-- </div> -->

            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-title">
                <h4><i class="icon-picture"></i> Others</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
              <div class="row-fluid">
                <?php
                  $countOthers = count($schoolInfo['others']);
                  $others = 0;
                  if($countOthers > 0){
                    foreach ($schoolInfo['others'] as $value) {
                      $others++;
                ?>
                <div class="span2">
                  <div class="thumbnail">
                    <div class="item">
                      <a class="contentOthers" data-rel="fancybox-button" title="Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?>" href="<?php echo $value['img']; ?>">
                        <div class="zoom">
                          <img rel="others" src="<?php echo $value['img']; ?>" alt="Photo"/>
                          <div class="zoom-icon"></div>
                          <small style="color: rgb(255, 255, 255); background: #000; padding: 0px 1%;">Date : <?php echo date("d-m-Y",strtotime($value['date']));; ?> | Time : <?php echo $value['time']; ?></small>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <?php
                  if ($others == 6 && $others != $countOthers) {
                    echo '</div>';
                    echo '<div class="row-fluid">';
                  } else if ($others == $countOthers) {
                    echo '</div>';
                  }
                ?>
                <?php } ?>
                <?php } else { ?>
                  <div class="span12">
                    <h2 style="text-align:center;">No Image Found for this Category</h2>
                  </div>
                <?php } ?>
              <!-- </div> -->

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= $asstesPath; ?>colorbox/colorbox.css">
<script type="text/javascript" src="<?= $asstesPath; ?>colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">
    $(".contenttwdb").colorbox({width: "50%", opacity: 0.35, height: "auto", rel:"twdb"});
    $(".contenttws").colorbox({width: "50%", opacity: 0.35, height: "auto", rel:"tws"});
    $(".contentSamity").colorbox({width: "50%", opacity: 0.35, height: "auto", rel:"samity"});
    $(".contentOthers").colorbox({width: "50%", opacity: 0.35, height: "auto", rel:"others"});
    var closeLightbox = function(){
        $.colorbox.close();
    };
</script>
