<?php 
/**
 * @package elit
 */
?>
  <?php $counter = 0; ?>
<?php while( have_posts() ): ?>

  <?php (d($wp_query)); ?>
  <?php the_post(); ?>


  <?php $meta = get_post_meta( $post->ID ); ?>
           
<article class="f-item--minor">
  <figure class="f-item__fig--minor">
    <a  href="<?php the_permalink(); ?>">
      <?php $thumb_id = (
        has_post_thumbnail() ? 
          get_post_thumbnail_id() : 
          $meta['elit_thumb'][0]
      );
        if ( $thumb_id ):
          $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-thumb' );
      ?>
      <img src="<?php echo $thumb_url[0]; ?>" width="96" height="64" class="image__img" alt="<?php get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?>">
      <?php endif; ?>
    </a>
  </figure>
  <div class="f-item__body--minor">
    <h5 class="f-item__kicker"><?php echo $meta['elit_kicker'][0]; ?></h5>
    <span class="f-item__date--major"><?php echo get_the_date( 'M. j, Y' ); ?></span>
    <h2 class="f-item__head">
      <a href="<?php the_permalink(); ?>" class="f-item__link">
        <?php the_title(); ?>
      </a>
    </h2>
    <p class="f-item__body-text">
      <?php echo wptexturize( get_the_excerpt() ); ?>
    </p>
  </div>
</article>
<?php $counter++; ?>
  <?php if ( $counter == 2 || ( $wp_query->post_count == 1 ) ): ?>
    <?php echo do_shortcode("[advertisements align='h']"); ?>
  <?php endif; ?>
<?php endwhile; ?>
