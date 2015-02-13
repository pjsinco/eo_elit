<?php

/**
 * Set up everything we need for our Super, 
 * the giant image on our front page
 *    --custom post type
 *    --meta boxes
 *
 */

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
  'publicly_queryable' => false,
  'exclude_from_search' => true,
  'show_ui' => true,
  'show_in_menu' => true,
  'show_in_admin_bar' => true,
  'menu_position' => 5,
  'capability_type' => 'post',
  'hierarchical' => false,
  'rewrite' => array( 'slug' => 'super'),
  'supports' => array( 'revision', 'thumbnail', 'custom_fields' ),
);

register_post_type( 'elit_super', $args );

/**
 * SUPER overlay color meta box
 *
 * Specify the background color for the Super's overlay
 */
add_action( 'load-post.php' , 'elit_super_overlay_color_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_super_overlay_color_meta_box_setup' );

function elit_super_overlay_color_meta_box_setup() {
  add_action( 'add_meta_boxes' , 'elit_add_super_overlay_color_meta_box' );
  add_action( 'save_post' , 'elit_save_super_overlay_color_meta', 10, 2 );
}

function elit_add_super_overlay_color_meta_box() {
  add_meta_box(
    'elit-super-overlay-color',
    esc_html( 'Overlay color' ),
    'elit_super_overlay_color_meta_box',
    'elit_super',
    'side',
    'low'
  );
}

function elit_super_overlay_color_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_super_overlay_color_nonce' );
  ?>
  <p>
    <label for="widefat">The hexadecimal value for the overlay base color.</label>
    <br />
    <input class="widefat" type="text" name="elit-super-overlay-color" id="elit-super-overlay-color" value="<?php echo esc_attr( get_post_meta( $object->ID, 'elit_super_overlay_color', true ) ); ?>" />
  </p>
  <?php 
}

function elit_save_super_overlay_color_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_super_overlay_color_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_super_overlay_color_nonce'], basename( __FILE__ ) )
  ) {
      // instead of just returning, we return the $post_id
      // so other hooks can continue to use it
      return $post_id;
  }

  // get post type object
  $post_type = get_post_type_object( $post->post_type );

  // if the user has permission to edit the post
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
    return $post_id;
  }

  // get the posted data and sanitize it
  $new_meta_value = 
    ( isset($_POST['elit-super-overlay-color'] ) ? $_POST['elit-super-overlay-color'] : '' );

  // set the meta key
  $meta_key = 'elit_super_overlay_color';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  // if a new meta value was added and there was no previous value, add it
  if ( $new_meta_value && $meta_value == '' ) {
    //add_post_meta( $post_id, 'elit_foo', 'bar');
    add_post_meta( $post_id, $meta_key, $new_meta_value, true);
  } elseif ($new_meta_value && $new_meta_value != $meta_value ) {
    // so the new meta value doesn't match the old one, so we're updating
    update_post_meta( $post_id, $meta_key, $new_meta_value );
  } elseif ( $new_meta_value == '' && $meta_value) {
    // if there is no new meta value but an old value exists, delete it
    delete_post_meta( $post_id, $meta_key, $meta_value );
  }
}


/**
 * SUPER overlay quadrant meta box
 *
 * Specify the quadrant for the overlay: 
 *   top-left, top-right, bottom-left, bottom-right
 */
add_action( 'load-post.php' , 'elit_super_overlay_quadrant_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_super_overlay_quadrant_meta_box_setup' );

function elit_super_overlay_quadrant_meta_box_setup() {
  add_action( 'add_meta_boxes' , 'elit_add_super_overlay_quadrant_meta_box' );
  add_action( 'save_post' , 'elit_save_super_overlay_quadrant_meta', 10, 2 );
}

function elit_add_super_overlay_quadrant_meta_box() {
  add_meta_box(
    'elit-super-overlay-quadrant',
    esc_html( 'Overlay quadrant' ),
    'elit_super_overlay_quadrant_meta_box',
    'elit_super',
    'side',
    'low'
  );
}

