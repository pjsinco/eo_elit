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
          <ul class="nav__list">
            <li class="nav__item">
              <a href="#" class="nav__item--link">Patient Care</a>
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item--link">Innovation</a>
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item--link">Training</a>
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item--link">Profession</a>
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item--link">Policy</a>
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item--link">Lifestyle</a>
            </li>
            <li class="nav__item nav__item--last">
              <section class="site-search">
                <form action="/search" id="search-form" class="site-search__form">
                  <label id="search-label" for="q" class="site-search__label">
                    <input type="search" name="q" placeholder="Enter search terms" id="q" class="site-search__input">
                  </label>
                  <input type="submit" class="site-search__button--hide">
                </form>
              </section>
            </li>
          </ul>
        </nav>
      </section>
    </header>
  
    <div id="main" class="content">
