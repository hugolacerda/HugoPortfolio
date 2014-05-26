<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false);
	   wp_enqueue_script('jquery');

       wp_register_script('carousel', get_bloginfo('template_directory') . "/js/carousel.js");
       wp_enqueue_script('carousel');
	}
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
	// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    if (function_exists('register_nav_menus')) {
        register_nav_menus(
            array(
                'main_nav' => 'Main Navigation Menu'
                )
            );
    }

    function getImage($num) {
        
        global $more;
        
        $more = 1;
        
        $link = get_permalink();
        
        $content = get_the_content();
        
        $count = substr_count($content, '<img');
        
        $start = 0;
        
        for($i=1; $i<=$count; $i++) {
            $imgBeg = strpos($content, '<img', $start);
            $post = substr($content, $imgBeg);
            $imgEnd = strpos($post, '>');
            $postOutput = substr($post, 0, $imgEnd+1);
            $postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
            $image[$i] = $postOutput;
            $start=$imgEnd+1;
        }

        if(stristr($image[$num],'<img')) {
         echo '<a href="'.$link.'">'.$image[$num]."</a>"; 
        }else{
            echo '<img src="http://placehold.it/640x235&text=[No Image Selected]" />';
        }

        $more = 0;
    }

    /** Grab IDs from new WP 3.5 gallery **/
function lc_grab_ids_from_gallery() {
global $post;
 
$attachment_ids = array();
$pattern = get_shortcode_regex();
$ids = array();
 
if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) { //finds the "gallery" shortcode and puts the image ids in an associative array at $matches[3]
  $count=count($matches[3]); //in case there is more than one gallery in the post.
  for ($i = 0; $i < $count; $i++){
    $atts = shortcode_parse_atts( $matches[3][$i] );
    if ( isset( $atts[ids] ) ){
      $attachment_ids = explode( ',', $atts[ids] );
      $ids = array_merge($ids, $attachment_ids);
    }
  }
}
return $ids;
 
}
add_action( 'wp', 'lc_grab_ids_from_gallery' );

?>