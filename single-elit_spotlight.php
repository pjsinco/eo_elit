<?php 
/**
 * For displaying the preview of the Spotlight custom post type
 * @package elit
 *
 */
?>


<?php $layout = 'one-col'; ?>

<?php get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>


    <div id="main" class="content">
      <section id="primary" class="content__primary--<?php echo $layout; ?>">

      <?php 
        $spotlight_post = get_post();
        $spotlight = get_fields( $spotlight_post->ID );

        elit_load_scripts_for_post( $spotlight );

        //include( locate_template( sprintf( 'content-spotlight_%s.php', $spotlight['elit_spotlight_type'] ) ) );
        include( locate_template( 'content-spotlight.php' ) );
      ?>

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

      </section> <!-- #primary -->

      <section id="secondary" class="<?php elit_secondary_class( $layout ); ?>">

        <?php get_sidebar( 'article_full_width' ); ?>

      </section> <!-- #secondary -->

    </div> <!-- #main -->

<?php get_footer(); ?>
