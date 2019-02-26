<?php 
/**
 * Plugin Name: Elit Meta Boxes
 * Description: Set up meta boxes for elit theme
 * Version: 0.0.1
 * Author: Patrick Sinco
 */

/**
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * AUTHOR BIO META BOX
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * http://www.smashingmagazine.com/2011/10/04/
 *   create-custom-post-meta-boxes-wordpress/
 */
add_action( 'load-post.php',      'elit_author_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_author_meta_box_setup' );

function elit_author_meta_box_setup() {
  // add meta boxes
  add_action( 'add_meta_boxes' , 'elit_add_bio_meta_box' );
  add_action( 'add_meta_boxes' , 'elit_add_author_photo_meta_box' );

  // save post meta
  add_action( 'save_post' , 'elit_save_bio_meta', 10, 2 );
  add_action( 'save_post' , 'elit_save_author_photo_meta', 10, 2 );
}

function elit_add_bio_meta_box() {
  add_meta_box(
    'elit-bio',
    esc_html('Author bio'),
    'elit_bio_meta_box',
    'post',
    'side',
    'low'
  );
}

function elit_add_author_photo_meta_box() {
  add_meta_box(
    'elit-author-photo-id',
    esc_html('Author photo ID'),
    'elit_author_photo_meta_box',
    'post',
    'side',
    'low'
  );
}

function elit_bio_meta_box( $object, $box) {
  wp_nonce_field( basename(__FILE__), 'elit_bio_nonce');

  // let's make our box
  ?>
  <p>
    <label for="widefat">Include a brief author bio with the story</label>
    <br />
    <textarea class="widefat"  name="elit-bio" id="elit-bio" rows="5"><?php echo esc_attr( get_post_meta( $object->ID, 'elit_bio', true ) ); ?></textarea>
  </p>
<?php } ?>


<?php 
/**
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * AUTHOR PHOTO META BOX
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 */
function elit_author_photo_meta_box( $object, $box) {
  wp_nonce_field( basename(__FILE__), 'elit_author_photo_nonce');

  // let's make our box
  ?>
  <p>
    <label for="widefat">The ID of the author's photo</label>
    <br />
    <input class="widefat" type="text" name="elit-author-photo-id" id="elit-author-photo-id" value="<?php echo esc_attr( get_post_meta( $object->ID, 'elit_author_photo_id', true ) ); ?>" />
  </p>
<?php } ?>

<?php
function elit_save_bio_meta($post_id, $post) {
  // verify the nonce
  if ( !isset( $_POST['elit_bio_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_bio_nonce'], basename( __FILE__ ) )
  ) {
      // instead of just returning, we return the $post_id
      // so other hooks can continue to use it
      return $post_id;
  }


  // get post type object
  $post_type = get_post_type_object( $post->post_type);
  

  // if the user has permission to edit the post
  if ( !current_user_can( $post_type->cap->edit_post, $post_id) ) {
    return $post_id;
  }

  // get the posted data and sanitize it
  $new_meta_value = 
    ( isset($_POST['elit-bio'] ) ? $_POST['elit-bio'] : '' );

  // set the meta key
  $meta_key = 'elit_bio';

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

function elit_save_author_photo_meta($post_id, $post) {
  // verify the nonce
  if ( !isset( $_POST['elit_author_photo_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_author_photo_nonce'], basename( __FILE__ ) )
  ) {
      // instead of just returning, we return the $post_id
      // so other hooks can continue to use it
      return $post_id;
  }

  // get post type object
  $post_type = get_post_type_object( $post->post_type);
  

  // if the user has permission to edit the post
  if ( !current_user_can( $post_type->cap->edit_post, $post_id) ) {
    return $post_id;
  }

  // get the posted data and sanitize it
  $new_meta_value = 
    ( isset($_POST['elit-author-photo-id'] ) ? $_POST['elit-author-photo-id'] : '' );

  // set the meta key
  $meta_key = 'elit_author_photo_id';

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
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * KICKER META BOX
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 */
add_action( 'load-post.php', 'elit_kicker_meta_box_setup' );
add_action( 'load-post-new.php', 'elit_kicker_meta_box_setup' );

function elit_kicker_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_kicker_meta_box' );
  add_action( 'save_post', 'elit_save_kicker_meta', 10, 2 );
}

function elit_add_kicker_meta_box() {
  $post_types = array('post', 'page', 'elit_slideshow', 'elit_spotlight');
  foreach ( $post_types as $post_type ) {
    add_meta_box(
      'elit-kicker',
      esc_html( 'Headline kicker' ),
      'elit_kicker_meta_box',
      $post_type,
      'side',
      'default'
    );
  }
//  add_meta_box(
//    'elit-kicker',
//    esc_html( 'Headline kicker' ),
//    'elit_kicker_meta_box',
//    'elit_slideshow',
//    'side',
//    'default'
//  );
}

function elit_kicker_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_kicker_nonce' );
  ?>
  <p>
    <label for="widefat">A few words above the headline to summarize, tease, add additional information</label>
    <br />
    <input class="widefat" type="text" name="elit-kicker" id="elit-kicker" value="<?php echo esc_attr( get_post_meta( $object->ID, 'elit_kicker', true ) ); ?>" />
  </p>
  <?php 
}

