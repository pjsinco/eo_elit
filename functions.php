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
	//load_theme_textdomain( 'elit', get_template_directory() . '/languages' );

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
  add_image_size( 'elit-article-top-large', 930, 620, true );
  add_image_size( 'elit-article-top-medium', 620, 413, true );
  add_image_size( 'elit-article-top-small', 413, 275, true );
  add_image_size( 'elit-article-mid-large', 728, 485, true );
  add_image_size( 'elit-article-mid-small', 486, 324, true );
  add_image_size( 'elit-super', 992, 661, true);

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'elit' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
  add_theme_support( 'post-formats', array( 'video', ) );

  // let's load our plugins (although they're not really plugins)
  // help--
  //   http://wordpress.stackexchange.com/questions/160255
  //   /how-to-include-plugin-without-activation
  define( 'elit_inc_path', TEMPLATEPATH . '/inc/' );
  define( 'elit_inc_url', get_template_directory_uri() . '/inc/' );
  require_once elit_inc_path . 'elit-custom-post-types.php';
  require_once elit_inc_path . 'elit-meta-boxes.php';
  require_once elit_inc_path . 'elit-shortcodes.php';
  require_once elit_inc_path . 'elit-taxonomies.php';
  require_once elit_inc_path . 'elit-super.php';
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
  echo 'hello. I\'m a dashboard widget.';
}

// http://codex.wordpress.org/Plugin_API/Filter_Reference/
//   wp_get_attachment_url
//add_filter( 'wp_get_attachment_url', 'elit_honor_ssl_for_attachments' );
function elit_honor_ssl_for_attachments( $url ) {
  $http = site_url( FALSE, 'http' );
  $https = site_url( FALSE, 'https' );

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


