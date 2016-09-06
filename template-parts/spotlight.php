<div id="spotlight" class="spotlight">
  <h3 class="vis-title"><?php echo wptexturize( $spotlight['elit_spotlight_secondary_headline'] ); ?></h3>
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
  </div>
</div>
