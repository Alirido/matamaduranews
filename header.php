<?php global $tux_option ?>

<div class="theader">
    <div class="header__top">
        <ul class="top_menu" style="margin: 0px">
            <?php wp_nav_menu(array('theme_location' => 'secondary', 'items_wrap' => '%3$s', 'container_class' => false, 'container' => false, 'menu_id' => '', 'fallback_cb' => false)); ?>
        </ul>
    </div>
    <div class="header__mid clearfix main">
        <div class="header__mid-content main clearfix">
            <div class="logo">
                    <?php if ($tux_option['tux_logo'] != '') { ?>
                        <?php if (is_single()) { ?>
                            <a href="<?php echo esc_url(get_bloginfo('url')); ?>">
                                <img src="<?php echo esc_attr($tux_option['tux_logo']); ?>" height="80"
                                     alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            <h2 class="hide" itemprop="headline"><?php bloginfo('name'); ?></h2><!-- END #logo -->

                        <?php } else { ?>
                            <a href="<?php echo esc_url(get_bloginfo('url')); ?>">
                                <img src="<?php echo esc_attr($tux_option['tux_logo']); ?>" height="80"
                                     alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
                            <h1 class="hide" itemprop="headline"><?php bloginfo('name'); ?></h1><!-- END #logo -->
                        <?php } ?>
                    <?php } else { ?>
                        <?php if (is_single()) { ?>
                            <h2 id="logo" class="text-logo" itemprop="headline">
                                <a href="<?php echo esc_url(get_bloginfo('url')); ?>"><?php bloginfo('name'); ?></a>
                            </h2><!-- END #logo -->
                        <?php } else { ?>
                            <h1 id="logo" class="text-logo" itemprop="headline">
                                <a href="<?php echo esc_url(get_bloginfo('url')); ?>"><?php bloginfo('name'); ?></a>
                            </h1><!-- END #logo -->
                        <?php } ?>
                    <?php }
                    date_default_timezone_set('Asia/Jakara');
                    //$my_date = date('Y-m-d');
                    $my_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
                    ?>
            </div>
            <div>
                <form class="header_search" action="<?php echo get_bloginfo('url'); ?>">
                    <input class="form__input form__input__header" id="search" type="text" name="s" placeholder="Search">
                    <input class="form__button form__button__header" type="submit">
                    <span class="search--icon">
                           <i class="fa fa-search"></i>
                        </span>
                </form>
            </div>
        </div>
    </div>

    <div class="js-nav-offset"></div>
    <div class="header__bottom">
        <ul class="nav__row clearfix ">
            <?php wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '%3$s', 'container_class' => false, 'container' => false, 'menu_id' => '', 'fallback_cb' => false)); ?>
        </ul>
    </div>
</div>
