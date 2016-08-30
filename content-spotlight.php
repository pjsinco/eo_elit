<?php 
/**
 * @package elit
 */
?>

  <?php if ($spotlight && !empty($spotlight)): ?>
    <div class="story--full-width">
<!--       <div class="unit size-1-of-1 module"> -->

      

        <?php include( locate_template( 'template-parts/spotlight.php' ) ); ?>


<!--       </div> -->
    </div> <!-- .story -->
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
        ); ?>
    </header>
    
    <div class="story">
      
      <footer class="<?php elit_story_footer_class( 'one-col' ); ?>">

        <?php elit_story_footer(); ?>
        <?php elit_social_links( $meta, $link, $title, $thumb_id, false ); ?>

      </footer>
    </div>
