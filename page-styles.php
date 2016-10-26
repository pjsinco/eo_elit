<?php
/**
 * Template Name: Styles
 *
 */
?>

<?php get_header(); ?>

<?php $layout = 'two-col'; ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary--<?php echo $layout; ?>">

        <?php while( have_posts() ): the_post(); ?>

          <?php get_template_part( 'content', 'styles' ); ?>

        <?php endwhile; ?>

      </section> <!-- #primary -->

      <section id="secondary" class="<?php elit_secondary_class( $layout ); ?>">
<?php $sidebar = ( $layout == 'two-col' ? 'article' : 'article_full_width' ); ?>
<?php get_sidebar( $sidebar ); ?>
      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>

