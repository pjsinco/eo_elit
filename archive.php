<?php 
/**
 * The template for displaying archive pages.
 *
 * @package elit
 */

// TODO this is all temporary

get_header(); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary">

        <?php if( have_posts() ): ?>

        <header>
          <?php elit_the_archive_title( '<pre>', '</pre>' ); ?>
          <?php //the_archive_description( '<div>', '</div' ); ?>

        </header>
        <?php while( have_posts() ): the_post(); ?>

          <pre><small><?php the_title(); ?></small></pre>
          <?php //get_template_part('content', get_post_format()); ?>
          <?php // get_template_part('content', 'single'); ?>

        <?php endwhile; endif; ?>

      </section> <!-- #primary -->

<!--       temp; make into a sidebar template? -->
      <section id="secondary" class="content__secondary">



<?php get_sidebar('article'); ?>
      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
