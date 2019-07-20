<?php global $tux_option;
if( $tux_option['tux_cat_slider'] == 1 && !empty($tux_option['tux_cat_slider_cat']) ) { ?>
<div>
	<div>
<div class="bsh mb20 pos_rel ovh" id="box2c" style="height:130px">
	<div class="fbo f16 red p1020 bsht wfull" style="position:absolute">&nbsp;
	</div>
	<?php 
	$topik_cat = $tux_option['tux_cat_slider_cat'];
	$num = count($topik_cat);
	//$cat_query = new WP_Query('cat='.$topik_cat.'&posts_per_page=10'); 
	?>		
	<div id="topil" class="">
	<?php $a = 0; 
	foreach ($topik_cat as $cat) { $a++;
	?>
		<div id="topik_<?php echo $a;?>" class="w677">	
			<h2 class="f400 f22 red p520">
			<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" title="<?php echo get_cat_name($cat); ?>"><?php echo get_cat_name($cat); ?></a></h2>		
<?php
 $args=array(
 'cat' => $cat,
 'ignore_sticky_posts'=>1,
 'posts_per_page'=>3,
 );
  $cat_query = new WP_Query($args);
  $count = 0;
?>
			<div class="ptb15 plr20">
			<?php if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); $count++;
			$excerpt_text = short_by_word( get_the_excerpt(), 20 );
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'widgetthumb' );
			if($img_src[0]!='') {
			$thumbnail = $img_src[0];
			}
			else {
			$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
			}
		 	?>
			<div class="fl topilitm pr10" style="width:32%">
				<div class="fl mr10 cright mt3">
				<a href="<?php the_permalink(); ?>" class="fbo2 f14" title="<?php echo get_the_title(); ?>"><img src="<?php echo $thumbnail; ?>" class="bgwhite" height="90" width="120" style="height:auto!important;width:100px!important" alt="<?php echo get_the_title(); ?>" /></a>
				</div>
				<div>
					<h3><a href="<?php the_permalink(); ?>" class="fbo2 f15 ln20 txt-oev-3" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
					<!--div class="grey pt2 pb5">
					<?php //$my_date = get_the_time('Y-m-d', '', '', FALSE); ?>
					<span class="fa fa-clock-o mr5"></span><time class="timeago" title="<?php //echo $my_date;?>"><?php //echo tux_indo_date($my_date);?></time></div-->
				</div>	
				<div class="cl2"></div>
			</div>
			<?php endwhile; endif; ?>
			<div class="cl2"></div>
			</div>
		
		</div>
	<?php } ?>	
	</div>
	<div id="navtopil" class="navhl" style="z-index:1;margin-top:7px">
	<?php $x = 0; 
	foreach ($topik_cat as $tp) { $x++; ?>
		<a data-slide-index="<?php echo $x-1;?>" title="Topik <?php echo $x;?>"></a>					
	<?php } ?>	
	</div>
</div>
</div>
			<div class="cl2"></div>
		</div>
<?php } ?>		