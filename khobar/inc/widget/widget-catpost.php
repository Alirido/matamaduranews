<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Tuxtheme Category Posts
	Version: 1.0
	
-----------------------------------------------------------------------------------*/

class single_category_posts_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'single_category_posts_widget',
			__('TUX: Pos Kategori','tuxtheme'),
			array( 'description' => __( 'Tampilkan postingan berdasarkan kategori','tuxtheme' ) )
		);
	}

 	public function form( $instance ) {
		$defaults = array(
			'title_length' => 7,
			'comment_num' => 0,
			'date' => 1,
			'show_thumb1' => 1,
			'box_layout' => 'horizontal-small',
			'show_excerpt' => 0,
			'judul_berwarna' => 0,
			'excerpt_length' => 10
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Kategori Pilihan','tuxtheme' );
		$title_length = isset( $instance[ 'title_length' ] ) ? intval( $instance[ 'title_length' ] ) : 7;
		$cat = isset( $instance[ 'cat' ] ) ? intval( $instance[ 'cat' ] ) : 0;
		$qty = isset( $instance[ 'qty' ] ) ? intval( $instance[ 'qty' ] ) : 5;
		$comment_num = isset( $instance[ 'comment_num' ] ) ? intval( $instance[ 'comment_num' ] ) : 1;
		$date = isset( $instance[ 'date' ] ) ? intval( $instance[ 'date' ] ) : 1;
		$show_thumb1 = isset( $instance[ 'show_thumb1' ] ) ? intval( $instance[ 'show_thumb1' ] ) : 1;
		$box_layout = $instance['box_layout'];
		$show_excerpt = isset( $instance[ 'show_excerpt' ] ) ? esc_attr( $instance[ 'show_excerpt' ] ) : 1;
		$excerpt_length = isset( $instance[ 'excerpt_length' ] ) ? intval( $instance[ 'excerpt_length' ] ) : 10;
		$judul_berwarna = isset( $instance[ 'judul_berwarna' ] ) ? esc_attr( $instance[ 'judul_berwarna' ] ) : 1;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Judul:','tuxtheme' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Kategori:','tuxtheme' ); ?></label> 
			<?php wp_dropdown_categories( Array(
						'orderby'            => 'ID', 
						'order'              => 'ASC',
						'show_count'         => 1,
						'hide_empty'         => 1,
						'hide_if_empty'      => true,
						'echo'               => 1,
						'selected'           => $cat,
						'hierarchical'       => 1, 
						'name'               => $this->get_field_name( 'cat' ),
						'id'                 => $this->get_field_id( 'cat' ),
						'taxonomy'           => 'category',
					) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'qty' ); ?>"><?php _e( 'Jumlah Pos','tuxtheme' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'qty' ); ?>" name="<?php echo $this->get_field_name( 'qty' ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $qty ); ?>" />
		</p>

		<p>
	       <label for="<?php echo $this->get_field_id( 'title_length' ); ?>"><?php _e( 'Panjang Judul:', 'tuxtheme' ); ?>
	       <input id="<?php echo $this->get_field_id( 'title_length' ); ?>" name="<?php echo $this->get_field_name( 'title_length' ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $title_length ); ?>" />
	       </label>
		</p>

		
		<p>
			<label for="<?php echo $this->get_field_id("show_thumb1"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_thumb1"); ?>" name="<?php echo $this->get_field_name("show_thumb1"); ?>" value="1" <?php if (isset($instance['show_thumb1'])) { checked( 1, $instance['show_thumb1'], true ); } ?> />
				<?php _e( 'Tampilkan Gambar', 'tuxtheme'); ?>
			</label>
		</p>
		

		<p>
			<label for="<?php echo $this->get_field_id("date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>" value="1" <?php checked( 1, $instance['date'], true ); ?> />
				<?php _e( 'Tampilkan Tanggal', 'tuxtheme'); ?>
			</label>
		</p>


		
		<p>
			<label for="<?php echo $this->get_field_id("show_excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_excerpt"); ?>" name="<?php echo $this->get_field_name("show_excerpt"); ?>" value="1" <?php checked( 1, $instance['show_excerpt'], true ); ?> />
				<?php _e( 'Tampilkan Excerpt', 'tuxtheme'); ?>
			</label>
		</p>
		
		<p>
	       <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Panjang Excerpt:', 'tuxtheme' ); ?>
	       <input id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $excerpt_length ); ?>" />
	       </label>
		</p>
		
		
	   
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cat'] = intval( $new_instance['cat'] );
		$instance['title_length'] = intval( $new_instance['title_length'] );
		$instance['qty'] = intval( $new_instance['qty'] );
		$instance['comment_num'] = intval( $new_instance['comment_num'] );
		$instance['date'] = intval( $new_instance['date'] );
		$instance['show_thumb1'] = intval( $new_instance['show_thumb1'] );
		$instance['box_layout'] = $new_instance['box_layout'];
		$instance['show_excerpt'] = intval( $new_instance['show_excerpt'] );
		$instance['excerpt_length'] = intval( $new_instance['excerpt_length'] );
		$instance['judul_berwarna'] = intval( $new_instance['judul_berwarna'] );
		
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$cat = $instance['cat'];
		$title_length = $instance['title_length'];
		$comment_num = $instance['comment_num'];
		$date = $instance['date'];
		$qty = (int) $instance['qty'];
		$show_thumb1 = (int) $instance['show_thumb1'];
		$box_layout = isset($instance['box_layout']) ? $instance['box_layout'] : 'horizontal-small';
		$show_excerpt = $instance['show_excerpt'];
		$excerpt_length = $instance['excerpt_length'];
		$judul_berwarna = $instance['judul_berwarna'];

		$before_widget = preg_replace('/class="([^"]+)"/i', 'class="$1 '.(isset($instance['box_layout']) ? $instance['box_layout'] : 'horizontal-small').'"', $before_widget); // Add horizontal/vertical class to widget
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title;
		echo $title;
		echo $after_title;
		echo self::get_cat_posts( $cat, $title_length, $qty, $comment_num, $date, $show_thumb1, $box_layout, $show_excerpt, $excerpt_length );
		echo $after_widget;
	}

	public function get_cat_posts( $cat, $title_length, $qty, $comment_num, $date, $show_thumb1, $box_layout, $show_excerpt, $excerpt_length ) {
		
		$no_image = ( $show_thumb1 ) ? '' : ' no-thumb';



		$posts = new WP_Query(
			"cat=".$cat."&orderby=date&order=DESC&posts_per_page=".$qty
		);

		echo '<ul class="list-text">';
		
		while ( $posts->have_posts() ) { $posts->the_post(); ?>
			<li class="pb15 art-list pos_rel">
				<?php if ( $show_thumb1 == 1 ) :
				
				$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $posts->ID ), 'widgetthumb' );
			if($img_src[0]!='') {
				$thumbnail = $img_src[0];
			}
			else {
				$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
			}	
				
				?>
				<div class="fr pos_rel">
					<a rel="nofollow" href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
						<img class="pa5 shou bgwhite"  src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>" width="90" height="60">
					</a>
				</div>
				<?php endif; ?>
				<div class="mt5 mr110">
						<h3>
							<a class="fbo2 f15 txt-oev-3" href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo esc_html( short_by_word( get_the_title(), $title_length, 'words' ) ); ?></a>
						</h3>
						<?php if ( $date == 1 ) : ?>
						<div class="grey pt3">
							<span class="fa fa-clock-o mr7"></span>
							<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
							echo '<time class="grey timeago" style="display: inline;">'.tux_indo_date($my_date).'</time>';
				 			?>						
						</div><!--.post-info-->
						<?php endif; ?>
						<?php if ( $show_excerpt == 1 ) : ?>
						<div class="post-excerpt">
							<?php echo tux_excerpt( $excerpt_length ); ?>
						</div>
						<?php endif; ?>
					</div>	
			</li>
		<?php }
		wp_reset_postdata();
		echo '</ul>'."\r\n";
	}
}

// Register widget
add_action( 'widgets_init', 'register_single_category_posts_widget' );
function register_single_category_posts_widget() {
	register_widget( 'single_category_posts_widget' );
}