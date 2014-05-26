<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	<style type="text/css">
		.modal{
			margin-top:
		}

		.modal img{
			border: 5px solid #000;
			width: 100%;
		}

		.modal h2{
		  font-family: "Myriad Pro", sans-serif !important;
		  font-size: 24px !important;
		}

		.modal p{
		  font-family: "Nunito" !important;
		  font-weight: "medium" !important;
		  font-size: 14px !important;
		}


	</style>
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link href='http://fonts.googleapis.com/css?family=Alegreya:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Nunito:400,700,300' rel='stylesheet' type='text/css'>

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<section id="page-wrap">

		<header id="header" class="row">
			
			
			<div id="logo" class="large-3 columns">
	     			 <h1><img src="/images/FWPLogo.png" /></h1>
	    	</div>
	    
		    <nav class="large-9 columns">
		    
		      	<?php
		      	 wp_nav_menu(array('menu' => 'Main Navigation Menu', 'items_wrap' => '<ul class="inline-list right button-group">%3$s</ul>' )) 
		      	?>

		    </nav>
		</header>