<?php 
/*
 * elit functions and defs
 */


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
  add_theme_support( 'menus' );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
  add_theme_support( 'post-formats', array( 'video', ) );

  /*
   * Set our image sizes
   */
  add_image_size( 'elit-super', 992, false );
  add_image_size( 'elit-large', 768, false );
  add_image_size( 'elit-medium', 480, false ); 
  add_image_size( 'elit-mug', 180 ); // vertical; mugshot
  add_image_size( 'elit-stamp', 120, 120, array( 'center', 'top' ) ); // vertical; mugshot

  // these precisely cropped because they often
  // need to align on the front page
  add_image_size( 'elit-small', 234, 156, true);
  add_image_size( 'elit-thumb', 160, 107, true);
  add_image_size( 'elit-tiny', 100, 66, true);

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
  require_once elit_inc_path . 'elit-spotlight.php';
  require_once elit_inc_path . 'template-tags.php'; 
  require_once elit_inc_path . 'elit-widgets.php'; 
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
		'name'          => 'Article Sidebar',
		'id'            => 'article-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
		'before_title'  => '<div class="section-title-hat"><span class="section-title-hat__text">',
		'after_title'   => '</span></div>',
	) );

	register_sidebar( array(
		'name'          => 'Article Sidebar Alt-1',
		'id'            => 'article-sidebar-alt-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
		'before_title'  => '<div class="section-title-hat"><span class="section-title-hat__text">',
		'after_title'   => '</span></div>',
	) );

	register_sidebar( array(
		'name'          => 'Article Sidebar Ad: Don',
		'id'            => 'article-sidebar-ad-don',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="%2$s ad rover-don-parent-b" ' .
      'data-set="rover-don-parent"><div class="rover-don">',
    'after_widget'  => '</div></aside>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => 'Article Sidebar Ad: Peggy',
		'id'            => 'article-sidebar-ad-peggy',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="%2$s ad rover-peggy-parent-b" ' .
      'data-set="rover-peggy-parent"><div class="rover-peggy">',
    'after_widget'  => '</div></aside>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => 'Article Ad: Leaderboard',
		'id'            => 'article-ad-leaderboard',
		'description'   => '',
		'before_widget' => '<aside class="ad ad--wide-shallow">',
    'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => 'Front Ad: Don',
		'id'            => 'front-ad-don',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="%2$s ad ad__med-rect--front rover-don-parent-f-a" ' .
      'data-set="rover-don-parent"><div class="rover-don">',
    'after_widget'  => '</div></aside>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => 'Front Ad: Peggy',
		'id'            => 'front-ad-peggy',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="%2$s ad ad__med-rect--front rover-peggy-parent-f-a" ' .
      'data-set="rover-peggy-parent"><div class="rover-peggy">',
    'after_widget'  => '</div></aside>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => 'Front Page Standalone',
		'id'            => 'front-page-standalone',
		'description'   => 'A front-page stand-alone widget, like \'Popular\'',
		'before_widget' => '<aside id="%1$s" class="widget--counter widget--front %2$s">',
    'after_widget'  => '</aside>',
		'before_title'  => '<div class="section-title-hat"><span class="section-title-hat__text">',
		'after_title'   => '</span></div>',
	) );

}
add_action( 'widgets_init', 'elit_widgets_init' );


/**
 * Remove default WP widgets we don't need.
 *
 */
function elit_unregister_default_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	//unregister_widget('WP_Widget_Search');
	//unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	//unregister_widget('WP_Widget_Recent_Posts');
	//unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	//unregister_widget('WP_Nav_Menu_Widget');
}
add_action( 'widgets_init', 'elit_unregister_default_widgets' );

/**
 * Register our menus
 *
 */
function elit_register_main_menu() {
  register_nav_menu( 'main-menu', 'Main menu' );
}
add_action( 'after_setup_theme' , 'elit_register_main_menu' );

/**
 * Add a search box to the Main menu
 *
 * help:
 * http://www.wpbeginner.com/wp-themes/
 *    how-to-add-custom-items-to-specific-wordpress-menus/
 */
