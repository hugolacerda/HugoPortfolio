<?php

/**
 * Plugin Name: Tidio Gallery
 * Plugin URI: http://www.tidioelements.com
 * Description: Totally free and beautiful gallery for your website.
 * Version: 1.1
 * Author: Tidio Ltd.
 * Author URI: http://www.tidioelements.com
 * License: GPL2
 */
  
class TidioGallery {
		
	private $pageId = '';
		
	public static $shortcodeTidioGallery;
		
	public function __construct() {
		
		$this->constDefine();
									
		//		
				
		add_action('admin_menu', array($this, 'addAdminMenuLink'));
					 			 
		add_action("wp_ajax_tidio_gallery_upload_image", array($this, "ajaxPageUploadImage"));	 

		add_action("wp_ajax_tidio_gallery_save_data", array($this, "ajaxPageSaveData"));	 

		add_action("wp_ajax_tidio_gallery_popup_insert_post", array($this, "ajaxGalleryPopUp"));	 
		
		add_shortcode('tidio-gallery', array($this, 'shortcodeTidioGallery'));
		
		add_action('admin_footer', array($this, 'adminJS'));
						 
	}
	
	// Gallery PopUp
	
	public function ajaxGalleryPopUp(){
				
		require __DIR__.'/popup-insert-post.php';
		
		exit;
		
	}
	
	// Admin JS
	
	public function adminJS(){
		
		echo '<script src="'.TGALLERY_PLUGIN_URL.'media/js/admin-gallery-inside.js"></script>';

		echo '<script> adminGalleryInside.create('.json_encode(array(
			'plugin_url' => TGALLERY_PLUGIN_URL,
			'admin_url' => TGALLERY_ADMIN_URL
		)).'); </script>';
		
	}
		
	// Menu Positions
	
	public function addAdminMenuLink(){
		
        $optionPage = add_menu_page(
                'Gallery', 'Gallery', 'manage_options', 'tidio-gallery', array($this, 'addAdminPage'), plugins_url(basename(__DIR__) . '/media/img/icon.png')
        );
        $this->pageId = $optionPage;
		
	}
	
    public function addAdminPage() {
        // Set class property
        $dir = plugin_dir_path(__FILE__);
        include $dir . 'options.php';
    }

	
	// Ajax Pages
	
	public function ajaxPageUploadImage(){
		
		require __DIR__.'/sources/ajax-upload-image.php';
		
	}
	
	public function ajaxPageSaveData(){

		require __DIR__.'/sources/ajax-save-data.php';

	}
	
	private function response($status = false, $value = null){
		
		echo json_encode(array(
			'status' => $status,
			'value' => $value
		));
		
		exit;

		
	}
	
	// Shortcodes
	
	public function shortcodeTidioGallery($attr, $content = null){
		
		if(empty($attr['id'])){
			return '';
		}
		
		//
		
		if(!self::$shortcodeTidioGallery){
			
			// js
						
			wp_enqueue_script('tidio-service-gallery',  TGALLERY_PLUGIN_URL.'media/js/service-gallery.js', array(), '1.0', false);
			wp_enqueue_script('tidio-photoswipe',  TGALLERY_PLUGIN_URL.'media/js/plugin-photoswipe.js', array(), '1.0', false);
			wp_enqueue_script('tidio-mosaicflow',  TGALLERY_PLUGIN_URL.'media/js/plugin-mosaicflow.js', array(), '1.0', false);
			
			// css
			
			wp_register_style('tidio-gallery-css', plugins_url('media/css/service-gallery.css', __FILE__) );
			wp_enqueue_style('tidio-gallery-css' );

			
			wp_register_style('tidio-photoswipe-css', plugins_url('media/css/plugin-photoswipe.css', __FILE__) );
			wp_enqueue_style('tidio-photoswipe-css' );
			
			//
			
			self::$shortcodeTidioGallery = true;
			
		}
		
		//
		
		$galleryData = $this->getGalleryData($attr['id']);
		
		if($galleryData){
		
			require __DIR__.'/sources/shortcode-gallery.php';
		
		}
				
	}
	
	// Data
	
	public function getGalleryData($galleryId){
		
		$galleryData = get_option('tidio_gallery_data');
		
		if(!$galleryData){
			return null;
		}
		
		$galleryData = json_decode($galleryData, true);
		
		$exportData = array(
			'data' => null,
			'elements' => array()
		);
		
		foreach($galleryData['container'] as $e){
			if($galleryId==$e['id']){
				$exportData['data'] = $e;
			}
		}
		
		if(!$exportData['data']){
			return null;
		}
		
		foreach($galleryData['element'] as $e){
			if($galleryId==$e['container_id']){
				$exportData['elements'][] = $e;
			}
		}
		
		return $exportData;
		
	}
	
	// Const
	
	public function constDefine(){
		
		$siteUrl = get_site_url();
		
		if(substr($siteUrl, -1)!='/'){
			$siteUrl .= '/';
		}
		
		//
		
		define('TGALLERY_SITE_URL', $siteUrl);

		define('TGALLERY_ADMIN_URL', TGALLERY_SITE_URL.'wp-admin/');

		define('TGALLERY_PLUGIN_URL', plugins_url(basename(__DIR__).'/'));
		
	}
	
}

$tidioGallery = new TidioGallery();

