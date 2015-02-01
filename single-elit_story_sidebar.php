<?php 
get_header();

$args = array(
  'post_type' => 'elit_story_sidebar',
);

$sidebars = new WP_Query($args);

while ( $sidebars->have_posts() ) : $sidebars->the_post();

  the_title();
  the_content();

endwhile;

get_footer();

 ?>

