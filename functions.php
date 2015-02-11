<?php 

/*
 * elit functions and defs
 */

/* Change the Site URL */
/*
update_option('siteurl','http://thedodev.osteopathic.org');
update_option('home','http://thedodev.osteopathic.org');
*/

// temporarily disable admin bar so we can see our susy grid display
//add_filter('show_admin_bar', '__return_false');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
//if ( ! isset( $content_width ) ) {
	//$content_width = 640; [> pixels <]
//}

if ( ! function_exists( 'elit_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function elit_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'elit', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );

  /*
   * Set our image sizes
   */
  add_image_size('article-top-large', 930, 620, true);
  add_image_size('article-top-medium', 620, 413, true);
  add_image_size('article-top-small', 413, 275, true);
  add_image_size('article-mid-large', 728, 485, true);
  add_image_size('article-mid-small', 486, 324, true);
  //add_image_size('super', 992, 661, true);

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'elit' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
  add_theme_support( 'post-formats', array(
    //'aside', 'image', 'video', 'quote', 'link', 'gallery',
    'video',
  ) );
}
endif; // elit_setup
add_action( 'after_setup_theme', 'elit_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function elit_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Article-Sidebar', 'elit' ),
		'id'            => 'article-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'elit_widgets_init' );

 
/**
 * Enqueue scripts and styles.
 */
function elit_scripts() {
	wp_enqueue_style( 'elit-style', get_stylesheet_uri() );

  wp_register_script( 'modernizr', 
    get_template_directory_uri() . '/js/modernizr.js', 
    array(), false, false
  );

  wp_register_script('typekit-load', 
    '//use.typekit.net/vdi5qvx.js', array(), false, false
  );

  //wp_register_script('picturefill', get_template_directory_uri() . '/js/picturefill.min.js', array(), false, false);

  wp_register_script('nav', 
    get_template_directory_uri() . '/js/nav.js', 
    array('jquery'), false, true
  );

  wp_register_script('ehs-head-tag', 
    get_template_directory_uri() . '/js/ehs-head-tag.js', 
    array(), false, false
  );

  //wp_register_script('ehs-ads', get_template_directory_uri() . '/js/ehs-ads.js', array('ehs-head-tag'), false, false);

  wp_register_script('append-around', 
    get_template_directory_uri() . '/js/appendAround.js', 
    array('jquery'), false, true
  );

  //wp_register_script('append-around-load', 
    //get_template_directory_uri() . '/js/append-around-load.js', 
    //array('append-around'), false, true
  //);

  wp_register_script('fitvids', 
    get_template_directory_uri() . '/js/jquery.fitvids.js', 
    array('jquery'), false, true
  );

  wp_register_script('main',
    get_template_directory_uri() . '/js/main.js', 
    array('jquery'), false, true
  );

  
  wp_enqueue_script('modernizr');
  wp_enqueue_script('typekit-load');
  //wp_enqueue_script('picturefill');
  //wp_enqueue_script('nav');
  wp_enqueue_script('ehs-head-tag');
  wp_enqueue_script('append-around');
  wp_enqueue_script('main');

  // if we're on a video page, load FitVids to make the video responsive
  if ( has_post_format( 'video' ) )  {
    wp_enqueue_script('fitvids');
    add_action( 'wp_footer' , 'elit_add_fitvids_script', 50 );
  }

  // note: comment-reply is built in; found in wp-includes
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'elit_scripts' );

/**
 * Add our fitvids loader
 *
 * http://fitvidsjs.com/
 */
function elit_add_fitvids_script() {
  $output = '<script>' . PHP_EOL;
  $output .= 'jQuery(document).ready(function() {' . PHP_EOL;
  $output .= "  jQuery('.image--primary').fitVids();" . PHP_EOL;
  $output .= "});";
  $output .= '</script>' . PHP_EOL;

  echo $output;
}

// use google's cdn for jquery and load it in the footer
// http://www.wpbeginner.com/wp-themes/
//    replace-default-wordpress-jquery-script-with-google-library/
function elit_modify_jquery() {
  if (! is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', FALSE, '1.11.1', TRUE);
    wp_enqueue_script('jquery');
  }    
}
add_action('init' , 'elit_modify_jquery');



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';


/**
 * Load our typekit fonts
 * https://typekit.com/account/kits
 */
function elit_load_typekit() {
  $output  = '<script>' . PHP_EOL;
  $output .= 'try{Typekit.load();}catch(e){}' . PHP_EOL;
  $output .= '</script>' . PHP_EOL;
  
  echo $output;
}
add_action('wp_head', 'elit_load_typekit');

/**
 * Picture element html5 shim
 */
function elit_picture_elem_shim() {
  $output  = '<script>' . PHP_EOL;
  $output .= 'document.createElement("picture");' . PHP_EOL;
  $output .= '</script>' . PHP_EOL;
  
  echo $output;
}
//add_action('wp_head', 'elit_picture_elem_shim');

/**
 * Add html5 shim
 */
function elit_html5_shim() {
  $output =  '<!--[if lt IE 9]>' . PHP_EOL;
  $output .= '<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>' . PHP_EOL;
  $output .= '<![endif]-->' . PHP_EOL;

  echo $output;
}
add_action('wp_head', 'elit_html5_shim');

function elit_append_around() {
  $output = '<script>' . PHP_EOL;
  $output .= 'jQuery(".rover-don").appendAround();' . PHP_EOL;
  $output .= 'jQuery(".rover-peggy").appendAround();' . PHP_EOL;
  $output = '</script>' . PHP_EOL;
  
  //echo $output;
}
//add_action( 'wp_footer', 'elit_append_around', 50 );

/**
 *  Add async to loading of picturefill script
 *  At some point, maybe abstract this for any js script
 *
 *  See:
 *  http://wordpress.stackexchange.com/questions/38319/how-to-add-defer-defer-tag-in-plugin-javascripts/38335#38335
 *  https://developer.wordpress.org/reference/hooks/script_loader_tag/
 */
function elit_add_async_to_picturefill_load($tag, $handle, $src) {
  // make sure we're looking at picturefill
  if ($handle !== 'picturefill') {
    return $tag;
  }

  return str_replace(' src', ' async="async" src', $tag);
  
}
//add_filter('script_loader_tag', 'elit_add_async_to_picturefill_load', 10, 3);


/**
 * SHORTCODES
 *
 */

function elit_hiya_shortcode($atts) {
  $a = shortcode_atts(
    array(
      'name' => 'Josie',
      'occupation' => 'Guitar player',
    ),
    $atts
  );

  return 'hiya ' . $a['name'] . '. You are a ' . $a['occupation'] . '.';
}
add_shortcode('hiya', 'elit_hiya_shortcode');

function elit_related_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
    ), $atts
  );

  $post = get_post( $a['id'] );

  // make sure the related post is published
  if ( !$post || $post->post_status != 'publish') {
    return $post; 
  }

  

  // build up our string to output
  $output  = '<div class="story__box">';
  $output .= '<div class="media">';
  $output .= '<div class="media__title">Related</div>';

  $thumb_id = get_post_thumbnail_id( $post->ID );
  $thumb = get_post( $thumb_id );

  if ( $thumb_id )  {
    $thumb_url = wp_get_attachment_thumb_url( $thumb_id );
    $output .= '<img class="media__img" src="' . $thumb_url . '" ';
    $output .= 'alt="' . $thumb->post_content . '" width="140" />';
  }

  $output .= '<div class="media__body">';
  $output .= '<h3 class="media__head">';
  $output .= '<a href="' . get_permalink( $post->ID ) . '" ';
  $output .= 'class="media__link">' . $post->post_title . '</a>';
  $output .= '</h3>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  
  return $output;
}
add_shortcode('related', 'elit_related_shortcode' );