function elit_save_kicker_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_kicker_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_kicker_nonce'], basename( __FILE__ ) )
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
    ( isset($_POST['elit-kicker'] ) ? $_POST['elit-kicker'] : '' );

  // set the meta key
  $meta_key = 'elit_kicker';

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
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * STANDALONE CREDIT META BOX
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 */
add_action( 'load-post.php' , 'elit_standalone_credit_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_standalone_credit_meta_box_setup' );

function elit_standalone_credit_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_standalone_credit_meta_box' );
  add_action( 'save_post', 'elit_save_standalone_credit_meta', 10, 2 );
}

function elit_add_standalone_credit_meta_box() {
  add_meta_box(
    'elit-standalone-credit',
    esc_html( 'Credit for featured image' ),
    'elit_standalone_credit_meta_box',
    'post',
    'side',
    'default'
  );
}

function elit_standalone_credit_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_standalone_credit_nonce' );
  ?>
  <p>
    <label for="widefat"><em>Ex.:</em> Top of page: Photo provided by Tonya Hawthorne, DO</label>
    <br />
    <textarea class="widefat"  name="elit-standalone-credit" id="elit-standalone-credit" rows="5"><?php echo esc_attr( get_post_meta( $object->ID, 'elit_standalone_credit', true ) ); ?></textarea>
  </p>
  <?php 
}

function elit_save_standalone_credit_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_standalone_credit_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_standalone_credit_nonce'], basename( __FILE__ ) )
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
    ( isset($_POST['elit-standalone-credit'] ) ? $_POST['elit-standalone-credit'] : '' );

  // set the meta key
  $meta_key = 'elit_standalone_credit';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  // if a new meta value was added and there was no previous value, add it
  if ( $new_meta_value && $meta_value == '' ) {
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
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * META BOX THAT DISPLAYS LINK TO POST ON THE OLD SITE
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * NOTE: Turned off
 */
add_action( 'load-post.php' , 'elit_origlink_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_origlink_meta_box_setup' );

function elit_origlink_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_origlink_meta_box' );
}
function elit_add_origlink_meta_box() {
  add_meta_box(
    'elit-origlink',
    esc_html( 'Link to original story' ),
    'elit_origlink_meta_box',
    'post',
    'side',
    'low'
  );
}

function elit_origlink_meta_box( $object, $box ) {
  $id_of_last_post_on_old_site = 179511;
  if ( (int) $object->ID <= $id_of_last_post_on_old_site ):
  ?>
  <p>
    <a href="<?php echo 'http://thedoarc.osteopathic.org/?p=' . $object->ID; ?>" target="_blank"><?php echo 'http://thedoarc.osteopathic.org/?p=' . $object->ID; ?></a>
  </p>
  <?php 
  endif;
}



