<?php
class Post_Category_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'post_category_widget', // ID
      __( 'Posts in a Category', 'rebelliontheme' ),
      __( 'Displays recent posts from within a category', 'rebelliontheme' )
    );
  }

  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] .
        apply_filters( 'widget_title' , $instance['title'] ) .
        $args['after_title'];
    }
    $qry = new WP_Query( array(
      'posts_per_page' => 3,
      'post_type' => 'post',
      'category_name' => 'community_tap'
    ) );
    if ( $qry->have_posts() ) {
      while ( $qry->have_posts() ) {
        echo '<ul>';
        $qry->the_post();
          echo '<li><h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
          echo '<p>' . get_the_excerpt() . '</p>';
          echo '</li>';
      }
      echo '</ul>';
    }
    echo $args['after_widget'];
  }

  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }
}

?>
