<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

    
      <div class="entry">
        <?php the_content(); ?>
      </div>

      

    </div>

  <?php endwhile; ?>

  <?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

  <?php else : ?>

    <h2>Not Found</h2>

  <?php endif; ?>


  <article id="features" class="row">
    <div class="large-4 columns">
      <h4 id="design">Design</h4>
      <p>I enjoy creating professional websites using front-end frameworks such as <em>Zurb's Foundation</em>, and <em>Twitters Bootsrap</em> as well creating graphics with <em>Photoshop</em> and <em>Adobe Illustrator</em>.</p>
    </div>
    
    <div class="large-4 columns">
      <h4 id="develope">Develope</h4>
      <p>My skillsets for web include <em>Javascript</em>, <em>Ajax</em>, <em>AngularJS</em>, <em>The Adobe Master Suite</em>, <em>ActionScript</em>, <em>HTML</em>, <em>CSS</em>, <em>MySQL</em>, <em>MongoDB</em>, <em>Worpdress</em>, <em>PHP</em>, and <em>Ruby</em>. </p>
    </div>
    
    <div class="large-4 columns">
      <h4 id="plan">Planning</h4>
      <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
    </div>
  
  </article>


 <article id="blog" class="row">
   <?php query_posts("post_per_page=1"); the_post(); ?>
    <div class="large-8 columns">
      <?php getImage('1'); ?>
      <h4 id="latest_project"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <p id="date"><?php the_date(); ?></p>
      <p><?php the_excerpt(); ?></p>
    </div>
  <?php wp_reset_query(); ?>
    
    <div class="large-4 columns">
      <img src="images/hugo_picture.JPG" />
      <h4 id="name">Hugo Lacerda</h4>
      <p>Hello, and welcome to my site!</p>
      <blockquote>I'm obsessed with making something with both purpose and with beauty.</blockquote>
      <p>I've been doing web work for about three years now and have graduated from FullSail University with a bachelors degree in science for Web Design and Development.</p>
    </div>
  
  </article>

</section> <!-- content wrap -->

<?php get_footer(); ?>