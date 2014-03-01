<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<?php 
$uh = Loader::helper('concrete/urls');
$bt = BlockType::getByHandle('cu3er');
$urlxml = $uh->getBlockTypeToolsURL($bt)."/xml?bID=".intval($bID);
?>
<style type="text/css">
<!--
/* body { margin: 0 auto; text-align:center;} */
#cu3er-container<?php  echo intval($bID)?> {width:<?php  echo $maxWidth; ?>px; height: <?php  echo $maxHeight; ?>; outline:0;}
/* #cu3er-bg<?php  echo intval($bID)?> {margin-top:30px;} */
#cu3er-bg<?php  echo intval($bID)?> {background-attachment: scroll; background-color: transparent; background-repeat: no-repeat; background-position: center 360px;}
/* .body-bg-shadow<?php  echo intval($bID)?> {background-image: url(<?php  echo $this->getBlockURL()?>/images/cube_shadow.jpg);} */
-->
</style>

<script type="text/javascript"> 
	$(document).ready(function() {
			<?php  if (false){?>
			$('#cu3er-bg<?php  echo intval($bID)?>').css({backgroundPosition: 'center ' + ($('#cu3er-bg').height() - 200) + 'px'});
			$('#cu3er-bg<?php  echo intval($bID)?>').css("height",$('#cu3er-bg<?php  echo intval($bID)?>').height() + 65); //for bottom of shadow
			$('#cu3er-bg<?php  echo intval($bID)?>').addClass("body-bg-shadow<?php  echo intval($bID)?>");
			<?php  } ?>
		});	
</script>

<script type="text/javascript">
		var flashvars = {};
		flashvars.xml = "<?php  echo $urlxml ?>";
		flashvars.font = "<?php  echo $this->getBlockURL()?>/fonts/miso_font.swf";
		var attributes = {};
		attributes.wmode = "transparent";
		attributes.id = "slider";
		swfobject.embedSWF("<?php  echo $this->getBlockURL()?>/cu3er.swf", "cu3er-container<?php  echo intval($bID)?>", "<?php  echo $maxWidth; ?>", "<?php  echo $maxHeight; ?>", "9", "<?php  echo $this->getBlockURL()?>/js/swfobject/expressInstall.swf", flashvars, attributes);
</script>

<div id="cu3er-bg<?php  echo intval($bID)?>">
<div id="cu3er-container<?php  echo intval($bID)?>">
	<?php  echo $controller->showFallbackImage(); ?>
</div>
</div>