<?php 
/**
 * Let's make some widgets. 
 *
 * We're working off of the Widgets API page in the codex.
 *
 */


/**
 * Display popular posts
 */
class elit_widget_popular_posts extends WP_Widget {
  public function __construct() {
    $widget_ops = array(
      'classname' => 'widget--counter',
      'description' => 'The DO\'s popular posts',
    );
    parent::__construct(
      'elit_widget_popular_posts', // base ID
      'Elit Widget Popular Posts', // name
      $widget_ops
    );
  }

  /**
   * Outputs the content of the widget. Front-end display of the widget.
   *
   * @param array $args Widget arguments
   * @param array $instance Saved values from the db
   * @author pjs
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title']  . 
        apply_filters( 'widget_title', $instance['title'] ) .
        $args['after_title'];
    }

    $params  = 'wpp_start="<ol>"';
    $params .= '&wpp_end="</ol>"';
    $params .= '&post_html="<li><a href=\'{url}\'>{text_title}</a></li>"';
    $params .= '&limit=5';
    $params .= '&post_type="post"';


    wpp_get_mostpopular( $params );

    echo $args['after_widget'];
  }

  /**
   * Outputs the options form on the back-end. 
   *
   * @return void
   * @param array $instance Previously saved values from the db
   * @author pjs
   */
  public function form( $instance ) {
    $title = !empty( $instance['title'] ) ?
      $instance['title'] : 'New title';
      ?>
    <p>
      <label for="<?php $this->get_field_id( 'title' ) ?>">Title:</label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ) ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
      <?php
  }
  /**
   * Process the widget form values as they are saved.
   *
   * @return void
   * @author array $new_instance Values just sent to be saved.
   * @author array $old_instance Previously saved values from the db.
   * @author pjs
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( !empty( $new_instance['title'] ) ) ? 
        strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }
} // eoc


/**
 * Recent_Posts widget class
 *
 * Based heavily on WP's default recent posts widget
 */
class elit_widget_recent_posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
      'classname' => 'widget--latest', 
      'description' => "The DO&#8217;s most recent posts.",
    );
		parent::__construct('recent-posts', 'Elit Recent Posts', $widget_ops);
		$this->alt_option_name = 'elit_widget_recent_posts';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'elit_widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : 'Recent Posts';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul class="widget__list">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
    <?php 
      $meta = get_post_meta( get_the_ID() );
      $thumb_id = ( 
        has_post_thumbnail() ? get_post_thumbnail_id() : $meta['elit_thumb'][0]
      );
   ?>
			<li class="widget__list-item">
    <?php 
      if ( $thumb_id ): 
        $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-tiny' );
    ?>
        <span class="widget__feature">
          <img src="<?php echo $thumb_url[0]; ?>" alt="<?php get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?>" width="100" height="66" class="image__img">
        </span>
    <?php endif; ?>
        <span class="widget__head">
          <a href="<?php the_permalink() ?>" class="widget__link"><?php get_the_title() ? the_title() : the_ID(); ?></a>
        </span>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['elit_widget_recent_posts']) )
			delete_option('elit_widget_recent_posts');

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}

/**
 * 
 */
class elit_widget_play extends WP_Widget {
  /**
   * 
   */
  public function __construct() {
    parent::__construct(
      'elit_widget_play', // base ID
      'Elit Widget Play', // name
      array (
        'description' => ('A widget for playing')
      )
    );
  }

  /**
   * Outputs the content of the widget. Front-end display of the widget.
   *
   * @param array $args Widget arguments
   * @param array $instance Saved values from the db
   * @author pjs
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title']  . 
        apply_filters( 'widget_title', $instance['title'] ) .
          $args['after_title'];
    }

    echo 'Hello, world.';
    echo $args['after_widget'];
  }

  /**
   * Outputs the options form on the back-end. 
   *
   * @return void
   * @param array $instance Previously saved values from the db
   * @author pjs
   */
  public function form( $instance ) {
    $title = !empty( $instance['title'] ) ?
      $instance['title'] : 'New title';
?>
    <p>
      <label for="<?php $this->get_field_id( 'title' ) ?>">Title:</label>

      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ) ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
<?php
  }

  /**
   * Process the widget form values as they are saved.
   *
   * @return void
   * @author array $new_instance Values just sent to be saved.
   * @author array $old_instance Previously saved values from the db.
   * @author pjs
   */
  public function update( $new_instance, $old_instance ) {

    $instance = array();
    $instance['title'] = ( !empty( $new_instance['title'] ) ) ? 
        strip_tags( $new_instance['title'] ) : '';

    return $instance;

  }
} // eoc

function elit_register_widgets() {
  register_widget( 'elit_widget_play' );
  register_widget( 'elit_widget_popular_posts' );
  register_widget( 'elit_widget_recent_posts' );
}
add_action( 'widgets_init' , 'elit_register_widgets' );
