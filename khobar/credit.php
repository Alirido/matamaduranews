<?php global $tux_option; ?>
<div class="f12 mb15" >
	<div class="footer">
		<h5><?php if(!empty($tux_option['tux_copyrights'] )) { echo $tux_option['tux_copyrights']; } else { ?>
			&copy; <?php echo date('Y'); ?> - <span class="red">Theme by <a href="http://tuxtheme.com" />Tuxtheme</a></span>
			<?php } ?></h5>
	<ul>
		<?php wp_nav_menu(array('theme_location'=>'footer','items_wrap' => '%3$s', 'container_class' => false,'container'=>false,'menu_id' => '','fallback_cb'=> false)); ?>
	</ul>		
	</div>
</div>