<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?> 
<div id="ccm-cu3erBlock-fsRow" class="ccm-cu3erBlock-fsRow" >
	<div class="backgroundRow" style="padding-left: 100px">
		<strong>File Set:</strong> <span class="ccm-file-set-pick-cb"><?php  echo $form->select('fsID', $fsInfo['fileSets'], $fsInfo['fsID'])?></span><br/><br/>
		<?php  echo t('Duration')?>: <input type="text" name="duration[]" value="<?php  echo floatval($fsInfo['duration'])?>" style="vertical-align: middle; width: 30px" />
		&nbsp;
		<?php  echo t('Number of Slices')?>: <input type="text" name="transitionNum[]" value="<?php  echo intval($fsInfo['defaultnumslices'])?>" style="vertical-align: middle; width: 20px" />
		&nbsp;
		<?php  echo t('Slice')?>: <select name="transitionSlicing_<?php  echo $fsInfo['fsID']?>" style="vertical-align: middle">
		<option value="vertical"<?php   if ($fsInfo['defaultslice'] == 'vertical') { ?> selected<?php   } ?>><?php  echo t('Vertical')?></option>
		<option value="horizontal"<?php   if ($fsInfo['defaultslice'] == 'horizontal') { ?> selected<?php   } ?>><?php  echo t('Horizontal')?></option>
	</select>
	<BR>
	<?php  echo t('Direction')?>
	<select name="transitionDirection_<?php  echo $fsInfo['fsID']?>" style="vertical-align: middle">
		<option value="left"<?php   if ($fsInfo['defaultdirection'] == 'left') { ?> selected<?php   } ?>><?php  echo t('Left')?></option>
		<option value="right"<?php   if ($fsInfo['defaultdirection'] == 'right') { ?> selected<?php   } ?>><?php  echo t('Right')?></option>
		<option value="up"<?php   if ($fsInfo['defaultdirection'] == 'up') { ?> selected<?php   } ?>><?php  echo t('Up')?></option>
		<option value="down"<?php   if ($fsInfo['defaultdirection'] == 'down') { ?> selected<?php   } ?>><?php  echo t('Down')?></option>
	</select>
	<?php  echo t('Shader')?>
	<select name="transitionFader_<?php  echo $fsInfo['fsID']?>" style="vertical-align: middle">
		<option value="none"<?php   if ($fsInfo['defaultFader'] == 'none') { ?> selected<?php   } ?>><?php  echo t('None')?></option>
		<option value="flat"<?php   if ($fsInfo['defaultFader'] == 'flat') { ?> selected<?php   } ?>><?php  echo t('Flat')?></option>
		<option value="phong"<?php   if ($fsInfo['defaultFader'] == 'phong') { ?> selected<?php   } ?>><?php  echo t('Phong')?></option>
	</select>
	&nbsp;
	<?php  echo t('Z Multiplier')?>: <input type="text" name="transitionZmultiplier[]" value="<?php  echo floatval($fsInfo['defaultZmultiplier'])?>" style="vertical-align: middle; width: 20px" />
	</div>
</div>
