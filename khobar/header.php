<?php global $tux_option; ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php tux_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600,800" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Work+Sans:300,400,600,700,900' rel='stylesheet' type='text/css'>
</head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-90640737-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-90640737-1');
</script>
<body >
<div style="position:fixed;width:100%;" id="skinads">
	<div class="main">
	<?php if(!empty($tux_option['tux_left_adcode'])) { ?>
		<div class="fl" style="height:600px;width:90px;left:-97px;position:relative;text-align:right;z-index:999999">
		<?php echo do_shortcode($tux_option['tux_left_adcode']); ?>
		</div>
	<?php } ?>	
	<?php if(!empty($tux_option['tux_right_adcode'])) { ?>
		<div class="fr" style="height:600px;width:90px;right:-97px;position:relative;text-align:left;z-index:999999">	 
		<?php echo do_shortcode($tux_option['tux_right_adcode']); ?>
		</div>
	<?php } ?>	
	</div>
	<div class="cl2"></div>
</div>

<!-- test -->
<div class="header clearfix">
    <div class="clearfix top-nav">
        <div class="main clearfix">
            <ul class="topmenu clearfix">
		<?php wp_nav_menu(array('theme_location'=>'secondary','items_wrap' => '%3$s', 'container_class' => false,'container'=>false,'menu_id' => '','fallback_cb'=> false)); ?>
            </ul>
        </div>
    </div>
    <!-- logo kompascom-->
    <div class="main clearfix header__wrap">
        <div class="clearfix header__row">
            <div class="row col-offset-fluid clearfix">
                <div class="tlogo">
                    <?php if ($tux_option['tux_logo'] != '') { ?>
					<?php if( is_single() ) { ?>
					<a href="<?php echo esc_url( get_bloginfo('url') ); ?>">
					<img src="<?php echo esc_attr( $tux_option['tux_logo'] ); ?>" height="80" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
					<h2 class="hide" itemprop="headline"><?php bloginfo( 'name' ); ?></h2><!-- END #logo -->
					
					<?php } else { ?>
					<a href="<?php echo esc_url( get_bloginfo('url') ); ?>">
					<img src="<?php echo esc_attr( $tux_option['tux_logo'] ); ?>" height="80" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
					<h1 class="hide" itemprop="headline"><?php bloginfo( 'name' ); ?></h1><!-- END #logo -->
					<?php } ?>
					<?php } else { ?>
					<?php if( is_single() ) { ?>
					<h2 id="logo" class="text-logo" itemprop="headline">
					<a href="<?php echo esc_url( get_bloginfo('url') ); ?>"><?php bloginfo( 'name' ); ?></a>
					</h2><!-- END #logo -->
					<?php } else { ?>
					<h1 id="logo" class="text-logo" itemprop="headline">
					<a href="<?php echo esc_url( get_bloginfo('url') ); ?>"><?php bloginfo( 'name' ); ?></a>
					</h1><!-- END #logo -->
					<?php } ?>
					<?php } 
					date_default_timezone_set('Asia/Jakara');
					//$my_date = date('Y-m-d');
					$my_date = gmdate("Y-m-d H:i:s", time()+60*60*7);
					?>        
                </div>
                <div class="header_search">
                    <form class="search search--header col-bs12-8 col-offset-0" action="<?php echo get_bloginfo('url'); ?>">
                        <input class="form__input form__input__header" id="search" type="text" name="s" placeholder="Search">
                        <input class="form__button form__button__header" type="submit">
                        <span class="search--icon">
                           <i class="fa fa-search"></i>
                        </span>
                    </form>
                     
                </div>
            </div>
        </div>
    </div>
    <!-- nav-->
    <div class="js-nav-offset"></div>
    <div class="row clearfix nav">
        <div class="container clearfix nav__wrap">
            <div class="logo logo--sticky">
                <a href="index.html">
				<?php if ($tux_option['tux_logo'] != '') { ?>
				<img src="<?php echo esc_attr( $tux_option['tux_logo'] ); ?>" alt="www.kompas.com" />
				<?php } ?>
				</a>
            </div>
			<div class="main-menu">
    <div>
	 <ul class="nav__row clearfix">
	<?php wp_nav_menu(array('theme_location'=>'primary','items_wrap' => '%3$s', 'container_class' => false,'container'=>false,'menu_id' => '','fallback_cb'=> false)); ?>
	</ul>
	</div>
</div>
               
        </div>
    </div>
</div>
<!-- end tes -->


<div class="main">
	<?php if(!empty($tux_option['tux_header_adcode'])&&!is_single()) { ?>
		<div class="pos_rel">
			<div id='div-Top-Leaderboard' class="ovh" style='width:auto;text-align:center;'>
			<?php echo do_shortcode($tux_option['tux_header_adcode']); ?>
			</div>
			<div class="cl2"></div>
		</div> 		
	<?php } ?>			
		
<div id="fixposmenu"></div>

<div class="slideout-menu">
	<h3>Menu <a href="#" class="slideout-menu-toggle"><i class="fa fa-times"></i></a></h3>
	<ul class="mobile-menu">
	<li class="home"><a href="<?php echo get_bloginfo('url'); ?>" title="Home"><span class="fa fa-home"></span> Beranda</a></li>
	<?php wp_nav_menu(array('theme_location'=>'primary','items_wrap' => '%3$s', 'container_class' => false,'container'=>false,'menu_id' => '','fallback_cb'=> false)); ?>	
	</ul>
</div>
<div class="toggle-menu">
	<a href="#" class="slideout-menu-toggle"><i class="fa fa-bars"></i></a>
</div>