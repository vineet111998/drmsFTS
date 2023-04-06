<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?= $asstesPath; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?= $asstesPath; ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?= $cssPath; ?>style.css" rel="stylesheet" />
        <link href="<?= $cssPath; ?>style_responsive.css" rel="stylesheet" />
        <link href="<?= $cssPath; ?>style_default.css" rel="stylesheet" id="style_color" />
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body id="login-body">
        <div class="login-header">
            <!-- BEGIN LOGO -->
            <div id="logo" class="center">
                <img src="https://www.ekal.org/images/logo.png" alt="Ekal DRMS" class="center" style="border: 2px solid #FFF;background: #FFF; max-height:80px;"/>
            </div>
            <!-- END LOGO -->
        </div>

        <!-- BEGIN LOGIN -->
        <div id="login">
            <!-- BEGIN LOGIN FORM -->
            <form id="loginform" class="form-vertical no-padding no-margin" action="<?php echo current_url()?>" method="POST">
                <div class="lock">
                    <i class="icon-lock"></i>
                </div>
                <div class="control-wrap">
                    <?=$this->session->flashdata("error");?>
                    <h4>Ekal DRMS Login</h4>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span><input id="input-username" name="username" type="text" placeholder="Username" />
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-key"></i></span><input id="input-password" name="pwd" type="password" placeholder="Password" />
                            </div>
                            <div class="mtop10">
<!--                                <div class="block-hint pull-left small">
                                    <input type="checkbox" id=""> Remember Me
                                </div>-->
<!--                                <div class="block-hint pull-right">
                                    <a href="javascript:;" class="" id="forget-password">Forgot Password?</a>
                                </div>-->
                            </div>

                            <div class="clearfix space5"></div>
                        </div>

                    </div>
                </div>

                <input type="submit" id="login-btn" class="btn btn-block login-btn" value="Login" />
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form id="forgotform" class="form-vertical no-padding no-margin hide" action="index.html">
                <p class="center">Enter your e-mail address below to reset your password.</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input id="input-email" type="text" placeholder="Email"  />
                        </div>
                        <div class="mtop10">
                            <div class="block-hint pull-left small">

                            </div>
                            <div class="block-hint pull-right">
                                <a href="javascript:;" class="" id="forget-btn">&larr;Back to Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="space20"></div>
                </div>
                <input type="button" class="btn btn-block login-btn" value="Submit" />
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div id="login-copyright">
            <?=  date("Y")?> &copy; Ekal DRMS
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS -->
        <script src="<?= $jsPath; ?>jquery-1.8.3.min.js"></script>
        <script src="<?= $asstesPath; ?>bootstrap/<?= $jsPath; ?>bootstrap.min.js"></script>
        <script src="<?= $jsPath; ?>jquery.blockui.js"></script>
        <script src="<?= $jsPath; ?>scripts.js"></script>
        <script>
            jQuery(document).ready(function () {
                App.initLogin();
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
