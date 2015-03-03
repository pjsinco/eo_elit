<?php 
/**
 * 
 * Template for displaying social icons
 * 
 * @package elit
 */


?>

<?php 
  $meta = get_post_meta( $post->ID );
  $link  = urlencode( get_permalink() );
  $title = urlencode( html_entity_decode( strip_tags( get_the_title() ) ) );
  $thumb_id = ( 
    has_post_thumbnail() ? get_post_thumbnail_id() : $meta['elit_thumb'][0]
  );
  if ( $thumb_id ) {
    $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-large', false );
  }
  
?>
<ul class="social social--shiftable">
  <li class="social__icon">
    <a id="social-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" class="social--shiftable__link" >
      <span class="icon-facebook">
        <span class="text-replace">Facebook</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a id="social-twitter" href="https://twitter.com/intent/tweet?text=<?php echo  $title; ?>&url=<?php echo $link; ?>&via=TheDOmagazine" class="social--shiftable__link">
      <span class="icon-twitter">
        <span class="text-replace">Twitter</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link; ?>&title=<?php echo $title; ?>&source=<?php echo urlencode( home_url( $path = '/', $scheme = 'https' ) ); ?>&summary=<?php echo urlencode( get_the_excerpt() ); ?>" id="social-linkedin" class="social--shiftable__link">
      <span class="icon-linkedin">
        <span class="text-replace">LinkedIn</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a id="social-pinterest" class="social--shiftable__link"
    href="https://www.pinterest.com/pin/create/button/?url=<?php echo $link; ?>&media=<?php echo urlencode( $thumb_url[0] ); ?>&description=<?php echo $title; ?>" target="_blank">
      <span class="icon-pinterest">
        <span class="text-replace">Pinterest</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>" title="Email this article" id="social-email" href="" class="social--shiftable__link">
      <span class="icon-mail">
        <span class="text-replace">Email</span>
      </span>
    </a>
  </li>
</ul>
