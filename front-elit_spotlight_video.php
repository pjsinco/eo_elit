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
                <iframe src="https://www.youtube.com/embed/AhIDxA-u1iA?color=ffffff&title=0&byline=0&portrait=0" width="654" height="368" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
            </div>
            <div class="spotlight__body">
              <h5 class="spotlight__kicker">Kicker will go here</h5>
              <h2 class="spotlight__head"><?php echo $spotlight->post_title; ?></h2>
              <p class="spotlight__body-text"><?php echo $spotlight->post_content; ?></p>
            </div>
          </div>
        </div>
      </div>
  <?php endif; ?>
      