function elit_super_overlay_quadrant_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_super_overlay_quadrant_nonce' );
  $quadrant = get_post_meta( $object->ID, 'elit_super_overlay_quadrant', true );
  d($quadrant);
  ?>
  <p>
    <label for="widefat">The area of the image in which the overlay should appear.</label>
    <br />
    <br />
    <select name="elit-super-overlay-quadrant" id="elit-super-overlay-quadrant">
      <option value="top-left" <?php if ( $quadrant ) : selected( $quadrant, 'top-left' ); endif;?>>Top-left</option>
      <option value="top-right" <?php if ( $quadrant ) : selected( $quadrant, 'top-right' ); endif;?>>Top-right</option>
      <option value="bottom-left" <?php if ( $quadrant ) : selected( $quadrant, 'bottom-left' ); endif;?>>Bottom-left</option>
      <option value="bottom-right" <?php if ( $quadrant ) : selected( $quadrant, 'bottom-right' ); endif;?>>Bottom-right</option>
      
    </select>
  </p>
  <?php 
}

function elit_save_super_overlay_quadrant_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_super_overlay_quadrant_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_super_overlay_quadrant_nonce'], basename( __FILE__ ) )
  ) {
      // instead of just returning, we return the $post_id
      // so other hooks can continue to use it
      return $post_id;
  }

  // get post type object
  $post_type = get_post_type_object( $post->post_type );

  // if the user has permission to edit the post
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
    return $post_id;
  }

  // get the posted data and sanitize it
  $new_meta_value = 
    ( isset($_POST['elit-super-overlay-quadrant'] ) ? $_POST['elit-super-overlay-quadrant'] : '' );

  // set the meta key
  $meta_key = 'elit_super_overlay_quadrant';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  // if a new meta value was added and there was no previous value, add it
  if ( $new_meta_value && $meta_value == '' ) {
    //add_post_meta( $post_id, 'elit_foo', 'bar');
    add_post_meta( $post_id, $meta_key, $new_meta_value, true);
  } elseif ($new_meta_value && $new_meta_value != $meta_value ) {
    // so the new meta value doesn't match the old one, so we're updating
    update_post_meta( $post_id, $meta_key, $new_meta_value );
  } elseif ( $new_meta_value == '' && $meta_value) {
    // if there is no new meta value but an old value exists, delete it
    delete_post_meta( $post_id, $meta_key, $meta_value );
  }
}


/**
 * SUPER body meta box
 *
 * Specify the body text used in the overlay: 
 */
//add_action( 'load-post.php' , 'elit_super_body_meta_box_setup' );
//add_action( 'load-post-new.php' , 'elit_super_body_meta_box_setup' );

function elit_super_body_meta_box_setup() {
  add_action( 'add_meta_boxes' , 'elit_add_super_body_meta_box' );
  add_action( 'save_post' , 'elit_save_super_body_meta', 10, 2 );
}

function elit_add_super_body_meta_box() {
  add_meta_box(
    'elit-super-body',
    esc_html( 'Body text' ),
    'elit_super_body_meta_box',
    'elit_super',
    'normal',
    'default'
  );
}

function elit_super_body_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_super_body_nonce' );
  $body = get_post_meta( $object->ID, 'elit_super_body', true );
  d($body);
  ?>
  <p>
    <label for="widefat">The body text for the overlay</label>
    <br />
    <br />
    <textarea class="widefat"  name="elit-super-body" id="elit-super-body" rows="5"><?php echo esc_attr( get_post_meta( $object->ID, 'elit_super_body', true ) ); ?></textarea>
  </p>
  <?php 
}

function elit_save_super_body_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_super_body_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_super_body_nonce'], basename( __FILE__ ) )
  ) {
      // instead of just returning, we return the $post_id
      // so other hooks can continue to use it
      return $post_id;
  }

  // get post type object
  $post_type = get_post_type_object( $post->post_type );

  // if the user has permission to edit the post
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
    return $post_id;
  }

  // get the posted data and sanitize it
  $new_meta_value = 
    ( isset($_POST['elit-super-body'] ) ? $_POST['elit-super-body'] : '' );

  // set the meta key
  $meta_key = 'elit_super_body';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  // if a new meta value was added and there was no previous value, add it
  if ( $new_meta_value && $meta_value == '' ) {
    //add_post_meta( $post_id, 'elit_foo', 'bar');
    add_post_meta( $post_id, $meta_key, $new_meta_value, true);
  } elseif ($new_meta_value && $new_meta_value != $meta_value ) {
    // so the new meta value doesn't match the old one, so we're updating
    update_post_meta( $post_id, $meta_key, $new_meta_value );
  } elseif ( $new_meta_value == '' && $meta_value) {
    // if there is no new meta value but an old value exists, delete it
    delete_post_meta( $post_id, $meta_key, $meta_value );
  }
}


/**
 * SUPER gowith meta bOX
 *
 * Specify the story attached to the super.
 */
