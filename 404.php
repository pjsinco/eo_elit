<?php get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>

<?php 
  // TODO We have the makings for distinguishing layout types.
  // For now, we're sticking with two-col only. 
  //
  // Here's how we would get the layout from an Advanced Custom Fields field 
  // $layout = empty( get_field( 'elit_post_layout' ) ) ? 'two-col' : get_field( 'elit_post_layout' ); 
?>

<?php $layout = 'one-col'; ?>

    <div id="main" class="content">
      <div class="story--full-width">
        <section id="primary" class="content__primary--<?php echo $layout; ?>">
          <h1 class="story-header__title--alt m-b--lg">We&rsquo;re sorry! This page does not exist.</h1>
            <div class="elit-archive m-b--xl">
              <div class="site-search__results--empty">
                <h3 id="reply-title" class="comment-reply-title">Try a search</h3>
                <form action="/" id="search-form" class="site-search__form">
                  <input type="search" name="s" placeholder="Enter search terms" id="q" class="site-search__input--onpage" required />
                  <input name="submit" type="submit" id="submit" class="site-search__submit" value="Search">
                </form>
              </div>
            </div> <!-- .elit-archive -->
        </section> <!-- #primary -->
      </div>

<!--       <section id="secondary" class="<?php //elit_secondary_class( $layout ); ?>"> -->

<?php //$sidebar = ($layout == 'two-col' ? 'article' : 'article_full_width'); ?>
<?php //get_sidebar( $sidebar ); ?>
<!--       </section> -->
    </div> <!-- #main -->

<?php get_footer(); ?>


