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
            $args = array(
              'theme_location' => 'main-menu',
              'menu' => 'main-menu',
              'container' => false,
              'menu_class' => 'nav__list',
              'depth' => 0,
            );
          ?>
          <?php wp_nav_menu( $args ); ?>
        </nav>
      </section>
    </header>
