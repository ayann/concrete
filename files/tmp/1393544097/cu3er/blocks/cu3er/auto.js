var Cu3erBlock = {
	
	init:function(){},	
	
	chooseImg:function(elem){ 
		ccm_launchFileManager('&fType=' + ccmi18n_filemanager.FTYPE_IMAGE);
	},
	
	showImages:function(){
		$("#ccm-cu3erBlock-imgRows").show();
		$("#ccm-cu3erBlock-chooseImg").show();
		$("#ccm-cu3erBlock-fsRow").hide();
	},

	showFileSet:function(){
		$("#ccm-cu3erBlock-imgRows").hide();
		$("#ccm-cu3erBlock-chooseImg").hide();
		$("#ccm-cu3erBlock-fsRow").show();
	},

	selectObj:function(obj){
		if (obj.fsID != undefined) {
			$("#ccm-cu3erBlock-fsRow input[name=fsID]").attr("value", obj.fsID);
			$("#ccm-cu3erBlock-fsRow input[name=fsName]").attr("value", obj.fsName);
			$("#ccm-cu3erBlock-fsRow .ccm-cu3erBlock-fsName").text(obj.fsName);
		} else {
			this.addNewImage(obj.fID, obj.thumbnailLevel1, obj.height, obj.title);	
		}
	},
	
	selectFall:function(obj){
		if (obj.fID != undefined) {
			$fallThumb = "<div class='ccm-file-selected-data'><img border='0' src='" + escape(obj.thumbnailLevel1) + "' align='absmiddle'> " + obj.title + "<BR><a href='javascript:Cu3erBlock.resetFallBack()'>(Reset)</a></div>";
			$("#cu3er-fallback").html($fallThumb);
			$("#fallbackFID").val(obj.fID);
		}
	},
		
	resetFallBack:function(){
		$("#cu3er-fallback").html('');
		$("#cu3er-fallback").css('background','none');
		$("#fallbackFID").val('');
	},
	
	showAddImage:function() {
		ccm_editorCurrentAuxTool = 'image';
		ccm_launchFileManager('&fType=' + ccmi18n_filemanager.FTYPE_IMAGE);
	},

	showAddFallBack:function() {
		ccm_editorCurrentAuxTool = 'fallback';
		ccm_launchFileManager('&fType=' + ccmi18n_filemanager.FTYPE_IMAGE);
	},


	addImageTo:null,
	addImages:0, 
	addNewImage: function(fID, thumbPath, imgHeight, title) { 
		this.addImages--; //negative counter - so it doesn't compete with real slideshowImgIds
		var slideshowImgId=this.addImages;
		var templateHTML=$('#imgRowTemplateWrap .ccm-cu3erBlock-imgRow').html().replace(/tempFID/g,fID);
		templateHTML=templateHTML.replace(/tempThumbPath/g,thumbPath);
		templateHTML=templateHTML.replace(/tempFilename/g,title);
		templateHTML=templateHTML.replace(/tempSlideshowImgId/g,slideshowImgId).replace(/tempHeight/g,imgHeight);
		var imgRow = document.createElement("div");
		imgRow.innerHTML=templateHTML;
		imgRow.id='ccm-cu3erBlock-imgRow'+parseInt(slideshowImgId);	
		imgRow.className='ccm-cu3erBlock-imgRow';
		document.getElementById('ccm-cu3erBlock-imgRows').appendChild(imgRow);
		var bgRow=$('#ccm-cu3erBlock-imgRow'+parseInt(fID)+' .backgroundRow');
		bgRow.css('background','url('+escape(thumbPath)+') no-repeat left top');
	},
	
	removeImage: function(fID){
		$('#ccm-cu3erBlock-imgRow'+fID).remove();
	},
	
	moveUp:function(fID){
		var thisImg=$('#ccm-cu3erBlock-imgRow'+fID);
		var qIDs=this.serialize();
		var previousQID=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				if(previousQID==0) break; 
				thisImg.after($('#ccm-cu3erBlock-imgRow'+previousQID));
				break;
			}
			previousQID=qIDs[i];
		}	 
	},
	moveDown:function(fID){
		var thisImg=$('#ccm-cu3erBlock-imgRow'+fID);
		var qIDs=this.serialize();
		var thisQIDfound=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				thisQIDfound=1;
				continue;
			}
			if(thisQIDfound){
				$('#ccm-cu3erBlock-imgRow'+qIDs[i]).after(thisImg);
				break;
			}
		} 
	},
	serialize:function(){
		var t = document.getElementById("ccm-cu3erBlock-imgRows");
		var qIDs=[];
		for(var i=0;i<t.childNodes.length;i++){ 
			if( t.childNodes[i].className && t.childNodes[i].className.indexOf('ccm-cu3erBlock-imgRow')>=0 ){ 
				var qID=t.childNodes[i].id.replace('ccm-cu3erBlock-imgRow','');
				qIDs.push(qID);
			}
		}
		return qIDs;
	},	

	validate:function(){
		var failed=0; 
		
		if ($("#newImg select[name=type]").val() == 'FILESET')
		{
			if ($("#ccm-cu3erBlock-fsRow input[name=fsID]").val() <= 0) {
				alert(ccm_t('choose-fileset'));
				$('#ccm-cu3erBlock-AddImg').focus();
				failed=1;
			}	
		} else {
			qIDs=this.serialize();
			if( qIDs.length<2 ){
				alert(ccm_t('choose-min-2'));
				$('#ccm-cu3erBlock-AddImg').focus();
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

ccmValidateBlockForm = function() { return Cu3erBlock.validate(); }
ccm_chooseAsset = function(obj) {
	switch(ccm_editorCurrentAuxTool) {
		case "image":
			Cu3erBlock.selectObj(obj);
			break;
		case "fallback":
			Cu3erBlock.selectFall(obj);
			break;
		default: // image
			Cu3erBlock.selectObj(obj);
			break;
		}
}

$(function() {
	if ($("#newImg select[name=type]").val() == 'FILESET') {
		$("#newImg select[name=type]").val('FILESET');
		Cu3erBlock.showFileSet();
	} else {
		$("#newImg select[name=type]").val('CUSTOM');
		Cu3erBlock.showImages();
	}

	$("#newImg select[name=type]").change(function(){
		if (this.value == 'FILESET') {
			Cu3erBlock.showFileSet();
		} else {
			Cu3erBlock.showImages();
		}
	});
});
