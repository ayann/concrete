<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));

class AwkwardSliderPackage extends Package {

	protected $pkgHandle = 'awkward_slider';
	protected $appVersionRequired = '5.3.0';
	protected $pkgVersion = '1.0.4';
	
	public function getPackageDescription() {
		return t("Awkward Slider integration");
	}
	
	public function getPackageName() {
		return t("Awkward Slider");
	}
	
	public function install() {
		$pkg = parent::install();
		
		//install blocks
	  	BlockType::installBlockTypeFromPackage('awkward_slider', $pkg);	
	  	
	 }
}
?>