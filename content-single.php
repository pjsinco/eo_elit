<?php 
/**
 * @package elit
 */
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php // if we have a featured image, show it ?>
          <?php if ( has_post_thumbnail() ): ?>
            <figure class="image--primary image-overlay">

            <!-- removing picture element because it's not used by ricg picturefill plugin -->
            <!--<picture> -->
              <?php 
                // let's get the img src of the featured image
                $img_src = wp_get_attachment_url(get_post_thumbnail_id()); 
              ?>
              <img class="image__img" src="<?php echo $img_src; ?>" <?php echo tevkori_get_src_sizes( 179421, 'article-top-large' ); ?> />
              <div class="image-overlay__body">
                <span class="image-overlay__text">Terrie E. Taylor, DO, a pediatric malaria researcher in Malawi, says her interest in her work outweighs the dangers she faces. "The risks are manageable," she says. </span>
              </div>
            <!--</picture> -->

            </figure>
            <figcaption class="image__caption caption caption--feature caption--right">
              <?php $thumb_id = (get_post_thumbnail_id()); ?>
              <?php echo get_post($thumb_id)->post_excerpt; ?>
            </figcaption>
          <?php endif; ?>


          <div class="story">
            <header class="story-header">
              <h5 class="story-header__kicker"><?php echo get_post_meta($post->ID, 'elit_kicker', true); ?></h5>
              <?php the_title('<h1 class="story-header__title">', '</h1>', true); ?>
              <h3 class="story-header__teaser"><?php echo get_the_excerpt(); ?></h3>
              <div>
                <div class="story-meta">
                  <span class="story-meta__by">By</span> 
                  <span class="story-meta__author"><?php the_author(); ?></span> 
                  <span class="story-meta__date">Wednesday, Dec. 14, 2014</span>
                  <span class="meta__comment-link comment-link">
                    <a href="#comments" class="comment-link__link">
                      <span class="icon-comment">
                        <span class="text-replace">Comments</span>
                      </span> 
                      <span class="comment-link__body">5</span>
                    </a>
                  </span>
                </div> <!-- story-meta -->
              </div>




            </header>

