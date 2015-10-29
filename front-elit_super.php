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
      if ( $super_meta['elit_super_label_quadrant'][0] != 'none' ):
        $featured_image_content = get_post( $featured_image_id );
      endif;
  ?>
      <div class="row--bleed-xl no-m-b">
        <div class="size-1-of-1">
          <div class="super"><a href="<?php echo $super_meta['elit_super_link'][0]; ?>">
            <figure class="super__figure">
              <img class="image__img" src="<?php echo wp_get_attachment_url( $featured_image_id ); ?>" <?php echo tevkori_get_sizes( $featured_image_id, 'elit-super' ); ?> />
              <?php if ( !empty( $featured_image_content ) ): ?>
                <figcaption class="super__label--<?php echo $super_meta['elit_super_label_quadrant'][0]; ?>"><?php echo $featured_image_content->post_content ?></figcaption>
              <?php endif; ?>
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
