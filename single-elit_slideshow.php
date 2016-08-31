<?php get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>

<?php $layout = 'one-col'; ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary--<?php echo $layout; ?>">
        <?php while(have_posts()): the_post(); ?>

          <?php get_template_part('content', 'slideshow'); ?>

    			<?php
    				// If comments are open or we have at least one comment, load up the comment template
    				if ( comments_open() || get_comments_number() ) :
              if ( $layout == 'one-col' ) {
                comments_template('/comments_full_width.php');
              } else {
                comments_template();
              }
    				endif;
    			?>

        <?php endwhile; ?>

      </section> <!-- #primary -->


<!--       temp; make into a sidebar template? -->
      <section id="secondary" class="<?php elit_secondary_class( $layout ); ?>">

        <?php $sidebar = ($layout == 'two-col' ? 'article' : 'article_full_width'); ?>
        <?php get_sidebar( $sidebar ); ?>

      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
