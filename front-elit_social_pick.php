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
