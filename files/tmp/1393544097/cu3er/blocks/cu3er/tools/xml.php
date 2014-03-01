<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<?php 
if($_GET['bID']) {
	$db = Loader::db();
	$sql = "SELECT `xmloutput` FROM `btCu3er` WHERE bID = " . intval($_GET['bID']);
	$xmlOutput = $db->getOne($sql);
	$xmlOutput = str_replace("?<?php xml","<?php xml",$xmlOutput); //clean invalid characters
	$xmlOutput = str_replace("? <?php xml","<?php xml",$xmlOutput); //clean invalid characters
	echo trim($xmlOutput);
}
?>