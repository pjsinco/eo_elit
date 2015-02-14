<?php 
/**
 * Template for the front-page content below the super.
 * These are the three most recent featurable stories.
 *
 * @package elit
 */

?>
<?php 
  // we need to exclude the super from the posts we grab for 
  // the front-primary

  global $super;
  $super_exclude_id = get_post_meta( $super[0]->ID, 'elit_super_gowith', true );

  $args = array(
    'posts_per_page' => 3,
    'orderby' => 'date',
    // ignore sticky posts
    'post__not_in' => array( $super_exclude_id ),
    'meta_query' => array(
      array(
        'key' => 'elit_featurable',
        'compare' => 'NOT EXISTS',
      )
    )
  );

  $primary = new WP_Query( $args );
  d( $primary );
  if ( $primary->have_posts() ): 
    while ( $primary->have_posts() ):
      $primary->the_post();
      $meta = get_post_meta( $post->ID );
      d( $meta );
?>

      <div class="row">
        <div class="size-2-of-3 module">
          <article class="f-item--major">
            <figure class="f-item__fig--major">
              <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ): ?>
                  <?php $thumb_id = get_post_thumbnail_id(); ?>
                  <?php $thumb_url = wp_get_attachment_image_src( $thumb_id, 'medium' ); ?>
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
              <p class="f-item__body-text--major"><?php the_excerpt(); ?></p>
            </div>
          </article>

<?php 
    endwhile;
  endif;
?>
          <!-- this is don's natural home-->
          <aside data-set="rover-don-parent" class="ad ad__med-rect--front rover-don-parent-f-a">
            <div class="rover-don"><a href="#"><img src="img/medium-rect-0.gif" alt="medium-rectangle"></a>
            </div>
          </aside>
          <aside data-set="rover-don-parent" class="ad ad__med-rect--front rover-don-parent-f-b"></aside>
          <aside data-set="rover-peggy-parent" class="ad ad__med-rect--front rover-peggy-parent-f-b"></aside>
        </div>
        <div class="size-1-of-3--last">
          <aside data-set="rover-don-parent" class="ad ad__med-rect--front rover-don-parent-f-c"></aside>
          <aside data-set="rover-peggy-parent" class="ad ad__med-rect--front rover-peggy-parent-f-c"></aside>
        </div>
      </div>
