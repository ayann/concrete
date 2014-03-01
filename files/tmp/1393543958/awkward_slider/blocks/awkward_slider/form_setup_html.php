<?php    
defined('C5_EXECUTE') or die(_("Access Denied."));
$al = Loader::helper('concrete/asset_library');
$ah = Loader::helper('concrete/interface');
$fm = Loader::helper('form'); 
$fmc = Loader::helper('form/color');  
?>
<style>
#awkwardgalleryBlock-imgRows a{cursor:pointer}
#awkwardgalleryBlock-imgRows .awkwardgalleryBlock-imgRow,
#awkwardgalleryBlock-fsRow {margin-bottom:16px;clear:both;padding:7px;background-color:#eee}
#awkwardgalleryBlock-imgRows .awkwardgalleryBlock-imgRow a.moveUpLink{ display:block; background:url(<?php    echo DIR_REL?>/concrete/images/icons/arrow_up.png) no-repeat center; height:10px; width:16px; }
#awkwardgalleryBlock-imgRows .awkwardgalleryBlock-imgRow a.moveDownLink{ display:block; background:url(<?php    echo DIR_REL?>/concrete/images/icons/arrow_down.png) no-repeat center; height:10px; width:16px; }
#awkwardgalleryBlock-imgRows .awkwardgalleryBlock-imgRow a.moveUpLink:hover{background:url(<?php    echo DIR_REL?>/concrete/images/icons/arrow_up_black.png) no-repeat center;}
#awkwardgalleryBlock-imgRows .awkwardgalleryBlock-imgRow a.moveDownLink:hover{background:url(<?php    echo DIR_REL?>/concrete/images/icons/arrow_down_black.png) no-repeat center;}
#awkwardgalleryBlock-imgRows .cm-GalleryBlock-imgRowIcons{ float:right; width:35px; text-align:left; }
</style>

<div id="newImg">
	<?php    echo t('Type')?>
	<select name="type" style="vertical-align: middle">
		<option value="CUSTOM"<?php     if ($type == 'CUSTOM') { ?> selected<?php     } ?>><?php    echo t('Custom Gallery')?></option>
		<option value="FILESET"<?php     if ($type == 'FILESET') { ?> selected<?php     } ?>><?php    echo t('Pictures from File Set')?></option>
	</select>
	<br/><br/>

    <div class="row">
      <div class="span6" style="float: left;">
      	<div class="control-group">
    	  <label class="checkbox">
            <input type="checkbox" name="showDesc" value="true" <?php  if($showDesc == 'true' || !$showDesc){echo 'checked';}?>> <?php echo t('Show Description')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="fit_to_parent" value="true" <?php  if($fit_to_parent == 'true'){echo 'checked';}?>> <?php echo t('Fit to parent')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="auto_scroll" value="true" <?php  if($auto_scroll == 'true' || !$auto_scroll){echo 'checked';}?>> <?php echo t('Auto Scroll')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="scroll_continuous" value="true" <?php  if($scroll_continuous == 'true' || !$scroll_continuous){echo 'checked';}?>> <?php echo t('Continuous Scroll')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="loading" value="true" <?php  if($loading == 'true' || !$loading){echo 'checked';}?>> <?php echo t('Show Loading')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="arrows" value="true" <?php  if($arrows == 'true' || !$arrows){echo 'checked';}?>> <?php echo t('Show Arrows')?>
          </label><br/>
        </div>
      </div>
      <div class="span6" style="float: left;">
      	<div class="control-group">
          <label class="checkbox">
            <input type="checkbox" name="buttons" value="true" <?php  if($buttons == 'true' || !$buttons){echo 'checked';}?>> <?php echo t('Show Buttons')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="btn_numbers" value="true" <?php  if($btn_numbers == 'true' || !$btn_numbers){echo 'checked';}?>> <?php echo t('Show Numbers')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="pauseonover" value="true" <?php  if($pauseonover == 'true' || !$pauseonover){echo 'checked';}?>> <?php echo t('Pause on Hover')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="thumbnails" value="true" <?php  if($thumbnails == 'true' || !$thumbnails){echo 'checked';}?>> <?php echo t('Show Thumbnails')?>
          </label><br/>
          <label class="checkbox">
            <input type="checkbox" name="dynamic_height" value="true" <?php  if($dynamic_height == 'true'){echo 'checked';}?>> <?php echo t('Dynamic Height')?>
          </label><br/>
        </div>
      </div>
    </div>
	<br style="clear: both"/>
	<br/>
	
	<?php    echo t('Thumbnail Direction')?>
	<select name="thumbnails_direction">
		<option value="horizontal" <?php  if($thumbnails_direction=='horizontal'){echo 'selected';}?>><?php echo t('Horizontal')?></option>
		<option value="vertical" <?php  if($thumbnails_direction=='vertical'){echo 'selected';}?>><?php echo t('Vertical')?></option>
    </select>
    
    <br/><br/>
    
    <?php    echo t('Thumbnail Position')?>
	<select name="thumbnails_position">
		<option value="outside-last" <?php  if($thumbnails_position=='outside-last'){echo 'selected';}?>><?php echo t('On the outside, rendered last')?></option>
		<option value="outside-first" <?php  if($thumbnails_position=='outside-first'){echo 'selected';}?>><?php echo t('On the outside, rendered first')?></option>
		<option value="inside-last" <?php  if($thumbnails_position=='inside-last'){echo 'selected';}?>><?php echo t('On the inside, rendered last')?></option>
		<option value="inside-first" <?php  if($thumbnails_position=='inside-first'){echo 'selected';}?>><?php echo t('On the inside, rendered first')?></option>
    </select>
    
    <br/><br/>
    
    <?php    echo t('Transition Type')?>
    <select name="transition">
		<option value="hslide" <?php  if($transition=='hslide' || !$transition){echo 'selected';}?>><?php echo t('Slide horizontal')?></option>
		<option value="vslide" <?php  if($transition=='vslide'){echo 'selected';}?>><?php echo t('Slide vertical')?></option>
		<option value="fade" <?php  if($transition=='fade'){echo 'selected';}?>><?php echo t('Fade')?></option>
    </select>

    <br/><br/>
	<table cellspacing="0" cellpadding="0" border="0" width="370px">
		<tr>
		<td>
		<?php   echo $form->label('maxWidth', 'Max image width');?>
		<?php   $mh = $maxHeight!= null ? $maxHeight : "600";
			$mw = $maxWidth != null ? $maxWidth : "800"; ?>
