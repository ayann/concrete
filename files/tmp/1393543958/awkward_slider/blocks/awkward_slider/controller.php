<?php    
require_once(DIR_FILES_BLOCK_TYPES_CORE . '/library_file/controller.php');
class AwkwardSliderBlockController extends BlockController {
	
	var $pobj;
	
	protected $btTable = 'btAwkwardSlider';
	protected $btInterfaceWidth = "450";
	protected $btInterfaceHeight = "450";
	
	protected $btExportFileColumns = array('bID');
	protected $btExportTables = array('btAwkwardSlider','btAwkwardSliderImg');

	/** 
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Display a beautiful image gallery");
	}
	
	public function getBlockTypeName() {
		return t("Awkward Slider");
	}
	
	public function getJavaScriptStrings() {
		return array(
			'choose-file' => t('Choose Image/File'),
			'choose-min-2' => t('Please choose at least two images.'),
			'choose-fileset' => t('Please choose a file set.')
		);
	}
	
	function __construct($obj = null) {		
		parent::__construct($obj);
		$this->db = Loader::db();
		if ($this->fsID == 0) {
			$this->loadImages();
		} else {
			$this->loadFileSet();
		}
		$this->set('minHeight', $this->minHeight);
		$this->set('fsID', $this->fsID);
		$this->set('fsName', $this->getFileSetName());
		$this->set('images', $this->images);
		$type = ($this->fsID > 0) ? 'FILESET' : 'CUSTOM';
		$this->set('type', $type);
		$this->set('bID', $this->bID);			
	}	
	
	
	function on_page_view(){
	
	$html = Loader::helper('html');
		  $b = $this->getBlockObject();
          $bv = new BlockView();
          $bv->setBlockObject($b);
	
	$tls=Loader::helper('concrete/urls');
	$bt = BlockType::getByHandle('awkward_slider');
	
	}
	
	public function view() {

	  	$html = Loader::helper('html');
	
		$u = new User();
		if(!$u->isLoggedIn()){
		  	$v = View::getInstance();
			$v->addHeaderItem($html->css('ccm.app.css'));
			$v->addFooterItem($html->css('ccm.app.js'));
			$v->addHeaderItem($html->javascript('jquery.ui.js'));
			$v->addHeaderItem($html->javascript('ccm.dialog.js'));
			$v->addHeaderItem($html->css('ccm.dialog.css'));
			$v->addHeaderItem($html->css('jquery.ui.css'));
		}
	
	}
	
	function getFileSetName(){
		$sql = "SELECT fsName FROM FileSets WHERE fsID=".intval($this->fsID);
		return $this->db->getOne($sql); 
	}

	function loadFileSet(){
		if (intval($this->fsID) < 1) {
			return false;
		}
        Loader::helper('concrete/file');
		Loader::model('file_attributes');
		Loader::library('file/types');
		Loader::model('file_list');
		Loader::model('file_set');
		
		$ak = FileAttributeKey::getByHandle('height');
		
		$fs = FileSet::getByID($this->fsID);
		$fileList = new FileList();		
		$fileList->filterBySet($fs);
		$fileList->sortByFileSetDisplayOrder();
		$fileList->filterByType(FileType::T_IMAGE);
		$files = $fileList->get(1000,0);				

		$image = array();
		$images = array();
		$maxHeight = 0;
		foreach ($files as $f) {
			$fp = new Permissions($f);
			if(!$fp->canRead()) { continue; }
							
			$image['fID'] 			= $f->getFileID();
			$image['fileName'] 		= $f->getFileName();
			$image['fullFilePath'] 	= $f->getPath();
			$image['url']			= $f->getRelativePath();
		
			$images[] = $image;
		}
		$this->images = $images;
	}

	function loadImages(){
		if(intval($this->bID)==0) $this->images=array();
		if(intval($this->bID)==0) return array();
		$sql = "SELECT * FROM btAwkwardSliderImg WHERE bID=".intval($this->bID);
		$this->images=$this->db->getAll($sql); 
	}
	
	function delete(){
		$this->db->query("DELETE FROM btAwkwardSliderImg WHERE bID=".intval($this->bID));		
		parent::delete();
	}
	
	function save($data) { 
		
		$args['maxHeight'] = $data['maxHeight'];
		$args['maxWidth'] = $data['maxWidth'];
		$args['showDesc'] = ($data['showDesc']) ? 'true' : 'false';
		$args['backgroundColor'] = $data['backgroundColor'];
		$args['activeThumbColor'] = $data['activeThumbColor'];
		$args['inactiveThumbColor'] = $data['inactiveThumbColor'];
		$args['fit_to_parent'] = ($data['fit_to_parent']) ? 'true' : 'false';
		$args['auto_scroll'] = ($data['auto_scroll']) ? 'true' : 'false';
		$args['scroll_continuous'] = ($data['scroll_continuous']) ? 'true' : 'false';
		$args['loading'] = ($data['loading']) ? 'true' : 'false';
		$args['arrows'] = ($data['arrows']) ? 'true' : 'false';
		$args['buttons'] = ($data['buttons']) ? 'true' : 'false';
		$args['btn_numbers'] = ($data['btn_numbers']) ? 'true' : 'false';
		$args['pauseonover'] = ($data['pauseonover']) ? 'true' : 'false';
		$args['transition'] = $data['transition'];
		$args['thumbnails'] = ($data['thumbnails']) ? 'true' : 'false';
		$args['thumbnails_position'] = $data['thumbnails_position'];
		$args['thumbnails_direction'] = $data['thumbnails_direction'];
		$args['dynamic_height'] = ($data['dynamic_height']) ? 'true' : 'false';
		
		
		if( $data['type'] == 'FILESET' && $data['fsID'] > 0){
			$args['fsID'] = $data['fsID'];

			$files = $this->db->getAll("SELECT fv.fID FROM FileSetFiles fsf, FileVersions fv WHERE fsf.fsID = " . $data['fsID'] ." AND fsf.fID = fv.fID AND fvIsApproved = 1");
			
			//delete existing images
			$this->db->query("DELETE FROM btAwkwardSliderImg WHERE bID=".intval($this->bID));
		} else if( $data['type'] == 'CUSTOM' && count($data['imgFIDs']) ){
			$args['fsID'] = 0;

			//delete existing images
			$this->db->query("DELETE FROM btAwkwardSliderImg WHERE bID=".intval($this->bID));
			
			//loop through and add the images
			$pos=0;

			foreach($data['imgFIDs'] as $imgFID){ 
				if(intval($imgFID)==0 || $data['fileNames'][$pos]=='tempFilename' && $imgFID != 'tempFID') continue;
				$vals = array(intval($this->bID),intval($imgFID),
					intval($data['imgHeight'][$pos]),$pos);
					$temp = intval($data['imgWidth'][$pos]);

				$this->db->query("INSERT INTO btAwkwardSliderImg (bID,fID,imgHeight,position) values (?,?,?,?)",$vals);
				$pos++;
			}
		}
		
		parent::save($args);
	}
	
}

?>
