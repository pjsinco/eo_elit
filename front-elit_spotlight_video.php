<?php 
/**
 * Template for the front-page spotlight.
 * 
 *
 * @package elit
 */

?>
  <?php 
    if ( is_preview() || is_single() ) {
      $spotlight = get_post();

    } else {
      $args = array(
        'post_type' => 'elit_spotlight_video',
        'post_count' => 1,
      );

      $spotlights = new WP_Query( $args );

      if ($spotlights->post_count > 0) {
        $spotlight = $spotlights->posts[0];
      }
    }
  ?>
    
  <?php if ($spotlight && !empty($spotlight)): ?>
      <div class="row">
        <div class="size-1-of-1">
          <div class="section-title-hat"><span class="section-title-hat__text">Spotlight</span></div>
        </div>
      </div>
      <div class="row">
        <div class="unit size-1-of-1 module">
          <div id="spotlight" class="spotlight">
            <div class="spotlight__feature-wrapper elit-video" id="video">
              <?php echo wptexturize( get_post_meta( $spotlight->ID, 'elit_featured_video', true ) ); ?></h5>
            </div>
            <div class="spotlight__body">
              <h5 class="spotlight__kicker"><?php echo wptexturize( get_post_meta( $spotlight->ID, 'elit_kicker', true ) ); ?></h5>
              <h2 class="spotlight__head"><?php echo $spotlight->post_title; ?></h2>
              <?php echo $spotlight->post_content; ?>
            </div>
          </div>
        </div>
      </div>
  <?php endif; ?>
      
