<?php
	function posts_terbaru() {
	// WP_Query arguments
	$args = array (
		'posts_per_page'		=> 12,
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> true
	);
	$query = new WP_Query( $args );
	?>
	<div class="blocking m10-b" style="border-top: 5px solid #dfdfdf;">
	<h2 class="title top p10-t">Berita Terbaru<span class="more indeks-terkini"><a href="<?php echo get_index();?>">Indeks</a></span></h2>
	<ul class="list-terkini">
	<?php
	while( $query->have_posts() ) {
	$query->the_post();
	$excerpt_text = short_by_word( get_the_excerpt(), 20 );

	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'post-slider-large' );
	if($img_src[0]!='') {
		$thumbnail = $img_src[0];
	}
	else {
		$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
	}	
	
	
	?>	
	<li>
		<div class="box-gambar">
		<a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
			<img class="img-150" src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
		</a>
		</div>
		<div class="box-text">
			<h5 class="kanal"><?php echo get_the_category_list( ', ' ); ?></h5>
			<h5 class="waktu"><?php echo get_the_date(); ?></h5>
			<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
			<p><?php echo $excerpt_text; ?></p>
		</div>
	</li>	
	<?php } ?>
	</ul>
	</div>
	<?php
	}
?>