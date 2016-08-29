<?php 

function elit_register_spotlight_cpt() {

  $labels = array(
    'name' => 'Spotlights',
    'singular_name' => 'Spotlight',
    'menu_name'          => 'Spotlights',
    'name_admin_bar'     => 'Spotlight',
    'add_new'            => 'Add new',
    'add_new_item'       => 'Add new Spotlight',
    'edit_item'          => 'Edit Spotlight',
    'view_item'          => 'View Spotlight',
    'all_items'          => 'All Spotlights',
    'search_items'       => 'Search Spotlights',
    'not_found'          => 'No Spotlights found',
    'not_found_in_trash' => 'No Spotlights found in trash',
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
    'rewrite' => array( 'slug' => 'spotlight'),
    'supports' => array( 'revision', 'title', 'custom_fields' ),
  );
  
  register_post_type( 'elit_spotlight', $args );
}

add_action('init' , 'elit_register_spotlight_cpt');


function elit_rewrite_flush() {
  elit_register_spotlight_cpt();
  flush_rewrite_rules();
}

//elit_rewrite_flush();