add_filter( 'wp_nav_menu_items', 'elit_add_search_box_to_menu', 10, 2 );
function elit_add_search_box_to_menu( $items, $args ) {
  if ( $args->theme_location == 'main-menu' ) {
    $search  = '<li class="nav__item nav__item--search">';
    $search .= '<section class="site-search">';
    $search .= '<form action="/" id="search-form" class="site-search__form">';
    $search .= '<input type="search" name="s" placeholder="Enter search terms"';
    $search .= ' id="q" class="site-search__input" required />';
    $search .= '<input type="submit" class="site-search__button--hide"/>';
    $search .= '</form></section></li>';
  
    $items .= $search;
  }

  return $items;
}

/**
 * Hack to get menu to appear on archive pages
 * 
 * Source: https://wordpress.org/support/topic/
 *    wp-nav-menu-dissapears-in-category-pages-1/page/2/#post-1751763
 *
 * via: http://wordpress.stackexchange.com/questions/35264/
 *    wp-nav-menu-not-appearing-for-a-couple-pages
 * 
 * @param $menu_location string - The menu location slug
 */
function get_main_menu( $menu_location ) {

  $locations = get_nav_menu_locations();
  $menu_items = wp_get_nav_menu_items( $locations[$menu_location] );

  if ( empty( $menu_items ) ) {
    return false;
  }

  $args = array(
    'theme_location' => $menu_location,
    'menu' => 'main-menu',
    'container' => false,
    'menu_class' => 'nav__list',
    'depth' => 0,
  );

  wp_nav_menu( $args );
  return true;
}

/**
 * Register scripts and styles. Enqueue as needed.
 */
function elit_scripts() {
  wp_enqueue_style(
    'elit-style', 
    get_stylesheet_uri(),
    array(),
    filemtime( get_template_directory() . '/style.css' ), 
    'all'
  );

  wp_register_script('typekit-load', 
    '//use.typekit.net/vdi5qvx.js', array(), false, false
  );

  wp_register_script( 'fitvids', 
    get_template_directory_uri() . '/js/jquery.fitvids.js', 
    array( 'jquery' ), false, true
  );

  wp_register_script( 'elit_load_d3', 
    get_template_directory_uri() . '/js/d3.min.js', 
    array(), false, true
  );

  wp_register_script('main',
    get_template_directory_uri() . '/dist/the-do.min.js', 
    array( 'jquery' ), 
    false, 
    true
  );

  wp_register_script( 'elit_load_topojson', 
    get_template_directory_uri() . '/js/topojson.v1.min.js', 
    array( 'elit_load_d3' ), false, true
  );

  wp_register_script( 'elit_load_d3_tip', 
    get_template_directory_uri() . '/js/d3-tip.min.js', 
    array( 'elit_load_d3' ), false, true
  );

  // if we're on a video page, load FitVids to make the video responsive
  if ( has_post_format( 'video' ) || 
       is_front_page() || 
       is_singular( 'elit_spotlight' ) ) {
    wp_enqueue_script( 'fitvids' );
    $output  = 'jQuery(document).ready(function() {' . PHP_EOL;
    $output .= "  jQuery('.elit-video').fitVids();" . PHP_EOL;
    $output .= "});";

    wp_add_inline_script( 'fitvids', $output );
  }

  // note: comment-reply is built in; found in wp-includes
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

  wp_enqueue_script( 'main' );

  /**
   * Subscribe page styles
   */
  if ( is_page_template( 'page-subscribe.php' ) ) {
    $style_uri = get_template_directory_uri() . '/dist/styles-subscribe.css';
    $style_path = get_template_directory() . '/dist/styles-subscribe.css';

    wp_enqueue_style(
      'subscribe-style',
      $style_uri,
      array( 'elit-style' ),
      filemtime( $style_path ), 
      'all'
    );
  }

  /**
   * Load our typekit fonts
   * https://typekit.com/account/kits
   */
  $output  =  '(function(d) {' . PHP_EOL;
  $output .=  '  var config = {' . PHP_EOL;
  $output .=  '    kitId: \'vdi5qvx\',' . PHP_EOL;
  $output .=  '    scriptTimeout: 3000,' . PHP_EOL;
  $output .=  '    async: true' . PHP_EOL;
  $output .=  '  },' . PHP_EOL;
  $output .=  '  h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src=\'https://use.typekit.net/\'+config.kitId+\'.js\';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)' . PHP_EOL;
  $output .=  '})(document);';

  wp_add_inline_script( 'main', $output );
}
add_action( 'wp_enqueue_scripts', 'elit_scripts', 9999 );



