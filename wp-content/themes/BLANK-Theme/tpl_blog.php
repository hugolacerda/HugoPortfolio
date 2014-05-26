<?php
/*
Template Name: Blog Posts
*/

?>

<?php get_header(); ?>
<secion id="blog_wrap">
	
	<img id="poster" src=
    "../images/poster2.jpg" />

	<h1 style="font-family: 'Alegreya', serif;font-weight: 700;" class="text-center">Constantly Evolving</h1>  
	
	<article class="row">
		<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>
			
			<article class="large-8 columns">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
						<img class="imgPost" src="<?php $key="image"; echo get_post_meta($post->ID, $key, true); ?>" />


						<h4 class="latest_project"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>

						<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

						<div class="entry">
							<?php the_content(); ?>
						</div>


					</div>

				<?php endwhile; ?>

				<div class="navigation pagination">
					<span class="newer"><?php previous_posts_link(__('« Newer','example')) ?></span> <span class="older"><?php next_posts_link(__('Older »','example')) ?></span>
				</div><!-- /.navigation -->

			</article> <!-- close columns large-8 -->

			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

			<?php else : ?>

				<h2>Not Found</h2>

			<?php endif; ?>
			
			<aside class="large-4 columns">
				<?php get_sidebar(); ?>
			</aside>

	</article> <!-- close row -->
<section>
<?php get_footer(); ?>