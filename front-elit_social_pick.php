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

  if ( $social_pick ): $social_pick_meta = get_post_meta( $social_pick->ID ); endif;

  d( $social_pick );
  d( $social_pick_meta );

?>
      <div class="row">
        <div class="size-1-of-1 social-pick-red module">
          <div class="social-pick-red__date">Jan. 15 on Twitter</div>
          <div class="social-pick-red__body">
            <div class="social-pick-red__img"><img src="img/minoritydoctor-bigger.jpg" class="image__img"></div>
            <div class="social-pick-red__author"><a href="#" class="social-pick-red__link">@minoritydoctor</a></div>
            <p class="social-pick-red__body-text">Done with all my exams for this week, so now I finally have time to study for next week's big exam :-/ <a href="#" class="social-pick-red__link">#medschoolproblems</a>
            </p>
          </div>
          <div class="social-pick-red__note"> 
            <ul class="social"> 
              <li class="social__icon"><a href="https://www.facebook.com/americanosteopathicassociation" class="social__link"><span class="icon-facebook"><span class="text-replace">Facebook</span></span></a></li>
              <li class="social__icon"><a href="https://twitter.com/TheDOmagazine" class="social__link"><span class="icon-twitter"><span class="text-replace">Twitter</span></span></a></li>
              <li class="social__icon"><a href="https://www.linkedin.com/groups/American-Osteopathic-Association-76192" class="social__link"><span class="icon-linkedin"><span class="text-replace">LinkedIn</span></span></a></li>
              <li class="social__icon"><a href="http://www.pinterest.com/AOAHealth/" class="social__link"><span class="icon-pinterest"><span class="text-replace">Pinterest</span></span></a></li>
            </ul>
            <p>Follow us </p>
          </div>
        </div> <!-- .size-1-of-1 .social-pick-red .module -->
      </div> <!-- .row -->
