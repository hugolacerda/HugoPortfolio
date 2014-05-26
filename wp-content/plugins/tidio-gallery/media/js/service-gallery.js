var serviceGallery = {
		
	setupGallery: function(gallery_id){
		
		Code.photoSwipe('a', '#tidio-gallery-' + gallery_id);
		
		//
				
		var $gallery = jQuery('#tidio-gallery-' + gallery_id),
			container_width = $gallery.parent().outerWidth(),
			item_width = 0,
			item_width_min = 200;
			
		for(var i=3;i<=10;++i){
			
			var e_width = container_width/i;
			
			if(item_width_min > e_width){
				break;
			}
			
		}
				
		//
		
		$gallery.find('a').css('width', 100/i + '%');
		
		//
		
		
				
		
				
		
					
		/*
		
		var container = jQuery('#tidio-gallery-' + gallery_id).mosaicflow({
			minItemWidth: 200
		});
		*/
		/*
		var container = jQuery('#tidio-gallery-' + gallery_id).mosaicflow({
			minItemWidth: 200
		});
		*/
				
	}
	
};
