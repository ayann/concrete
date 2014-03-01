<?php    
defined('C5_EXECUTE') or die(_("Access Denied."));
/**************************************/
// Copyright 2010 jDynamic Pty Ltd  All rights reserved.
// 
// Page: controller.php
// Description: Controller functions for package
//
/**************************************/

class Cu3erPackage extends Package {

	protected $pkgHandle = 'cu3er';
	protected $appVersionRequired = '5.3.0';
	protected $pkgVersion = '1.1.7'; 
	
	public function getPackageName() {
		return t("Cu3er Slideshow"); 
	}	
	
	public function getPackageDescription() {
		return t("Converts static images into 3D Flash-based slideshow");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		BlockType::installBlockTypeFromPackage('cu3er', $pkg);		
	}
	
}
