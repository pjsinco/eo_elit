<div id="spotlight" class="spotlight">
  <h3 class="vis-title" style="color: #888; font-weight: 200">Spotlight<span style="color: #ef3f23;">Video</span></h3>
  <div class="spotlight__feature-wrapper elit-video" id="video">
    <?php echo wptexturize( $spotlight['elit_spotlight_video_embed_code'] ); ?>
  </div>
  <div class="spotlight__body">
    <h5 class="spotlight__kicker"><?php echo wptexturize( $spotlight['elit_spotlight_kicker'] ); ?></h5>
    <h2 class="spotlight__head"><?php echo $spotlight_post->post_title; ?></h2>
    <?php echo wptexturize( $spotlight['elit_spotlight_body_text'] ); ?>
  </div>
</div>