// use google's cdn for jquery and load it in the footer
// http://www.wpbeginner.com/wp-themes/
//    replace-default-wordpress-jquery-script-with-google-library/
function elit_modify_jquery() {
  if (! is_admin()) {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', FALSE, '1.11.1', TRUE );
    wp_enqueue_script( 'jquery' );
  }    
}
add_action( 'wp_enqueue_scripts' , 'elit_modify_jquery' );

/**
 * Association Revenue Partners snippet for retargeting ads.
 *
 */
function elit_add_arp_snippet() {
  $src = '//nexus.ensighten.com/choozle/4769/Bootstrap.js';
  $output  = "<script type=\"text/javascript\" src=\"$src\"></script>" . 
             PHP_EOL;

  echo $output;
}
add_action( 'wp_head' , 'elit_add_arp_snippet' );

/**
 * Add Google Publisher Tag head matter
 *
 */
function elit_add_gpt_script() {
  $src = 'https://www.googletagservices.com/tag/js/gpt.js';
  $output  = "<script type=\"text/javascript\" async=\"async\" src=\"$src\"></script>" . PHP_EOL;
  $output .= '<script>var googletag = googletag || {}; googletag.cmd = googletag.cmd || [];</script>' .  PHP_EOL;
  

  // Right Rail - Top (Don)
  $output .= '<script>' . PHP_EOL;
  $output .= '  googletag.cmd.push(function() {' . PHP_EOL;
  $output .= '  googletag.defineSlot("/11459905/thedo.osteopathic.org/Top_Right_Rail", [300, 250], ';
  $output .= '"div-gpt-ad-1546881023339-0").addService(googletag.pubads());' . PHP_EOL;
  $output .= '  googletag.pubads().enableSingleRequest();' . PHP_EOL;
  $output .= '  googletag.enableServices();' . PHP_EOL;
  $output .= '});' . PHP_EOL;
  $output .= '</script>' . PHP_EOL;

  // Right Rail - Bottom (Peggy)
  $output .= '<script>' . PHP_EOL;
  $output .= '  googletag.cmd.push(function() {' . PHP_EOL;
  $output .= '  googletag.defineSlot("/11459905/thedo.osteopathic.org/Bottom_Right_Rail", [300, 250], ';
  $output .= '"div-gpt-ad-1546881092063-0").addService(googletag.pubads());' . PHP_EOL;
  $output .= '  googletag.pubads().enableSingleRequest();' . PHP_EOL;
  $output .= '  googletag.enableServices();' . PHP_EOL;
  $output .= '});' . PHP_EOL;
  $output .= '</script>' . PHP_EOL;

  // Leaderboard
  $output .= '<script>' . PHP_EOL;
  $output .= '  googletag.cmd.push(function() {' . PHP_EOL;
  $output .= '  googletag.defineSlot("/11459905/thedo.osteopathic.org/Top_Banner", [728, 90], ';
  $output .= '"div-gpt-ad-1546880898179-0").addService(googletag.pubads());' . PHP_EOL;
  $output .= '  googletag.pubads().enableSingleRequest();' . PHP_EOL;
  $output .= '  googletag.enableServices();' . PHP_EOL;
  $output .= '});' . PHP_EOL;
  $output .= '</script>' . PHP_EOL;

  echo $output;
}
add_action( 'wp_head' , 'elit_add_gpt_script' );

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
    'helps' => 'Example: "Photo by Jim Kirk" or "Photo provided by Dr. Quinn" or "Image by Thinkstock" or "Thinkstock" (for in-article images)',
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
//add_action( 'wp_dashboard_setup' , 'elit_add_dashboard_widgets' );

function elit_link_to_original() {
  echo 'hello. I\'m a dashboard widget.';
}

