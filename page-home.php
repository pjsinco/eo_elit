<?php

/**
 * Our template for the home page
 *
 * Template Name: Home page
 *
 * @package elit
 */
?>
<?php get_header(); ?>

    <div id="main" class="content">
      <?php 

        /**************************************************************
         *
         *                         SET UP SUPER
         * we're going to pull this var into several templates with 
         * the global keyword
         *
         *************************************************************/

        $args = array(
          'post_type' => 'elit_super',
          'posts_per_page' => 1,
          'post_status' => 'publish',
        );
        $super_post = get_posts( $args );
        get_template_part( 'front', 'elit_super' );
    
        // we're going to exclude the super other loop queries on this page
        $super_exclude_id = get_post_meta( $super_post[0]->ID, 'elit_super_gowith', true );
     ?>

      <?php  
        /**************************************************************
         *
         *                        SET UP PRIMARY
         *
         *
         *************************************************************/
        $do_not_dupe = array( (int) $super_exclude_id );
        $args = array(
          'posts_per_page' => 3,
          'post__not_in' => $do_not_dupe,
          'meta_query' => array(
            array(
              'key' => 'elit_featurable',
              'compare' => 'NOT EXISTS',
            )
          )
        );

        $primary = new WP_Query( $args );

        // by using locate_template(), front-primary.php will have access
        // to the vars we've created in this file
        include( locate_template( 'front-primary.php' ) );
        wp_reset_postdata();


        /**************************************************************
         *
         *                       SET UP SECONDARY
         *
         *
         *************************************************************/
        //echo '<pre>'; var_dump( $do_not_dupe ); echo '</pre>'; die(  );
        $args = array(
          'post__not_in' => $do_not_dupe,
          'posts_per_page' => 4,
        );
        $secondary = new WP_Query ( $args );

        include( locate_template( 'front-secondary_fours.php' ) ); 
        wp_reset_postdata();


        /**************************************************************
         *
         *                    SET UP SOCIAL-PICK
         *
         *
         *************************************************************/
        $args = array(
          'post_type' => 'elit_social_pick',
          'posts_per_page' => 1,
          'post_status' => 'publish',
        );
        $social = get_posts( $args );

        get_template_part( 'front', 'elit_social_pick' );

        ?>
    </div> <!-- #main -->

<?php get_footer(); ?>
