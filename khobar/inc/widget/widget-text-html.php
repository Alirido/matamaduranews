<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Tuxtheme HTML Widget
	Version: 1.0
	
-----------------------------------------------------------------------------------*/

class tux_html_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'tux_html_widget',
			__('TUX: HTML Widget','tuxtheme'),
			array( 'description' => __( 'Widget HTML/Text.','tuxtheme' ) )
		);
	}

 	public function form( $instance ) {

		$defaults = array(
			'title_length' => 7,
			'center' => 1,
			'text_code' => '',
			'tran_bg' => 1,
			'hide_title' => 1
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$text_html_title = isset( $instance[ 'text_html_title' ] ) ? $instance[ 'text_html_title' ] : __( 'Text','tuxtheme' );
		$text_code = isset( $instance[ 'text_code' ] ) ? $instance[ 'text_code' ] : '';
		$center = isset( $instance[ 'center' ] ) ? intval( $instance[ 'center' ] ) : 1;
		$tran_bg = isset( $instance[ 'tran_bg' ] ) ? esc_attr( $instance[ 'tran_bg' ] ) : 1;
		$hide_title = isset( $instance[ 'hide_title' ] ) ? esc_attr( $instance[ 'hide_title' ] ) : 1;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_html_title' ); ?>"><?php _e( 'Judul:','tuxtheme' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'text_html_title' ); ?>" name="<?php echo $this->get_field_name( 'text_html_title' ); ?>" type="text" value="<?php echo esc_attr( $text_html_title ); ?>" />
		</p>
		

		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">Text , Shortcodes or Html code : </label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php echo $instance['text_code']; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("hide_title"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_title"); ?>" name="<?php echo $this->get_field_name("hide_title"); ?>" value="1" <?php checked( 1, $instance['hide_title'], true ); ?> />
				<?php _e( 'Sembunyikan Judul', 'tuxtheme'); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("center"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("center"); ?>" name="<?php echo $this->get_field_name("center"); ?>" value="1" <?php checked( 1, $instance['center'], true ); ?> />
				<?php _e( 'Rata Tengah / Center', 'tuxtheme'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("tran_bg"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tran_bg"); ?>" name="<?php echo $this->get_field_name("tran_bg"); ?>" value="1" <?php checked( 1, $instance['tran_bg'], true ); ?> />
				<?php _e( 'Transparan', 'tuxtheme'); ?>
			</label>
		</p>

		<?php 
	
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['text_html_title'] = strip_tags( $new_instance['text_html_title'] );
		$instance['text_code'] = $new_instance['text_code'] ;
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['hide_title'] = strip_tags( $new_instance['hide_title'] );
		$instance['center'] = strip_tags( $new_instance['center'] );
		return $instance;
	}

	public function widget( $args, $instance ) {
	
		extract( $args );

		$title = apply_filters('widget_title', $instance['text_html_title'] );
		$text_code = $instance['text_code'];
		$tran_bg = $instance['tran_bg'];
		$hide_title = $instance['hide_title'];
		$center = $instance['center'];
		
		if ($center)
			$center = 'style="text-align:center;"';
		else
			$center = '';
		
		if($hide_title ){
				echo $before_widget;
				echo do_shortcode( $text_code );
				echo $after_widget;
			}
		elseif( !$tran_bg ){
				echo $before_widget;
				echo $before_title;
				echo $title ; 
				echo $after_title;
				echo '<div '.$center.'>';
				echo do_shortcode( $text_code ) .'
					</div><div class="clear"></div>';
				echo $after_widget;
			}
		else { ?>
			<div class="text-html-box" <?php echo $center ?>>
			<?php echo do_shortcode( $text_code ) ?>
			</div>
		<?php
		
		}			
	}
}


// Register widget
add_action( 'widgets_init', 'register_tux_html_widget' );
function register_tux_html_widget() {
	register_widget( 'tux_html_widget' );
}