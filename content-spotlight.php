<?php 
/**
 * @package elit
 */
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php $layout = empty( get_field( 'elit_post_layout' ) ) ? 'two-col' : get_field( 'elit_post_layout' ); ?>

          <?php // if we have featured html, show it ?>
          <?php $featured_html = get_field( 'elit_spotlight_html' ); ?>
          <?php if ( !empty( $featured_html ) ): ?>
          <?php echo $featured_html; ?>
          <?php endif; ?>

          <div class="story">
            <header class="story-header">
              <h5 class="story-header__kicker"><?php echo wptexturize( get_post_meta( $post->ID, 'elit_kicker', true ) ); ?></h5>
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
                if ( !get_field( 'elit_short_post' ) ):
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
                elit_social_links( $meta, $link, $title, $thumb_id, true ); ?>
                <?php endif; ?>
            </header>

            <div class="<?php elit_story_body_class( $layout ); ?>">
              <?php the_content(); ?>
            </div> <!-- story__body-text -->
            
            <footer class="<?php elit_story_footer_class( $layout ) ?>">
              <?php elit_social_links( $meta, $link, $title, $thumb_id, false ); ?>
              <?php elit_story_footer(); ?>
            </footer>

          </div> <!-- .story -->
        </article>
