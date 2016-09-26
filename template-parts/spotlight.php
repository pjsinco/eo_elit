<div id="spotlight" class="spotlight">
  <h3 class="spotlight__vis-title"><?php echo wptexturize( $spotlight['elit_spotlight_secondary_headline'] ); ?></h3>
  <div class="spotlight__feature-wrapper <?php echo ( $spotlight['elit_spotlight_type'] == 'video' ? 'elit-video' : '' ); ?>" <?php echo ( $spotlight['elit_spotlight_type'] == 'video' ? 'id="video"' : '' );  ?>>
    <?php 
      if ( $spotlight['elit_spotlight_type'] == 'video' ): 

        echo wptexturize( $spotlight['elit_spotlight_video_embed_code'] );

      elseif ( $spotlight['elit_spotlight_type']  == 'custom' ):

        echo $spotlight['elit_spotlight_html'];

      endif; ?>
  </div>
  <div class="spotlight__body">
    <h5 class="spotlight__kicker">Spotlight</h5>
    <h2 class="spotlight__head"><?php echo wptexturize( $spotlight_post->post_title ); ?></h2>
    <?php echo wptexturize( $spotlight['elit_spotlight_body_text'] ); ?>
    <?php if ( is_front_page() ): ?>
      <a href="<?php echo $permalink; ?>" class="spotlight__explicitlink"><?php echo $permalink; ?></a>
      <?php 

        /**
         * Set up social
         *
         */
        $meta = get_post_meta( $spotlight_post->ID );
        $title = get_the_title( $spotlight_post->ID );
        $thumb_id = ( 
          has_post_thumbnail() ? get_post_thumbnail_id() : 
            $meta['elit_thumb'][0]
        );
        elit_social_links( $meta, $permalink, $title, $thumb_id, $shiftable = false );
      ?>
    <?php endif; ?>
  </div>
</div>
