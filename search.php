<?php 
/**
 * The template for displaying search results.
 *
 * @package elit
 */

get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary">
        <div class="row">
          <div class="elit-archive">
        <?php if ( have_posts() ): ?>
            <div class="size-1-of-1">
              <div class="section-title--archive">
                <?php 
                    global $wp_query;
                    printf( 
                        '%s search results for: %s', 
                        $wp_query->found_posts,
                        '<span>' . get_search_query() . '</span>'
                    ); 
                ?>
              </div>
            </div>

          <?php get_template_part('content', 'archive' ); ?>
        <?php endif; ?>
            <div class="pagination">
              <div class="pagination__prev">
                <?php echo get_previous_posts_link( '<span class="icon-arrow-left-alt1"></span> Previous' ); ?>
                
              </div>
              <div class="pagination__next">
                <?php echo get_next_posts_link( 'More stories <span class="icon-arrow-right-alt1"></span>' ); ?>

              </div>
            </div> <!-- .pagination -->
          </div> <!-- .elit-archive -->
        </div> <!-- .row -->
      </section> <!-- #primary -->

      <section id="secondary" class="content__secondary">
<?php get_sidebar('archive'); ?>
      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
