<?php 
/**
 * @package elit
 */
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <figure class="image--primary">

<!-- removing picture element because it's not used by ricg picturefill plugin -->
<!--             <picture> -->
              <?php 
                // let's get the img src of the featured image
                $img_src = wp_get_attachment_url(get_post_thumbnail_id()); 
              ?>
              <img class="image__img" src="<?php echo $img_src; ?>" <?php echo tevkori_get_src_sizes( 179421, 'article-top-large' ); ?> />
<!--             </picture> -->
            <figcaption class="image__caption caption caption--feature caption--right">
              <?php  ?>
            </figcaption>
          </figure>
          <div class="story">
            <header class="story-header">
              <h5 class="story-header__kicker">Duis Arte</h5>
              <h1 class="story-header__title">Media 101: How to position yourself as a medical expert</h1>
              <h3 class="story-header__teaser">Do you see yourself as the next Dr. Sanjay Gupta? A seasoned expert shares words of wisdom on working with the media.</h3>
              <div>
                <div class="story-meta">
                  <span class="story-meta__by">By</span> 
                  <span class="story-meta__author">Euismod Mollis Purus</span> 
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