/**
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * META BOX FOR FEATURED VIDEO
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 */
add_action( 'load-post.php' , 'elit_featured_video_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_featured_video_meta_box_setup' );

function elit_featured_video_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_featured_video_meta_box' );
  add_action( 'save_post', 'elit_save_featured_video_meta', 10, 2 );
}

function elit_add_featured_video_meta_box() {
  $post_types = array('post', 'elit_spotlight_video');
  foreach ($post_types as $post_type) {
    add_meta_box(
      'elit-featured-video',
      esc_html( 'Featured video embed code' ),
      'elit_featured_video_meta_box',
      $post_type,
      'side',
      'low'
    );
  }
}

function elit_featured_video_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_featured_video_nonce' );
  $autoplay = get_post_meta( $object->ID, 'elit_featured_video_autoplay', true );
  $mute = get_post_meta( $object->ID, 'elit_featured_video_mute', true );

  ?>
  <p>
    <label class="widefat" for="elit-featured-video">The embed code for the YouTube video, sized to 728px wide.</label>
    <br>
    <textarea class="widefat"  name="elit-featured-video" id="elit-featured-video" rows="5"><?php echo esc_attr( get_post_meta( $object->ID, 'elit_featured_video', true ) ); ?></textarea>
  </p>
        
  <fieldset>
    <label  for="elit-featured-video-autoplay">Autoplay</label>
    <input  style="margin-right: 4px;" type="checkbox" name="elit-featured-video-autoplay" id="elit-featured-video-autoplay" value="no" <?php if ( $autoplay ): checked( $autoplay, 'no' ); endif; ?> />

    <label  for="elit-featured-video-mute">Mute</label>
    <input  type="checkbox" name="elit-featured-video-mute" id="elit-featured-video-mute" value="no" <?php if ( $mute ): checked( $mute, 'no' ); endif; ?> />
  </p>
  </fieldset>
  <?php 
}

function elit_save_featured_video_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_featured_video_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_featured_video_nonce'], basename( __FILE__ ) )
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
    ( isset($_POST['elit-featured-video'] ) ? $_POST['elit-featured-video'] : '' );

  // set the meta key
  $meta_key = 'elit_featured_video';
  $meta_key_autoplay = 'elit_featured_video_autoplay';
  $meta_key_mute = 'elit_featured_video_mute';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  if ( isset( $_POST['elit-featured-video'] ) ) {
    update_post_meta( $post_id, $meta_key, $_POST['elit-featured-video'] );
  }

  if ( isset( $_POST['elit-featured-video-autoplay'] ) ) {
    update_post_meta( $post_id, $meta_key_autoplay, $_POST['elit-featured-video-autoplay'] );
  } else {
    delete_post_meta( $post_id, $meta_key_autoplay );
  }
  
  if ( isset( $_POST['elit-featured-video-mute'] ) ) {
    update_post_meta( $post_id, $meta_key_mute, $_POST['elit-featured-video-mute'] );
  } else {
    delete_post_meta( $post_id, $meta_key_mute );
  }


//  // if a new meta value was added and there was no previous value, add it
//  if ( $new_meta_value && $meta_value == '' ) {
//    add_post_meta( $post_id, $meta_key, $new_meta_value, true);
//  } elseif ($new_meta_value && $new_meta_value != $meta_value ) {
//    // so the new meta value doesn't match the old one, so we're updating
//    update_post_meta( $post_id, $meta_key, $new_meta_value );
//  } elseif ( $new_meta_value == '' && $meta_value) {
//    // if there is no new meta value but an old value exists, delete it
//    delete_post_meta( $post_id, $meta_key, $meta_value );
//  }
}



/**
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * FEATURABLE META BOX
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 */
add_action( 'load-post.php', 'elit_featurable_meta_box_setup' );
add_action( 'load-post-new.php', 'elit_featurable_meta_box_setup' );

