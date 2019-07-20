<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Tuxtheme Popular Posts
	Version: 1.0
	
-----------------------------------------------------------------------------------*/

class tux_popular_posts_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'tux_popular_posts_widget',
			__('TUX: Terpopuler','tuxtheme'),
			array( 'description' => __( 'Tampilkan Postingan Terpopuler.','tuxtheme' ) )
		);
	}

 	public function form( $instance ) {
		$defaults = array(
			'days' => 30,
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Terpopuler','tuxtheme' );
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
			<label for="<?php echo $this->get_field_id( 'sort' ); ?>"><?php _e( 'Query:','tuxtheme' ); ?></label>			
			<select id="<?php echo $this->get_field_id( 'sort' ); ?>" name="<?php echo $this->get_field_name( 'sort' ); ?>">
			<option value="kunjungan" <?php  if(esc_attr( $sort )=='kunjungan'){echo 'selected';} ?>>Kunjungan</option>
			<option value="komentar" <?php  if(esc_attr( $sort )=='komentar'){echo 'selected';} ?>>Komentar</option>
			</select> 
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Tipe Pos:','tuxtheme' ); ?></label>			
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
			<option value="berita" <?php  if(esc_attr( $type )=='berita'){echo 'selected';} ?>>Berita</option>
			<option value="foto" <?php  if(esc_attr( $type )=='foto'){echo 'selected';} ?>>Foto</option>
			<option value="video" <?php  if(esc_attr( $type )=='video'){echo 'selected';} ?>>Video</option>
			</select> 
		</p>
		
		<p>
	       <label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php _e( 'Terpopuler dalam (hari):', 'tuxtheme' ); ?>
	       <input id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $days ); ?>" />
	       </label>
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
		$instance['sort'] = strip_tags( $new_instance['sort'] );		
		$instance['type'] = strip_tags( $new_instance['type'] );		
		$instance['days'] = intval( $new_instance['days'] );
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$type = $instance['type'];
		$sort = $instance['sort'];
		$days = $instance['days'];
		$qty = (int) $instance['qty'];
		echo $before_widget;
		if ( ! empty( $title ) ){ 
		/*$tt = explode(' ',$title);
		if(isset($tt[1])) {
		$title2 = '<span class="blue2 bdrblue">'.$tt[0].'</span> <span class="red">'.$tt[1].'</span>';
		}
		else {
		$title2 = $title;
		}*/
		echo $before_title . $title . $after_title;
		}
		echo self::get_popular_posts( $qty, $days, $type, $sort );
		echo $after_widget;
	}

	public function get_popular_posts( $qty,$days,$type, $sort ) {
		global $post;
		$cpost = array();
		$read = 'Dibaca';
		if($type!='berita') {
			$cpost = array('post_type' => $type);
			$read = 'Dilihat';
		}

        $popular_days = array();
		if ( $days ) {
			$popular_days = array(
        		//set date ranges
        		'after' => "$days day ago",
        		'before' => 'today',
        		//allow exact matches to be returned
        		'inclusive' => true,
        	);
		}
		
		$args = array();
		if($sort=='komentar'){
			$args = array( 
            'suppress_filters' => false,
			'orderby' => 'comment_count',
            'numberposts' => $qty,
            'date_query' => $popular_days
			);
		}
		if($sort=='kunjungan'){
		$args = array( 
            'suppress_filters' => false,
			'meta_key'  => 'views',
			'orderby'   => 'meta_value_num',
            'numberposts' => $qty,
			'order'=> 'DESC',
            'date_query' => $popular_days
			);
		}
		$popular = get_posts( array_merge($cpost,$args) );
		//$popular = get_posts($args);
		$x = 0;
		echo '<div class="bsh3 bgblue2 mt10 lsi-1">';
		echo '<ul>';
		foreach($popular as $post) : $x++;
			setup_postdata($post);
		?>
			<li>
			<div class="f16 pos_rel">
			<div class="most_count fbo al fl"><?php echo $x; ?></div>
			<h4 class="most_title"><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
			<?php echo get_the_title(); ?></a>
			</h4>
			<div class="most_read"><?php echo get_post_meta($post->ID,'views',true); ?> Kali <?php echo $read; ?></div>
			<div class="cl2"></div>
			</div>
			</li>
		<?php endforeach; wp_reset_postdata();
		echo '</ul></div>';
	}

}

// Register widget
add_action( 'widgets_init', 'register_tux_popular_posts_widget' );
function register_tux_popular_posts_widget() {
	register_widget( 'tux_popular_posts_widget' );
}
