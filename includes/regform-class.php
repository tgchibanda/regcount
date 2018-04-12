<?php

/**
 * Adds Reg_Form widget.
 */
class Reg_Form_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'regform_widget', // Base ID
			esc_html__( 'User Count', 'rf_domain' ), // Name
			array( 'description' => esc_html__( 'Widget to register users', 'rf_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // What you want to display before widget eg <div>
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        

        //Widget content output
        
        //echo esc_html__( 'Hello, World!', 'rf_domain' );
        
        $result = count_users();
        echo 'There are ', $result['total_users'], ' total users';
        foreach($result['avail_roles'] as $role => $count)
            echo ', ', $count, ' are ', $role, 's';
        echo '.';

		echo $args['after_widget']; // What you want to display after widget eg </div>
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Youtube Subs', 'rf_domain' );
        
      
		?>

        <!-- Title -->
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
            
                <?php esc_attr_e( 'Title:', 'text_domain' ); ?>
            
            </label> 

            <input 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
                type="text" 
                value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
        $instance = array();
        
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        
       
		return $instance;
	}

} // class Foo_Widget