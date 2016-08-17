<?php

/**
 * Template for displaying default page content
 *
 * @package elit
 *
 */
?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php // if we have a featured image, show it ?>
          <?php if ( has_post_thumbnail() ): ?>
            <?php $featured_image_id = (get_post_thumbnail_id()); ?>
            <?php $featured_image_content = get_post($featured_image_id); ?>

            <?php // if we don't have a label for the image, add some space below with image-overlay--space ?>
            <figure class="image--primary <?php echo (($featured_image_content->post_excerpt) ? 'image-overlay ' : ''); ?> <?php echo (($featured_image_content->post_content) ? '' : 'image-overlay--space '); ?>">
              <img class="image__img" src="<?php echo wp_get_attachment_url($featured_image_id); ?>" <?php echo wp_get_attachment_image_srcset( $featured_image_id, 'elit-large' ); ?> />

            <?php // the caption overlay ?>
            <?php if ($featured_image_content->post_excerpt): ?>
              <div class="image-overlay__body">
                <span class="image-overlay__text"><?php echo $featured_image_content->post_excerpt; ?></span>
              </div>
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
              <?php the_title('<h1 class="story-header__title--alt">', '</h1>', true); ?>
            </header>

            <div class="story--page__body-text">
              <?php the_content(); ?>
            </div> <!-- story__body-text -->
            
            <footer class="story-footer"> 
              <?php //elit_story_footer(); ?>
            </footer>

          </div> <!-- .story -->
        </article>