// http://codex.wordpress.org/Plugin_API/Filter_Reference/
//   wp_get_attachment_url
add_filter( 'wp_get_attachment_url', 'elit_honor_ssl_for_attachments' );
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
//add_action('transition_post_status', 'elit_notify_of_post_status_change', 10, 3);


function elit_eight_posts_on_archive_and_search( $query ) {
  if ( ( $query->is_archive() || $query->is_search() ) && $query->is_main_query() ) {
    $query->set( 'posts_per_page', 8 );
  }
}
add_action( 'pre_get_posts' , 'elit_eight_posts_on_archive_and_search' );

add_action( 'wp_print_styles' , 'elit_disable_plugin_stylesheets', 100 );
function elit_disable_plugin_stylesheets() {

  wp_dequeue_style( 'wordpress-popular-posts' );

}

function elit_create_feed_for_aoa_app() {
  load_template( get_template_directory() . '/elit-feed-for-aoa-app.php' );
}
//add_action( 'do_feed_app' , 'elit_create_feed_for_aoa_app', 10, 1 );

function elit_remove_shortcodes_from_content_for_aoa_app( $content ) {

  if ( is_feed( 'app' ) ) {
    $content = strip_shortcodes( $content );
  }

  return $content;
}
add_filter( 'the_content', 'elit_remove_shortcodes_from_content_for_aoa_app', 10, 1 );

/**
 * Based on this gist:
 * https://gist.github.com/danielbachhuber/7126249
 */
function elit_include_authors_in_search($posts_search, $wp_query)
{
    if (! $wp_query->is_search() || empty($posts_search)) {
        return $posts_search;
    }

    global $wpdb;

    add_filter('pre_user_query', 'elit_filter_user_query');

    $search = sanitize_text_field(get_query_var('s'));
    $args = array(
        'count_total' => false,
        'search' => sprintf('*%s*', $search),
        'count_total' => false,
        'search_columns' => array(
            'display_name',
        ),
        'fields' => 'ID',
    );

    $matching_users = get_users($args);

    remove_filter('pre_user_query', 'elit_filter_user_query');

    if (empty($matching_users)) {
        return $posts_search;
    }

    $posts_search = str_replace(')))', ")) OR ({$wpdb->posts}.post_author IN (" .
        implode(',', array_map('absint', $matching_users)) . ')))', $posts_search );

    return $posts_search;

}
add_filter('posts_search' , 'elit_include_authors_in_search', 10, 2);

function elit_filter_user_query( &$user_query )
{
    if (is_object($user_query)) {
        $user_query->query_where = str_replace("user_nicename LIKE", "display_name LIKE", $user_query->query_where);
    }
    return $user_query;
}


function elit_add_custom_ninja_form_class ( $form_class, $form_id ) 
{
  if ( $form_id == 7 ) {
    $form_class .= ' contact-form';
  }

  return $form_class;
}
add_filter( 'ninja_forms_form_class', 'elit_add_custom_ninja_form_class', 10, 2 );

function elit_add_custom_ninja_form_response_class( $form_class, $form_id ) {
  if ( $form_id == 1 ) {
    $form_class .= ' contact__success';
  }

  return $form_class;
}
//add_filter ( 'ninja_forms_display_response_message_class', 'elit_add_custom_ninja_form_response_class', 10, 2);

/**
 * Spotlights have the same categories as regular posts.
 * Include them in the archive page for a category.
 */
function elit_modify_main_query_for_archive( $query ) {

  if ( $query->is_category() ) {
    $query->set( 'post_type', array( 'post', 'elit_spotlight' ) );
  }

  return $query;
}

add_action('pre_get_posts' , 'elit_modify_main_query_for_archive');

/**
 * Redo WP's get_adjacent_post() to allow us to get an adjacent post 
 * regardless of its type.
 *
 * WP's default function does not work across post types.
 *
 * Source: http://stackoverflow.com/questions/10376891/
 *   make-get-adjacent-post-work-across-custom-post-types
 */