function elit_featurable_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_featurable_meta_box' );
  add_action( 'save_post', 'elit_save_featurable_meta', 10, 2 );
}

function elit_add_featurable_meta_box() {
  add_meta_box(
    'elit-featurable',
    esc_html( 'Not featurable' ),
    'elit_featurable_meta_box',
    'post',
    'side',
    'low'
  );
}

function elit_featurable_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_featurable_nonce' );

  $featurable = get_post_meta( $object->ID, 'elit_featurable', true );

  ?>
  <p>
    <input class="widefat" type="checkbox" name="elit-featurable" id="elit-featurable" value="no" <?php if ( $featurable ): checked( $featurable, 'no' ); endif; ?>" />
    This story is not a feature
  </p>
  <?php 
}

function elit_save_featurable_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_featurable_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_featurable_nonce'], basename( __FILE__ ) )
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
    ( isset($_POST['elit-featurable'] ) ? $_POST['elit-featurable'] : '' );

  // set the meta key
  $meta_key = 'elit_featurable';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  // if a new meta value was added and there was no previous value, add it
  if ( $new_meta_value && $meta_value == '' ) {
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
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * THUMBNAIL META BOX
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 */
add_action( 'load-post.php', 'elit_thumb_meta_box_setup' );
add_action( 'load-post-new.php', 'elit_thumb_meta_box_setup' );


function elit_thumb_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_thumb_meta_box' );
  add_action( 'save_post', 'elit_save_thumb_meta', 10, 2 );
}

function elit_add_thumb_meta_box() {
  add_meta_box(
    'elit-thumb-meta',
    esc_html( 'Thumbnail image ID' ),
    'elit_thumb_meta_box',
    'post',
    'side',
    'low'
  );
}

function elit_thumb_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_thumb_nonce' );

  $thumb_id = get_post_meta( $object->ID, 'elit_thumb', true );
  $image_markup = null;

  if ( $thumb_id ){
    $thumb_src = wp_get_attachment_image_src( $thumb_id, 'elit-medium' );
    $thumb_srcset = wp_get_attachment_image_srcset( $thumb_id, 'elit-medium' );
    $img_src = esc_url( $thumb_src[0] );
    $img_srcset = esc_attr( $thumb_srcset );
    $sizes = "(max-width: 266px) 100vw, 266px";
    $image_markup = ($img_src && $img_srcset) ? "<p><img src='$img_src' srcset='$img_srcset' sizes='$sizes' alt='Thumbnail for post' width='254' height='169' /></p>" : null;
  }
  ?>

  <p>
    <?php if ( $image_markup ): echo $image_markup; endif; ?>
    <label for="widefat">The ID of the thumbnail image to use with this story. Not needed if a Featured Image is selected.</label>
    <br />
    <input class="widefat" type="text" name="elit-thumb-meta" id="elit-thumb-meta" value="<?php echo esc_attr( get_post_meta( $object->ID, 'elit_thumb', true ) ); ?>" />

  </p>
  <?php 
}

function elit_save_thumb_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_thumb_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_thumb_nonce'], basename( __FILE__ ) )
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
    ( isset($_POST['elit-thumb-meta'] ) ? $_POST['elit-thumb-meta'] : '' );

  // set the meta key
  $meta_key = 'elit_thumb';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  // if a new meta value was added and there was no previous value, add it
  if ( $new_meta_value && $meta_value == '' ) {
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
 *************************************************************************
 *************************************************************************
 *************************************************************************
 *
 * PIN-INSIDE-THE-AOA META BOX
 *
 *       NOT USED
 *
 *************************************************************************
 *************************************************************************
 *************************************************************************
 */
//add_action( 'load-post.php', 'elit_pin_inside_the_aoa_meta_box_setup' );
//add_action( 'load-post-new.php', 'elit_pin_inside_the_aoa_meta_box_setup' );

function elit_pin_inside_the_aoa_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_pin_inside_the_aoa_meta_box' );
  add_action( 'save_post', 'elit_save_pin_inside_the_aoa_meta', 10, 2 );
}

