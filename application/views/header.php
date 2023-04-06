<!DOCTYPE html>
<!--
Template Name: Admin Lab Dashboard build with Bootstrap v2.3.1
Template Version: 1.3
Author: Mosaddek Hossain
Website: http://thevectorlab.net/
-->

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title> Ekal DRMS</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?= $asstesPath; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?= $asstesPath; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="<?= $asstesPath; ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?= $cssPath; ?>style.css" rel="stylesheet" />
        <link href="<?= $cssPath; ?>style_responsive.css" rel="stylesheet" />
        <link href="<?= $cssPath; ?>style_default.css" rel="stylesheet" id="style_color" />

        <link href="<?= $asstesPath; ?>fancybox/source/jquery.fancybox.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?= $asstesPath; ?>uniform/css/uniform.default.css" />
        <link href="<?= $asstesPath; ?>fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <link href="<?= $asstesPath; ?>jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>chosen-bootstrap/chosen/chosen.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>jquery-tags-input/jquery.tagsinput.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>clockface/css/clockface.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>bootstrap-colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" href="<?php echo $asstesPath;?>bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
        <link rel="stylesheet" href="<?php echo $asstesPath;?>data-tables/DT_bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>bootstrap-daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $asstesPath;?>gritter/css/jquery.gritter.css" />
        <link href="<?php echo $asstesPath;?>bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
        <script type="text/javascript">
        var MIS_URL = '<?=MIS_URL?>';
        var BASE_URL = '<?=  base_url()?>';
        </script>
        <style type="text/css">
            /* Preloader */

            #preloader {
                position:fixed;
                top:0;
                left:0;
                right:0;
                bottom:0;
                background-color:#fff; /* change if the mask should have another color then white */
                z-index:99999; /* makes sure it stays on top */
            }

            #status {
              width: 100%;
              position:absolute;
              text-align: center;
              top:20%;
              background-repeat:no-repeat;
              background-position:center;
            }
        </style>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="fixed-top">
      <div id="preloader">
          <div id="status"><img src="<?=$imgPath?>page-loader.gif"/></div>
      </div>
        <!-- BEGIN HEADER -->
        <div id="header" class="navbar navbar-inverse navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN LOGO -->
                    <a class="brand" href="#" style="text-align: center;">
                        <img src="" alt="Ekal DRMS" style="max-height: 24px;" />
                    </a>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="arrow"></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
<!--                    <div id="top_menu" class="nav notify-row">
                         BEGIN NOTIFICATION
                        <ul class="nav top-menu">
                             BEGIN SETTINGS
                                                        <li class="dropdown">
                                                            <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Settings">
                                                                <i class="icon-cog"></i>
                                                            </a>
                                                        </li>
                             END SETTINGS
                             BEGIN INBOX DROPDOWN
                                                        <li class="dropdown" id="header_inbox_bar">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-envelope-alt"></i>
                                                                <span class="badge badge-important">5</span>
                                                            </a>
                                                            <ul class="dropdown-menu extended inbox">
                                                                <li>
                                                                    <p>You have 5 new messages</p>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="photo"><img src="<?= $imgPath; ?>avatar-mini.png" alt="avatar" /></span>
                                                                        <span class="subject">
                                                                            <span class="from">Dulal Khan</span>
                                                                            <span class="time">Just now</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            Hello, this is an example messages please check
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="photo"><img src="<?= $imgPath; ?>avatar-mini.png" alt="avatar" /></span>
                                                                        <span class="subject">
                                                                            <span class="from">Rafiqul Islam</span>
                                                                            <span class="time">10 mins</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            Hi, Mosaddek Bhai how are you ?
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="photo"><img src="<?= $imgPath; ?>avatar-mini.png" alt="avatar" /></span>
                                                                        <span class="subject">
                                                                            <span class="from">Sumon Ahmed</span>
                                                                            <span class="time">3 hrs</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            This is awesome dashboard templates
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="photo"><img src="<?= $imgPath; ?>avatar-mini.png" alt="avatar" /></span>
                                                                        <span class="subject">
                                                                            <span class="from">Dulal Khan</span>
                                                                            <span class="time">Just now</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            Hello, this is an example messages please check
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">See all messages</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                             END INBOX DROPDOWN
                             BEGIN NOTIFICATION DROPDOWN
                            <li class="dropdown" id="header_notification_bar">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                    <i class="icon-bell-alt"></i>
                                    <span class="badge badge-warning">7</span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <li>
                                        <p>You have 7 new notifications</p>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-important"><i class="icon-bolt"></i></span>
                                            Server #3 overloaded.
                                            <span class="small italic">34 mins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-warning"><i class="icon-bell"></i></span>
                                            Server #10 not respoding.
                                            <span class="small italic">1 Hours</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-important"><i class="icon-bolt"></i></span>
                                            Database overloaded 24%.
                                            <span class="small italic">4 hrs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-success"><i class="icon-plus"></i></span>
                                            New user registered.
                                            <span class="small italic">Just now</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-info"><i class="icon-bullhorn"></i></span>
                                            Application error.
                                            <span class="small italic">10 mins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">See all notifications</a>
                                    </li>
                                </ul>
                            </li>
                             END NOTIFICATION DROPDOWN

                        </ul>
                    </div>-->
                    <!-- END  NOTIFICATION -->
                    <div class="top-nav ">
                        <ul class="nav pull-right top-menu">
                            <!--
                            <li class="dropdown mtop5">

                                <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Chat">
                                    <i class="icon-comments-alt"></i>
                                </a>
                            </li>
                            <li class="dropdown mtop5">
                                <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Help">
                                    <i class="icon-headphones"></i>
                                </a>
                            </li>
                            -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="username"><?=$this->session->userdata("adminName");?></span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                  <li><a href="<?=  base_url("drm/changePassword")?>" class="content"><i class="icon-key"></i> Change Password</a></li>
                                  <li><a href="<?=  base_url("drm/mailsubject")?>"><i class="icon-envelope"></i> Mail Subjects</a></li>
                                  <li><a href="<?=  base_url("administration/settings")?>"><i class="icon-cogs"></i> Settings</a></li>
                                  <li class="divider"></li>
                                  <li><a href="<?=  base_url("login/logout")?>"><i class="icon-off"></i> Log Out</a></li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                        <!-- END TOP NAVIGATION MENU -->
                    </div>
                </div>
            </div>
            <!-- END TOP NAVIGATION BAR -->
        </div>
        <!-- END HEADER -->
