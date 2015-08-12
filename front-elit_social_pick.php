<?php 
/**
 * @package elit
 */
?>

<?php 
  if ( is_preview() || is_single() ) {
    $social_pick = get_post();
  } else {
    global $social;    
    $social_pick = $social[0];
  }

  if ( $social_pick ): $meta = get_post_meta( $social_pick->ID ); endif;

  $args = array(
    'class' => 'image__img',
  );
?>
      <div class="row">
        <div class="size-1-of-1 social-pick-red module">
          <div class="social-pick-red__date"><?php echo elit_time_ago($meta['elit_social_pick_date'][0]); ?> on Twitter</div>
          <div class="social-pick-red__body">
            <div class="social-pick-red__img">
              <?php echo get_the_post_thumbnail( $social_pick->ID, 'full', array( 'class' => 'image__img' ) ); ?>
            </div>
            <div class="social-pick-red__author"><a href="https://twitter.com/<?php echo $meta['elit_social_pick_screen_name'][0]; ?>" class="social-pick-red__link">@<?php echo $meta['elit_social_pick_screen_name'][0]; ?></a></div>
            <p class="social-pick-red__body-text"><?php echo $meta['elit_social_pick_tweet'][0]; ?></p>
          </div>
          <div class="social-pick-red__note"> 
            <ul class="social"> 
              <li class="social__icon"><a href="https://www.facebook.com/americanosteopathicassociation" class="social__link" target="_blank"><span class="icon-facebook"><span class="text-replace">Facebook</span></span></a></li>
              <li class="social__icon"><a href="https://twitter.com/AOAforDOs" class="social__link" target="_blank"><span class="icon-twitter"><span class="text-replace">Twitter</span></span></a></li>
              <li class="social__icon"><a href="https://www.linkedin.com/groups/American-Osteopathic-Association-76192" class="social__link" target="_blank"><span class="icon-linkedin"><span class="text-replace">LinkedIn</span></span></a></li>
              <li class="social__icon"><a href="http://www.pinterest.com/AOAHealth/" class="social__link" target="_blank"><span class="icon-pinterest"><span class="text-replace">Pinterest</span></span></a></li>
            </ul>
            <p>Follow us </p>
          </div>
        </div> <!-- .size-1-of-1 .social-pick-red .module -->
      </div> <!-- .row -->
