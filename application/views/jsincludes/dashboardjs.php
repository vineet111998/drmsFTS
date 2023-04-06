<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<script src="<?= $jsPath; ?>jquery-1.8.3.min.js"></script>
<script src="<?= $asstesPath; ?>jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?= $asstesPath; ?>jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= $asstesPath; ?>fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<script src="<?= $asstesPath; ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $jsPath; ?>jquery.blockui.js"></script>
<script src="<?= $jsPath; ?>jquery.cookie.js"></script>
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="<?= $jsPath; ?>excanvas.js"></script>
<script src="<?= $jsPath; ?>respond.js"></script>
<![endif]-->
<script src="<?= $asstesPath; ?>jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?= $asstesPath; ?>jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?= $asstesPath; ?>jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?= $asstesPath; ?>jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?= $asstesPath; ?>jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?= $asstesPath; ?>jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?= $asstesPath; ?>jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?= $asstesPath; ?>jquery-knob/js/jquery.knob.js"></script>
<script src="<?= $asstesPath; ?>flot/jquery.flot.js"></script>
<script src="<?= $asstesPath; ?>flot/jquery.flot.resize.js"></script>
<script src="<?= $asstesPath; ?>flot/jquery.flot.pie.js"></script>
<script src="<?= $asstesPath; ?>flot/jquery.flot.stack.js"></script>
<script src="<?= $asstesPath; ?>flot/jquery.flot.crosshair.js"></script>

<script src="<?= $jsPath; ?>jquery.peity.min.js"></script>
<script type="text/javascript" src="<?= $asstesPath; ?>uniform/jquery.uniform.min.js"></script>
<script src="<?= $jsPath; ?>scripts.js"></script>
<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
//        App.setMainPage(true);
        App.init();
    });
</script>
<!-- END JAVASCRIPTS -->