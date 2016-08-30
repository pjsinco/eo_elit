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

<?php elit_load_scripts_for_post(); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary--<?php echo $layout; ?>">

      <?php 
        $spotlight_post = get_post();
        $spotlight = get_fields( $spotlight_post->ID );
        include( locate_template( sprintf( 'content-spotlight_%s.php', $spotlight['elit_spotlight_type'] ) ) );
      ?>

      </section> <!-- #primary -->

      <section id="secondary" class="<?php elit_secondary_class( $layout ); ?>">

        <?php get_sidebar( 'article_full_width' ); ?>

      </section> <!-- #secondary -->

    </div> <!-- #main -->

<?php get_footer(); ?>
