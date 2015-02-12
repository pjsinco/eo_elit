<?php 
/**
 * Plugin Name: Elit Taxonomies
 * Description: Set up custom custom taxonomies for elit theme
 * Version: 0.0.1
 * Author: Patrick Sinco
 */

function elit_taxonomies() {
  /**
   * Create **School** taxonomy
   */
  $labels = array(
    'name'              => _x('Schools', 'taxonomy general name'),
    'singular_name'     => _x('Schools', 'taxonomy general name'),
    'search_items'      => __('Search Schools'),
    'all_items'         => __('All Schools'),
    'parent_item'       => null,
    'parent_item_colon' => null,
    'edit_item'         => __('Edit School'),
    'update_item'       => __('Update School'),
    'add_new_item'      => __('Add New School'),
    'new_item_name'     => __('New School Name'),
    'separate_items_with_commas' => __('Separate schools with commas'),
    'add_or_remove_items' => __('Add or remove schools'),
    'choose_from_most_used' => __('Choose from most-used schools'),
    'not_found' => __('No schools found'),
    'menu_name'         => __('School'),
  );

  $args = array(
    'labels'            => $labels,
    'rewrite'           => array('slug' => 'genre'),
    'hierarchical'      => false,
    'public'            => true,
    'update_count_callback'            => '_update_post_term_count',
    'show_admin_column' => true,
    'query_var'         => true,
    'show_ui'         => true,
    'sort'              => true,
    'show_tagcloud'     => false,
  );

  register_taxonomy( 'pro_theme_school', 'post', $args);

  /**
   * Create **Series** taxonomy
   */
  $labels = array(
    'name'              => _x('Series', 'taxonomy general name'),
    'singular_name'     => _x('Series', 'taxonomy general name'),
    'search_items'      => __('Search Series'),
    'all_items'         => __('All Series'),
    'parent_item'       => null,
    'parent_item_colon' => null,
    'edit_item'         => __('Edit Series'),
    'update_item'       => __('Update Series'),
    'add_new_item'      => __('Add New Series'),
    'new_item_name'     => __('New Series Name'),
    'separate_items_with_commas' => __('Separate series with commas'),
    'add_or_remove_items' => __('Add or remove series'),
    'choose_from_most_used' => __('Choose from most-used series'),
    'not_found' => __('No series found'),
    'menu_name'         => __('Series'),
  );

  $args = array(
    'labels'            => $labels,
    'rewrite'           => array('slug' => 'series'),
    'hierarchical'      => false,
    'public'            => true,
    'update_count_callback'            => '_update_post_term_count',
    'show_admin_column' => true,
    'query_var'         => true,
    'show_ui'         => true,
    'sort'              => true,
    'show_tagcloud'     => false,
  );

  register_taxonomy( 'pro_theme_series', 'post', $args);
}
add_action( 'init' , 'elit_taxonomies' );
