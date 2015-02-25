<?php 
/**
 * Let's play around making a widget to see what happens.
 *
 * We're working off of the Widgets API page in the codex.
 *
 */

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
   *
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

function elit_register_widget_play() {
  register_widget( 'elit_widget_play' );
}
add_action( 'widgets_init' , 'elit_register_widget_play' );
