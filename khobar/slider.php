<?php
global $tux_option;
	$args = array (
		'posts_per_page'		=> $tux_option['tux_num_slider'],
		'post_status'			=> 'publish',
		'post__in' => get_option('sticky_posts'),
		'ignore_sticky_posts' => 1
	);
	$query = new WP_Query( $args );
?>
<div class="ovh" id="headline"  >
		<div id="slideshow" class="clsslide" style="z-index:0">
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
	}
?>			<div class="pos_abs" style="z-index:9999">
			<div class="pos_abs ovh hlover" >
			<div class="cl2">&nbsp;</div>
<h4 class="hlover_topix f16 red"><?php echo tux_the_category(', '); ?></h4>
<div class="pt5"></div>						
			<h2 class="hlover_title"><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="txt-oev-2"><?php echo get_the_title(); ?></a></h2>
				</div>
				<a style="display:block" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
				<img src='<?php echo $thumbnail; ?>' height='493' width='735' class='al' alt='<?php echo get_the_title(); ?>' /></a>
			</div>
<?php } ?>				
				</div>

</div>
<div class="navthumb ovh bgwhite pos_rel" style="height:215px;overflow:hidden; " >
<div id="bx-pager" style="">
<?php
$i=0;
	while( $query->have_posts() ) {
	$i++;
	$query->the_post();
	$excerpt_text = short_by_word( get_the_excerpt(), 20 );
	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'post-slider-small' );
	if($img_src[0]!='') {
		$thumbnail = $img_src[0];
	}
	else {
		$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
	}
?>
	<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="ovh tsa2 pos_rel hladvthumb" data-slide-index="<?php echo $i-1;?>" style="height:215px">
		<div class="ovh imgthumbhl" style="height:124px;" title="<?php echo get_the_title(); ?>"><img width="188" height="124" src='<?php echo $thumbnail; ?>' /></div>
		<div class="ovh f11 ac cl2 pa5" style="height:75px;font-size:14px;"><?php echo get_the_title(); ?></div>
	</a>
<?php } ?>			
</div>
</div>
<div class="cl2"></div>    