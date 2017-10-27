<?php 
/**
 * Template for the front-page spotlight.
 * 
 *
 * @package elit
 */

?>


  <?php if ( isset( $spotlight ) && ! empty( $spotlight )): ?>

    <?php if ( in_array( 'elit_script_file', $spotlight ) ):

      $all_fields = get_fields( $spotlight_post->ID );

      $deps = elit_get_script_dependencies_for_post( $all_fields );

      if ( $deps ):
        $script = $all_fields['elit_script_file'];
        wp_enqueue_script( $script['title'], $script['url'], $deps, false, true);
      endif;

    endif; ?>

      <div class="row">
        <div class="size-1-of-1">
          <div class="section-title-hat">
            <span class="section-title-hat__text">Spotlight</span>
            <a href="/spotlight" class="section-title__link">
              <span class="section-title--muted">All Spotlights <span class="icon-arrow-right-alt1"></span></span>
             </a>
          </div>
        </div> <!-- .size-1-of-1 -->
      </div> <!-- .row -->
      <div class="row">
        <div class="unit size-1-of-1 module">
          <?php include( locate_template( 'template-parts/spotlight.php' ) ); ?>
        </div> <!-- .unit -->
      </div> <!-- .row -->
  <?php endif; ?>
