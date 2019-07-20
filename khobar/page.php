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
	
	<div id="article_con" class="fl pos_rel">
		<div class="txt-article" >
		<?php the_content(); ?>
		</div>
		<div class="cl2"></div>
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
	<div class="cl2"></div>		
	</div>

	<div class="cl2"></div>
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