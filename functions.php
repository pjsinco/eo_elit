<?php 

/*
 * elit functions and defs
 */

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
  add_image_size('super', 992, 661, true);

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'elit' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	//add_theme_support( 'post-formats', array(
		//'aside', 'image', 'video', 'quote', 'link', 'gallery',
	//) );
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

  wp_register_script('append-around-load', 
    get_template_directory_uri() . '/js/append-around-load.js', 
    array('append-around'), false, true
  );
  
  wp_enqueue_script('modernizr');
  wp_enqueue_script('typekit-load');
  //wp_enqueue_script('picturefill');
  wp_enqueue_script('nav');
  wp_enqueue_script('ehs-head-tag');
  wp_enqueue_script('append-around');
  wp_enqueue_script('append-around-load');

  // note: comment-reply is built in; found in wp-includes
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elit_scripts' );

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
add_action('wp_head', 'elit_picture_elem_shim');

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

function elit_story_image_shortcode($atts, $content = null) {
  
  $a = shortcode_atts(
    array(
      'id' => '',
    ), $atts
  );

  $attachment = get_post( $a['id'] );

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
  
  return $str;

}
add_shortcode( 'pullquote', 'elit_pull_quote_shortcode' );


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

  register_taxonomy( 'pro_theme_series', 'post', $args);
}
add_action( 'init' , 'elit_taxonomies' );

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

// temporarily disable admin bar so we can see our susy grid display
//add_filter('show_admin_bar', '__return_false');
