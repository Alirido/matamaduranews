<?php
	function posts_carousel() {
	// WP_Query arguments
	$args = array (
		'posts_per_page'		=> 5,
		'post_status'			=> 'publish',
		'post__in' => get_option('sticky_posts')
	);
	$query = new WP_Query( $args );
	?>
    <div id="berita-utama" class="flexslider m15-b">
		<ul class="slides">
	<?php
	while( $query->have_posts() ) {
	$query->the_post();
	$excerpt_text = short_by_word( get_the_excerpt(), 20 );
	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'post-slider-medium' );
	if($img_src[0]!='') {
		$thumbnail = $img_src[0];
	}
	else {
		$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
	}	?>	
			<li><div class="box-image">
			<a href="<?php echo get_permalink(); ?>" target="_parent">
			<img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>" width="430" height="246">
			</a></div>				
				<div class="box-slide">
					<h5><?php echo get_the_category_list( ', ' ); ?></h5>
					<h2><a href="<?php echo get_permalink(); ?>" target="_parent" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h2>
					<p><?php echo $excerpt_text; ?></p>
				</div>
			</li>				
	<?php } ?>						
		</ul>
     </div>
	<?php
	}
?>