add_action( 'load-post.php' , 'elit_super_gowith_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_super_gowith_meta_box_setup' );

function elit_super_gowith_meta_box_setup() {
  add_action( 'add_meta_boxes' , 'elit_add_super_gowith_meta_box' );
  add_action( 'save_post' , 'elit_save_super_gowith_meta', 10, 2 );
}

function elit_add_super_gowith_meta_box() {
  add_meta_box(
    'elit-super-gowith',
    esc_html( 'Goes with' ),
    'elit_super_gowith_meta_box',
    'elit_super',
    'side',
    'default'
  );
}

function elit_super_gowith_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_super_gowith_nonce' );
  ?>
  <p>
    <label for="widefat">The ID of the article for the Super</label>
    <br />
    <input class="widefat" type="text" name="elit-super-gowith" id="elit-super-gowith" value="<?php echo esc_attr( get_post_meta( $object->ID, 'elit_super_gowith', true ) ); ?>" />
  </p>
  <?php 
}

function elit_save_super_gowith_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_super_gowith_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_super_gowith_nonce'], basename( __FILE__ ) )
  ) {
    // instead of just returning, we return the $post_id
    // so other hooks can continue to use it
    return $post_id;
  }

  // get post type object
  $post_type = get_post_type_object( $post->post_type );

  // if the user has permission to edit the post
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
    return $post_id;
  }

  // get the posted data and sanitize it
  $new_meta_value = 
    ( isset($_POST['elit-super-gowith'] ) ? $_POST['elit-super-gowith'] : '' );

  // grab the post that our go-with refers to
  $gowith = get_post( $new_meta_value );

  // set the meta key
  $meta_key = 'elit_super_gowith';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);


  // if a new meta value was added and there was no previous value, add it,
  // along with the particulars from the go-with
  if ( $new_meta_value && $meta_value == '' ) {
    //add_post_meta( $post_id, 'elit_foo', 'bar');
    add_post_meta( $post_id, $meta_key, $new_meta_value, true);

    //$gowith = get_post( $new_meta_value );
    if ( $gowith ) {
      add_post_meta( $post_id, 'elit_super_title', $gowith->post_title );
      add_post_meta( $post_id, 'elit_super_body', $gowith->post_excerpt );
      add_post_meta( $post_id, 'elit_super_date', get_the_date( 'M. j, Y', $gowith->ID ) );

      $gowith_kicker = get_post_meta( $gowith->ID, 'elit_kicker', true );
      if ( $gowith_kicker ) {
        add_post_meta( $post_id, 'elit_super_kicker', $gowith_kicker );
      }
    } 
  } elseif ($new_meta_value && $new_meta_value != $meta_value ) {
    // so the new meta value doesn't match the old one, so we're updating
    update_post_meta( $post_id, $meta_key, $new_meta_value );

    //$gowith = get_post( $new_meta_value );
    if ( $gowith ) {
      update_post_meta( $post_id, 'elit_super_title', $gowith->post_title );
      update_post_meta( $post_id, 'elit_super_body', $gowith->post_excerpt );
      update_post_meta( $post_id, 'elit_super_date', get_the_date( 'M. j, Y', $gowith->ID ) );

      $gowith_kicker = get_post_meta( $gowith->ID, 'elit_kicker', true );
      if ( $gowith_kicker ) {
        update_post_meta( $post_id, 'elit_super_kicker', $gowith_kicker );
      }
    } 
  } elseif ( $new_meta_value == '' && $meta_value ) {
    // if there is no new meta value but an old value exists, delete it ...
    delete_post_meta( $post_id, $meta_key, $meta_value );
  } 

  // if our go-with doesn't belong to a post (wrong id, blank id), delete
  // the data we've pulled from the go-with


  // if $new_meta_value is empty, get_post() will grab its own post object,
  // meaning this one, the super. so we need to guard against that false-positive
  if ( !( $gowith && $gowith->post_type != 'elit_super' ) ) {
    // problem with the gowith, let's delete the info we've captured from it
    delete_post_meta( $post_id, 'elit_super_title' );
    delete_post_meta( $post_id, 'elit_super_body' );
    delete_post_meta( $post_id, 'elit_super_date' );

    $gowith_kicker = get_post_meta( $gowith->ID, 'elit_kicker', true );
    if ( $gowith_kicker ) {
      delete_post_meta( $post_id, 'elit_super_kicker' );
    }
  } 
}

// we need to add a title for our super.
// this post type doesn't support titles, 
// so it defaults to 'Auto Draft'

