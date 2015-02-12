<?php 
/**
 * Plugin Name: Elit Custom Post Types
 * Description: Set up custom post types for elit theme
 * Version: 0.0.1
 * Author: Patrick Sinco
 */

add_action( 'init' , 'elit_register_post_types' );

function elit_register_post_types() {

  /**
   * STORY SIDEBAR custom post type
   *
   * For displaying additional, related content in a story--
   * aka, a sidebar, but in the publishing sense, not the WP sense
   */
  $labels = array(
    'name'               => 'Story sidebars',
    'singular_name'      => 'Story sidebar',
    'menu_name'          => 'Story sidebars',
    'name_admin_bar'     => 'Story sidebar',
    'add_new'            => 'Add new',
    'add_new_item'       => 'Add new sidebar for a story',
    'edit_item'          => 'Edit story sidebar',
    'view_item'          => 'View story sidebar',
    'all_items'          => 'All story sidebars',
    'search_items'       => 'Search story sidebars',
    'not_found'          => 'No story sidebars found',
    'not_found_in_trash' => 'No story sidebars found in trash.',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array( 'slug' => 'story_sidebar'),
    'supports' => array( 'title', 'editor', 'revision', 'author' ),
  );

  register_post_type( 'elit_story_sidebar', $args );


  /**
   * SUPER custom post type
   * 
   * For displaying the big image on the home page
   */
  $labels = array(
    'name'               => 'Super',
    'singular_name'      => 'Super',
    'menu_name'          => 'Super',
    'name_admin_bar'     => 'Super',
    'add_new'            => 'Add new Super',
    'add_new_item'       => 'Add new Super',
    'edit_item'          => 'Edit Super',
    'view_item'          => 'View Super',
    'all_items'          => 'All Supers',
    'search_items'       => 'Search Supers',
    'not_found'          => 'No Supers found',
    'not_found_in_trash' => 'No Supers found in trash.',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array( 'slug' => 'super'),
    'supports' => array( 'title', 'excerpt', 'revision', 'thumbnail', 'custom_fields' ),
  );

  register_post_type( 'elit_super', $args );
}