function elit_story_image_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
    ), $atts
  );

  $attachment = get_post( $a['id'] );
  $credit = get_post_meta( $attachment->ID, 'elit_image_credit', true );

  //d( wp_get_attachment_image_src($a['id'], 'article-mid-large', false ) );
  //d( get_intermediate_image_sizes() );
  $largest = wp_get_attachment_image_src( $a['id'], 'article-mid-large', false );
  
  // generates the string needed to use with the RICG Responsive Images plugin
  
  $ricg_responsive_str = '<figure class="image image--secondary">'; 
  $ricg_responsive_str .= '<img class="image__img" src="' . $largest[0] . '" '; 
  $ricg_responsive_str .= tevkori_get_src_sizes( $a['id'], $largest[0]);
  $ricg_responsive_str .= '/>';
  $ricg_responsive_str .= 
    '<figcaption class="image__caption caption caption--left">';
  
  $ricg_responsive_str .= $attachment->post_excerpt;

  $ricg_responsive_str .= $credit ? " <small>($credit)</small>" : "";
  
  $ricg_responsive_str .= '</figcaption></figure>';

  
  return $ricg_responsive_str;
}
add_shortcode('story-image', 'elit_story_image_shortcode' );

function elit_pull_quote_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'quote' => '',
      'style' => 'left',
      'speaker' => '',
      'image-id' => '',
    ), $atts
  );


  //we're using only speaker for now
  $str = '<aside class="pq';

  // so in this ternary operator, we're deciding whether we have full column width 
  // or a just a fraction
  $str .= ('full' == $a['style']) ? '--full fractional--full">' : ' fractional">';
  $str .= '<div class="pq__body">';
  $str .= $a['quote'];
  $str .= '</div>';
  $str .= '</aside>';
  
  return wptexturize($str);
}
add_shortcode( 'pullquote', 'elit_pull_quote_shortcode' );