function elit_get_adjacent_post( $direction = 'prev', $post_types = 'post' ) {
  global $post, $wpdb;

  if ( empty( $post ) ) {
    return null;
  }

  if ( is_array( $post_types ) ) {
    $text = '';
    for ( $i = 0; $i < count( $post_types ); $i++ ) {
      $text .= "'" . $post_types[$i] . "'";
      if ( $i != count( $post_types ) - 1 ) {
        $text .= ', ';
      }
    }
    $post_types = $text;
  }

  $current_post_date = $post->post_date;
  
  $join = '';
  $in_same_cat = false;
  $excluded_categories = '';
  $adjacent = ( $direction == 'prev' ? 'prev' : 'next' );
  $op = ( $direction == 'prev' ? '<' : '>' );
  $order = ( $direction == 'prev' ? 'DESC' : 'ASC' );

  $join = apply_filters( 
    'get_{$adjacent}_post_join', 
    $join, 
    $in_same_cat, 
    $excluded_categories );

  $where = apply_filters(
    'get_{$adjacent}_post_where', 
    $wpdb->prepare( "WHERE p.post_date $op %s AND p.post_type " .
                    "IN ({$post_types}) " .
                    "AND p.post_status = 'publish'", $current_post_date),
    $in_same_cat,
    $excluded_categories );
    
  $sort = apply_filters(
    'get_{$adjacent}_post_sort', 
    "ORDER BY p.post_date $order LIMIT 1" );

  $query = "SELECT p.* FROM $wpdb->posts as p $join $where $sort";
  $query_key = 'adjacent_post_' . md5( $query );
  $result = wp_cache_get( $query_key, 'counts' );
  if ( $result !== false ) {
    return $result;
  }

  $result = 
    $wpdb->get_row( "select p.* from $wpdb->posts as p $join $where $sort" );

  if ( $result == null ) {
    $result = '';
  }

  return $result;
}

/**
 * Add excerpt to our page-styles.php template
 */
function elit_add_excerpt_to_page_styles() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action('init' , 'elit_add_excerpt_to_page_styles');


/**
 * TEMP -- start
 *
 */

function elit_temp_c3_for_post_196413() {

  global $post;

  $target_id = 196413;

  if ( $post && ( $post->ID == $target_id ) ) {

    wp_enqueue_style(
      'c3-library-style',
      get_template_directory_uri() . '/js/c3-temp/c3.css'
    );

    wp_enqueue_style(
      'c3-chart-style',
      get_template_directory_uri() . '/js/c3-temp/style.css',
      array( 'c3-library-style' )
    );

    wp_enqueue_script(
      'd3-library-script',
      get_template_directory_uri() . '/js/c3-temp/d3.min.js',
      false,
      true
    );

    wp_enqueue_script(
      'c3-library-script',
      get_template_directory_uri() . '/js/c3-temp/c3.min.js',
      array( 'd3-library-script' ),
      false,
      true
    );

    wp_enqueue_script(
      'c3-chart-script',
      get_template_directory_uri() . '/js/c3-temp/script.js',
      array( 'd3-library-script', 'c3-library-script' ),
      false,
      true
    );
  }
}
add_action('wp_enqueue_scripts' , 'elit_temp_c3_for_post_196413', 10 );

function elit_temp_c3_for_post_196768() {

  global $post;

  $target_id = 196768;
  //$target_id = 186295;

  if ( $post && ( $post->ID == $target_id ) ) {

    wp_enqueue_style(
      'c3-library-style',
      get_template_directory_uri() . '/js/c3-temp/c3.css'
    );

    wp_enqueue_style(
      'c3-chart-style',
      get_template_directory_uri() . '/js/c3-temp/style.css',
      array( 'c3-library-style' )
    );

    wp_enqueue_script(
      'd3-library-script',
      get_template_directory_uri() . '/js/c3-temp/d3.min.js',
      false,
      true
    );

    wp_enqueue_script(
      'c3-library-script',
      get_template_directory_uri() . '/js/c3-temp/c3.min.js',
      array( 'd3-library-script' ),
      false,
      true
    );

    wp_enqueue_script(
      'c3-chart-script-loan-forgiveness',
      get_template_directory_uri() . '/js/c3-temp/script-loan-forgiveness.js',
      array( 'd3-library-script', 'c3-library-script' ),
      false,
      true
    );

    wp_enqueue_script(
      'c3-chart-script-monthly-comparison',
      get_template_directory_uri() . '/js/c3-temp/script-monthly-comparison.js',
      array( 'd3-library-script', 'c3-library-script' ),
      false,
      true
    );
  }
}
add_action('wp_enqueue_scripts' , 'elit_temp_c3_for_post_196768', 10 );

