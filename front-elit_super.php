<?php 
/**
 * @package elit
 */
?>

  <?php 
    if ( is_preview() || is_single() ) {
      $super = get_post( );
    } else {
      global $super_post;
      $super = $super_post[0];
    }
    if ( $super ): $super_meta = get_post_meta( $super->ID ); endif;
    if ( has_post_thumbnail( $super->ID ) ):
      $featured_image_id = get_post_thumbnail_id( $super->ID );
  ?>
      <div class="row--bleed-xl no-m-b">
        <div class="size-1-of-1">
          <div class="super"><a href="<?php echo $super_meta['elit_super_link'][0]; ?>">
              <figure class="super__figure">
                <img class="image__img" src="<?php echo wp_get_attachment_url($featured_image_id); ?>" <?php echo tevkori_get_src_sizes( $featured_image_id, 'elit-super' ); ?> />
<!--                 <figcaption class="super__tag">Placeholder</figcaption> -->
              </figure></a>
            <div class="super__body--<?php echo $super_meta['elit_super_quadrant'][0]; ?> <?php echo ($super_meta['elit_super_overlay_color'][0] == 'light' ? 'super__body--alt' : ''); ?>">
              <h5 class="super__kicker"><?php echo $super_meta['elit_super_kicker'][0]; ?></h5>
              <span class="super__date<?php echo ($super_meta['elit_super_overlay_color'][0] == 'light' ? '--alt' : ''); ?>"><?php echo $super_meta['elit_super_date'][0]; ?></span>
              <h1 class="super__head">
                <a href="<?php echo $super_meta['elit_super_link'][0]; ?>" class="super__link">
                  <?php echo wptexturize( $super_meta['elit_super_title'][0] ); ?>
                </a>
              </h1>
              <p class="super__body-text"><?php echo wptexturize( $super_meta['elit_super_body'][0] ); ?></p>
            </div>
          </div>
        </div>
      </div>
  <?php endif; ?>
