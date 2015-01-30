<?php 
/**
 * @package elit
 */
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <figure class="image--primary">
            <picture>
              <?php 
                // let's get the img src of the featured image
                $img_src = wp_get_attachment_url(get_post_thumbnail_id()); 
              ?>
              <img class="image__img" src="<?php echo $img_src; ?>" <?php echo tevkori_get_src_sizes( 179419, 'small' ); ?> />
            </picture>
            <figcaption class="image__caption caption caption--feature caption--right">
              Sed Consectetur Lobortis, LL
            </figcaption>
          </figure>
          <div class="story">