function is_dev_env() {
  return WP_ENV !== null && WP_ENV === 'development';
}

function elit_add_google_tag_manager_code(){
  if ( is_dev_env() ) {
    return;
  }
?> 
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W99R32S');</script>
<!-- End Google Tag Manager -->

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MFNTPN5');</script>
<!-- End Google Tag Manager -->

<?php
}
add_action('wp_head' , 'elit_add_google_tag_manager_code');

function elit_add_google_tag_manager_body_code() {
  if ( is_dev_env() ) {
    return;
  }
?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W99R32S"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFNTPN5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php 
}
add_action( 'just_opened_body_tag' , 'elit_add_google_tag_manager_body_code' );


function elit_add_worldata_pixel() {
  if ( is_dev_env() || is_admin() ) {
    return;
  }
?>
<script>
var versaTag = {};
versaTag.id = "7475";
versaTag.sync = 0;
versaTag.dispType = "js";
versaTag.ptcl = "HTTPS";
versaTag.bsUrl = "bs.serving-sys.com/BurstingPipe";
versaTag.activityParams = { "Session":"" };
versaTag.retargetParams = {};
versaTag.dynamicRetargetParams = {};
versaTag.conditionalParams = {};
</script>
<script id="ebOneTagUrlId" src="https://secure-ds.serving-sys.com/SemiCachedScripts/ebOneTag.js"></script>
<noscript>
<iframe src="https://bs.serving-sys.com/BurstingPipe?cn=ot&amp;onetagid=7475&amp;ns=1&amp;activityValues=$$Session=[Session]$$&amp;retargetingValues=$$$$&amp;dynamicRetargetingValues=$$$$&amp;acp=$$$$&amp;" style="display:none;width:0px;height:0px"></iframe>
</noscript>
<?php
}
add_action('just_opened_body_tag' , 'elit_add_worldata_pixel');

/**
 * Retrieve the url of a post's elit_thumb.
 * The elit_thumb meta data property is the image to use on a post
 * in place of a featured image.
 *
 * @param int $post_id The post id
 * @param string $size The image size to retrieve
 * @return string      The full url of the elit_thum
 */
function elit_get_thumb_url($post_id, $size = 'elit-super') {

}

/**
 * Make sure we add an image to the Open Graph meta tags.
 * This ensures an image will appear when someone posts a story
 * on Facebook or Twitter.
 *
 * Note: We're only adding an Open Graph image tag. Twitter cards
 * will fall back to this Open Graph tag.
 *
 * @see https://dev.twitter.com/cards/getting-started#opengraph
 * @see https://github.com/Yoast/wordpress-seo/issues/1060
 *
 */
function elit_opengraph_add_social_thumbnail() {

  if ( ! is_singular() ) return;

  global $post;

  // If we already have a featured image, we don't need to add it
  if ( has_post_thumbnail( $post->ID ) ) return;

  $thumb = get_post_meta( $post->ID, 'elit_thumb' );

  if ( count( $thumb ) == 0 ) return;

  $thumb_url = wp_get_attachment_image_src( $thumb[0], 'elit-super' );
  
  if ( $thumb_url ) {
    $GLOBALS['wpseo_og']->image( $thumb_url[0] );
  }
}
add_action( 'wpseo_opengraph', 'elit_opengraph_add_social_thumbnail' );

function elit_get_available_dependencies( $all_fields ) {

  if ( ! $all_fields ) return false;

  // Dependencies begin with "elit_load_"
  return array_filter( array_keys( $all_fields ), function( $val ) {
    return substr( $val, 0, strlen( 'elit_load_' ) ) == 'elit_load_';
  } );
}

function elit_get_possible_dependencies( $all_fields, 
                                         $all_available_dependencies ) {

    if ( ! ( $all_fields && $all_available_dependencies ) ) return false;

    return 
      array_filter_key( $all_fields, 
                        function( $value ) use ( $all_available_dependencies ) {
                          return in_array( $value, 
                                           $all_available_dependencies, 
                                           true );
                        } );
}  

