<!DOCTYPE html>
<html>
<head>
	<?php Loader::element('header_required');?>
	<title>Polo 360</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath();?>/pure/grids-min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath();?>/pure/forms-min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath();?>/pure/styles.css">
</head>
<body>
	<div class="pure-g">
		<div class="pure-u-1" id="header">
			<div id="c-h">
				<div id="logo">
					<img src="<?php echo $this->getThemePath();?>/pure/img/logo.png">
				</div>	
				<div id="lien_nav">
					<?php
			            $a = new Area("nav");
			            $a->setBlockLimit(1);
			            $a->display($c);
		            ?>
				</div>	
			</div>
		</div>
