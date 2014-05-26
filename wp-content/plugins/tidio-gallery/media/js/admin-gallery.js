var adminGallery = {
	
	container_list: {},
	
	element_list: {},
	
	_id: 0,
	
	popup_mode: false,
	
	save_func: null,
		
	//
	
	create: function(data){
		
		if($('body').hasClass('popup-mode')){
			this.popup_mode = true;
		}
		
		//
		
		this.showSection('list');
		
		//
		
		this.initContainer();

		this.initDetails();
		
		//
		
		this.containerController();
		
		//
		
		if(data.replay_data){	
			this.replayData(data.replay_data);
		}
		
	},
	
	// Container List
	
	initContainer: function(){
		
		$("#gallery-btn-add").on('click', function(){
			
			var id = adminGallery.containerAdd();
			
			adminGallery.containerAddView(id);
			
			adminGallery.saveChangesAuto();
			
			return false;
			
		});
		
		$("#gallery-list").delegate('.delete-link', 'click', function(){
			
			var container_id = $(this).closest('.e').attr('data-id');
			
			adminGallery.containerDeleteService(container_id);
			
			adminGallery.saveChangesAuto();
			
			return false;
			
		}).delegate('.edit-link', 'click', function(){
			
			var container_id = $(this).closest('.e').attr('data-id');
			
			adminGallery.containerShowDetails(container_id);
			
			return false;
			
		}).delegate('.input-name', 'blur', function(){
			
			var container_id = $(this).closest('.e').attr('data-id');
			
			adminGallery.containerUpdate(container_id, {
				name: this.value
			});
			
			adminGallery.saveChangesAuto();
			
			return false;
			
		}).delegate('.gallery-select-link', 'click', function(){
			
			var container_id = $(this).closest('.e').attr('data-id');
			
			adminGallery.selectGalleryPopUp(container_id);
			
			return false;
			
		});
		
		
		
	},
	
	// Element Details
	
	initDetails: function(){
		
		$("#images-btn-add").on('click', function(){
			
			var element_id = adminGallery.elementAdd();
			
			adminGallery.elementAddView(element_id);
			
			adminGallery.elementsController();
			
			adminGallery.saveChangesAuto();
			
			//
			
			return false;
			
		});

		$("#images-btn-back").on('click', function(){
			
			adminGallery.showSection('list')
			
			return false;
			
		});
		
		// manage
		
		$("#images-list").delegate('.delete-link', 'click', function(){
			
			var element_id = $(this).closest('.e').attr('data-id');
			
			adminGallery.elementDeleteService(element_id);
			
			adminGallery.elementsController();
			
			adminGallery.saveChangesAuto();
			
			return false;
			
		});
		
		//
		
		$("#images-list").delegate('.input-file', 'change', function(){
			
			var image_id = $(this).closest('.e').attr('data-id');
			
			adminGallery.uploadImageRequest(image_id);
			
			return false;
			
		}).delegate('.input-name', 'blur', function(){
			
			var container_id = $(this).closest('.e').attr('data-id');
			
			adminGallery.elementUpdate(container_id, {
				name: this.value
			});
			
			adminGallery.saveChangesAuto();
			
			return false;
			
		});
		
		//
		
		$("#images-btn-gallery-select").on('click', function(){
			
			adminGallery.selectGalleryPopUp();
			
			return false;
			
		});
		
	},
	
	// Select Gallery
	
	selectGalleryPopUp: function(gallery_id){
		
		if(typeof gallery_id=='undefined' || gallery_id===null){
			gallery_id = this.current_container_id;
		}
		
		if(!gallery_id){
			return false;
		}
		
		if(this.popup_mode){
		
			window.opener.adminGalleryOnSelect(gallery_id);
					
			window.close();
		
		} else {
			
			var popup_url = app.plugin_url + 'popup-insert-help.php?galleryId=' + gallery_id;
			
			var popup = window.open(popup_url, "mywindow", "location=1,status=1,scrollbars=1,width=500,height=450");
			
			popup.focus();
						
		}
		
	},
	
	// Sections
	
	showSection: function(id){
		
		var header_text = '';
		
		if(id=='list'){
			header_text = '<strong>Gallery</strong> Management';
		}

		if(id=='details'){
			
			// var gallery_info = adminGallery.containerDataGet(this.current_container_id);
			
			header_text = '<strong>Gallery</strong> Details';
		}
		
		$("#wrap-header").html(header_text);
		
		//
		
		$("#wrap > .section-content.active").hide().removeClass('active');
		
		$("#section-" + id).show().addClass('active');
	},
	
	/*
	** Containers
	*/
	
	containerAdd: function(data){
		
		var default_data = {
			id: this._renderId(),
			name: ''
		};
		
		data = $.extend(default_data, data);
		
		this.container_list[data.id] = data;
		
		return data.id;
		
	},
	
	containerAddView: function(container_id){
		
		var container_data = this.containerDataGet(container_id);		
		
		$("#gallery-list").append(
			'<div id="image-e-' + container_data.id + '" class="e" data-id="' + container_data.id + '">' + 
				'<a href="#" class="gallery-select-link">add to site</a>' + 
				'<div class="top"><a href="#" class="edit-link">edit</a><span class="seperator">|</span><a href="#" class="delete-link">delete</a></div>' + 
				'<div class="footer"><input type="text" class="input-name" placeholder="type name..." value="' + container_data.name + '" /></div>' + 
			'</div>'
		);
		
		adminGallery.containerController();
		
	},
	
	containerDeleteService: function(container_id){
		
		// db
		
		if(!this.container_list[container_id]){	
			return false;
		}
			
		delete this.container_list[container_id];
		
		// view
		
		$("#gallery-list .e[data-id='" + container_id + "']").remove();
		
		//
		
		for(i in this.element_list){
			var e = this.element_list[i];
			if(e.container_id==container_id){
				delete this.element_list[i];
			}
		}
		
		// controller
		
		this.containerController();
		
	},
	
	
	containerDataGet: function(id){
		
		if(!this.container_list[id]){
			return false;
		}
		
		return this.container_list[id];
		
	},
	
	containerUpdate: function(id, data_update){

		if(!this.container_list[id]){
			return false;
		}
		
		this.container_list[id] = $.extend(this.container_list[id], data_update);

	},
	
	///
	
	containerLengthIndex: function(){
		
		return Object.keys(this.container_list).length;
		
	},
	
	containerController: function(){
		
		var index_length = this.containerLengthIndex();
		
		//
		
		$("#gallery-list,#gallery-list-empty").hide();
		
		//
		
		if(!index_length){
			
			$("#gallery-list-empty").show();
			
		} else {
			
			$("#gallery-list").show();
			
		}
		
	},
	
	/* go to details */
	
	containerShowDetails: function(container_id){
	
		this.current_container_id = container_id;
			
		this.showSection('details')
				
		this.elementsController();
		
		//
				
		$("#images-list").html('');
		
		var elements = this.elementsGet();
		
		for(i in elements){
			
			var e = elements[i];
			
			adminGallery.elementAddView(e.id);
			
		}
	},
	
	/*
	** Elements
	*/
	
	elementAddView: function(id){
		
		var element_data = this.elementDataGet(id);
		
		if(!element_data){	
			return false;
		}
				
		var element_html =
		'<div class="e" id="e-' + element_data.id + '" data-id="' + element_data.id + '">' + 
				'<div class="e-gradinet"></div>' +
				'<div class="top-loading">uploading...</div>' + 
				'<div class="top">' + 
					'<div class="upload">upload<input type="file" class="input-file" id="image-e-' + element_data.id + '-upload-image" /></div>' + 
					'<a href="#" class="delete-link">delete</a>' + 
				'</div>' + 
				'<div class="footer"><input type="text" class="input-name" placeholder="type name..." value="' + element_data.name + '" /></div>' + 
			'</div>'
		//
		
		$("#images-list").append(element_html);
		
		//
		
		var $element = $("#images-list .e[data-id=" + id + "]");
		
		if(element_data.thumb){
			$element.backstretch(element_data.thumb.fileUrl);
		}
		
		
	},
	
	elementAdd: function(data){

		var default_data = {
			id: this._renderId(),
			name: '',
			container_id: this.current_container_id,
			thumb: null,
			orginal: null,
		};
		
		data = $.extend(default_data, data);
		
		this.element_list[data.id] = data;
		
		return data.id;

	},
	
	elementUpdate: function(id, update_data){
		
		if(!this.element_list[id]){	
			return false;
		}
		
		this.element_list[id] = $.extend(this.element_list[id], update_data);
				
		return true;
		
	},
	
	elementDelete: function(id){
		
		if(!this.element_list[id]){	
			return false;
		}
		
		delete this.element_list[id];
		
		return true;
		
	},
	
	elementDataGet: function(id){
		
		if(!this.element_list[id]){	
			return false;
		}
		
		return this.element_list[id];
		
	},
	
	elementDeleteService: function(element_id){
		
		$("#images-list .e[data-id=" + element_id + "]").remove();
		
		this.elementDelete(element_id);
		
		this.elementsController();
		
	},
	
	//
	
	elementsGet: function(container_id){
		
		if(!container_id){
			container_id = this.current_container_id;
		}
		
		var arr = [];
		
		for(i in this.element_list){
			
			var e = this.element_list[i];
			
			if(e.container_id==container_id){
				
				arr.push(e);
				
			}
			
		}
		
		return arr;
		
	},
	
	elementsController: function(){
		
		var elements = this.elementsGet();
		
		//
		
		$("#images-list-empty,#images-list").hide();
		
		if(!elements.length){
			$("#images-list-empty").show();
		} else {
			$("#images-list").show();
		}
		
	},
	
	/*
	** Upload Image
	*/
	
	uploadImageRequest: function(image_id){
		
		var client = new XMLHttpRequest(),
			file = document.getElementById('image-e-' + image_id + '-upload-image'),
			formData = new FormData(),
			xhr_url = app.admin_url + 'admin-ajax.php?action=tidio_gallery_upload_image';
		//
		
		var $container = $("#e-" + image_id);
		
		$container.find('.top').hide();

		$container.find('.top-loading').show();

		//

		formData.append("upload", file.files[0]);

		client.open("post", xhr_url, true);

		client.send(formData);

		//

		client.onreadystatechange = function() {

			var response = null;

			if (client.readyState == 4 && client.status == 200) {
				try {
					response = JSON.parse(client.response)
				} catch (e) { return false; }

				if (response.status) {

					$container.find('.top').show();
			
					$container.find('.top-loading').hide();

					//

					adminGallery.uploadImageAfter(image_id, response.value);

				}


			}

		};
		
	},
	
	uploadImageAfter: function(image_id, upload_data){
		
		this.elementUpdate(image_id, {
			thumb: upload_data.thumb,
			orginal: upload_data.orginal
		});
		
		//
				
		var $element = $("#images-list .e[data-id=" + image_id + "]");
				
		$element.backstretch(upload_data.thumb.fileUrl);
		
		//
		
		this.saveChangesAuto();
				
	},
	
	/*
	** Data Process
	*/
	
	saveChangesAuto: function(){
		
		if(this.save_func){
			clearTimeout(this.save_func);
		}
		
		this.save_func = setTimeout(function(){
		
			adminGallery.saveChanges();
		
		}, 500);
		
	},
	
	saveChanges: function(){
		
		adminGallery.loadingStatus('saving...');
		
		this.saveChangesRequest(function(){
			
			adminGallery.loadingStatusHide();
			
		});
		
	},
	
	saveChangesRequest: function(_func){
		
		if(typeof _func!='function')
			_func = function(){};
		
		//
		
		var export_data = this.exportData();
		
		export_data = JSON.stringify(export_data);
		
		//
		
		$.ajax({
			url: app.admin_url + 'admin-ajax.php?action=tidio_gallery_save_data',
			data: {
				saveData: encodeURIComponent(export_data)
			},
			dataType: 'JSON',
			type: 'POST'
		}).done(function(){
			
			_func();
			
		});
		
	},
		
	exportData: function(){
		
		var data = {
			container: [],
			element: []
		};
		
		for(i in this.container_list){
			var e = this.container_list[i];
			data.container.push(e);
		}

		for(i in this.element_list){
			var e = this.element_list[i];
			data.element.push(e);
		}
		
		return data;

	},
	
	replayData: function(data){
						
		if(!data.container || !data.element){
			return false;
		}
				
		for(i in data.container){
			var e = data.container[i];		
			this.container_list[e.id] = e;	
			adminGallery.containerAddView(e.id);
		}
		
		adminGallery.containerController();
		
		//

		for(i in data.element){
			var e = data.element[i];
			this.element_list[e.id] = e;
		}
				
	},
	
	loadingStatus: function(text){
		
		$("#fixed-loading-bottom").fadeIn('fast');
		
		$("#fixed-loading-bottom .text").text(text);
		
	},
	
	loadingStatusHide: function(){
		
		$("#fixed-loading-bottom").fadeOut();
		
	},
	
	/*
	** Helpers
	*/
	
	_renderId: function(){
				
		return this._generateHash(32);
		
	},
	
	_generateHash: function(length){

		if (!length)
			length = 32;
		
		var string = '',
			hash_arr = 'abcdefghijklmnopqrstuvwxyz0123456789';
		
		for (var i = 0; i < length; ++i) {
			var word_i = this._rand(0, hash_arr.length - 1);
			string += hash_arr[word_i]
		}
		return string;

	},
	
	_rand: function(min, max){
		var argc = arguments.length;
		if (argc === 0) {
			min = 0;
			max = 2147483647;
		} else if (argc === 1) {
			throw new Error('Warning: rand() expects exactly 2 parameters, 1 given');
		}
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
	
};