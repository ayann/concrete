<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));
Loader::model('file_list');
Loader::model('file_set');
class Cu3erBlockController extends BlockController {
	
	var $pobj;
	
	protected $btTable = 'btCu3er';
	protected $btInterfaceWidth = "550";
	protected $btInterfaceHeight = "400";

	public $defaultDuration = 0.5;	
	public $defaultFadeDuration = 0.5;
	public $linkImage = 0;
	public $maxHeight = 300;
	public $maxWidth = 800;
	public $defaultcubecolour = '0x333333';
	
	public $playback = "ORDER";
	
	public $images;
	
	public function on_page_view() {
		$html = Loader::helper('html');
		//$this->addHeaderItem($html->javascript('swfobject.js'));
		$this->addHeaderItem($html->javascript('swfobject.js'));
	}
	
	/** 
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Display a Flash-based slideshow with 3D transitions.");
	}
	
	public function getBlockTypeName() {
		return t("Cu3er Slideshow");
	}
	
	public function getJavaScriptStrings() {
		return array(
			'choose-file' => t('Choose Image/File'),
			'choose-min-2' => t('Please choose at least two images.'),
			'choose-fileset' => t('Please choose a file set.')
		);
	}
	
	function getFallbackFileID() {return $this->fallbackFID;}
	
	function getFallbackFileObject() {
			return File::getByID($this->fallbackFID);
		}	
	
	function getFileSetName(){
		$sql = "SELECT fsName FROM FileSets WHERE fsID=".intval($this->fsID);
		$db = Loader::db();
		return $db->getOne($sql); 
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
		$fileList->filterByType(FileType::T_IMAGE);	
		$files = $fileList->get(1000,0);
		
		
		$image = array();
		$image['duration'] = $this->duration;
		$image['fadeDuration'] = $this->fadeDuration;
		$image['groupSet'] = 0;
		$image['url'] = '';
		$images = array();
		//$maxHeight = 0;
		//$maxWidth = 0;
		foreach ($files as $f) {
			$fp = new Permissions($f);
			if(!$fp->canRead()) { continue; }
			$image['fID'] 			= $f->getFileID();
			$image['fileName'] 		= $f->getFileName();
			$image['fullFilePath'] 	= $f->getPath();
			$image['url']			= $f->getRelativePath();
			
			// find the max height of all the images so slideshow doesn't bounce around while rotating
			$vo = $f->getAttributeValueObject($ak);
			if (is_object($vo)) {
				$image['imgHeight'] = $vo->getValue('height');
				$image['imgWidth'] = $vo->getValue('width');
			}
			/* if ($this->maxHeight == 0 || $image['imgHeight'] > $this->maxHeight) {
				$this->maxHeight = $image['imgHeight'];
			}
			if ($this->maxWidth == 0 || $image['imgWidth'] > $this->maxWidth) {
				$this->maxWidth = $image['imgWidth'];
			} */
			$images[] = $image;
		}
		$this->images = $images;
	
	}

	function loadImages(){
		if(intval($this->bID)==0) $this->images=array();
		$sortChoices=array('ORDER'=>'position','RANDOM-SET'=>'groupSet asc, position asc','RANDOM'=>'rand()');
		if( !array_key_exists($this->playback,$sortChoices) ) 
			$this->playback='ORDER';
		if(intval($this->bID)==0) return array();
		$sql = "SELECT * FROM btCu3erImg WHERE bID=".intval($this->bID).' ORDER BY '.$sortChoices[$this->playback];
		$db = Loader::db();
		$this->images=$db->getAll($sql); 
	}
	
	function delete(){
		$db = Loader::db();
		
		//delete config file from server
		//unlink(getCuberXMLfilename()); //keep file to ensure previous versions of each page work correctly
		
		$db->query("DELETE FROM btCu3erImg WHERE bID=".intval($this->bID));		
		parent::delete();
	}
	
	function loadBlockInformation() {
		if ($this->fsID == 0) {
			$this->loadImages();
		} else {
			$this->loadFileSet();
		}
		//thanks to nemonoman
		$images=$this->images;
		foreach($images as $image){
			
			if(!$image['fullFilePath']){
				$image['fullFilePath'] = $this->pathfromfileid($image['fID']);
				if ($image['fullFilePath']){
					try{
						$x=getimagesize($image['fullFilePath']);
						$image['imgWidth']=$x[0];
						$image['imgHeight']=$x[1];

						if ($image['imgHeight'] >$maxHeight) {
							$this->maxHeight = $image['imgHeight'];
							$maxHeight = $image['imgHeight'];
						}
						if ($image['imgWidth'] > $maxWidth) {
							$this->maxWidth = $image['imgWidth'];
							$maxWidth = $image['imgWidth'];
						}
					}
					catch(Exception $e){
						$maxHeight = "";
						$maxWidth = "";
					}
				}
			}
		}
		//
		
		$this->randomizeImages();	
		$this->set('defaultFadeDuration', $this->defaultFadeDuration);
		$this->set('defaultDuration', $this->defaultDuration);
		$this->set('fadeDuration', $this->fadeDuration);
		$this->set('duration', $this->duration);
		$this->set('minHeight', $this->minHeight);
		$this->set('fsID', $this->fsID);
		$this->set('fsName', $this->getFileSetName());
		$this->set('images', $this->images);
		$this->set('playback', $this->playback);
		$this->set('linkImage', $this->linkImage);
		$this->set('defaultslice', $this->defaultslice);
		$this->set('defaultnumslices', $this->defaultnumslices);
		$this->set('defaultdirection', $this->defaultdirection);
		$this->set('defaultdelay', $this->defaultdelay);
		
		$this->set('defaultFader', $this->defaultFader);
		$this->set('defaultZmultiplier', $this->defaultZmultiplier);

		
		$this->set('defaultcubecolour', $this->defaultcubecolour);
		$this->set('enableShadow', $this->enableShadow);
		$this->set('shadowImage', $this->shadowImage);
		$this->set('shadowfID', $this->shadowfID);
		$this->set('fallbackFID', $this->fallbackFID);
		
		$type = ($this->fsID > 0) ? 'FILESET' : 'CUSTOM';
		$this->set('type', $type);
		$this->set('bID', $this->bID);
		
		$this->set('maxHeight', $this->maxHeight);
		$this->set('maxWidth', $this->maxWidth);
		$this->set('durationBeforeTransition', $this->durationBeforeTransition);
	}
	
	function view() {
		$this->loadBlockInformation();
	}

	function add() {
		$this->loadBlockInformation();
	}
	
	function edit() {
		$this->loadBlockInformation();
	}
	
	function duplicate($nbID) {
		parent::duplicate($nbID);
		$this->loadBlockInformation();
		$db = Loader::db();
		foreach($this->images as $im) {
			$db->Execute('insert into btCu3erImg (bID, fID, url, duration, fadeDuration, groupSet, position, imgHeight, descriptionLink, descriptionHeading, descriptionParagraph, transitionNum, transitionSlicing, transitionDirection, transitionFader, transitionDelay, transitionZmultiplier) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
				array($nbID, $im['fID'], $im['url'], $im['duration'], $im['fadeDuration'], $im['groupSet'], $im['position'], $im['imgHeight'], $im['descriptionLink'], $im['descriptionHeading'], $im['descriptionParagraph'], $im['transitionNum'], $im['transitionSlicing'], $im['transitionDirection'], $im['transitionFader'], $im['transitionDelay'], $im['transitionZmultiplier'])
			);		
		}
	}
	
	
	function save($data) { 
		$args['playback'] = isset($data['playback']) ? trim($data['playback']) : 'ORDER';
		$args['linkImage'] = isset($data['linkImage']) ? trim($data['linkImage']) : 0;
		$args['maxHeight'] = isset($data['maxHeight']) ? trim($data['maxHeight']) : 900;
		$args['maxWidth'] = isset($data['maxWidth']) ? trim($data['maxWidth']) : 300;
		$args['fallbackFID'] = isset($data['fallbackFID']) ? intval($data['fallbackFID']) : 0;
		$args['defaultcubecolour'] = isset($data['defaultcubecolour']) ? $data['defaultcubecolour'] : '0x333333';
		$args['defaultcubecolour'] = str_replace("#","0x",$args['defaultcubecolour']);
		$args['nobuttons'] = isset($data['nobuttons']) ? intval($data['nobuttons']) : 0;
		$args['xmloutput'] = $this->buildCuberXML($args, $data);
		$args['durationBeforeTransition'] = $data['durationBeforeTransition'];
		
		if( $data['type'] == 'FILESET' && $data['fsID'] > 0){
			$pos=0;
			$args['defaultslice'] = isset($data['transitionSlicing_'.$data['fsID']]) ? trim($data['transitionSlicing_'.$data['fsID']]) : 'vertical';
			$args['defaultnumslices'] = isset($data['transitionNum'][$pos]) ? intval($data['transitionNum'][$pos]) : 3;
			$args['defaultdirection'] = isset($data['transitionDirection_'.$data['fsID']]) ? trim($data['transitionDirection_'.$data['fsID']]) : 'down';
			$args['defaultdelay'] = isset($data['defaultdelay'][$pos]) ? floatval($data['defaultdelay'][$pos]) : 0.1;
			$args['defaultFader'] = isset($data['transitionFader_'.$data['fsID']]) ? trim($data['transitionFader_'.$data['fsID']]) : 'none';
			$args['defaultZmultiplier'] = isset($data['transitionZmultiplier'][$pos]) ? floatval($data['transitionZmultiplier'][$pos]) : 2;
			
			//$args['enableShadow'] = isset($data['enableShadow']) ? $data['enableShadow'] : 0;
			//$args['shadowfID'] = $data['shadowfID'];
		}
		
		$db = Loader::db();
		
		if( $data['type'] == 'FILESET' && $data['fsID'] > 0){
			$args['fsID'] = $data['fsID'];
			$args['duration'] = $data['duration'][0];
			$args['fadeDuration'] = $data['fadeDuration'][0];

			$files = $db->getAll("SELECT fv.fID FROM FileSetFiles fsf, FileVersions fv WHERE fsf.fsID = " . $data['fsID'] .
			         " AND fsf.fID = fv.fID AND fvIsApproved = 1");
			
			//delete existing images
			$db->query("DELETE FROM btCu3erImg WHERE bID=".intval($this->bID));
		} else if( $data['type'] == 'CUSTOM' && count($data['imgFIDs']) ){
			$args['fsID'] = 0;

			//delete existing images
			$db->query("DELETE FROM btCu3erImg WHERE bID=".intval($this->bID));
			
			//loop through and add the images
			$pos=0;
			foreach($data['imgFIDs'] as $imgFID){ 
				if(intval($imgFID)==0 || $data['fileNames'][$pos]=='tempFilename') continue;
				$vals = array(intval($this->bID),intval($imgFID), trim($data['url'][$pos]),floatval($data['duration'][$pos]),floatval($data['fadeDuration'][$pos]),
						intval($data['groupSet'][$pos]),intval($data['imgHeight_'.$imgFID]), $data['descriptionLink'][$pos], $data['descriptionHeading'][$pos], $data['descriptionParagraph'][$pos], intval($data['transitionNum'][$pos]), $data['transitionSlicing_'.$imgFID], $data['transitionDirection_'.$imgFID], $data['transitionFader_'.$imgFID], $data['transitionDelay'][$pos], $data['transitionZmultiplier'][$pos],$pos);
				$db->query("INSERT INTO btCu3erImg (bID,fID,url,duration,fadeDuration,groupSet,imgHeight,descriptionLink,descriptionHeading,descriptionParagraph,transitionNum,transitionSlicing,transitionDirection,transitionFader,transitionDelay,transitionZmultiplier,position) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$vals);
				$pos++;
			}
		}
		//$this->generateCuberConfigFile($args, $data); //no longer used from 1.1.0
		
		parent::save($args);
	}
	
	function randomizeImages()
	{
		if($this->playback == 'RANDOM')
		{
			shuffle($this->images);
		}
		else if($this->playback == 'RANDOM-SET')
		{
			$imageGroups=array();
			$imageGroupIds=array();
			$sortedImgs=array();
			foreach($this->images as $imgInfo){
				$imageGroups[$imgInfo['groupSet']][]=$imgInfo;
				if( !in_array($imgInfo['groupSet'],$imageGroupIds) )
					$imageGroupIds[]=$imgInfo['groupSet'];
			}
			shuffle($imageGroupIds);
			foreach($imageGroupIds as $imageGroupId){
				foreach($imageGroups[$imageGroupId] as $imgInfo)
					$sortedImgs[]=$imgInfo;
			}
			$this->images=$sortedImgs;
		}
	}
	
	public function showFallbackImage(){
		$f = $this->getFallbackFileObject(); //File::getByID($this->fallbackFID);
		$fp = new Permissions($f);
		if ($fp->canRead()) {
			return "<img src='" . $f->getRelativePath() . "'>";
		}
	}
	
	private function getCuberXMLfilename(){
		
		return DIR_REL . "/" . DIR_PACKAGES . "/cu3er/blocks/cu3er/xml/config" . intval($this->bID) . ".xml";
	}
		
	private function buildCuberXML($args, $data){
		$xmlDefaultSection = 'slicing="vertical"
			num="4"
			direction="left"
			duration="0.5"
			delay="0.1"
			cube_color="' . (isset($args['defaultcubecolour']) ? $args['defaultcubecolour'] : '0x333333') . '"';
		$xmlSlides = '';
		
		if( $data['type'] == 'FILESET' && $data['fsID'] > 0){
				$fs = FileSet::getByID($data['fsID']);
				$fileList = new FileList();		
				$fileList->filterBySet($fs);
				$fileList->filterByType(FileType::T_IMAGE);	
				$files = $fileList->get(1000,0);
				foreach ($files as $f) {
					$fp = new Permissions($f);
					if ($fp->canRead()) {
												
						$xmlSlides .= '<slide>
						<url>' . $f->getRelativePath() . '</url>';
						$xmlSlides .= '</slide>
						';
						
						//$xmlSlides .= '<transition duration="' . $args['duration'] . '" num="' . $args['defaultnumslices'] . '" slicing="' . $args['defaultslice'] . '" direction="' . $args['defaultdirection'] . '" shader="' . $args['defaultFader'] . '" delay="0.2" z_multiplier="' . $args['defaultZmultiplier'] . '" />';
						$xmlSlides .= '<transition duration="' . $data['duration'][0] . '" num="' . isset($data['transitionNum'][$pos]) ? intval($data['transitionNum'][$pos]) : 3 . '" slicing="' . isset($data['transitionSlicing_'.$data['fsID']]) ? trim($data['transitionSlicing_'.$data['fsID']]) : 'vertical' . '" direction="' . isset($data['transitionDirection_'.$data['fsID']]) ? trim($data['transitionDirection_'.$data['fsID']]) : 'down' . '" shader="' . isset($data['transitionFader_'.$data['fsID']]) ? trim($data['transitionFader_'.$data['fsID']]) : 'none' . '" delay="0.2" z_multiplier="' . isset($data['transitionZmultiplier'][$pos]) ? floatval($data['transitionZmultiplier'][$pos]) : 2 . '" />';
					}
				}
		} else if( $data['type'] == 'CUSTOM' && count($data['imgFIDs']) ){
			$pos=0;
			foreach($data['imgFIDs'] as $imgFID){ 
				if(intval($imgFID)==0 || $data['fileNames'][$pos]=='tempFilename') continue;
				
				$f = File::getByID(intval($imgFID));
				$fp = new Permissions($f);
				if ($fp->canRead()) {
			
					$xmlSlides .= '<slide>
					<url>' . $f->getRelativePath() . '</url>';
					if (isset($data['url'][$pos]) && trim($data['url'][$pos]) != ''){
						$xmlSlides .= '<link>' . trim($data['url'][$pos]) . '</link>
						';
					}
					if ((isset($data['descriptionHeading'][$pos]) && $data['descriptionHeading'][$pos] != '') || (isset($data['descriptionParagraph'][$pos]) && $data['descriptionParagraph'][$pos] != '')){
						$xmlSlides .= '<description>';
						
						if (isset($data['url'][$pos]) && trim($data['url'][$pos]) != ''){
							$xmlSlides .= '<link>' . trim($data['url'][$pos]) . '</link>
							';
						}
						
						$xmlSlides .= '<heading>' . trim($data['descriptionHeading'][$pos]) . '</heading>
						<paragraph>' . trim($data['descriptionParagraph'][$pos]) . '</paragraph>
					</description>
					';
					}
					$xmlSlides .= '</slide>
					';
					$xmlSlides .= '<transition duration="' . floatval($data['duration'][$pos]) . '" num="' . intval($data['transitionNum'][$pos]) . '" slicing="' . $data['transitionSlicing_'. $imgFID] . '" direction="' . $data['transitionDirection_'. $imgFID] . '" shader="' . $data['transitionFader_'. $imgFID] . '" delay="' . floatval($data['transitionDelay'][$pos]) . '" z_multiplier="' . $data['transitionZmultiplier'][$pos] . '" />
					';
				}
				$pos++;
			}
		}
		$buttonTemplate = null;
		if (intval($args['nobuttons']) == 0){
			$buttonTemplate = $this->getXMLtemplateButton();
		}

		$descriptionTemplate = $this->getXMLtemplateDescription();
		$templateContent = $this->getXMLtemplateContent($data['durationBeforeTransition']);

		$templateContent = str_replace("%%defaults%%",$xmlDefaultSection,$templateContent);
		$templateContent = str_replace("%%slides%%",$xmlSlides,$templateContent);
		$templateContent = str_replace("%%buttons%%",$buttonTemplate,$templateContent);
		$templateContent = str_replace("%%descriptions%%",$descriptionTemplate,$templateContent);
		$templateContent = str_replace("?<?php xml","<?php xml",$templateContent);
		$templateContent = str_replace("? <?php xml","<?php xml",$templateContent);
		
		//if (substr($templateContent,0,0)!="<"){ //trim first "?"
			//$templateContent = substr($templateContent,0-(strlen($templateContent)-1));
		//}

		return strval($templateContent);
	}
	
	private function getXMLtemplateButton(){
		return '<prev_button>
	<defaults round_corners="5,5,5,5"/>
	<tweenOver tint="0xFFFFFF" scaleX="1.2" scaleY="1.2"/>
	<tweenOut tint="0x000000" />
</prev_button>

<prev_symbol>
	<defaults type="6" />
	<tweenOver tint="0x000000" />			
</prev_symbol>

<next_button>
	<defaults round_corners="5,5,5,5"/>			
	<tweenOver tint="0xFFFFFF"  scaleX="1.2" scaleY="1.2"/>
	<tweenOut tint="0x000000" />
</next_button>

<next_symbol>
	<defaults type="6" />
	<tweenOver tint="0x000000" />
</next_symbol>	';
	}
	
	private function getXMLtemplateDescription(){
		return '<description>
	<defaults 
	round_corners="0, 0, 0, 0"
	heading_text_size="22"
	heading_text_color="0xFFFFFF"          
	heading_text_margin="10, 0, 0,10"  
	 
	paragraph_text_size="13"
	paragraph_text_color="0xFFFFFF"
	paragraph_text_margin="10, 0, 0, 10"

	/>
	<tweenIn tint="0x000000" alpha="0.15" />
	<tweenOut time="0.5" />
	<tweenOver tint="0x000000" alpha="0.4" />
</description>';
	}
	
	private function getXMLtemplateContent($duration){
		return '<?php xml version="1.0" encoding="utf-8" ?>
<cu3er>
	<settings>
		<auto_play> 
			<defaults symbol="circular" time="'.$duration.'" /> 
			<tweenIn x="20" y="20" width="20" height="20" tint="0xFFFFFF" alpha="0.3" />
			<tweenOut scaleX="0" scaleY="0" alpha="0" />
			<tweenOver alpha="0.8"/> 
		</auto_play> 
		
    	%%buttons%%
		
		%%descriptions%%
		
		<preloader>
          <defaults 
		  symbol="linear"
		  width="100"
		  height="3"
		  alpha="0.6"
		  />
          <tweenIn tint="0x000000" alpha="0.2" />
		  <tweenOut time="0.5" />
		</preloader>
	  
		<transitions
			%%defaults%%
		/> 
	</settings>    

	<slides>
		%%slides%%				
	</slides>
</cu3er>
';
	}
	
	private function generateCuberConfigFile($args, $data){
		$configxml = $this->buildCuberXML($args, $data);
		
		if (chmod(DIR_PACKAGES ."/cu3er/blocks/cu3er/xml/", 0755)) {
			//ok
			$ourFileHandle = fopen($this->getCuberXMLfilename(), 'w', true) or die("can't open file");
			fwrite($ourFileHandle, $configxml);
			fclose($ourFileHandle);
		}
		else{
			//unable to write to file.
		}
		
	}
	
	function outputCuberXMLdata($bid){
		$db = Loader::db();
		$sql = "SELECT `xmloutput` FROM `btCu3er` WHERE bID = " . $bid;
		$xmlOutput = $db->getOne($sql);
		return $xmlOutput;
	}
	
	function pathfromfileid($fileid){
		//thanks to nemonoman
		$db = Loader::db();
		$fileversion = $db->getOne("SELECT max(fvID) FROM FileVersions WHERE fID=$fileid");
		$filename = $db->getOne("SELECT fvFilename FROM FileVersions WHERE fID=$fileid AND fvID=$fileversion");
		$path=$db->getOne("SELECT CONCAT('".BASE_URL.DIR_REL."/files/',SUBSTRING(fvPrefix,1,4),'/',
		SUBSTRING(fvPrefix,5,4),'/',
		SUBSTRING(fvPrefix,9,4),'/',
		fvFilename)
		FROM FileVersions
		WHERE fID=$fileid
		AND fvID=$fileversion");
		$path=str_replace($filename,rawurlencode($filename),$path);

		return $path;
	}
	
	function relpathfromfileid($fileid){
		//thanks to nemonoman
		$db = Loader::db();
		$fileversion = $db->getOne("SELECT max(fvID) FROM FileVersions WHERE fID=$fileid");
		$filename = $db->getOne("SELECT fvFilename FROM FileVersions WHERE fID=$fileid AND fvID=$fileversion");
		$path=$db->getOne("SELECT CONCAT('".DIR_REL."/files/',SUBSTRING(fvPrefix,1,4),'/',
		SUBSTRING(fvPrefix,5,4),'/',
		SUBSTRING(fvPrefix,9,4),'/',
		fvFilename)
		FROM FileVersions
		WHERE fID=$fileid
		AND fvID=$fileversion");
		$path=str_replace($filename,rawurlencode($filename),$path);

		return $path;
	}

}

?>
