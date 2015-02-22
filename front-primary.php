<?php 
/**
 * Template for the front-page content below the super.
 * These are the three most recent featurable stories.
 *
 * @package elit
 */

?>
      <div class="row">
        <div class="size-2-of-3 module">
<?php 
  foreach ( $query_results as $post ) {

    setup_postdata( $post );

    $do_not_dupe[] = $post->ID;
    $meta = get_post_meta( $post->ID );
?>
        <article class="f-item--major">
          <figure class="f-item__fig--major">
            <a href="<?php the_permalink(); ?>">
              <?php 
                $thumb_id = ( 
                  has_post_thumbnail() ? get_post_thumbnail_id() : $meta['elit_thumb'][0]
                );
                if ( $thumb_id ): 
                  $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-small' );
              ?>
              <img src="<?php echo $thumb_url[0]; ?>" alt="<?php get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?>" class="image__img">
              <?php endif; ?>
            </a>
          </figure>
          <div class="f-item__body--major"> 
            <h5 class="f-item__kicker--major"><?php echo $meta['elit_kicker'][0]; ?></h5>
            <span class="f-item__date--major"><?php echo get_the_date( 'M. j, Y' ); ?></span>
            <h2 class="f-item__head--major">
              <a href="<?php the_permalink(); ?>" class="f-item__link"><?php the_title(); ?></a>
            </h2>
            <p class="f-item__body-text--major"><?php echo wptexturize( get_the_excerpt() ); ?></p>
          </div>
        </article>
<?php } ?>
        </div> <!-- size-2-of-3 module -->

        <?php get_template_part('ad', 'don_home_front'); ?>

        <div class="size-1-of-3--last">
          <aside data-set="rover-don-parent" class="ad ad__med-rect--front rover-don-parent-f-c"></aside>
          <aside data-set="rover-peggy-parent" class="ad ad__med-rect--front rover-peggy-parent-f-c"></aside>
        </div> <!-- size-1-of-3-last -->
      </div><!-- .row -->
