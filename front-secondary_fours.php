<?php 
/**
 * Template for a front page row with 4 items 
 *
 * @package elit
 */
?>

      <div class="row">
        <div class="size-1-of-1">
          <div class="section-title-hat">
            <span class="section-title-hat__text">More Stories</span> 
<!--            <a href="#" class="section-title__link">
              <span class="section-title--> <!--muted">All stories <span class="icon-arrow-right-alt1"></span></span> -->
<!--             </a> -->
          </div>
        </div>
      </div>

      <div class="row module">
        <?php 
          // we'll need a counter variable because we'll be incrementing
          // border-n-of-4 in each article's wrapping div
          $counter = 0;
          $cols = 4;
          while ( $secondary->have_posts() ):
            $secondary->the_post();
            $meta = get_post_meta( $post->ID );
            ++$counter;
            d($meta);
        ?>
        <div class="unit size-1-of-4 f-item<?php echo ($counter > 1) ? " border-$counter-of-$cols" : ''; ?>">
          <article>
            <figure class="f-item__fig">
              <a href="<?php the_permalink(); ?>">
                <?php 
                  $thumb_id = ( 
                    has_post_thumbnail() ? get_post_thumbnail_id() : $meta['elit_thumb'][0]
                  );
                  if ( $thumb_id ): 
                    $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-thumb' );
                ?>
                <img src="<?php echo $thumb_url[0]; ?>" alt="<?php get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?>" class="image__img">
                <?php endif; ?>
              </a>
            </figure>
            <div class="f-item__body">
              <h5 class="f-item__kicker"><?php echo $meta['elit_kicker'][0]; ?></h5>
<!--               <span class="f-item__date"><?php //echo get_the_date( 'M. j, Y' ); ?></span> -->
              <h2 class="f-item__head">
                <a href="<?php the_permalink(); ?>" class="f-item__link"><?php the_title(); ?></a>
              </h2>
              <p class="f-item__body-text"><?php echo wptexturize( get_the_excerpt() ); ?></p>
            </div>
          </article>
        </div>
        <?php endwhile; ?>

      </div> <!-- .row .module -->
