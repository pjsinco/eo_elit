<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<?php $meta = get_post_meta( $post->ID ); ?>
<?php if ( has_post_thumbnail() ): 
  $featured_image_id = get_post_thumbnail_id();
//  quadrant  = $meta['elit_super_overlay_quadrant'][0];
//  color     = $meta['elit_super_overlay_color'][0];
//  kicker    = $meta['elit_super_kicker'][0];
//  title     = $meta['elit_super_title'][0];
//  body      = $meta['elit_super_body'][0];
//  date      = $meta['elit_super_date'][0];
//  gowith    = $meta['elit_super_gowith'][0];
//  link      = $meta['elit_super_link'][0];
//  link      = get_permalink( $meta['elit_super_gowith'][0] );
d($meta);
d($meta['elit_super_gowith'] );
//d(get_permalink( $meta['elit_super_gowith'][0] ));
?>
    <div id="main" class="content">
      <div class="row--bleed-xl no-m-b">
        <div class="size-1-of-1">
          <div class="super"><a href="<?php echo $meta['elit_super_link'][0]; ?>">
              <figure class="super__figure">
                <img class="image__img" src="<?php echo wp_get_attachment_url($featured_image_id); ?>" <?php echo tevkori_get_src_sizes( $featured_image_id, 'elit-article-super' ); ?> />
                <figcaption class="super__tag">Placeholder</figcaption>
              </figure></a>
            <div class="super__body--<?php echo $meta['elit_super_quadrant'][0]; ?> <?php echo ($meta['elit_super_overlay_color'][0] == 'light' ? 'super__body--alt' : ''); ?>">
              <h5 class="super__kicker"><?php echo $meta['elit_super_kicker'][0]; ?></h5>
              <span class="super__date<?php echo ($meta['elit_super_overlay_color'][0] == 'light' ? '--alt' : ''); ?>"><?php echo $meta['elit_super_date'][0]; ?></span>
              <h1 class="super__head">
                <a href="<?php echo $meta['elit_super_link'][0]; ?>" class="super__link">
                  <?php echo $meta['elit_super_title'][0]; ?>
                </a>
              </h1>
              <p class="super__body-text"><?php echo $meta['elit_super_body'][0]; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
          <?php // get_template_part('content', 'single'); ?>

<?php endif; ?>
        <?php endwhile; ?>

<?php get_footer(); ?>
