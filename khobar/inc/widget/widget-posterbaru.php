<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Tuxtheme Latest Post
	Version: 1.0
	
-----------------------------------------------------------------------------------*/

class tux_latest_posts_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'tux_latest_posts_widget',
			__('TUX: Post Terbaru','tuxtheme'),
			array( 'description' => __( 'Tampilkan Postingan Terbaru.','tuxtheme' ) )
		);
	}

 	public function form( $instance ) {
		$defaults = array(
			'days' => 30,
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Terbaru','tuxtheme' );
		$qty = isset( $instance[ 'qty' ] ) ? intval( $instance[ 'qty' ] ) : 5;
		$days = isset( $instance[ 'days' ] ) ? intval( $instance[ 'days' ] ) : 30;
		$sort = isset( $instance[ 'sort' ] ) ? $instance[ 'sort' ] :'kunjungan';
		$type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] :'berita';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','tuxtheme' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Tipe Pos:','tuxtheme' ); ?></label>			
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
			<option value="berita" <?php  if(esc_attr( $type )=='berita'){echo 'selected';} ?>>Berita</option>
			<option value="gallery" <?php  if(esc_attr( $type )=='foto'){echo 'selected';} ?>>Foto</option>
			<option value="video" <?php  if(esc_attr( $type )=='video'){echo 'selected';} ?>>Video</option>
			</select> 
		</p>

	   
		<p>
			<label for="<?php echo $this->get_field_id( 'qty' ); ?>"><?php _e( 'Jumlah Post','tuxtheme' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'qty' ); ?>" name="<?php echo $this->get_field_name( 'qty' ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $qty ); ?>" />
		</p>



	
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['qty'] = intval( $new_instance['qty'] );
		$instance['type'] = strip_tags( $new_instance['type'] );		
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$type = $instance['type'];
		$qty = (int) $instance['qty'];
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		echo self::get_latest_posts( $qty, $type );
		echo $after_widget;
	}

	public function get_latest_posts( $qty,$type ) {
		$cpost = array();
		if($type!='berita') {
			$cpost = array('post_type' => $type);
		}

		
		$args = array('numberposts' => $qty,'post_status' => 'publish');
		//$recent_post = get_posts( array_merge($cpost,$args) );
		//$recent_post = wp_get_recent_posts( array_merge($cpost,$args) );
		$recent_post = wp_get_recent_posts( array_merge($cpost,$args) );
		
		//$popular = get_posts($args);
		$x = 0;
		echo '<ul class="list-text">';
		 foreach( $recent_post as $recent ){
		 	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'widgetthumb' );
			if($img_src[0]!='') {
			$thumbnail = $img_src[0];
			}
			else {
			$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
			}

		?>
		<li class="pb15 art-list pos_rel">
		<div class="fr pos_rel">
			<a rel="nofollow" href="<?php echo get_permalink($recent["ID"]); ?>" title="<?php echo  $recent["post_title"];?>">
				<img class="pa5 shou bgwhite" src="<?php echo $thumbnail; ?>" alt="<?php echo  $recent["post_title"];?>" width="90" height="60">
			</a>
		</div>
		<div class="mt5 mr110">
			<h3>
			<a class="fbo2 f15 txt-oev-3" href="<?php echo get_permalink($recent["ID"]); ?>" title="<?php echo  $recent["post_title"];?>"><?php echo  $recent["post_title"];?></a>
			</h3>
			<div class="grey pt3">
			<span class="fa fa-clock-o mr7"></span> 
			<time class="grey timeago" style="display: inline;"><?php echo human_time_diff_id(get_the_time('U',$recent["ID"]), current_time('timestamp') ) . ' yang lalu'; ?></time>
			</div><!--.grey pt3-->
			</div>
		</li>
		<?php
		 } wp_reset_postdata();
		echo '</ul>';
		
	}

}

// Register widget
add_action( 'widgets_init', 'register_tux_latest_posts_widget' );
function register_tux_latest_posts_widget() {
	register_widget( 'tux_latest_posts_widget' );
}