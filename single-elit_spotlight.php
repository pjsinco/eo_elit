<?php 
/**
 * For displaying the preview of the Spotlight custom post type
 * @package elit
 *
 */
?>


<?php get_header(); ?>

    <div id="main" class="content">
      <?php echo '<pre>'; var_dump(get_fields()); echo '</pre>'; die(); ?>
      <?php //get_template_part( 'front', 'elit_spotlight_video' ); ?>

<?php get_footer(); ?>
