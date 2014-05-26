<?php
/*
Template Name: Gallery Page
*/
?>

<?php get_header(); ?>
<section id="gallery_wrap"> <!-- content wrap --> 
  	
	<img id="poster" src=
    "../images/poster2.jpg" />

	<h1 style="font-family: 'Alegreya', serif;font-weight: 700;" class="text-center">Always Stand Out.</h1> 

	<?php

		$args = array(
		    'numberposts' => -1, // Using -1 loads all posts
		    'orderby' => 'menu_order', // This ensures images are in the order set in the page media manager
		    'order'=> 'ASC',
		    'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos
		    'post_parent' => $post->ID, // Important part - ensures the associated images are loaded
		    'post_status' => null,
		    'post_type' => 'attachment'
		);

		$images = get_children( $args );

		if($images){ ?>
		<article class="row">
		    <?php foreach($images as $image){ ?>
		    <div class="large-4 columns hover"><figure><img src="<?php echo $image->guid; ?>" height="335" width="400" alt="<?php echo $image->post_title; ?>" title="<?php echo $image->post_title; ?>" /><figcaption><p><?php echo $image->post_title; ?></p></figcaption></figure></a></div>
		    <?php    } ?>
		</article>
		<?php } ?>


</section> 
<?php get_footer(); ?>