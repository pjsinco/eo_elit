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
        if ( $super_post ) {
          get_template_part( 'front', 'elit_super' );
    
          // we're going to exclude the super other loop queries on this page
          $super_exclude_id = get_post_meta( $super_post[0]->ID, 'elit_super_gowith', true );
        }
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
          //'post__in' => get_option( 'sticky_posts' ),
          //'category_name' => 'lifestyle,patient-care,policy,profession,training',
          'meta_query' => array(
            array(
              'key' => 'elit_featurable',
              'compare' => 'NOT EXISTS',
            ),
          ),
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => array(
                'lifestyle', 
                'patient-care',
                'policy',
                'profession',
                'training',
              ),
            ),
          ),
        );

        $primary = new WP_Query( $args );
        if ( $primary->have_posts() ) {
          // by using locate_template(), front-primary.php will have access
          // to the vars we've created in this file
          include( locate_template( 'front-primary.php' ) );
          wp_reset_postdata();
        }

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
        if ( $secondary->have_posts() ) {
          include( locate_template( 'front-secondary_fours.php' ) ); 
          wp_reset_postdata();
        }

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

        if ( $social ) {
          get_template_part( 'front', 'elit_social_pick' );
        }

        /**************************************************************
         *
         *                    SET UP SPOTLIGHT
         *
         *
         *************************************************************/

        // TODO we're just stubbing this for now
        get_template_part( 'front', 'elit_spotlight' );


        /**************************************************************
         *
         *                    SET UP POPULAR
         *
         *
         *************************************************************/
        // TODO temporary; we'll replace this with a widgetable area
?>
      <div class="row">
        <div class="size-1-of-3 module">
          <div class="section-title-hat"><span class="section-title-hat__text">Most read</span></div>
          <aside class="widget--counter widget--front">
            <ol class="widget__list--counter">
              <li class="widget-f__list-item--counter"><a href="#" class="widget__link">New Year's resolutions: 10 life hacks to increase physician productivity</a></li>
              <li class="widget-f__list-item--counter"><a href="#" class="widget__link">'Grey's Anatomy' vs. real-life residency: You already know how this turns out</a></li>
              <li class="widget-f__list-item--counter"><a href="#" class="widget__link">Anesthesiology’s allure: High pay, flexibility, intellectual stimulation</a></li>
              <li class="widget-f__list-item--counter"><a href="#" class="widget__link">How I survived the first 2 years of medical school</a></li>
              <li class="widget-f__list-item--counter"><a href="#" class="widget__link">Making the cut: How to specialize in general surgery</a></li>
            </ol>
          </aside>
        </div>
<?php
        


        /**************************************************************
         *
         *                 SET UP INSIDE THE AOA
         *
         *
         *************************************************************/
        // TODO temporary; also note we're closing the row div started 
        //    in prev section
      
        $sticky = get_option( 'sticky_posts' );
        d( $sticky );
        $args = array(
          //'ignore_sticky_posts' => 1,
          'posts_per_page' => 4,
          'post__not_in' => $sticky,
          'category_name' => 'inside-the-aoa',
        );
        $inside = new WP_Query( $args );
        if ( $inside ) {
          d( $inside );
          d( get_option( 'sticky_posts') );
        }
?>

      </div><!-- .row -->




    </div> <!-- #main -->

<?php get_footer(); ?>
