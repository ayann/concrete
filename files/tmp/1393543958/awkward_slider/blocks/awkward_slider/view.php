<?php 
$fm = Loader::helper('form');
$thumbwidth = 180;
if($thumbnails_direction == 'vertical'){
	$set_width = $maxWidth + $thumbwidth;
}else{
	$set_width = $maxWidth;
}
?>
<script type="text/javascript">

$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			<?php echo $maxWidth?>,
		content_height:			<?php echo $maxHeight?>,
		fit_to_parent:			<?php echo $fit_to_parent?>,
		auto:					<?php echo $auto_scroll?>,
		interval:				4000,
		continuous:				<?php echo $scroll_continuous?>,
		loading:				<?php echo $loading?>,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					<?php echo $arrows?>,
		buttons:				<?php echo $buttons?>,
		btn_numbers:			<?php echo $btn_numbers?>,
		keybord_keys:			true,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			<?php echo $pauseonover?>,
		stoponclick:			true,
		transition:				'<?php echo $transition?>', /* hslide/vslide/fade */
		transition_delay:		300,
		transition_speed:		500,
		show_caption:			'onload', /* onload/onhover/show */
		thumbnails:				<?php echo $thumbnails?>,
		thumbnails_position:	'<?php echo $thumbnails_position?>', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'<?php echo $thumbnails_direction?>', /* vertical/horizontal */
		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			<?php echo $dynamic_height?>, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			false, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
});

</script>

<div style="width: <?php echo $set_width?>px; margin: auto;">

	<div id="showcase" class="showcase">
		<!-- Each child div in #showcase represents a slide -->
		<!--
		<div class="showcase-slide">
			<div class="showcase-content">
				<div class="showcase-content-wrapper">
					<h1>You can put what ever you want<br/>in this sliding machine!</h1>
					<h2>Let's start with an image...</h2>
					<p><em>pssst.. you can use the arrow keys to navigate.</em></p>
				</div>
			</div>
		</div>
		-->
		<?php 
		foreach($images as $imgInfo) { 
			$i++;
			$f = File::getByID($imgInfo['fID']);
			$imgHelper = Loader::helper('image'); 
			$path = $f->getRelativePath();
			$imageThumb = $imgHelper->getThumbnail($f, 180,160)->src; 
			$description = $f->getDescription();
			?>
			<div class="showcase-slide">
			<!-- Put the slide content in a div with the class .showcase-content. -->
				<div class="showcase-content">
					<img src="<?php echo $path?>" width="<?php echo $maxWidth?>" />
				</div>
				<!-- Put the thumbnail content in a div with the class .showcase-thumbnail -->
				<div class="showcase-thumbnail">
					<img src="<?php echo $imageThumb?>" width="<?php echo $thumbwidth?>"/>
				</div>
				<!-- Put the caption content in a div with the class .showcase-caption -->
				<?php  if($showDesc!='false' && $description){ ?>
				<div class="showcase-caption">
					<?php echo $description?>
				</div>
				<?php  } ?>
			</div>
			<?php 
		}
		?>
	</div>
		
</div>