<?php
	function posts_terkomentari2() {
	// WP_Query arguments
	$args = array (
		'posts_per_page'		=> 5,
		'orderby'				=> 'comment_count',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> true
	);
	$query = new WP_Query( $args );
	?>
	<h2 class="title">Terkomentari</h2>
	<ul class="list-text">
	<?php
	while( $query->have_posts() ) {
	$query->the_post();
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = '0 Komentar';
		}
		elseif ( $num_comments > 1 ) {
			$comments = $num_comments . 'Komentar';
		}
		else {
			$comments = '1 Komentar';
		}
	}
	else {
		$comments = '';
	}	
	?>	
	<li>
	<h4><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
	<span class="jumlah_komentar"><?php echo $comments; ?></span></li>
	<?php } ?>
	</ul>
	<?php
	}
?>