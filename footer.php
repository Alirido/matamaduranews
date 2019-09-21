<?php global $tux_option;?>
<div style="padding: 10px 0px 0px; background: lightskyblue">
    <div class="footer-top main" style="background: dodgerblue; margin: 10px 20px;">
        <?php if ( is_active_sidebar( 'home-footer-widget' ) ) : ?>
            <?php dynamic_sidebar( 'home-footer-widget' ); ?>
        <?php endif; ?>
    </div>
    <div class="footer-bottom" style="background: red">
        <div>
            <?php if ($tux_option['tux_logo'] != '') { ?>
                <div>
                    <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_attr( $tux_option['tux_logo'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>
            <?php } ?>
        </div>
        <div>
            <div>
                <div style="text-align: right">
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

