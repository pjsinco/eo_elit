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
          <?php global $wp_query; ?>
            <div class="site-search__results<?php echo ($wp_query->found_posts === 0 ? '--empty' : ''); ?>">
              <div class="section-title--archive">
                <?php 
                    printf( 
                        '%s search results for: %s', 
                        $wp_query->found_posts,
                        '<span class="site-search__term">' . get_search_query() . '</span>'
                    ); 
                ?>
              </div>
              <?php if ($wp_query->found_posts === 0): ?>
              <h3 id="reply-title" class="comment-reply-title">Try another search</h3>
              <form action="/" id="search-form" class="site-search__form">
                <input type="search" name="s" placeholder="Enter search terms" id="q" class="site-search__input--onpage" required />
                <input name="submit" type="submit" id="submit" class="site-search__submit" value="Search">
              </form>
            </div>
          <?php endif ?>

        <?php if ( have_posts() ): ?>
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
