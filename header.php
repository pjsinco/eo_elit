<?php 

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package elit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="google-site-verification" content="zwl9DY1Wxaqtno-h9xYz84daOQZgWTCwHaoum9_PObc" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
    <?php wp_head(); ?>
  </head>
  
  <body <?php body_class(); ?>>
    <!--from html5boilerplate--><!--[if lt IE 9]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser.  Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience."></p><![endif]-->
    
    <header role="banner" id="banner" class="banner">
      <section class="site-branding">
        <div class="site-branding--alpha">
          <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-branding__link">
            <?php bloginfo('name'); ?>
          </a>
        </div>
        <div class="site-branding--beta">
          <a href="http://www.osteopathic.org" title="American Osteopathic Association">
            <span class="icon-aoa-solid"></span>
          </a>
        </div>
      </section>
      <section class="site-navigation"><a href="#site-nav" class="nav__link--toggle"><span class="icon-menu"></span></a>
        <nav role="navigation" id="site-nav" class="nav">
          <?php 
            if ( !get_main_menu( 'main-menu' ) ) {
              $orig_wp_query = $wp_query;
              $wp_query = null;
              $wp_query = new WP_Query( array( 'post_type' => 'post' ) );
              get_main_menu( 'main-menu' );
              $wp_query = $orig_wp_query;
            }
          ?>
        </nav>
      </section>
    </header>