function elit_add_pin_inside_the_aoa_meta_box() {
  add_meta_box(
    'elit-pin-inside-the-aoa',
    esc_html( 'Pin this \'Inside the AOA\' story' ),
    'elit_pin_inside_the_aoa_meta_box',
    'post',
    'side',
    'default'
  );
}

function elit_pin_inside_the_aoa_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_pin_inside_the_aoa_nonce' );

  $pinned = get_post_meta( $object->ID, 'elit_pin_inside_the_aoa', true );

  ?>
  <p>
    <input class="widefat" type="checkbox" name="elit-pin-inside-the-aoa" id="elit-pin-inside" value="1" <?php if ( $pinned ): checked( $pinned, 1 ); endif; ?> />
    This 'Inside the AOA' story will be pinned to the top of the feature story list
  </p>
  <?php 
}

function elit_save_pin_inside_the_aoa_meta( $post_id, $post ) {
  // verify the nonce
  if ( !isset( $_POST['elit_pin_inside_the_aoa_nonce'] ) || 
    !wp_verify_nonce( $_POST['elit_pin_inside_the_aoa_nonce'], basename( __FILE__ ) )
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
    ( isset($_POST['elit-pin-inside-the-aoa'] ) ? $_POST['elit-pin-inside-the-aoa'] : '' );

  // set the meta key
  $meta_key = 'elit_pin_inside_the_aoa';

  // get the meta value as a string
  $meta_value = get_post_meta( $post_id, $meta_key, true);

  // if a new meta value was added and there was no previous value, add it
  if ( $new_meta_value && $meta_value == '' ) {
    add_post_meta( $post_id, $meta_key, $new_meta_value, true);
  } elseif ($new_meta_value && $new_meta_value != $meta_value ) {
    // so the new meta value doesn't match the old one, so we're updating
    update_post_meta( $post_id, $meta_key, $new_meta_value );
  } elseif ( $new_meta_value == '' && $meta_value) {
    // if there is no new meta value but an old value exists, delete it
    delete_post_meta( $post_id, $meta_key, $meta_value );
  }
}

//add_action( 'admin_footer' , 'elit_pin_inside_javascript' );
function elit_pin_inside_javascript() {
  
?>

  <script type="text/javascript" charset="utf-8">
    (function($) {
    
      $(document).ready(function() {
    
        // the category checkbox for "Inside the AOA"
        var $category = $('#in-category-191');
      
        // the metabox for Pin this Inside the AOA story
        var  $pin = $('#elit-pin-inside-the-aoa');

        // the checkbox in our metabox
        var $pinCheckbox = $('#elit-pin-inside')

        var  $postId = $('#post_ID').val();
    
        if ( !$category.attr( 'checked' ) ) {
     
          // if 'Inside the AOA' isn't selected as a category,
          // hide the 'Pin' meta box right off the bat
          $pin.hide();
        }
      
        $category.change(function() {
          var data = {
            // our callback inside elit-meta-boxes.php
            'action': 'elit_pin_inside_action',

            // we need to know whether the checkbox to pin is checked
            //'checked': $pinCheckbox.prop('checked'),
            'post_id': $postId
          };


          // we want to uncheck the checkbox and delete the post meta
          // for elit_pin_inside_the_aoa
          $.post(ajaxurl, data, function(response) {

            $pinCheckbox.prop('checked', false);

            if ( $category.attr( 'checked' ) ) {
              //$pinCheckbox.prop('checked', false);
              $pin.show();
            } else {
              $pin.hide();
            }
          });
        });
      });
    })(jQuery);
  </script>
<?php 
}
//add_action( 'wp_ajax_elit_pin_inside_action' , 'elit_pin_inside_action_callback' );
function elit_pin_inside_action_callback() {

  if ( $_POST['post_id'] ) {
    delete_post_meta( $_POST['post_id'], 'elit_pin_inside_the_aoa');
    echo 'success';
  } else {
    echo 'failure';
  }
  wp_die();
}
