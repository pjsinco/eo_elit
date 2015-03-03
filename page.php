<?php get_header(); ?>


    <div id="main" class="content">
      <section id="primary" class="content__primary">

        <?php while(have_posts()): the_post(); ?>

          <?php d(get_post_format()); ?>
          <?php //get_template_part('content', get_post_format()); ?>
          <?php get_template_part('content', 'page'); ?>

        <?php endwhile; ?>

      </section> <!-- #primary -->


<!--       temp; make into a sidebar template? -->
      <section id="secondary" class="content__secondary">

<?php get_sidebar('page'); ?>
      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
