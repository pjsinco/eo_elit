<?php 

function elit_register_spotlight_video_cpt() {

  $labels = array(
    'name' => 'Spotlight videos',
    'singular_name' => 'Spotlight video',
    'menu_name'          => 'Spotlight videos',
    'name_admin_bar'     => 'Spotlight video',
    'add_new'            => 'Add new',
    'add_new_item'       => 'Add new Spotlight video',
    'edit_item'          => 'Edit Spotlight video',
    'view_item'          => 'View Spotlight video',
    'all_items'          => 'All Spotlight videos',
    'search_items'       => 'Search Spotlight videos',
    'not_found'          => 'No Spotlight videos found',
    'not_found_in_trash' => 'No Spotlight videos found in trash',
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
    //'rewrite' => array( 'slug' => 'spotlight-video'),
    'supports' => array( 'revision', 'title', 'editor', 'custom_fields' ),
  );
  
  register_post_type( 'elit_spotlight_video', $args );
}

add_action('init' , 'elit_register_spotlight_video_cpt');


function elit_rewrite_flush() {
  elit_register_spotlight_video_cpt();
  flush_rewrite_rules();
}
