<?php 
/**
 * @package elit
 */
?>

  <?php if ($spotlight && !empty($spotlight)): ?>
    <div class="row">
      <div class="unit size-1-of-1 module">
        <?php include( locate_template( 'template-parts/spotlight-video.php' ) ); ?>
      </div>
    </div>
  <?php endif; ?>

    <header>
      <?php 
        /**
         * Set up social
         *
         */
        $meta = get_post_meta( $post->ID );
        $link = get_permalink();
        $title = get_the_title();
        $thumb_id = ( 
          has_post_thumbnail() ? get_post_thumbnail_id() : 
            $meta['elit_thumb'][0]
        );
      ?>
    </header>
    
    <footer class="<?php elit_story_footer_class( $layout ) ?>">
      <?php elit_social_links( $meta, $link, $title, $thumb_id, false ); ?>
    </footer>
