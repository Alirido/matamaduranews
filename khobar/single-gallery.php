<?php get_header();?>
<div class="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php tux_the_breadcrumb(); ?></div>
<h1 class="read_title" style="line-height:110%" id="arttitle"><?php the_title(); ?></h1>

<div class="fl w750">
<?php if (tux_get_thumbnail_url()) : ?>
<meta itemprop="image" content="<?php echo tux_get_thumbnail_url(); ?>" />
<?php endif; ?>
		
<div class="bsh mb20" id="va">
	<div class="pos_rel" id="article" >
		<div class="f14 author fl w320">
		<?php the_author_posts_link(); ?>
		<?php //tux_the_category(', ') ?>
		<div class="mt5">
		<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
		// the_time( get_option( 'date_format' ) );
		echo '<time class="grey timeago" style="display: inline-block;">'.tux_indo_date($my_date).'</time>';
		echo '&nbsp;&nbsp;<span class="grey view">'.setPostViews($post->ID); echo 'Dibaca : '.get_post_meta($post->ID,'views',true).' kali</span>';
		?>
		</div>
		</div>
		<div class="social social--article fr w320 ar">
		<a href='javascript:void(0);' onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');" class="ac white rd2 mb10 f16 dip" style="background: #3b5998;width: 35px;padding: 8px 2px;margin-right:5px;border-radius: 100%;"><i class="fa fa-facebook fa-lg"></i></a>
		
		<a href='javascript:void(0);' onClick="window.open('https://twitter.com/intent/tweet?original_referer=<?php echo get_the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo get_the_permalink(); ?>&amp;via=tribunnews', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');" class="ac white rd2 mb10 f16 dip" style="background: #4099ff;width: 35px;padding: 8px 2px;margin-right:5px;border-radius: 100%;"><i class="fa fa-twitter fa-lg"></i></a>

	
		<a href='javascript:void(0);' onClick="window.open('https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');" class="ac white rd2 mb10 f16 dip" style="background: #d34836;width: 35px;padding: 8px 2px;margin-right:5px;border-radius: 100%;"><i class="fa fa-google-plus fa-lg"></i></a>

		<a href='javascript:void(0);' onClick="window.open('http://www.pinterest.com/pin/create/button/?url=<?php echo get_the_permalink(); ?>&amp;media=<?php echo tux_get_thumbnail_url(); ?>&amp;description=<?php the_title(); ?>', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');" class="ac white rd2 mb10 f16 dip" style="background: #bd081c;width: 35px;padding: 8px 2px;margin-right:5px;border-radius: 100%;"><i class="fa fa-pinterest fa-lg"></i></a>
		
<span href="#" style="background:#aaaaaa;width: 35px;padding: 8px 2px;border-radius: 100%;cursor:pointer;display: inline-table;" class="ac white rd2 mb10 f16 show" onClick="fbox('#shareother','Share','inline')" title="Share"><i class="fa fa-share-alt fa-lg"></i></span>	
		
		</div>
		<div class="lsi hide w250 f15 f600" id="shareother">
	<ul>
		<li class="ptb5"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>&amp;t=<?php the_title(); ?>" title="Facebook" target="_blank">Facebook</a></li>
		<li class="ptb5"><a href="https://twitter.com/intent/tweet?original_referer=<?php echo get_the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;url=<?php echo get_the_permalink(); ?>&amp;via=tribunnews" title="Twitter" target="_blank">Twitter</a></li>
		<li class="ptb5"><a href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>" title="Google Plus" target="_blank">Google+</a></li>
        <li class="ptb5"><a href="http://www.pinterest.com/pin/create/button/?url=<?php echo get_the_permalink(); ?>&amp;media=<?php echo tux_get_thumbnail_url(); ?>&amp;description=<?php the_title(); ?>" title="Pinterest" target="_blank">Pinterest</a></li>
		<li class="ptb5"><a href="http://digg.com/submit?url=<?php echo get_the_permalink(); ?>&amp;title=<?php the_title(); ?>" title="Digg" target="_blank">Digg</a></li>
		<li class="ptb5"><a href="http://delicious.com/save?jump=yes&amp;url=<?php echo get_the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;notes=<?php the_title(); ?>.&amp;via=tribunnews.com" title="Delicious" target="_blank">delicious</a></li>
		<li class="ptb5"><a href="http://reddit.com/submit?url=<?php echo get_the_permalink(); ?>&amp;title=<?php the_title(); ?>" title="reddit" target="_blank">reddit</a></li>
		<li class="ptb5"><a href="http://www.stumbleupon.com/submit?url=<?php echo get_the_permalink(); ?>&amp;title=<?php the_title(); ?>" title="StumbleUpon"  target="_blank">StumbleUpon</a></li>
		<li class="ptb5"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=<?php the_title(); ?>.&amp;source=<?php echo get_bloginfo('url');?>"  title="LinkenIn" target="_blank">LinkedIn</a></li>
	</ul>
</div>
	<div id="article_con" class="fl pt20 pos_rel">
			<div id="artimg">
			<div class="pb20 ovh">
			<div class="ovh imgfull_div">
			<img style="float:none;height:auto" class="imgfull" src="<?php echo tux_get_thumbnail_url('postlarge'); ?>" width='730' height='480' alt="<?php echo get_the_title(); ?>" /></div>
			<div class="cl2"></div>
			<div class="f11 white pa3 fr pos_rel ar" style="margin-top: -22px;background: rgba(0,0,0,.5);"><?php echo get_the_title();?></div>
			<div class="cl2"></div>
			<div class="arial f12 pt5 grey2"><?php tux_get_thumbnail_caption(); ?></div>
			</div>
			</div>
			<div class="cl2 mr20 fl cright w160 mb20" id="articleright">
	
			<div id="fixads"></div>
				<div id="wideskyscraper" class="bggrey" style="height:600px;width:160px;padding:0px;z-index:1">
					<?php if(!empty($tux_option['tux_post_left_adcode'])) { ?>
								<?php echo do_shortcode($tux_option['tux_post_left_adcode']); ?>
							<?php } ?>	
				</div>
			</div>
	
			<div class="side-article txt-article" >
			<?php the_content(); ?>
			</div>
			<div class="side-article mb5" >
			<div class="f12 grey mb15" >
				<div>Editor: <?php the_author_posts_link(); ?></div>
			</div>

			<div class="mb10 f16 ln24 mb10 mt5" style="display:inline-block">
			<?php tux_the_tags(); ?>
			<div class="cl2"></div>	
			</div>
			
			<?php //tux_related_posts(); ?> 
			</div>
			<div id="fixsharebottom"></div>
			<div class="cl2"></div>
		</div>		
	<div class="cl2"></div>
	</div>
</div>

<div class="bsh ovh mb20 artoht" id="criteo-365464" style="display:none"></div>
<?php tux_related_posts_cat('gallery'); ?>

<div class="bsh mb20 artoht" id="comments">
	<div class="terkait">
	<div class="f22 bsht" style="padding:10px 0px;">KOMENTAR</div>
	</div>
	<div class="comment" style="padding:20px 0">
		<div class="fb-comments" data-href="<?php echo get_the_permalink(); ?>" data-numposts="20" data-colorscheme="light" data-width="100%"></div>
		<?php comments_template( '', true );  ?>
	</div>
</div>

<div id="latestul">
	<div data-sort='0' style="display:none"></div>	
</div>
</div>
<?php endwhile;?>		
<?php get_sidebar('single'); ?>
</div>
</div>

<?php get_footer(); ?>