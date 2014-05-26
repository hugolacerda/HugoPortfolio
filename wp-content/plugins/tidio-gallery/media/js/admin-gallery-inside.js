var $ = jQuery;

var adminGalleryOnSelect = function(gallery_id){
	
	var shortcode_html = '[tidio-gallery id="' + gallery_id + '" /]';
	
	//
	
	if($("#wp-content-wrap").hasClass('tmce-active')){
	
		var html_content = tinymce.editors.content.getContent();
		
		html_content += "\n\n" + shortcode_html;
		
		tinymce.editors.content.setContent(html_content);
	
	} else {
		
		var $textarea = $("#content");
		
		var html_content = $textarea.val();
		
		if(html_content!=''){
			
			html_content += "\n";
		}
		
		html_content += shortcode_html;
		
		$textarea.val(html_content);
		
	}
	
};

window.adminGalleryOnSelect = adminGalleryOnSelect;

//

var adminGalleryInside = {
	
	plugin_url: null,

	admin_url: null,
	
	create: function(data){
		
		if(data.plugin_url){
			this.plugin_url = data.plugin_url;
		}

		if(data.admin_url){
			this.admin_url = data.admin_url;
		}
		
		if($('#wp-content-media-buttons').length){
			adminGalleryInside.initInjectButton();
		}
				
	},
	
	initInjectButton: function(){
		
		$("#wp-content-media-buttons").append(
			'<a href="#" id="insert-gallery-button" class="button insert-media add_media" data-editor="content" title="Add Gallery"><span class="wp-media-buttons-icon"></span> Add Gallery</a>'
		);
		
		$('#insert-gallery-button').on('click', function(){
			
			adminGalleryInside.showInjectPopUp();
			
			return false;
			
		});
		
	},
	
	showInjectPopUp: function(){
				
		var popup = window.open(this.admin_url + 'admin-ajax.php?action=tidio_gallery_popup_insert_post', "popup-inject", "status=1,width=800,height=450");
				
		popup.focus();
		
	}
	
};