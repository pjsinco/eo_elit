<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<?php $meta = get_post_meta( $post->ID ); ?>
<?php if ( has_post_thumbnail() ): 
  $featured_image_id = get_post_thumbnail_id();
//  quadrant  = $meta['elit_super_overlay_quadrant'][0];
//  color     = $meta['elit_super_color'][0];
//  kicker    = $meta['elit_super_kicker'][0];
//  title     = $meta['elit_super_title'][0];
//  body      = $meta['elit_super_body'][0];
//  date      = $meta['elit_super_date'][0];
//  gowith    = $meta['elit_super_gowith'][0];
d($meta);
?>
    <div id="main" class="content">
      <div class="row--bleed-xl no-m-b">
        <div class="size-1-of-1">
          <div class="super"><a href="#">
              <figure class="super__figure">
                <img class="image__img" src="<?php echo wp_get_attachment_url($featured_image_id); ?>" <?php echo tevkori_get_src_sizes( $featured_image_id, 'elit-article-super' ); ?> />
                <figcaption class="super__tag">Placeholder</figcaption>
              </figure></a>
            <div class="super__body--<?php echo $meta['elit_super_quadrant'][0]; ?>">
              <h5 class="super__kicker">Porta Parturient</h5><span class="super__date">Jan. 21, 2015</span>
              <h1 class="super__head"><a href="#" class="super__link">Tales from the front lines of vaccine research at the NIH</a></h1>
              <p class="super__body-text">A flu vaccine every three years? This and other predictions and insights from inside the largest biomedical research center in the world.</p>
            </div>
          </div>
        </div>
      </div>
          <?php // get_template_part('content', 'single'); ?>

<?php endif; ?>
        <?php endwhile; ?>

<?php get_footer(); ?>
