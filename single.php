<?php get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>

<?php elit_load_scripts_for_post(); ?>

<?php $layout = empty( get_field( 'elit_post_layout' ) ) ? 'two-col' : get_field( 'elit_post_layout' ); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary--<?php echo $layout; ?>">

        <?php while(have_posts()): the_post(); ?>

          <?php get_template_part('content', get_post_format()); ?>

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
