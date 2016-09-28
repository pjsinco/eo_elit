<?php 

/**
 * Calculate suggested posts based on the given post
 */
class ElitSuggestedPosts
{
  private $post_id; // the ID of the current post
  private $categories; // the categories object of the current post
  private $category_id; // the category ID of the current post
  private $meta; // the meta data object for the current post
  private $school_slugs; // the schools associated with the current post

  public function __construct( $post ) {
    $this->post_id      = $post->ID;
    $this->categories   = get_the_category( $post->ID );
    $this->category_id  = $this->categories[0]->term_id;
    $this->meta         = get_post_meta( $post->ID );
    $this->school_slugs = $this->get_schools_for_post( $post->ID );
  }

  public function display() {
    $recommended_posts = $this->get_recommended_posts( $this->post_id );
    //$school_posts = 
      //$this->get_school_posts( array( $this->post_id ), $this->school_slugs );
    $category_posts = 
      $this->get_posts_in_category( array( $this->post_id ), $this->category_id );
  ?>
    <h3 class="suggested__bigtitle">What to read next</h3>

    <?php if ( $recommended_posts ): ?>
    <div class="suggested">
      <h4 class="suggested__title">
        <?php echo sprintf( '%s %s', 
                            'Related', 
                            $this->singular_or_plural( 'article', $recommended_posts ) ); ?>
      </h4>
      <?php $this->display_posts( $recommended_posts ); ?>
    </div>
    <?php endif; ?>

    <?php if( $this->school_slugs ): foreach( $this->school_slugs as $school_slug ): ?>
    <div class="suggested">
      <h4 class="suggested__title">
        <?php echo 'More articles about ' . $school_slug; ?>
      </h4>
      <?php $this->display_posts( $this->get_school_posts( array( $this->post_id ), $school_slug ) ); ?>
    </div>
    <?php endforeach; endif; ?>


    <?php if ( $category_posts ): ?>
    <div class="suggested">
      <h4 class="suggested__title">
        <?php echo 'More in ' . $this->categories[0]->name; ?>
      </h4>
      <?php $this->display_posts( $category_posts ); ?>
    </div>
    <?php endif; ?>

  <?php
  }

  private function singular_or_plural( $term, $arr ) {
    return $term . ( count( $arr ) > 1 ? 's' : '' );

  }

  private function get_section( $section, $posts ) {
    
  }

  /**
   * Retrive posts in the given category, excluding posts with the given ID.
   * 
   * @param array   $post_ids_to_exclude
   * @param int     $category_id
   * @return array
   */
  private function get_posts_in_category( $post_ids_to_exclude, $category_id ) {

    $args = array(
      'posts_per_page' => 2,
      'post__not_in' => $post_ids_to_exclude,
      'category' => $category_id,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish',
      'post_type' => 'post',
    );

    $posts = get_posts( $args );
    return $posts;
  }

  private function get_recommended_posts( $post_id ) {
    return get_field( 'elit_recommended', $post_id );
  }

  private function display_posts( $posts ) {
    foreach ( $posts as $post ) {
      setup_postdata( $post );
      echo ( $this->get_formatted_post( $post ) );
    }
  }


  private function get_schools_for_post( $post_id ) {

    function filter_school_slug( $taxonomy ) {
      return $taxonomy->slug;
    }

    $posts = get_the_terms( $post->ID, 'elit_school' );

    if ( $posts ) {
      return array_map('filter_school_slug', $posts );
    }

    return null;
  }

  /**
   * Retrive posts associated with the given schools, excluding posts with the given IDs.
   * 
   * @param array   $post_ids_to_exclude
   * @param array   $school_slugs
   * @return array
   */
  private function get_school_posts( $post_ids_to_exclude, $school_slugs ) {
    $args = array(
      'posts_per_page' => 2,
      'post__not_in' => $post_ids_to_exclude,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish',
      'post_type' => 'post',
      'tax_query' => array(
        array(
          'taxonomy' => 'elit_school',
          'field' => 'slug',
          'terms' => $school_slugs,
          'operator' => 'IN',
        )
      )
    );

    return get_posts( $args );
  }

  private function format_section( $section, $posts ) {
    $label = 'Article' . ( count( $posts ) > 1 ? 's' : '' );
    return $label;
  ?>

  <?php
  }

  private function get_formatted_post( $post ) {

    $meta = get_post_meta( $post->ID );
    $thumb_id = ( has_post_thumbnail( $post->ID ) ? 
                    get_post_thumbnail_id( $post->ID ) : 
                    $meta['elit_thumb'][0]);
    $url = get_permalink( $post->ID );
    ob_start();
    ?>
    <article>
      <figure>
        <a href="<?php echo $url; ?>" title="<?php $post->post_title ?>">
          <?php if ( $thumb_id ): ?>
          <?php $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-thumb' ); ?>
          <img src="<?php echo $thumb_url[0]; ?>" alt="<?php get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?>" class="image__img" width="96" height="64">
          <?php endif; ?>
        </a>
      </figure>
      <div class="suggested__body">
        <h5>
          <a href="<?php echo $url; ?>" title="<?php $post->post_title; ?>"><?php echo wptexturize( $post->post_title ); ?></a>
        </h5> 
        <p><?php echo wptexturize( $post->post_excerpt ); ?></p>
      </div>
    </article>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  } 
}
