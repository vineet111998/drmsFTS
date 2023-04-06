 <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
    <script src="<?=$jsPath;?>jquery-1.8.3.min.js"></script>
    <script src="<?=$asstesPath;?>bootstrap/js/bootstrap.min.js"></script>   
    <script src="<?=$jsPath;?>jquery.blockui.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="<?=$jsPath;?>excanvas.js"></script>
   <script src="<?=$jsPath;?>respond.js"></script>
   <![endif]-->   
   <script type="text/javascript" src="<?=$asstesPath;?>uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="<?=$asstesPath;?>data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?=$asstesPath;?>data-tables/DT_bootstrap.js"></script>
   <script src="<?=$jsPath;?>scripts.js"></script>
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
      });
   </script>