<?php   echo $form->text('maxWidth', $mw, array('style' => 'width: 30px'));?>
		</td>
		<td>
				<?php   echo $form->label('maxHeight','Max image height');?>
<?php   echo $form->text('maxHeight', $mh, array('style' => 'width: 30px'));?>
		</td>
	</tr>
	</table>
	<table>
	<tr style="padding-top: 2px">
	<td colspan="2">
	<span id="awkwardgalleryBlock-chooseImg"><?php    echo $ah->button_js(t('Add Image'), 'awkwardgalleryBlock.chooseImg()', 'left');?></span>
	</td>
	</tr>
	</table>
</div>
<h3><?php echo t('Selected Images')?></h3>
<div id="awkwardgalleryBlock-imgRows">
<?php     if ($fsID <= 0) {
	foreach($images as $imgInfo){ 
		$f = File::getByID($imgInfo['fID']);
		$fp = new Permissions($f);
		$imgInfo['thumbPath'] = $f->getThumbnailSRC(1);
		$imgInfo['fileName'] = $f->getTitle();
		$imgInfo['description'] = $f->getDescription();
		if ($fp->canRead()) { 
			$this->inc('image_row_include.php', array('imgInfo' => $imgInfo));
		}
	}
} ?>
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
} else {
	$fsInfo['fsID']='0';
}
$this->inc('fileset_row_include.php', array('fsInfo' => $fsInfo)); ?> 

<div id="imgRowTemplateWrap" style="display:none">
<?php    
$imgInfo['GalleryImgId']='tempGalleryImgId';
$imgInfo['fID']='tempFID';
$imgInfo['fileName']='tempFilename';
$imgInfo['origfileName']='tempOrigFilename';
$imgInfo['thumbPath']='tempThumbPath';
$imgInfo['imgHeight']='tempHeight';
$imgInfo['imgWidth']='tempWidth';
$imgInfo['class']='awkwardgalleryBlock-imgRow';
?>
<?php     $this->inc('image_row_include.php', array('imgInfo' => $imgInfo)); ?> 
</div>
