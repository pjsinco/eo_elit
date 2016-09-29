<?php 
/**
 * @package elit
 */
?>
  <?php
    $meta = get_post_meta( $spotlight_post->ID );
    $link = get_permalink();
    $title = get_the_title();
    $thumb_id = ( 
      has_post_thumbnail() ? get_post_thumbnail_id() : 
        $meta['elit_thumb'][0]
    );
  ?>

  <?php if ($spotlight && !empty($spotlight)): ?>
    <div class="story--full-width">
      <?php include( locate_template( 'template-parts/spotlight.php' ) ); ?>
    </div> <!-- .story -->
  <?php endif; ?>

    <div class="story">
      <footer class="<?php elit_story_footer_class( 'one-col' ); ?>">

        <?php elit_social_links( $meta, $link, $title, $thumb_id, false ); ?>
        <?php elit_story_footer( get_post() ); ?>

      </footer>
    </div> <!-- .story -->
