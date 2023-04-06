<?php if($this->session->userdata("userType")){ ?>

<!-- livezilla.net PLACE SOMEWHERE IN BODY -->
<div id="lvztr_12b" style="display:none"></div><script id="lz_r_scr_ee4c76f0cf0339fef0ee2c38ee40385a" type="text/javascript">lz_code_id="ee4c76f0cf0339fef0ee2c38ee40385a";var script = document.createElement("script");script.async=true;script.type="text/javascript";var src = "http://connectapp.net/dev/drm/livechat/server.php?rqst=track&output=jcrpt&fbpos=12&fbw=39&fbh=137&fbmr=40&fbmb=30&nse="+Math.random();script.src=src;document.getElementById('lvztr_12b').appendChild(script);</script>
<div style="display:none;">
  <?php $chatData = "?ptn=".urlencode($this->session->userdata("adminName"))."&pto=true&pte=".urlencode($this->session->userdata("userEmail")); ?>
  <a href="javascript:void(window.open('http://connectapp.net/dev/drm/livechat/chat.php<?=$chatData?>','','width=400,height=600,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))" class="lz_fl"><img id="chat_button_image" src="http://connectapp.net/dev/drm/livechat/image.php?id=4&type=overlay" width="39" height="137" style="border:0px;" alt="LiveZilla Live Chat Software"></a></div>
<!-- livezilla.net PLACE SOMEWHERE IN BODY -->
<?php } ?>


<link rel="stylesheet" href="<?= $asstesPath; ?>colorbox/colorbox.css">
<script type="text/javascript" src="<?= $asstesPath; ?>colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">
    jQuery(".content").colorbox({width: "70%", opacity: 0.35, height: "auto"});
    var closeLightbox = function(){
        $.colorbox.close();
    };
    $(window).load(function () {
        $('#status').fadeOut();
        $('#preloader').delay(350).fadeOut('slow');
        $('body').delay(350);
    });
</script>

<!-- BEGIN FOOTER -->
	<div id="footer">
		<?=  date("Y")?> &copy; Ekal DRM | Developed by <a href="http://www.masspl.com/" target="_blank">MASS</a>
		<div class="span pull-right">
			<span class="go-top"><i class="icon-arrow-up"></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
</body>
<!-- END BODY -->
</html>
