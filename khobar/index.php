<?php global $tux_option; get_header();?>
	<div class="cl2"></div>
	<div id='div-Top-LargeLeaderboard' class="blt ovh" style="display:none;margin:0px auto 15px;width:auto;height:auto;max-height:250px;text-align:center;"></div>
	<div class="content">
	<div class="fl w750">
		<?php  if($tux_option['tux_cat_slider_cat']!='0'){ get_template_part('topik'); } ?>
		<?php //get_template_part('home-left'); //sidebar kiri?>
		<div class="fl w502">	
		<?php if($tux_option['tux_post_big_slider']!='0'){ ?>
		<?php echo get_template_part('slider'); ?> 
		<?php } ?> 
		<div class="bsh ovh site-main">
			<ul class="lsi" id="latestul">
			<?php 
			$j = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); $j++;
			if(!in_array($post->ID,get_option( 'sticky_posts' ))) {
			?>
            <?php tux_archive_post($j);
			}
			 ?>
            <?php endwhile; endif;
			?>						
			</ul>			
		</div>
			<?php $pgn=$tux_option['tux_paginate'];
			if ( $j !== 0 ) { // No pagination if there is no posts ?>
			<?php 
			if($pgn==0) {
			tux_pagination(); 			
			}
			else {
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tuxtribune' ) . ' </span>',
			) );
			}
			?>
			<?php } ?>
	</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>