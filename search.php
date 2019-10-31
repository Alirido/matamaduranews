<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php wp_head();?>
    <script type="text/javascript" src="js/stickyHeader.js"></script>

</head>

<body>
<?php global $tux_option; get_header();?>
    <div class="cl2"></div>
    <div id='div-Top-LargeLeaderboard' class="blt ovh" style="display:none;margin:0px auto 15px;width:auto;height:auto;max-height:250px;text-align:center;"></div>
    <div>
    <div class="content">
    <div class="fl w750">
        <div class="fl w502" style="width:100%">
            <div class="bsh ovh site-main">
                <ul class="lsi" id="latestul">

                    <?php
                    $j = 0;
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); $j++; ?>
                        <?php tux_archive_post2($j); ?>
                    <?php endwhile;
                    else:
                        echo '<li><div class="pertamax">Hasil pencarian untuk <strong>'.$_GET['s'].'</strong> tidak ditemukan!</div></li>';
                    endif;
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
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
                    ) );
                }
                ?>
            <?php } ?>
        </div>
    </div>
    </div>
    <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
</body>
</html>