function elit_sidebar_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
      'style' => 'left',
    ),
    $atts
  );

  $post = get_post($a['id']);

  // make sure the story-sidebar is published
  if ( !$post || $post->post_status != 'publish') {
    return false;
  }

  $str = '<aside class="story-sidebar fractional';
  // figure out whether our fractional class needs '--full'
  $str .= (($a['style'] == 'left') ? '">' : '--full">') . PHP_EOL;
  $str .= '<h3 class="story-sidebar__head">' . $post->post_title; 
  $str .= '</h3>' . PHP_EOL;
  $str .= '<div class="story-sidebar__body">' . PHP_EOL; 
  $str .= $post->post_content;
  $str .= '</div>' . PHP_EOL;
  $str .= '</aside>' . PHP_EOL;

  return $str;
}
add_shortcode('story-sidebar', 'elit_sidebar_shortcode');

function elit_advertisement_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
    ),
    $atts
  );

  $str = '<aside data-set="rover-' . $a['id'] . '-parent" ';
  $str .= 'class="ad ad__med-rect--article rover-' . $a['id'] . '-parent-a">';
  $str .= '<div class="rover-' . $a['id'] . '">';
  $str .= '<a href=';
  $str .= '"http://www.e-healthcaresolutions.com/forms/?did=ehs.pro.aoa.jaoatest"';
  $str .= ' target="_blank">';
  $str .= '<script> EHS_AD("t", "r", "300x250"); </script>';
  $str .= '</a></div></aside>';

  return $str;
}
add_shortcode('advertisement', 'elit_advertisement_shortcode');



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

function elit_register_post_types() {
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

  register_post_type('elit_story_sidebar', $args);
}
add_action( 'init' , 'elit_register_post_types' );


/**
 * BIO META BOX
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
 * END AUTHOR META BOX
 */


/**
 * KICKER META BOX
 *
 */
add_action( 'load-post.php', 'elit_kicker_meta_box_setup' );
add_action( 'load-post-new.php', 'elit_kicker_meta_box_setup' );

function elit_kicker_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_kicker_meta_box' );
  add_action( 'save_post', 'elit_save_kicker_meta', 10, 2 );
}

