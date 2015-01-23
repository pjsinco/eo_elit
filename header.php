<?php 

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package elit
 */

?>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--typekit-->

  <?php wp_head(); ?>


<script src="//use.typekit.net/vdi5qvx.js"></script>
<script>
  try{Typekit.load();}catch(e){}
  
</script>
<script>
  //picture element html5 shim
  document.createElement('picture');
  
</script>
<script src="js/picturefill.min.js" async="async"></script>
<script src="js/modernizr.js"></script>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

  <title></title>
  
</head>

