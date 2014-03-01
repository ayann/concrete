<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?> 
<div id="ccm-cu3erBlock-imgRow<?php  echo $imgInfo['slideshowImgId']?>" class="ccm-cu3erBlock-imgRow" >
	<div class="backgroundRow" style="background: url(<?php  echo $imgInfo['thumbPath']?>) no-repeat left top; padding-left: 100px">
		<div class="cm-cu3erBlock-imgRowIcons" >
			<div style="float:right">
				<a onclick="Cu3erBlock.moveUp('<?php  echo $imgInfo['slideshowImgId']?>')" class="moveUpLink"></a>
				<a onclick="Cu3erBlock.moveDown('<?php  echo $imgInfo['slideshowImgId']?>')" class="moveDownLink"></a>									  
			</div>
			<div style="margin-top:4px"><a onclick="Cu3erBlock.removeImage('<?php  echo $imgInfo['slideshowImgId']?>')"><img src="<?php  echo ASSETS_URL_IMAGES?>/icons/delete_small.png" /></a></div>
		</div>
		<strong><?php  echo $imgInfo['fileName']?></strong><br/><br/>
		<?php  echo t('Duration')?>: <input type="text" name="duration[]" value="<?php  echo floatval($imgInfo['duration'])?>" style="vertical-align: middle; width: 30px" />
		&nbsp;	
		<?php  echo t('Number of Slices')?>: <input type="text" name="transitionNum[]" value="<?php  echo intval($imgInfo['transitionNum'])?>" style="vertical-align: middle; width: 20px" />
		
		<?php  echo t('Slice')?>: <select name="transitionSlicing_<?php  echo $imgInfo['fID']?>" style="vertical-align: middle">
		<option value="vertical" <?php  echo ($imgInfo['transitionSlicing'] == "vertical"?'selected':'')?> >Vertical</option>
		<option value="horizontal" <?php  echo ($imgInfo['transitionSlicing'] == "horizontal"?'selected':'')?> >Horizontal</option>
	</select>
	&nbsp;
	<?php  echo t('Direction')?>: <select name="transitionDirection_<?php  echo $imgInfo['fID']?>" style="vertical-align: middle">
	<option value="left" <?php  echo ($imgInfo['transitionDirection'] == "left"?'selected':'')?> >Left</option>
	<option value="right" <?php  echo ($imgInfo['transitionDirection'] == "right"?'selected':'')?> >Right</option>
	<option value="up" <?php  echo ($imgInfo['transitionDirection'] == "up"?'selected':'')?> >Up</option>
	<option value="down" <?php  echo ($imgInfo['transitionDirection'] == "down"?'selected':'')?> >Down</option>
	</select>
	&nbsp;
	<?php  echo t('Shader')?>: <select name="transitionFader_<?php  echo $imgInfo['fID']?>" style="vertical-align: middle">
	<option value="none" <?php  echo ($imgInfo['transitionFader'] == "none"?'selected':'')?> >None</option>
	<option value="flat" <?php  echo ($imgInfo['transitionFader'] == "flat"?'selected':'')?> >Flat</option>
	<option value="phong" <?php  echo ($imgInfo['transitionFader'] == "phong"?'selected':'')?> >Phong</option>
	</select>
	<?php  echo t('Delay')?>: <input type="text" name="transitionDelay[]" value="<?php  echo floatval($imgInfo['transitionDelay'])?>" style="vertical-align: middle; width: 20px" />
	<?php  echo t('Z Multiplier')?>: <input type="text" name="transitionZmultiplier[]" value="<?php  echo floatval($imgInfo['transitionZmultiplier'])?>" style="vertical-align: middle; width: 20px" />
	<br/>
	
		<?php  echo t('Link URL (optional)')?>: <input type="text" name="url[]" value="<?php  echo $imgInfo['url']?>" style="vertical-align: middle; font-size: 10px; width: 140px" />
		<br/>
		<?php  echo t('Caption Heading')?>: <input type="text" name="descriptionHeading[]" value="<?php  echo $imgInfo['descriptionHeading']?>" style="vertical-align: middle; font-size: 10px; width: 140px" />
		<br/>
		<?php  echo t('Caption Body')?>: <input type="text" name="descriptionParagraph[]" value="<?php  echo $imgInfo['descriptionParagraph']?>" style="vertical-align: middle; font-size: 10px; width: 240px" />
		
		
		<input type="hidden" name="imgFIDs[]" value="<?php  echo $imgInfo['fID']?>">
		<input type="hidden" name="imgHeight_<?php  echo $imgInfo['fID']?>" value="<?php  echo $imgInfo['imgHeight']?>">
		
	</div>
</div>
