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

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'elit' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery',
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

  wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), false, false);
  wp_register_script('typekit-load', '//use.typekit.net/vdi5qvx.js', array(), false, false);
  wp_register_script('picturefill', get_template_directory_uri() . '/js/picturefill.min.js', array(), false, false);
  wp_register_script('nav', get_template_directory_uri() . '/js/nav.js', array(), false, true);
  
  wp_enqueue_script('modernizr');
  wp_enqueue_script('typekit-load');
  wp_enqueue_script('picturefill');

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
function elit_add_html5_shim() {
  $output =  '<!--[if lt IE 9]>' . PHP_EOL;
  $output .= '<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>' . PHP_EOL;
  $output .= '<![endif]-->' . PHP_EOL;

  echo $output;
}
add_action('wp_head', 'elit_add_html5_shim');

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
add_filter('script_loader_tag', 'elit_add_async_to_picturefill_load', 10, 3);