function elit_add_kicker_meta_box() {
  add_meta_box(
    'elit-kicker',
    esc_html( 'Headline kicker' ),
    'elit_kicker_meta_box',
    'post',
    'side',
    'default'
  );
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
 * END KICKER META BOX
 */


/**
 * ADD CREDIT LINE TO MEDIA UPLOADER
 * http://www.wpbeginner.com/wp-tutorials/how-to-add-additional-fields-
 *     to-the-wordpress-media-uploader/
 *
 *  @param $form_fields array, fields to include in the attachment form
 *  @param $post object, attachment record in the db
 *  @return $form_fields, modified form fields
 */
function elit_attachment_field_credit($form_fields, $post) {

  $form_fields['elit-image-credit'] = array (
    'label' => 'Credit line',
    'input' => 'textarea',
    'application' => 'image',
    'exclusions' => array('audio', 'video'),
    'value' => get_post_meta( $post->ID, 'elit_image_credit', true),
    'helps' => 'Example: "Photo by Jim Kirk" or "Photo provided by Dr. Quinn"',
  );

//  $form_fields['elit-photographer-name'] = array (
//    'label' => 'Photographer name',
//    'input' => 'text',
//    'value' => get_post_meta( $post->ID, 'elit_photographer_name', true),
//    'helps' => 'If provided, photo credit will be displayed',
//  );
//
//  $form_fields['elit-photographer-url'] = array (
//    'label' => 'Photographer URL',
//    'input' => 'text',
//    'value' => get_post_meta( $post->ID, 'elit_photographer_url', true),
//    'helps' => 'Add the photographer\'s URL',
//  );

  return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'elit_attachment_field_credit', 10, 2 );

/**
 * Save values of photograher's name and url in media uploader
 *
 *  @param $post array, the post data for the db
 *  @param $attachement array, attachment fields from post form
 *  @return $post array, modified post data
 */
function elit_attachment_field_credit_save( $post, $attachment) {

  if ( isset( $attachment['elit-image-credit']) ) {
    update_post_meta( 
      $post['ID'], 
      'elit_image_credit', 
      $attachment['elit-image-credit']
    );
  }
//  if ( isset( $attachment['elit-photographer-name']) ) {
//    update_post_meta( 
//      $post['ID'], 
//      'elit_photographer_name', 
//      $attachment['elit-photographer-name']
//    );
//  }
//
//  if ( isset( $attachment['elit-photographer-url']) ) {
//    update_post_meta( 
//      $posti['ID'], 
//      'elit_photographer_url', 
//      $attachment['elit-photographer-url']
//    );
//  }

  return $post;
}

add_filter( 
  'attachment_fields_to_save', 
  'elit_attachment_field_credit_save',
  10, 2 
);

/**
 * Filter to remove wp's dimension attributes on images
 *
 * http://wordpress.stackexchange.com/questions/22302/
 *   how-do-you-remove-hard-coded-thumbnail-image-dimensions
 */
//add_filter('post_thumbnail_html', 'elit_remove_thumbnail_dimensions', 10, 3);
//function elit_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
  //$html = preg_replace(' /')
//}

/**
 * STANDALONE CREDIT META BOX
 *
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
    'low'
  );
  
}

function elit_standalone_credit_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_standalone_credit_nonce' );
  ?>
  <p>
    <label for="widefat">The credit line for the featured image</label>
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
// END STANDALONE CREDIT META BOX

/**
 * META BOX THAT DISPLAYS LINK TO POST ON THE OLD SITE
 *
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
  ?>
  <p>
    <a href="<?php echo 'http://thedo.osteopathic.org/?p=' . $object->ID; ?>" target="_blank"><?php echo 'http://thedo.osteopathic.org/?p=' . $object->ID; ?></a>
  </p>
  <?php 
}
// end original-link meta box

/**
 * META BOX FOR FEATURED VIDEO
 *
 */
add_action( 'load-post.php' , 'elit_featured_video_meta_box_setup' );
add_action( 'load-post-new.php' , 'elit_featured_video_meta_box_setup' );

function elit_featured_video_meta_box_setup() {
  add_action( 'add_meta_boxes', 'elit_add_featured_video_meta_box' );
  add_action( 'save_post', 'elit_save_featured_video_meta', 10, 2 );
}

function elit_add_featured_video_meta_box() {
  add_meta_box(
    'elit-featured-video',
    esc_html( 'Featured video embed code' ),
    'elit_featured_video_meta_box',
    'post',
    'side',
    'low'
  );
  
}

function elit_featured_video_meta_box( $object, $box ) {
  wp_nonce_field( basename(__FILE__), 'elit_featured_video_nonce' );
  ?>
  <p>
    <label for="widefat">The embed code for the YouTube video, sized to 728px wide. See our documentation for more details.</label>
    <br />
    <textarea class="widefat"  name="elit-featured-video" id="elit-featured-video" rows="5"><?php echo esc_attr( get_post_meta( $object->ID, 'elit_featured_video', true ) ); ?></textarea>
  </p>
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
 * HELLO-WORLD THE DASHBOARD WIDGET 
 *
 */
function elit_add_dashboard_widgets() {
  wp_add_dashboard_widget(
    'elit-link-to-original',
    'Link to original',
    'elit_link_to_original'
  );
}
add_action( 'wp_dashboard_setup' , 'elit_add_dashboard_widgets' );

function elit_link_to_original() {
  d('hiya');
  echo 'hello, world. I\m a dashboard widget.';
}

// http://codex.wordpress.org/Plugin_API/Filter_Reference/
//   wp_get_attachment_url
add_filter( 'wp_get_attachment_url', 'elit_honor_ssl_for_attachments' );
function elit_honor_ssl_for_attachments( $url ) {

  $http = site_url( FALSE, 'http' );
  $https = site_url( FALSE, 'https' );
  //d($_SERVER['HTTPS'] == 'on');
  d($http);
  d($https);

  if ( isset( $_SERVER['HTTPS'] ) ) {
    
    return ( $_SERVER['HTTPS'] == 'on' ) ? 
      str_replace( $http, $https, $url) : $url;

  } else {
    return $url;
  }

}

/**
 * Notify Patrick when post status changes
 *
 */
function elit_notify_of_post_status_change($new_status, $old_status, $post) {

  if ($new_status !== $old_status) {
    $post_title = wp_kses_decode_entities(get_the_title());
    $post_url = get_permalink();
    $subject = "Status change in '" . wp_kses_decode_entities($post_title) . "'";
    $message = "A post has been updated on Elit Ornare:\n\n";
    //$message .= "<a href='" . $post_url. "'>" . $post_title . "</a>\n\n";
    $message .= $post_title . PHP_EOL;
    $message .= $post_url . PHP_EOL . PHP_EOL;
    $message .= "Old status: " . print_r($old_status, true) . PHP_EOL;
    $message .= "New status: " . print_r($new_status, true) . PHP_EOL;
    
    // send mail to PJS
    $headers = 'Content-Type: text/plain' . "\r\n";
    wp_mail('psinco@osteopathic.org', $subject, $message, $headers);
  }
}
add_action('transition_post_status', 'elit_notify_of_post_status_change', 10, 3);
