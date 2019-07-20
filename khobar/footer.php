</div></div>
<?php global $tux_option; ?>
<div class="footer clearfix">
    <div class="row footer__top main clearfix">
	<?php if ( is_active_sidebar( 'home-footer-widget' ) ) : ?>
	<?php dynamic_sidebar( 'home-footer-widget' ); ?>
	<?php endif; ?>

    </div>
    <div class="row footer__bottom main clearfix">
      <div class="col-bs10-3" style="margin-left:0px;padding-left: 0px;">
	   <?php if ($tux_option['tux_logo'] != '') { ?>
            <div class="logo">
                <a href="<?php echo esc_url( home_url() ); ?>">
				<img src="<?php echo esc_attr( $tux_option['tux_logo'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				</a>
            </div>
		<?php } ?>	
        </div>
      <div class="col-bs10-7">
            <div class="text-right clearfix">
			<div class="footer__copy clearfix">
			<?php if(!empty($tux_option['tux_copyrights'] )) { echo $tux_option['tux_copyrights']; } else { ?>
			Copyright &copy; <?php echo date('Y'); ?> - <span class="red">Theme by <a href="http://tuxtheme.com" />Tuxtheme</a></span>
			<?php } ?>
			</div>
            </div>
        </div>
    </div>
</div>


<div class="ontop hide"><i class="fa fa-arrow-circle-up"></i></div>
<div class="pos_rel" id="adspop">
<div id="adplusedgyvideo" style="position:fixed;right:5px;bottom:20px;width:1px;height:1px;"></div>
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/slick.min.js" defer></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/general.js" defer></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.fancybox.pack.js" defer></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.bxslider.mini.js" defer></script>
<?php wp_footer(); ?>

<script type="text/javascript">

<?php if(!is_single()){ ?>
//left sidebar
jQuery(document).ready(function($){
	moveScroller_sec();
});
//home slider
jQuery(document).ready(function($){
	home_slider();
}); 
var ia = 1;
var ibc = 1;
//topik slider
jQuery(document).ready(function($){
    $('#topil').bxSlider({
		pagerCustom: '#navtopil',
		autoHover: true,
		pagerEvent:'mousemove',
		controls:false
    });
}); 
<?php } ?>
jQuery(document).ready(function($){
	//moveScroller_menu();
});
<?php if(is_single()){ ?>
jQuery(document).ready(function($){
	//moveScroller3();
});
jQuery(document).ready(function($){
	//moveScroller2();
});
<?php } ?>

</script>
</body>
</html>