<?php 
/**
 * @package elit
 */
?>
        <?php $meta = get_post_meta( $post->ID ); ?>
        <?php $has_mute_key = metadata_exists( 'post', $post->ID, 'elit_featured_video_mute' ); ?>
        <?php $has_kicker = metadata_exists( 'post', $post->ID, 'elit_kicker' ); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php $iframe = $meta['elit_featured_video'][0]; ?>
          <?php if ( !empty( $iframe ) ): ?>
            <?php if ( metadata_exists( 'post', $post->ID, 'elit_featured_video_autoplay' ) && $meta['elit_featured_video_autoplay'] ): ?>
              <?php $subst = 'src="$1?autoplay=1&cc_load_policy=1"'; ?>
              <?php if ( $has_mute_key && $meta['elit_featured_video_mute'] ): ?>
                <?php $subst = 'src="$1?autoplay=1&cc_load_policy=1&mute=1"'; ?>
              <?php endif; ?>
              <?php $iframe = preg_replace( '/src="(.*?)"/m', $subst, $iframe ); ?>
            <?php elseif ( $has_mute_key && $meta['elit_featured_video_mute'] ): ?>
              <?php $iframe = preg_replace( '/src="(.*?)"/m', 'src="$1?mute=1"', $iframe ); ?>
            <?php endif; ?>

            <figure class="image--primary image-overlay--space elit-video" id="video">
              <?php echo $iframe; ?>
            </figure>
          <?php endif; ?>

          <div class="story">
            <header class="story-header">
              <h5 class="story-header__kicker"><?php echo wptexturize( $has_kicker ? $meta['elit_kicker'][0] : '' ); ?></h5>
              <?php the_title('<h1 class="story-header__title">', '</h1>', true); ?>
              <h3 class="story-header__teaser"><?php echo wptexturize( get_the_excerpt() ); ?></h3>
              <div>
                <div class="story-meta">
                  <?php elit_byline(); ?>
                  <?php elit_posted_on(); ?>
                  <?php elit_comments_link(); ?>
                </div> <!-- story-meta -->
              </div>

              <?php 
                /**
                 * Set up social
                 *
                 */
                $link = get_permalink();
                $title = get_the_title();
                $thumb_id = ( 
                  has_post_thumbnail() ? get_post_thumbnail_id() : ( $has_kicker ? $meta['elit_thumb'][0] : '' )
                );
                elit_social_links( $meta, $link, $title, $thumb_id, true ); ?>
            </header>

            <div class="story__body-text">
              <?php the_content(); ?>
            </div> <!-- story__body-text -->
            
            <footer class="story-footer"> 
              <?php elit_social_links( $meta, $link, $title, $thumb_id, false ); ?>
              <?php elit_story_footer( get_post() ); ?>
            </footer>
          </div> <!-- .story -->
        </article>

