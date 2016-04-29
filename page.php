<?php get_header(); ?>


    <div id="main" class="content">
      <section id="primary" class="content__primary">

        <?php while(have_posts()): the_post(); ?>

          <?php get_template_part('content', 'page'); ?>

        <?php endwhile; ?>

      </section> <!-- #primary -->

      <section id="secondary" class="content__secondary">

        <?php get_sidebar('article'); ?>

      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
