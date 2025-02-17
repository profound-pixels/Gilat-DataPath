<?php

//PPX-WDGTS 1.0 CONTENT VIEWS WIDGET
class ppx_widget extends WP_Widget {
  
    function __construct() {
    parent::__construct(

    // Base ID of your widget
    'ppx_widget', 

    // Widget name will appear in UI
    __('PPx Content Views', 'ppx-starter'), 

    // Widget description
    array( 'description' => __( 'Load custom views of site content.', 'ppx-starter' ), ) 
    );
    }


    // Creating widget front-end 
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

        //-----------------------------------------------------------
        // This is where you run the code and display the output
        initContentView($args);
        //-----------------------------------------------------------
    }    


    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'ppx-starter' );
        }
        //Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php 
    
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
 

}// Class wpb_widget ends here 
 
 
// Register and load the widget
function ppx_load_widget() {
    register_widget( 'ppx_widget' );
}
add_action( 'widgets_init', 'ppx_load_widget' );