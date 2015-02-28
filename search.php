<?php 
/**
 * The template for displaying search results.
 *
 * @package elit
 */

get_header(); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary">

        <?php if ( have_posts() ): ?>
        <header>
          <h1 class="page-title">
            <?php printf( 
              'Search results for: %s', 
              '<span>' . get_search_query() . '</span>'
            ); ?>
          </h1>
        </header>
        <?php while( have_posts() ): the_post(); ?>

          <pre><small><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></small></pre>
          <?php //get_template_part('content', get_post_format()); ?>
          <?php // get_template_part('content', 'single'); ?>
        <?php endwhile; endif; ?>

      </section> <!-- #primary -->

<!--       temp; make into a sidebar template? -->
      <section id="secondary" class="content__secondary">



<?php get_sidebar('archive'); ?>
      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
