<?php get_header(); ?>

<?php 
  $args = array(
    'post_type' => 'elit_story_sidebar',
    'post_count' => 1,
  );
?>

<?php $sidebars = new WP_Query($args); ?>
<?php $sidebars->the_post(); ?>

<aside class="story-sidebar">
  
  <h3 class="story-sidebar__head"> 
    <?php the_title(); ?>
  </h3>

  <?php the_content(); ?>
  
<?php get_footer(); ?>

