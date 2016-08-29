<?php 
/**
 * @package elit
 */
?>





  <?php $spotlight = get_post(); ?>
    
  <?php if ($spotlight && !empty($spotlight)): ?>
      <div class="row">
        <div class="unit size-1-of-1 module">
          <div id="spotlight" class="spotlight">
            <h3 class="vis-title" style="color: #888; font-weight: 200">Spotlight<span style="color: #ef3f23; font-weight: 600">Interactive</span></h3>
            <div class="spotlight__feature-wrapper elit-video" id="video">
              <?php echo wptexturize( get_field( 'elit_spotlight_video_embed_code' ) ); ?>
            </div>
            <div class="spotlight__body">
              <h5 class="spotlight__kicker"><?php echo wptexturize( get_field( 'elit_spotlight_kicker', $spotlight->ID ) ); ?></h5>
              <h2 class="spotlight__head"><?php echo $spotlight->post_title; ?></h2>
              <?php echo wptexturize( get_field( 'elit_spotlight_body_text' ) ); ?>
            </div>
          </div>
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

          </div> <!-- .story -->
        </article>

