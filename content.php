<?php 
/**
 * @package elit
 */
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php // if we have a featured image, show it ?>
          <?php if ( has_post_thumbnail() ): ?>
            <?php $featured_image_id = (get_post_thumbnail_id()); ?>
            <?php $featured_image_content = get_post($featured_image_id); ?>

            <?php // if we don't have a label for the image, add some space below with image-overlay--space ?>
            <figure class="image--primary 
              <?php echo (($featured_image_content->post_excerpt) ? 'image-overlay ' : ''); ?>
              <?php echo (($featured_image_content->post_content) ? '' : 'image-overlay--space '); ?>">
            <!-- removing picture element because it's not used by ricg picturefill plugin -->
            <!--<picture> -->
              <img class="image__img" src="<?php echo wp_get_attachment_url($featured_image_id); ?>" <?php echo tevkori_get_src_sizes( $featured_image_id, 'elit-article-top-large' ); ?> />
              <?php d($featured_image_id); ?>

            <?php // the caption overlay ?>
            <?php if ($featured_image_content->post_excerpt): ?>
              <div class="image-overlay__body">
                <span class="image-overlay__text"><?php echo $featured_image_content->post_excerpt; ?></span>
              </div>
            <!--</picture> -->
            <?php endif; ?>
            </figure>

            <?php // our label for the featured image  ?>
            <?php if ($featured_image_content->post_content): ?>
            <figcaption class="image__caption caption caption--feature caption--right">
              <?php echo $featured_image_content->post_content; ?>
            </figcaption>
            <?php endif; ?>
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

              <?php get_template_part('social', 'shiftable'); ?>
            </header>

            <div class="story__body-text">
              <?php the_content(); ?>
            </div> <!-- story__body-text -->
            
            <footer class="story-footer"> 
              <?php elit_story_footer(); ?>
            </footer>

          </div> <!-- .story -->
        </article>

