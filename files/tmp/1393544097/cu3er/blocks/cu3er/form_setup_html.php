<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));
$al = Loader::helper('concrete/asset_library');
$ah = Loader::helper('concrete/interface');

if ($controller->getFallbackFileID() > 0) { 
	$bf = $controller->getFallbackFileObject();
	$fallContent = '<div class="ccm-file-selected-data"><img src="' . $bf->getThumbnailSRC(1) . '"> ' . $bf->getFileName() . "<BR><a href='javascript:Cu3erBlock.resetFallBack()'>(Reset)</a><div>";
}
?>
<style type="text/css">
#ccm-cu3erBlock-imgRows a{cursor:pointer}
#ccm-cu3erBlock-imgRows .ccm-cu3erBlock-imgRow,
#ccm-cu3erBlock-fsRow {margin-bottom:16px;clear:both;padding:7px;background-color:#eee}
#ccm-cu3erBlock-imgRows .ccm-cu3erBlock-imgRow a.moveUpLink{ display:block; background:url(<?php  echo DIR_REL?>/concrete/images/icons/arrow_up.png) no-repeat center; height:10px; width:16px; }
#ccm-cu3erBlock-imgRows .ccm-cu3erBlock-imgRow a.moveDownLink{ display:block; background:url(<?php  echo DIR_REL?>/concrete/images/icons/arrow_down.png) no-repeat center; height:10px; width:16px; }
#ccm-cu3erBlock-imgRows .ccm-cu3erBlock-imgRow a.moveUpLink:hover{background:url(<?php  echo DIR_REL?>/concrete/images/icons/arrow_up_black.png) no-repeat center;}
#ccm-cu3erBlock-imgRows .ccm-cu3erBlock-imgRow a.moveDownLink:hover{background:url(<?php  echo DIR_REL?>/concrete/images/icons/arrow_down_black.png) no-repeat center;}
#ccm-cu3erBlock-imgRows .cm-cu3erBlock-imgRowIcons{ float:right; width:35px; text-align:left; }
</style>

<div id="newImg">
<?php 
//if (chmod("packages/cu3er/blocks/cu3er/xml/", 0755)) {
	//can write to "xml" folder ok
//}
//else{
//	echo "<em><b>WARNING:</b> Your server configuration does not allow this add-on to automatically adjust the writable permissions for the '<b>XML</b>' folder (where the configuration data is stored for this block). Please manually CHMOD the '<b>XML</b>' folder in this add-on to <b>0755</b> or <b>0777</b> permissions before saving this block. If you are unsure how to do this, please contact your web developer or hosting provider.</em><BR><BR>";
//}
?>
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
	<td>
	<strong><?php  echo t('Type')?></strong>
	<select name="type" style="vertical-align: middle">
		<option value="CUSTOM" <?php  echo ($type == 'CUSTOM'?'selected':'')?> ><?php  echo t('Custom Slideshow')?></option>
		<option value="FILESET" <?php  echo ($type == 'FILESET'?'selected':'')?> ><?php  echo t('Pictures from File Set')?></option>
	</select>
	</td>
	<td>
	<strong><?php  echo t('Playback')?></strong>
	<select name="playback" style="vertical-align: middle">
		<option value="ORDER"<?php   if ($playback == 'ORDER') { ?> selected<?php   } ?>><?php  echo t('Display Order')?></option>
		<option value="RANDOM-SET"<?php   if ($playback == 'RANDOM-SET') { ?> selected<?php   } ?>><?php  echo t('Random (But keep sets together)')?></option>
		<option value="RANDOM"<?php   if ($playback == 'RANDOM') { ?> selected<?php   } ?>><?php  echo t('Completely Random')?></option>
	</select>
	</td>
	</tr>
	<tr>
	<td>
	<strong><?php  echo t('Width/Height (px)')?></strong>
	<input type="text" name="maxWidth" value="<?php  echo $maxWidth ?>" style="vertical-align: middle; width: 30px" /> <input type="text" name="maxHeight" value="<?php  echo $maxHeight ?>" style="vertical-align: middle; width: 30px" />
	
	</td>
	<td>
	<strong><?php  echo t('Cube Colour')?></strong>
	<input type="text" name="defaultcubecolour" value="<?php  echo str_replace("0x","#",$defaultcubecolour) ?>" style="vertical-align: middle; width: 60px" /> (eg. #222222)
	</td>
	</tr>
	<tr>
	<td>
	<strong><?php  echo t('Hide Nav Buttons')?></strong>
	<input name="nobuttons" value="1" <?php   echo (intval($nobuttons)>=1)?'checked="checked"':''?> type="checkbox" />
	</td>
	<td>
	<strong><?php  echo t('Duration Before Transition')?></strong>
	<input name="durationBeforeTransition" value="<?php  echo isset($durationBeforeTransition) ? $durationBeforeTransition : '4.0'; ?>" type="text" />
	</td>
	</tr>
	<td colspan='2'>
	
	<div style="float:left;width:140px; padding-top:5px;"><span id="ccm-cu3erBlock-chooseFallbackImg"><?php  echo $ah->button_js(t('Select Fallback Image'), 'Cu3erBlock.showAddFallBack()', 'left');?></span></div>
	<div id="cu3er-fallback" style="float:left; margin-left:15px; width:300px; padding-top:10px;"><?php  echo $fallContent; ?></div>
	<input type="hidden" value="<?php  echo $fallbackFID; ?>" name="fallbackFID" id="fallbackFID" size="4" />
	
	</td>
	</tr>
	
	<tr style="padding-top: 8px">
	<td colspan="2">
	<br />
	
	<span id="ccm-cu3erBlock-chooseImg"><?php  echo $ah->button_js(t('Add Image'), 'Cu3erBlock.showAddImage()', 'left');?></span>
	
	</td>
	</tr>
	</table>

