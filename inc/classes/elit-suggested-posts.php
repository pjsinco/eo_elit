<?php 

/**
 * A panel of suggested posts to read next
 *
 */
class ElitSuggestedPosts
{
  private $post_id;                 // the ID of the current post
  private $categories;              // the categories object of the current post
  private $category_id;             // the category ID of the current post
  private $meta;                    // the meta data object for the current post
  private $school_slugs;            // the schools associated with the current post
  private $suggested_ids = array(); // array of the IDs of posts that we are suggesting

  public function __construct( $post ) {
    $this->post_id      = $post->ID;
    $this->categories   = get_the_category( $post->ID );
    $this->category_id  = $this->categories[0]->term_id;
    $this->meta         = get_post_meta( $post->ID );
    $this->school_slugs = $this->get_schools_for_post( $post->ID );
  }

  /**
   * Add the post IDs to the collection of all suggested post IDs. 
   *
   * @param array of post objects $posts 
   * @return none
   */
  private function add_to_suggested( $posts ) {
    $this->suggested_ids = array_merge( array_map( function( $post ) {
      return $post->ID;
    }, $posts ), $this->suggested_ids );
  }

  /**
   * Display the panel of suggested posts
   *
   * @return none
   */
  public function display() {
    echo '<h3 class="suggested__bigtitle">What to read next</h3>';

    /**
     * Display recommended posts if we have them
     *
     */
    $recommended_posts = $this->get_recommended_posts( $this->post_id );

    if ( ! empty( $recommended_posts ) ) {
      $this->add_to_suggested( $recommended_posts );
      $this->display_section( 
        sprintf( 
          '%s %s', 
          'Related', 
          $this->singular_or_plural( 'article', count( $recommended_posts ) )
        ),
        $recommended_posts 
      );
    }

    /**
     * Display posts for associated schools if we have them
     *
     */

    if ( ! empty( $this->school_slugs ) ) {
      foreach( $this->school_slugs as $school_slug ) {
        $school_posts = $this->get_school_posts( 
            array_merge( $this->suggested_ids, array( $this->post_id ) ), 
            $school_slug
        );

        if ( ! empty( $school_posts ) ) {
          $this->add_to_suggested( $school_posts );

          $this->display_section( 
            sprintf( 
              '%s featuring <span>%s</span>', 
              $this->singular_or_plural( 'Article', count( $school_posts ) ),
              $school_slug 
            ),
            $school_posts 
          );
        }
      }
    }

    /**
     * Display other posts in same category
     *
     */
    $field_exists = array_key_exists( 'elit_display_more_posts_in_category', get_fields() );
    
    // Make sure older posts that haven't yet set the field
    // don't falsely indicate they do not want to display cagegory posts
    if ( $field_exists && get_field( 'elit_display_more_posts_in_category' ) || 
         !$field_exists ) {
      $category_posts = 
        $this->get_posts_in_category( 
          array_merge( $this->suggested_ids, array( $this->post_id ) ), 
          $this->category_id );
    
      if ( ! empty( $category_posts ) ) {
        $this->add_to_suggested( $category_posts );
        $this->display_section( 
          sprintf( 'More in <span>%s</span>', $this->categories[0]->name ),
          $category_posts 
        );
      }
    }
  }

  /**
   * Display a single section of the panel
   *
   * @param string $text
   * @param string $text
   */
  private function display_section( $text, $posts ) {
  ?>
    <div class="suggested">
      <h4 class="suggested__title">
        <?php echo $text; ?>
      </h4>
      <?php $this->display_posts( $posts ); ?>
    </div>
  <?php
  }

  private function singular_or_plural( $term, $count ) {
    return $term . ( $count > 1 ? 's' : '' );
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

    $posts = get_the_terms( $post_id, 'elit_school' );

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
