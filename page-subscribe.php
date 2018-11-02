<?php 
/**
 * Template Name: Subscribe
 *
 */
?>

<?php get_header(); ?>

<?php $layout = 'one-col'; ?>

    <div id="main" class="content">
      <?php while(have_posts()): the_post(); ?>

        <?php get_template_part('content', 'page'); ?>

      <?php endwhile; ?>

    </div> <!-- #main -->

<?php get_footer(); ?>

