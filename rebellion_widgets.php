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

class Post_With_Excerpt_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'post_with_excerpt_widget', // ID
      __( 'Posts with an excerpt displayed', 'rebelliontheme' ),
      __( 'Displays recent posts along with an excerpt', 'rebelliontheme' )
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
      'post_type' => 'post'
    ) );
    if ( $qry->have_posts() ) {
      while ( $qry->have_posts() ) {
        echo '<ul id="news-items">';
        $qry->the_post();
        echo '<li><h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
        echo '<time class="updated" datetime="' . get_the_time('Y-m-j') . '" pubdate>' . get_the_time(get_option('date_format')) . '</time>';
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

class Social_Links_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'social_links_widget', // ID
      __( 'Social Links', 'rebelliontheme' ),
      __( 'Displays social media icons with links', 'rebelliontheme' )
    );
  }

  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] .
      apply_filters( 'widget_title' , $instance['title'] ) .
      $args['after_title'];
    }
    echo '<p>' . $instance['tagline'] . '</p>';
    echo '<ul id="social-links">';
    if ( ! empty( $instance['facebook'] ) ) {
      echo '<li><a href="' . $instance['facebook'] . '"><i class="fa fa-facebook fa-2x"></i></a></li>';
    }
    if ( ! empty( $instance['twitter'] ) ) {
      echo '<li><a href="' . $instance['twitter'] . '"><i class="fa fa-twitter fa-2x"></i></a></li>';
    }
    if ( ! empty( $instance['youtube'] ) ) {
      echo '<li><a href="' . $instance['youtube'] . '"><i class="fa fa-youtube fa-2x"></i></a></li>';
    }
    if ( ! empty( $instance['instagram'] ) ) {
      echo '<li><a href="' . $instance['instagram'] . '"><i class="fa fa-instagram fa-2x"></i></a></li>';
    }
    echo '</ul>';
    echo $args['after_widget'];
  }

  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'rebelliontheme' );
    $facebook = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
    $twitter = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
    $youtube = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
    $instagram = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
    $tagline = ! empty( $instance['tagline'] ) ? $instance['tagline'] : __( 'Like. Follow. Share.', 'rebelliontheme' );
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'tagline' ); ?>"><?php _e( 'Tagline:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'tagline' ); ?>" name="<?php echo $this->get_field_name( 'tagline' ); ?>" type="text" value="<?php echo esc_attr( $tagline ); ?>">
    <p>
      <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
    </p>
    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
    $instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
    $instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
    $instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
    $instance['tagline'] = ( ! empty( $new_instance['tagline'] ) ) ? strip_tags( $new_instance['tagline'] ) : '';
    return $instance;
  }
}


?>