<br/>

<div id="ccm-cu3erBlock-imgRows">
<?php   if ($fsID <= 0) {
	foreach($images as $imgInfo){ 
		$f = File::getByID($imgInfo['fID']);
		$fp = new Permissions($f);
		$imgInfo['thumbPath'] = $f->getThumbnailSRC(1);
		$imgInfo['fileName'] = $f->getTitle();
		if ($fp->canRead()) { 
			$this->inc('image_row_include.php', array('imgInfo' => $imgInfo));
		}
	}
} ?>
</div>
</div>
<?php  
Loader::model('file_set');
$s1 = FileSet::getMySets();
$sets = array();
foreach ($s1 as $s){
    $sets[$s->fsID] = $s->fsName;
}
$fsInfo['fileSets'] = $sets;

if ($fsID > 0) {
	$fsInfo['fsID'] = $fsID;
	$fsInfo['duration']=$duration;
	$fsInfo['fadeDuration']=$fadeDuration;
	$fsInfo['defaultnumslices']=$defaultnumslices;
	$fsInfo['defaultslice']=$defaultslice;
	$fsInfo['defaultdirection']=$defaultdirection;
	$fsInfo['defaultFader']=$defaultFader;
	$fsInfo['defaultZmultiplier']=$defaultZmultiplier;
	$fsInfo['descriptionLink']='';
	$fsInfo['descriptionHeading']='';
	$fsInfo['descriptionParagraph']='';
} else {
	$fsInfo['fsID']='0';
	$fsInfo['duration']=$defaultDuration;
	$fsInfo['fadeDuration']=$defaultFadeDuration;
	$fsInfo['transitionNum']='3';
	$fsInfo['defaultnumslices']='3';
	$fsInfo['defaultslice']='vertical';
	$fsInfo['defaultdirection']='down';
	$fsInfo['defaultFader']='none';
	$fsInfo['defaultZmultiplier']='2';
}
$this->inc('fileset_row_include.php', array('fsInfo' => $fsInfo)); ?> 

<div id="imgRowTemplateWrap" style="display:none">
<?php  
$imgInfo['slideshowImgId']='tempSlideshowImgId';
$imgInfo['fID']='tempFID';
$imgInfo['fileName']='tempFilename';
$imgInfo['origfileName']='tempOrigFilename';
$imgInfo['thumbPath']='tempThumbPath';
$imgInfo['duration']=$defaultDuration;
$imgInfo['fadeDuration']=$defaultFadeDuration;
$imgInfo['transitionNum']='3';
$imgInfo['transitionSlicing']='vertical';
$imgInfo['transitionDirection']='down';
$imgInfo['transitionFader']='none';
$imgInfo['transitionDelay']='0.1';
$imgInfo['transitionZmultiplier']='2';
$imgInfo['descriptionHeading']='';
$imgInfo['descriptionParagraph']='';
$imgInfo['groupSet']=0;
$imgInfo['imgHeight']=tempHeight;
$imgInfo['url']='';
$imgInfo['class']='ccm-cu3erBlock-imgRow';
?>
<?php   $this->inc('image_row_include.php', array('imgInfo' => $imgInfo)); ?> 
</div>

<div style="padding:12px;line-height:1.4em;border:1px #ecebb4 solid;background-color:#ffffdb;color:#000;">
If you like this add-on, please consider <a href='https://www.concrete5.org/marketplace/addons/slider-overlay/' target='_blank'>the <b>SLIDER OVERLAY</b> add-on</a> which does not require Flash. Or for more quality Concrete5 add-ons, check out <a href='http://c5extras.com/' target='_blank'>c5extras.com</a>.
</div>