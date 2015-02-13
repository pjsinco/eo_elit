<?php get_header(); ?>

<!-- Stuff will go here  -->
  <?php 
    $args = array(
      'post_type' => 'elit_super',
      'post_count' => 5,
    );


    $query = new WP_Query( $args );
    d($query);
  ?>

<?php get_footer(); ?>
