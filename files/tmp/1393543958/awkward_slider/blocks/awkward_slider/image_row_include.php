<?php     
defined('C5_EXECUTE') or die(_("Access Denied.")); 
?> 
<div id="awkwardgalleryBlock-imgRow<?php    echo $imgInfo['GalleryImgId']?>" class="awkwardgalleryBlock-imgRow" >
	<div class="backgroundRow" style="background: url(<?php    echo $imgInfo['thumbPath']?>) no-repeat left top; padding-left: 100px">
		<div class="cm-GalleryBlock-imgRowIcons" >
			<div style="float:right">
				<a onclick="awkwardgalleryBlock.moveUp('<?php    echo $imgInfo['GalleryImgId']?>')" class="moveUpLink"></a>
				<a onclick="awkwardgalleryBlock.moveDown('<?php    echo $imgInfo['GalleryImgId']?>')" class="moveDownLink"></a>									  
			</div>
			<div style="margin-top:4px"><a onclick="awkwardgalleryBlock.removeImage('<?php    echo $imgInfo['GalleryImgId']?>')"><img src="<?php    echo ASSETS_URL_IMAGES?>/icons/delete_small.png" /></a></div>
		</div>
		<strong><?php    echo $imgInfo['fileName']?></strong>
		<br/><br/><br/>
		<div style="margin-top:4px">
		<input type="hidden" name="imgFIDs[]" value="<?php    echo $imgInfo['fID']?>">
		<input type="hidden" name="imgHeight[]" value="<?php    echo $imgInfo['imgHeight']?>">
		<input type="hidden" name="imgWidth[]" value="<?php   echo $imgInfo['imgWidth']?>">
		</div>
	</div>
</div>