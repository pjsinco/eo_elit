<?php get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary">

        <?php while(have_posts()): the_post(); ?>

          <?php d(get_post_format()); ?>
          <?php get_template_part('content', get_post_format()); ?>
          <?php // get_template_part('content', 'single'); ?>

    			<?php
    				// If comments are open or we have at least one comment, load up the comment template
    				if ( comments_open() || get_comments_number() ) :
    					comments_template();
    				endif;
    			?>

        <?php endwhile; ?>

      </section> <!-- #primary -->


<!--       temp; make into a sidebar template? -->
      <section id="secondary" class="content__secondary">

<?php get_sidebar('article'); ?>

<?php get_footer(); ?>
