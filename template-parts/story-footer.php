<?php
/**
 * Display a footer for an article
 *
 */
?>

<footer class="<?php elit_story_footer_class( $layout ); ?>"> 
  <?php elit_social_links( $meta, $link, $title, $thumb_id, false ); ?>
  <?php elit_story_footer( get_post(), $include_footer_author_info ); ?>
</footer>
