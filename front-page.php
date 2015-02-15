<?php
/**
 * Displays the Super custom post type
 *
 * @package elit
 */
?>
<?php get_header(); ?>

    <div id="main" class="content">
      <?php 

        /**
         * get super--
         * we're going to pull this var into several templates with 
         * the global keyword
         */
        $args = array(
          'post_type' => 'elit_super',
          'posts_per_page' => 1,
        );
        $super_post = get_posts( $args );

     ?>
      <?php get_template_part( 'front', 'elit_super' ); ?>

      <?php get_template_part( 'front', 'primary' ); ?>

      <?php get_template_part( 'front', 'secondary_fours' ); ?>

    </div> <!-- #main -->

<?php get_footer(); ?>
