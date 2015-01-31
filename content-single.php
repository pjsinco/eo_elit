<?php 
/**
 * @package elit
 */
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php // if we have a featured image, show it ?>
          <?php if ( has_post_thumbnail() ): ?>
            <?php $thumb_id = (get_post_thumbnail_id()); ?>
            <?php $thumb_content = get_post($thumb_id); ?>

            <?php // if we don't have a label for the image, add some space below with image-overlay--space ?>
            <figure class="image--primary <?php echo (($thumb_content->post_content) ? 'image-overlay' : 'image-overlay--space'); ?>">
            <!-- removing picture element because it's not used by ricg picturefill plugin -->
            <!--<picture> -->
              <img class="image__img" src="<?php echo wp_get_attachment_url($thumb_id); ?>" <?php echo tevkori_get_src_sizes( 179421, 'article-top-large' ); ?> />

            <?php // the caption overlay ?>
            <?php if ($thumb_content->post_excerpt): ?>
              <div class="image-overlay__body">
                <span class="image-overlay__text"><?php echo $thumb_content->post_excerpt; ?></span>
              </div>
            <!--</picture> -->
            <?php endif; ?>
            </figure>

            <?php // our label for the featured image  ?>
            <?php if ($thumb_content->post_content): ?>
            <figcaption class="image__caption caption caption--feature caption--right">
              <?php echo $thumb_content->post_content; ?>
            </figcaption>
            <?php endif; ?>
          <?php endif; ?>


          <div class="story">
            <header class="story-header">
              <h5 class="story-header__kicker"><?php echo get_post_meta($post->ID, 'elit_kicker', true); ?></h5>
              <?php the_title('<h1 class="story-header__title">', '</h1>', true); ?>
              <h3 class="story-header__teaser"><?php echo get_the_excerpt(); ?></h3>
              <div>
                <div class="story-meta">
                  <?php elit_byline(); ?>
                  <?php elit_posted_on(); ?>
                  <?php elit_comment_link(); ?>
                </div> <!-- story-meta -->
              </div>

              <ul class="social social--shiftable">
                <li class="social__icon">
                  <a href="#" class="social--shiftable__link">
                    <span class="icon-facebook">
                      <span class="text-replace">Facebook</span>
                    </span>
                  </a>
                </li>
                <li class="social__icon">
                  <a href="#" class="social--shiftable__link">
                    <span class="icon-twitter">
                      <span class="text-replace">Twitter</span>
                    </span>
                  </a>
                </li>
                <li class="social__icon">
                  <a href="#" class="social--shiftable__link">
                    <span class="icon-linkedin">
                      <span class="text-replace">LinkedIn</span>
                    </span>
                  </a>
                </li>
                <li class="social__icon">
                  <a href="#" class="social--shiftable__link">
                    <span class="icon-pinterest">
                      <span class="text-replace">Pinterest</span>
                    </span>
                  </a>
                </li>
                <li class="social__icon">
                  <a href="#" class="social--shiftable__link">
                    <span class="icon-email">
                      <span class="text-replace">Email</span>
                    </span>
                  </a>
                </li>
              </ul>
            </header>

