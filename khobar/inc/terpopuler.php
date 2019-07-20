<?php
	function posts_terpopuler() {

	$args = array (
		'posts_per_page' => 10,
		//'orderby' => 'meta_value meta_value_num', 
		//'meta_key'    => 'views',
		//'meta_value_num' => 'views',
		'order'       => 'DESC',
		'post_type'   => 'post',
		'post_status' => 'publish',
		'ignore_sticky_posts' => true
	);
	$query = new WP_Query( $args );
	?>
	<?php $x = 0;
	while( $query->have_posts() ) { $x++;
	global $post;
	$numview = get_post_meta( $post->ID, 'views', true  );
	$query->the_post();
	?>	
	<span class="number"><?php echo $x; ?></span>
	<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
	<!--li>
			<div class="fleft bold italic font-18 width-percent-10 pad-10 pad-l"><?php echo $x; ?></div>
			<div class="fleft font-14 width-percent-85 pad-10 pad-l pad-r ">
				<a target="_parent" href="<?php echo get_permalink(); ?>"><?php echo short_by_word(get_the_title(),5); ?>...</a>
				<span class="hist" style="font-size:10px; color:#999999"><?php echo $numview; ?>x dibaca</span>
			</div>
			<div class="clear"></div>
	</li-->
	<?php } 
	}
?>