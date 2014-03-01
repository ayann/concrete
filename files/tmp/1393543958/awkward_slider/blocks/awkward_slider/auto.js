var awkwardgalleryBlock = {
	
	init:function(){},	
	
	chooseImg:function(){ 
		ccm_launchFileManager('&fType=' + ccmi18n_filemanager.FTYPE_IMAGE);
	},
	
	showImages:function(){
		$("#awkwardgalleryBlock-imgRows").show();
		$("#awkwardgalleryBlock-chooseImg").show();
		$("#awkwardgalleryBlock-fsRow").hide();
	},

	showFileSet:function(){
		$("#awkwardgalleryBlock-imgRows").hide();
		$("#awkwardgalleryBlock-chooseImg").hide();
		$("#awkwardgalleryBlock-fsRow").show();
	},

	selectObj:function(obj){
		if (obj.fsID != undefined) {
			$("#awkwardgalleryBlock-fsRow input[name=fsID]").attr("value", obj.fsID);
			$("#awkwardgalleryBlock-fsRow input[name=fsName]").attr("value", obj.fsName);
			$("#awkwardgalleryBlock-fsRow .awkwardgalleryBlock-fsName").text(obj.fsName);
		} else {
			this.addNewImage(obj.fID, obj.thumbnailLevel1, obj.height, obj.title);
		}
	},

	addImages:0, 
	addNewImage: function(fID, thumbPath, imgHeight, title, description) { 
		this.addImages--; //negative counter - so it doesn't compete with real GalleryImgIds
		var GalleryImgId=this.addImages;
		var templateHTML=$('#imgRowTemplateWrap .awkwardgalleryBlock-imgRow').html().replace(/tempFID/g,fID);
		templateHTML=templateHTML.replace(/tempThumbPath/g,thumbPath);
		templateHTML=templateHTML.replace(/tempFilename/g,title);
		templateHTML=templateHTML.replace(/tempGalleryImgId/g,GalleryImgId).replace(/tempHeight/g,imgHeight);
		var imgRow = document.createElement("div");
		imgRow.innerHTML=templateHTML;
		imgRow.id='awkwardgalleryBlock-imgRow'+parseInt(GalleryImgId);	
		imgRow.className='awkwardgalleryBlock-imgRow';
		document.getElementById('awkwardgalleryBlock-imgRows').appendChild(imgRow);
		var bgRow=$('#awkwardgalleryBlock-imgRow'+parseInt(fID)+' .backgroundRow');
		bgRow.css('background','url('+thumbPath+') no-repeat left top');
	},
	
	removeImage: function(fID){
		$('#awkwardgalleryBlock-imgRow'+fID).remove();
	},
	
	moveUp:function(fID){
		var thisImg=$('#awkwardgalleryBlock-imgRow'+fID);
		var qIDs=this.serialize();
		var previousQID=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				if(previousQID==0) break; 
				thisImg.after($('#awkwardgalleryBlock-imgRow'+previousQID));
				break;
			}
			previousQID=qIDs[i];
		}	 
	},
	moveDown:function(fID){
		var thisImg=$('#awkwardgalleryBlock-imgRow'+fID);
		var qIDs=this.serialize();
		var thisQIDfound=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				thisQIDfound=1;
				continue;
			}
			if(thisQIDfound){
				$('#awkwardgalleryBlock-imgRow'+qIDs[i]).after(thisImg);
				break;
			}
		} 
	},
	serialize:function(){
		var t = document.getElementById("awkwardgalleryBlock-imgRows");
		var qIDs=[];
		for(var i=0;i<t.childNodes.length;i++){ 
			if( t.childNodes[i].className && t.childNodes[i].className.indexOf('awkwardgalleryBlock-imgRow')>=0 ){ 
				var qID=t.childNodes[i].id.replace('awkwardgalleryBlock-imgRow','');
				qIDs.push(qID);
			}
		}
		return qIDs;
	},	

	validate:function(){
		var failed=0; 
		
		if ($("#newImg select[name=type]").val() == 'FILESET')
		{
			if ($("#awkwardgalleryBlock-fsRow input[name=fsID]").val() <= 0) {
				alert(ccm_t('choose-fileset'));
				$('#awkwardgalleryBlock-AddImg').focus();
				failed=1;
			}	
		} else {
			qIDs=this.serialize();
			if( qIDs.length<2 ){
				alert(ccm_t('choose-min-2'));
				$('#awkwardgalleryBlock-AddImg').focus();
				failed=1;
			}	
		}
		
		if(failed){
			ccm_isBlockError=1;
			return false;
		}
		return true;
	} 
}

ccmValidateBlockForm = function() { return awkwardgalleryBlock.validate(); }
ccm_chooseAsset = function(obj) { awkwardgalleryBlock.selectObj(obj); }

$(function() {
	if ($("#newImg select[name=type]").val() == 'FILESET') {
		$("#newImg select[name=type]").val('FILESET');
		awkwardgalleryBlock.showFileSet();
	} else {
		$("#newImg select[name=type]").val('CUSTOM');
		awkwardgalleryBlock.showImages();
	}

	$("#newImg select[name=type]").change(function(){
		if (this.value == 'FILESET') {
			awkwardgalleryBlock.showFileSet();
		} else {
			awkwardgalleryBlock.showImages();
		}
	});
});
