<?php 
/**
 * Template for the front-page spotlight.
 * 
 *
 * @package elit
 */

?>

  <?php 
  ?>
    
  <?php if ($spotlight && !empty($spotlight)): ?>
      <div class="row">
        <div class="size-1-of-1">
          <div class="section-title-hat"><span class="section-title-hat__text">Spotlight</span></div>
        </div>
      </div>
      <div class="row">
        <div class="unit size-1-of-1 module">
          <?php include( locate_template( 'template-parts/spotlight-video.php' ) ); ?>
        </div> <!-- .unit -->
      </div> <!-- .row -->
  <?php endif; ?>
