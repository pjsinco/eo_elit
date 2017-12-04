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
        /**
         * We'll display these post types
         *
         */
        $post_types_to_include = array('post', 'elit_slideshow');

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
        $stickies = get_option( 'sticky_post' );
        $num_posts = 3;

        // Our desired query:
        // Get the 3 most recent posts in any category except 
        // "Inside the AOA," unless one of those "Inside" posts is 'sticky.'
        // We need to use a UNION operation in MySQL, which we need to do 
        // by writing our own query.
        // We're following a technique explained here:
        // http://www.devdevote.com/cms/wordpress-hacks/
        //    use-sql-querys-in-the-loop-with-template-tags/
        $stickies = get_option( 'sticky_posts' );
        $num_posts = 3; 

        // NOTE: The categories we're selecting (3,4,5,6,7) are the IDs of the 
        // the categories on the live site. 
        // They correspond to Lifestyle (3), Patient Care (4), 
        // Advocacy (5), Profession (6), Training (7)
        $query = "
          select *
          from 
            (
        ";
        if ( $stickies ) {
        // we'll add our UNION query only if we have sticky posts
        $query .= "
              (SELECT {$wpdb->prefix}posts.*
              from {$wpdb->prefix}posts
              where {$wpdb->prefix}posts.ID IN (" . implode( ',', $stickies ) . ")
              AND {$wpdb->prefix}posts.post_type IN ('" . implode( "','", $post_types_to_include) . "')
              AND {$wpdb->prefix}posts.post_status = 'publish'
              order by post_date DESC)
              UNION
        ";
        }
        $query .= "
              (SELECT {$wpdb->prefix}posts.* 
              FROM {$wpdb->prefix}posts 
                INNER JOIN {$wpdb->prefix}term_relationships 
                  ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id) 
                LEFT JOIN {$wpdb->prefix}postmeta 
                  ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id AND {$wpdb->prefix}postmeta.meta_key = 'elit_featurable' ) 
              WHERE 1=1 
                AND {$wpdb->prefix}posts.ID NOT IN (" . implode( ',', $do_not_dupe ) . ") 
                AND {$wpdb->prefix}term_relationships.term_taxonomy_id IN (3,4,5,6,7)
                AND {$wpdb->prefix}posts.post_type in ('" . implode( "','", $post_types_to_include) . "')
                AND ({$wpdb->prefix}posts.post_status = 'publish' OR {$wpdb->prefix}posts.post_status = 'private')
                AND ({$wpdb->prefix}postmeta.post_id IS NULL)
              order by post_date DESC
              limit 0, ". ( $num_posts - count( $stickies ) ) . ")
            ) as t;
        ";
        global $wpdb;
        $query_results = $wpdb->get_results( $query, OBJECT );

        if ( $query_results ) {
          // by using locate_template(), front-primary.php will have access
          // to the vars we've created in this file
          include( locate_template( 'front-primary.php' ) );
        }

?>



      <div class="row">

<?php
        /**************************************************************
         *
         *                 SET UP NEWSBRIEFS
         *
         *
         *************************************************************/
        // TODO temporary; also note we're closing the row div started 
        //    in prev section
      
        $args = array(
          'posts_per_page' => 4,
          'post__not_in' => array_merge( $stickies, $do_not_dupe ),
          'category_name' => 'newsbriefs',
        );
        $newsbriefs = new WP_Query( $args );
        if ( $newsbriefs ) {
          include( locate_template( 'front-newsbriefs.php' ) ); 
          wp_reset_postdata();
        }
?>
<?php
        /**************************************************************
         *
         *                    SET UP WIDGET
         *
         *
         *************************************************************/
?>
        <div class="size-1-of-3--last module">
          <?php if ( ! dynamic_sidebar( 'front-page-standalone' ) ); ?>
        </div>




      </div><!-- .row -->
<?php

        /**************************************************************
         *
         *                       SET UP SECONDARY
         *
         *
         *************************************************************/
        $args = array(
          'post__not_in' => $do_not_dupe,
          'posts_per_page' => 4,
          'post_type' => $post_types_to_include,
          'ignore_sticky_posts' => 1,
          'category_name' => 'lifestyle,patient-care,advocacy,profession,training',
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

        get_template_part( 'ad', 'peggy_home_front' );


        /**************************************************************
         *
         *                    SET UP SPOTLIGHT
         *
         *
         *************************************************************/
        $args = array(
          'post_type' => 'elit_spotlight',
          'post_count' => 1,
        );
        $spotlights = new WP_Query( $args );

        if ($spotlights->post_count > 0) {
          $spotlight_post = $spotlights->posts[0];
          $spotlight = get_fields( $spotlight_post->ID );
          $permalink = get_permalink( $spotlight_post->ID );
          $meta = get_post_meta( $spotlight_post->ID );
        }

        include( locate_template( 'front-elit_spotlight.php' ) ); 

        /**************************************************************
         *
         *                    SET UP SIGNUP FORM
         *
         *
         *************************************************************/
        include( locate_template( 'front-signup.php' ) );
?>



    </div> <!-- #main -->

<?php get_footer(); ?>
