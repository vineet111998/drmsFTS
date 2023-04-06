<link rel="stylesheet" href="<?= $asstesPath; ?>colorbox/colorbox.css">
<script type="text/javascript" src="<?= $asstesPath; ?>colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">
    jQuery(".content").colorbox({width: "50%", opacity: 0.35, height: "auto"});
    var closeLightbox = function(){
        $.colorbox.close();
    };
</script>