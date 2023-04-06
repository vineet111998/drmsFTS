<?php echo $header; ?>
<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid">
    <!-- BEGIN SIDEBAR -->
    <div id="sidebar" class="nav-collapse collapse">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler hidden-phone"></div>
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
        <div class="navbar-inverse">
            <form class="navbar-search visible-phone">
                <input type="text" class="search-query" placeholder="Search" />
            </form>
        </div>
        <!-- END RESPONSIVE QUICK SEARCH FORM -->
        <!-- BEGIN SIDEBAR MENU -->
        <?php echo $sidebar ?>
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
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Dashboard
                        <small> General Information </small>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                        </li>
                        <li><a href="#">Dashboard</a><span class="divider-last">&nbsp;</span></li>
                    <?php if($this->session->typeofuser==0 ) { ?>
                        <a class="btn btn-success" href="fundingChapter/mapFunding"> <span>FC-Allocation</span></a>
                        <a class="btn btn-success" href="donor/donorAllocation"> <span>Donor-Allocation</span></a>
                        <a class="btn btn-success" href="sif/sifEdit"> <span>SIF Edit</span></a>
                        <a class="btn btn-success" href="report/schoolChapter"> <span>School Under Chapter</span></a>
                        <a class="btn btn-success" href="login/userCreate"> <span>Create User</span></a>
                    <!-- <?php }elseif($this->session->typeofuser==1 ) { ?>
                        <a class="btn btn-success" href="administration/map_funding"> <span>FC-Allocation</span></a>
                    <?php }elseif ($this->session->typeofuser==2) { ?>
                        <a class="btn btn-success" href="administration/donor_allocation"> <span>Donor-Allocation</span></a>
                    <?php }elseif ($this->session->typeofuser==3) { ?>
                        <a class="btn btn-success" href="administration/sif_editt"> <span>SIF Edit</span></a>
                    <?php }elseif ($this->session->typeofuser==4) { ?>
                        < a class="btn btn-success" href="administration/School_chapter"> <span>School Under Chapter</span></a>-->
                <?php }?>
                    </ul>
                    
                    
                    <!-- END PAGE TITLE & BREADCRUMB-->
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
            <div id="page" class="dashboard">
                <!-- <div class="square-state">
                      <div class="row-fluid">
                          <a href="<?=base_url("userinput/userList")?>" class="icon-btn span2">
                              <i class="icon-user"></i>
                              <div>User Search</div>
                          </a>
                      </div>
                  </div> -->
                <!-- <hr>
                <h2>General Information</h2>
                <hr> -->
                <?php if(!$this->isAdmin){ ?>
                  <div class="row-fluid circle-state-overview">
                    <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                        <a href="<?=base_url('drm/listSchools')?>" style="text-decoration: none;">
                            <div class="circle-stat block">
                                <div class="visual">
                                    <div class="circle-state-icon">
                                        <i class="icon-suitcase purple-color"></i>
                                    </div>
                                    <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100" data-fgColor="#c8abdb" data-bgColor="#ddd"/>
                                </div>
                                <div class="details">
                                    <div class="number"><?=$associatedSchools?></div>
                                    <div class="title">Associated Schools</div>
                                </div>
                            </div>
                        </a>
                    </div>
                  </div>
                <?php } else { ?>
                    <hr>
                    <h2>DPS Dashboard</h2>
                    <hr>
                    <div class="row-fluid circle-state-overview">
                      <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                            <a href="<?=base_url('administration/donors/DPS-B');?>" style="text-decoration: none;">
                                <div class="circle-stat block">
                                    <div class="visual">
                                        <div class="circle-state-icon">
                                            <i class="icon-user green-color"></i>
                                        </div>
                                        <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100"  data-fgColor="#a8c77b" data-bgColor="#ddd"/>
                                    </div>
                                    <div class="details">
                                        <div class="number"><?=$totalDonorsDPSBig?></div>
                                        <div class="title">Big Donors for <?=$sessionDPS?></div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                              <a href="<?=base_url('administration/donors/DPS-S');?>" style="text-decoration: none;">
                                  <div class="circle-stat block">
                                      <div class="visual">
                                          <div class="circle-state-icon">
                                              <i class="icon-user green-color"></i>
                                          </div>
                                          <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100"  data-fgColor="#a8c77b" data-bgColor="#ddd"/>
                                      </div>
                                      <div class="details">
                                          <div class="number"><?=$totalDonorsDPS?></div>
                                          <div class="title">Donors (<20 Schools) for <?=$sessionDPS?></div>
                                      </div>
                                  </div>
                              </a>
                          </div>

                        <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                            <a href="<?=base_url('administration/listSchools/DPS')?>" style="text-decoration: none;">
                                <div class="circle-stat block">
                                    <div class="visual">
                                        <div class="circle-state-icon">
                                            <i class="icon-suitcase gray-color"></i>
                                        </div>
                                        <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100" data-fgColor="#b9baba" data-bgColor="#ddd" />
                                    </div>
                                    <div class="details">
                                        <div class="number"><?=$totalSchoolsDPS?></div>
                                        <div class="title">Associated Schools DPS</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                            <a href="<?=base_url('drm/emailLogs/0/DPS');?>" style="text-decoration: none;">
                                <div class="circle-stat block">
                                    <div class="visual">
                                        <div class="circle-state-icon">
                                            <i class="icon-envelope purple-color"></i>
                                        </div>
                                        <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100" data-fgColor="#c8abdb" data-bgColor="#ddd"/>
                                    </div>
                                    <div class="details">
                                        <div class="number"><?=$stat["mst_total_email"]?></div>
                                        <div class="title">Total Email Sent</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                            <a href="<?=base_url('administration/notification/DPS')?>" style="text-decoration: none;">
                                <div class="circle-stat block">
                                    <div class="visual">
                                        <div class="circle-state-icon">
                                            <i class="icon-picture turquoise-color"></i>
                                        </div>
                                        <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100" data-fgColor="#4CC5CD" data-bgColor="#ddd"/>
                                    </div>
                                    <div class="details">
                                        <div class="number"><?php echo $notif["countNotif"]?></div>
                                        <div class="title">New approved school pictures from connectapp</div>
                                    </div>

                                </div>
                            </a>
                        </div>

                    </div>
                    <hr>
                    <h2>RMS Dashboard</h2>
                    <hr>
                    <div class="row-fluid circle-state-overview">

                        <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                              <a href="<?=base_url('administration/donors/RMS-B');?>" style="text-decoration: none;">
                                  <div class="circle-stat block">
                                      <div class="visual">
                                          <div class="circle-state-icon">
                                              <i class="icon-user green-color"></i>
                                          </div>
                                          <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100"  data-fgColor="#a8c77b" data-bgColor="#ddd"/>
                                      </div>
                                      <div class="details">
                                          <div class="number"><?=$totalDonorsRMSBig?></div>
                                          <div class="title">Big Donors for <?=$sessionRMS?></div>
                                      </div>
                                  </div>
                              </a>
                          </div>

                          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                                <a href="<?=base_url('administration/donors/RMS-S');?>" style="text-decoration: none;">
                                    <div class="circle-stat block">
                                        <div class="visual">
                                            <div class="circle-state-icon">
                                                <i class="icon-user green-color"></i>
                                            </div>
                                            <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100"  data-fgColor="#a8c77b" data-bgColor="#ddd"/>
                                        </div>
                                        <div class="details">
                                            <div class="number"><?=$totalDonorsRMS?></div>
                                            <div class="title">Donors (<20 Schools) for <?=$sessionRMS?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                              <a href="<?=base_url('administration/listSchools/RMS')?>" style="text-decoration: none;">
                                  <div class="circle-stat block">
                                      <div class="visual">
                                          <div class="circle-state-icon">
                                              <i class="icon-suitcase gray-color"></i>
                                          </div>
                                          <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100" data-fgColor="#b9baba" data-bgColor="#ddd" />
                                      </div>
                                      <div class="details">
                                          <div class="number"><?=$totalSchoolsRMS?></div>
                                          <div class="title">Associated Schools RMS</div>
                                      </div>
                                  </div>
                              </a>
                          </div>

                          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                              <a href="<?=base_url('drm/emailLogs/0/RMS');?>" style="text-decoration: none;">
                                  <div class="circle-stat block">
                                      <div class="visual">
                                          <div class="circle-state-icon">
                                              <i class="icon-envelope purple-color"></i>
                                          </div>
                                          <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100" data-fgColor="#c8abdb" data-bgColor="#ddd"/>
                                      </div>
                                      <div class="details">
                                          <div class="number"><?=$statRMS["mst_total_email"]?></div>
                                          <div class="title">Total Email Sent</div>
                                      </div>

                                  </div>
                              </a>
                          </div>

                          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
                              <a href="<?=base_url('administration/notification/RMS')?>" style="text-decoration: none;">
                                  <div class="circle-stat block">
                                      <div class="visual">
                                          <div class="circle-state-icon">
                                              <i class="icon-picture turquoise-color"></i>
                                          </div>
                                          <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="100" data-fgColor="#4CC5CD" data-bgColor="#ddd"/>
                                      </div>
                                      <div class="details">
                                          <div class="number"><?php echo $notifRMS["countNotif"]?></div>
                                          <div class="title">New approved school pictures from connectapp</div>
                                      </div>

                                  </div>
                              </a>
                          </div>

                    </div>
                  <?php } ?>


            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<?php echo $dashboardJS; ?>
<?php echo $footer; ?>