function elit_get_dependencies_to_load( $possible_deps ) {
  
  if ( ! $possible_deps ) return [];

  return array_keys( array_filter( $possible_deps, function( $value ) {
      return $value == true;
  } ) );
}
 
function elit_rename_dependencies( $deps_to_load = array()) {

  // Rename jquery dependency so WP will load it
  return array_map( function( $dep ) {
    return $dep === 'elit_load_jquery' ? 'jquery' : $dep;
  }, $deps_to_load );
}

/**
 * List the JavaScript library dependencies needed based on the Advanced
 * Custom Fields fields associated with a post.
 *
 * @param array $all_fields - The result of ACF function get_fields()
 * @return array | false    - The dependencies to load
 */
function elit_get_script_dependencies_for_post( $all_fields ) {

  if ( ! $all_fields ) return false;

  $all_available_deps = elit_get_available_dependencies( $all_fields );
  $possible_deps = elit_get_possible_dependencies( $all_fields, 
                                                   $all_available_deps );
  $deps_to_load = elit_get_dependencies_to_load( $possible_deps );

  $deps = elit_rename_dependencies( $deps_to_load );

  return $deps;
}

/**
 * Load any post-specific scripts.
 * 
 * The scripts are set in the post via an Advanced Custom Fields
 * meta box.
 *
 * @return none
 * @author pjs
 */
function elit_load_scripts_for_post() {

  if ( ! is_singular() ) return;

  global $post;

  $all_fields = get_fields( $post->ID );

  if ( ! $all_fields ) return;

  if ( ! array_key_exists( 'elit_script_file', $all_fields ) ) return;

  $script = $all_fields['elit_script_file'];

  $deps = elit_get_script_dependencies_for_post( $all_fields );

  wp_enqueue_script( 
    $script['title'],
    $script['url'],
    $deps, 
    false, 
    true
  );
}
add_action( 'wp_enqueue_scripts', 'elit_load_scripts_for_post' );

function elit_mail_from( $email ) {
  return 'wordpress@thedo.osteopathic.org';
}
add_filter( 'wp_mail_from', 'elit_mail_from' );

function elit_mail_from_name( $name ) {
  return 'WordPress - The DO';
}
add_filter( 'wp_mail_from_name', 'elit_mail_from_name' );

function elit_sd_enqueue_scripts() {
  $path = '/js/jquery.scrolldepth.min.js';

  if ( ! is_admin() ) {
    wp_enqueue_script(
      'scrollDepth',
      get_template_directory_uri() . $path, 
      array( 'jquery' ),
      false,
      true
    );

    $output  = 'jQuery.scrollDepth({' . PHP_EOL;
    $output .= '  minHeight: 2000,' . PHP_EOL;
    $output .= '  pixelDepth: false,' . PHP_EOL;
    $output .= '  elements: [\'.story-footer\'],' . PHP_EOL;
    $output .= '  userTiming: true,' . PHP_EOL;
    $output .= "});";

    wp_add_inline_script( 'scrollDepth', $output, 'after' );
  }
}
add_action( 'wp_enqueue_scripts' , 'elit_sd_enqueue_scripts' );

/* D I S A B L E D */
function elit_add_http_to_https_script() {
  if ( ! is_dev_env() ) {
    /**
     * Forward from http to https
     *
     */
    $script  = '<script type="text/javascript">';
    $script .= 'if (location.protocol != \'https:\') { ';
    $script .= '  location.href = \'https:\' + ';
    $script .= '  window.location.href.substring(window.location.protocol.length)';
    $script .= '}';
    $script .= '</script>';

    echo $script;
  }
}
//add_action( 'wp_head' , 'elit_add_http_to_https_script', 0 );


function elit_add_query_string_to_redirect( $location, $comment ) 
{
    if ( $comment->comment_approved == 1 ) {
      return $location;
    }

    $query_str = 'show_comment_policy=true';

    if ( strpos( $location, '&' ) ) {
      return $location . '&' . $query_str;
    }

    return $location . '?' . $query_str;
}
add_action( 'comment_post_redirect', 'elit_add_query_string_to_redirect', 10, 2 );
