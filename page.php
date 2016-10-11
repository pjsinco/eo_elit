<?php get_header(); ?>

<?php $layout = 'two-col'; ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary--<?php echo $layout; ?>">

        <?php while(have_posts()): the_post(); ?>

          <?php get_template_part('content', 'page'); ?>

        <?php endwhile; ?>

      </section> <!-- #primary -->

      <section id="secondary" class="<?php elit_secondary_class( $layout ); ?>">

        <?php get_sidebar('article'); ?>

      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
