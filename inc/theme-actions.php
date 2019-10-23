<?php
function tux_the_category( $separator = ', ' ) {
    $categories = get_the_category();
    $count = count($categories);
    if( !empty($categories) ) {
        echo '<span class="thecategory">';
        foreach ( $categories as $i => $category ) {
            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( __( "View all posts in %s", 'tuxtheme' ), esc_attr( $category->name ) ) . '" ' . ' itemprop="articleSection">' . esc_html( $category->name ).'</a>';
            if ( $i < $count - 1 )
                echo $separator;
        }
        echo '</span>';
    }
}?>

<?php
function tux_archive_post2( $j,$layout = '' ) {
    global $post,$tux_option, $wp_query;
    $excerpt_text = short_by_word( get_the_excerpt(), 20 );
    $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'postmedium' );

    if($img_src[0]!='') {
        $thumbnail = $img_src[0];
    }
    else {
        $thumbnail = get_template_directory_uri().'/images/no-image-available.png';
    }
    $cur = $wp_query->current_post;
    $page  = max( 1, get_query_var( 'paged' ) );
    $ppp   = get_query_var('posts_per_page');
    $start = $ppp * ( $page - 1 ) + 1;
    $end   = $start + $wp_query->post_count - 1;
    $no = ($start+$cur)-1;
    if($j==1) {
        ?>
        <div id="headline" class="ovh pos_rel" style="clear:both; display:block;">
            <div class="" style="display:block">
                <div class="pos_abs hlover">
                    <h2 class="hlover_title">
                        <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
                    </h2>
                </div>
                <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                    <img src="<?php echo tux_get_thumbnail_url('post-slider-medium'); ?>" height="493" width="735" class="al" alt="<?php echo get_the_title(); ?>"></a>
            </div>
            <div class="pos_abs" style="top:0px;left:0px">
                <h3 class="f20 white p510 bgblue f800">
                    <?php
                    if(is_tag()) {
                        $tag = get_queried_object();
                        echo ucwords(str_replace("-"," ",$tag->slug));
                    }
                    else {echo get_the_category_list( ', ' ); }
                    ?>

                </h3>
            </div>
        </div>
    <?php } else { ?>
        <li <?php post_class('p1520 art-list pos_rel'); ?> data-sort="1" style="clear:both; display:block;">
            <div class="mr3 fr mt5 pos_rel">
                <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                    <img src="<?php echo $thumbnail; ?>" class="shou2 bgwhite" height="111" width="148" alt="teluk-borgo_20161004_111126.jpg" />
                </a>
            </div>
            <div class='mr180'>
                <h3><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="f20 ln24 fbo txt-oev-2"><?php echo get_the_title(); ?></a></h3>
                <div class=""><?php echo $excerpt_text; ?></div>
                <div class="pt5 grey">
                    <span><?php echo get_the_category_list( ', ' ); ?></span>
                    <span class="fa fa-clock-o mr5 ml7"></span><?php $my_date = get_the_time('Y-m-d', '', '', FALSE); ?>
                    <time class="foot timeago" title="<?php echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);?>">
                        <?php echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);?> WIB </time>
                </div>

            </div>
            <div class="cl2"></div>
        </li>
        <?php
    }
    wp_reset_postdata();
}
?>
<?php
function tux_pagination($pages = '', $range = 3) {
    $tux_options = get_option(TUX_THEME_NAME);
    // numeric pagination
    $showitems = ($range * 3)+1;
    global $paged; if(empty($paged)) $paged = 1;
    if($pages == '') {
        global $wp_query; $pages = $wp_query->max_num_pages;
        if(!$pages){ $pages = 1; }
    }
    if(1 != $pages) {
        echo '<div class="pagination pagination-numeric"><ul style="display: flex;flex-direction: row;">';

        if($paged > 2 && $paged > $range+1 && $showitems < $pages)
            echo "<li><a rel='nofollow' href='".esc_url( get_pagenum_link(1) )."'><i class='fa fa-angle-double-left'></i> ".__('First','tuxtheme')."</a></li>";
        if($paged > 1 && $showitems < $pages)
            echo "<li><a rel='nofollow' href='".esc_url( get_pagenum_link($paged - 1) )."' class='inactive'><i class='fa fa-angle-left'></i> ".__('Prev','tuxtheme')."</a></li>";
        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a rel='nofollow' href='".esc_url( get_pagenum_link($i) )."' class='inactive'>".$i."</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<li><a rel='nofollow' href='".esc_url( get_pagenum_link($paged + 1) )."' class='inactive'>".__('Next','tuxtheme')."</a></li>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages)
            echo "<li><a rel='nofollow' class='inactive' href='".esc_url( get_pagenum_link($pages) )."'>".__('Last','tuxtheme')."</a></li>";

        echo '</ul></div>';
    }

}
?>
<?php
function tux_indo_date($date=null)
{
    date_default_timezone_set('Asia/Jakara');
    //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
    $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Ahad');
    //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
    $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
        'September','Oktober', 'November','Desember');
    if($date == null) {
        //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
        $hari = $array_hari[date('N')];
        $tanggal = date ('j');
        $bulan = $array_bulan[date('n')];
        $tahun = date('Y');
    } else {
        //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
        $date = strtotime($date);
        $hari = $array_hari[date('N',$date)];
        $tanggal = date ('j', $date);
        $bulan = $array_bulan[date('n',$date)];
        $tahun = date('Y',$date);
    }
    $formatTanggal = $hari . ", " . $tanggal ." ". $bulan ." ". $tahun;
    return $formatTanggal;
}
?>
