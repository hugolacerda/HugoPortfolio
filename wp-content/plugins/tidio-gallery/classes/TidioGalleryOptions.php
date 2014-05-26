<?php

class TidioGalleryOptions {
	
	public function __construct(){
		
		
	}
	
	public static function register(){
		
		if(get_option('tidio_gallery_key')){
				
			return false;
		}
		
		$url = 'http://www.tidioelements.com/apiExternalPlugin/registerPlugin?'.http_build_query(array(
			'siteUrl' => site_url(),
			'pluginType' => 'gallery',
			'_ip' => $_SERVER['REMOTE_ADDR']
		));
		
		//
		
		$key = '-1';
		
		//
				
		$content = self::getContent($url);
		
		
		if($content){
		
			$content = json_decode($content, true);
			
			if(isset($content['value'])){
				
				$key = '1';
				
			}
		
		}
		
		update_option('tidio_gallery_key', $key);
			
	}
	
	private static function getContent($url){

		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
	
		$data = curl_exec($ch);
		curl_close($ch);
		
		return $data;

	}
	
}