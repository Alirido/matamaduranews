<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Tuxtheme Topik Terhangat
	Version: 1.0
	
-----------------------------------------------------------------------------------*/

class tux_topik_terhangat_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'tux_topik_terhangat_widget',
			__('TUX: Popular Tag','tuxtheme'),
			array( 'description' => __( 'Widget HTML/Text.','tuxtheme' ) )
		);
	}

 	public function form( $instance ) {

		$defaults = array(
			'text_html_title' => 'Topik Terhangat'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$text_html_title = isset( $instance[ 'text_html_title' ] ) ? $instance[ 'text_html_title' ] : __( 'Text','tuxtheme' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_html_title' ); ?>"><?php _e( 'Judul:','tuxtheme' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'text_html_title' ); ?>" name="<?php echo $this->get_field_name( 'text_html_title' ); ?>" type="text" value="<?php echo esc_attr( $text_html_title ); ?>" />
		</p>
		<p>Untuk menambhakna topik terhangat, Anda perlu  mengatur melalui panel pengaturan tema</p>
		

		<?php 
	
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['text_html_title'] = strip_tags( $new_instance['text_html_title'] );
		return $instance;
	}

	public function widget( $args, $instance ) {
	global $tux_option;
		extract( $args );

		$title = apply_filters('widget_title', $instance['text_html_title'] );
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo '<ul class="bsh3 bgred mt10 white tsa lsi-1">';
		$topic = $tux_option['tux_topik_terhangat'];
		if($topic) {
			foreach ( $topic as $section ) {
			$judul = $section['tux_topik_terhangat_judul'];
			$url = $section['tux_topik_terhangat_url'];
			?>
			<li class="pa10 bdr">
			<div class="f16 pos_rel">
			<h4><a href="<?php echo get_tag_link($url); ?>">#<?php echo $judul;?></a></h4>
			<div class="cl2"></div>
			</div>
			</li>
			
			<?php
			}
		}	
		echo '</ul>';	
		echo $after_widget;
		
	}
}


// Register widget
add_action( 'widgets_init', 'register_tux_topik_terhangat_widget' );
function register_tux_topik_terhangat_widget() {
	register_widget( 'tux_topik_terhangat_widget' );
}