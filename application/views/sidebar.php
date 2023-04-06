<!-- BEGIN SIDEBAR MENU -->
<ul class="sidebar-menu">
  <li id="dashboard">
      <a href="<?= base_url('drm') ?>">
          <span class="icon-box"><i class="icon-dashboard"></i></span> Dashboard
      </a>
  </li>
  <?php if($this->session->userdata("userType") == "0"): ?>
    <!-- <li>
        <a href="<?= base_url('livechat/mobile/index.php') ?>" target="_blank">
            <span class="icon-box"><i class="icon-comment"></i></span> Chat Admin
        </a>
    </li>-->
    <!-- <li>
        <a href="<?= base_url('administration/uploadDonors') ?>">
            <span class="icon-box"><i class="icon-upload"></i></span> Upload Donors
        </a>
    </li> -->
    <li>
        <a href="<?= base_url('administration/uploadDonors') ?>">
            <span class="icon-box"><i class="icon-upload"></i></span> Upload Donors
        </a>
    </li>

    <li>
        <a href="<?= base_url('administration/uploadPDF') ?>">
            <span class="icon-box"><i class="icon-upload"></i></span> Upload PDF
        </a>
    </li>
    <li class="has-sub">
        <a href="javascript:;">
            <span class="icon-box"><i class="icon-envelope"></i></span> Compose Email
            <span class="arrow"></span>
        </a>
        <ul class="sub">
          <li class=""><a class="" href="<?= base_url('administration/compose') ?>">Individual Emails</a></li>
          <li class=""><a class="" href="<?= base_url('administration/composeAttendance') ?>">Attendance Report</a></li>
          <li class=""><a class="" href="<?= base_url('administration/composeBulk') ?>">Bulk Email</a></li>
          <li class=""><a class="" href="<?= base_url('administration/composePictures') ?>">Send School Pictures</a></li>
          <li class=""><a class="" href="<?= base_url('administration/composeDonorBoard') ?>">Send Donor Board</a></li>
        </ul>
    </li>
  <?php endif; ?>
  <!-- <li class="has-sub active">
      <a href="javascript:;" class="">
          <span class="icon-box"> <i class="icon-book"></i></span> Donors
          <span class="arrow"></span>
      </a>
      <ul class="sub">
          <li class=""><a class="" href="<?=base_url('drm/donors');?>">Donors List</a></li>
      </ul>
  </li> -->
</ul>
<!-- END SIDEBAR MENU -->
