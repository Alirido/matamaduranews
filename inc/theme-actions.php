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

<?php function tux_related_posts() {
        global $post,$tux_option;
           $empty_taxonomy = false;
                // related posts based on tags
                $tags = get_the_tags($post->ID);
                if (empty($tags)) {
                    $empty_taxonomy = true;
                } else {
                    $tag_ids = array();
					foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id;
                    }
                    $args = array( 'tag__in' => $tag_ids,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 2,
                        'ignore_sticky_posts' => 1,
                        'orderby' => 'rand'
                    );
					$split = array('tag__in' => $tag_ids);
                }

            if (!$empty_taxonomy) {
    		$my_query = new WP_Query( $args ); if( $my_query->have_posts() ) {
    			echo '<div class="mb10">';
                echo '<div class="f16 fbo2 pb10"><span class="fbo2 grey">Baca Juga</span></div> ';
                echo '<div class="f14"><ul>';
                $posts_per_row = 3;
                $j = 0;

    			while( $my_query->have_posts() ) { $my_query->the_post(); ?>
    			<li class="pb7">
					<h3><a href="<?php echo esc_url( get_the_permalink() ); ?>" class="fbo2 f15" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h3>
                </li><!--.post.excerpt-->
    			<?php } echo '</ul></div></div>';
	wp_reset_postdata();

    }
			}

		$args_pic=array(
					'post_type' => 'video',
					'ignore_sticky_posts'=>1,
					'posts_per_page'=>1,
					//'orderby' => 'rand',
					);
		$loop_vid = new WP_Query(array_merge($args_pic,$split));
		if($loop_vid->have_posts()) {
			while ( $loop_vid->have_posts() ) : $loop_vid->the_post();
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'postlarge' );
			if($img_src[0]!='') {
				$thumbnail = $img_src[0];
			}
			else {
				$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
			}
				?>
			<div class="mt20 f16 fbo2 pb5">
			<a href="<?php echo esc_url( get_bloginfo('url') ); ?>/video" class="grey" title="Video Pilihan">Video Pilihan</a>: <a class="" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a>
			</div>
			<div class="pos_rel" style="display: block; position: relative; max-width: 100%;">
	<a class="show" href="<?php echo esc_url( get_the_permalink() ); ?>" style="width:550px;height:292px;background:url(<?php echo $thumbnail; ?>);background-size:100%">
		<span class="hide"><?php echo esc_attr( get_the_title() ); ?></span>
		<i class="fa fa-play fa-3x playoverlay playoverlay-c" style="border-radius:30px;padding:10px 15px;opacity:0.8"></i>
	</a>
</div>

				<?php
				endwhile;
			}


}

/*------------[ breadcrumb ]-------------*/

function tux_the_breadcrumb() {
    echo '<ul typeof="v:Breadcrumb" class="block-kanal-map"><li><a rel="v:url" property="v:title" href="';
    echo home_url();
    echo '" rel="nofollow">'.sprintf( __( "Home","tuxtheme"));
    echo '</a></li>';
    if (is_single()) {
        $categories = get_the_category();
        if ( $categories ) {
            $level = 0;
            $hierarchy_arr = array();
            foreach ( $categories as $cat ) {
                $anc = get_ancestors( $cat->term_id, 'category' );
                $count_anc = count( $anc );
                if (  0 < $count_anc && $level < $count_anc ) {
                    $level = $count_anc;
                    $hierarchy_arr = array_reverse( $anc );
                    array_push( $hierarchy_arr, $cat->term_id );
                }
            }
            if ( empty( $hierarchy_arr ) ) {
                $category = $categories[0];
                echo '<li typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></li>';
            } else {
                foreach ( $hierarchy_arr as $cat_id ) {
                    $category = get_term_by( 'id', $cat_id, 'category' );
                    echo '<li typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></li>';
                }
            }
        }
        // echo "<li class='end_slug'><span>";
        // the_title();
        // echo "</span></li>";
    } elseif (is_page()) {
        global $post;
        if ( $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ( $parent_id ) {
                $page = get_page( $parent_id );
                $breadcrumbs[] = '<li typeof="v:Breadcrumb"><a href="'.esc_url( get_permalink( $page->ID ) ).'" rel="v:url" property="v:title">'.esc_html( get_the_title($page->ID) ). '</a> <i class="fa fa-angle-right"></i></li>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            foreach ( $breadcrumbs as $crumb ) { echo $crumb; }
        }
        echo "<li><span>";
        the_title();
        echo "</span></li>";
    } elseif (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $this_cat_id = $cat_obj->term_id;
        $hierarchy_arr = get_ancestors( $this_cat_id, 'category' );
        if ( $hierarchy_arr ) {
            $hierarchy_arr = array_reverse( $hierarchy_arr );
            foreach ( $hierarchy_arr as $cat_id ) {
                $category = get_term_by( 'id', $cat_id, 'category' );
                echo '<div typeof="v:Breadcrumb"><a href="'.esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></div><div><i class="fa fa-angle-right"></i></div>';
            }
        }
        echo "<div><span>";
        single_cat_title();
        echo "</span></div>";
    } elseif (is_author()) {
        echo "<div><span>";
        if(get_query_var('author_name')) :
            $curauth = get_user_by('slug', get_query_var('author_name'));
        else :
            $curauth = get_userdata(get_query_var('author'));
        endif;
        echo esc_html( $curauth->nickname );
        echo "</span></div>";
    } elseif (is_search()) {
        echo "<div><span>";
        the_search_query();
        echo "</span></div>";
    } elseif (is_tag()) {
        echo "<div><span>";
        single_tag_title();
        echo "</span></div>";
    }
    echo '</ul>';
}

/*------------[ schema.org-enabled the_category() and the_tags() ]-------------*/

function tux_the_tags($before = '', $sep = ' ', $after = '') {
    $before = '<div class="fbo2 pr10 tag_article_teaser fl">'.__('Tag:</div>', 'tuxtheme');
    $after = '';

    $tags = get_the_tags();
    if (empty( $tags ) || is_wp_error( $tags ) ) {
        return;
    }
    $tag_links = array();
    foreach ($tags as $tag) {
        $link = get_tag_link($tag->term_id);
        $tag_links[] = '<h5 class="tagcloud3"><a href="' . esc_url( $link ) . '" rel="tag" itemprop="keywords">' . $tag->name . '</a></h5>';
    }
    echo $before.join($sep, $tag_links).$after;
}

function tux_related_posts_cat($tipe='post') {
    global $post,$tux_option;
    $empty_taxonomy = false;
    // related posts based on categories
    $categories = get_the_category($post->ID);
    if (empty($categories)) {
        $empty_taxonomy = true;
    } else {
        $category_ids = array();
        foreach($categories as $individual_category)
            $category_ids[] = $individual_category->term_id;
        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' =>5,
            //'ignore_sticky_posts' => 1,
            //'orderby' => 'rand'
        );
        if($tipe=='video') {

            $args = array(
                'post_type' => 'video',
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' =>5,
                //'ignore_sticky_posts' => 1,
                //'orderby' => 'rand'
            );
        }
        if($tipe=='gallery') {

            $args = array(
                'post_type' => 'gallery',
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' =>5,
                //'ignore_sticky_posts' => 1,
                //'orderby' => 'rand'
            );
        }

        $split = array('category__in' => $category_ids);
    }


    if (!$empty_taxonomy) {
        $my_query = new WP_Query( $args ); if( $my_query->have_posts() ) {
            echo '<div class="bsh ovh artoht">';
            if($tipe=='video') {
                echo '<h2 class="f22 bsht">VIDEO TERKAIT</h2>';
            }
            else if($tipe=='gallery') {
                echo '<h2 class="f22 bsht">FOTO TERKAIT</h2>';
            }
            else {
                echo '<div class="terkait"><h2 class="f22 bsht">REKOMENDASI UNTUK ANDA</h2></div>';
            }
            echo '<div style="padding:20px 0 0px!important">';
            $posts_per_row = 3;
            $j = 0;

            while( $my_query->have_posts() ) { $my_query->the_post();
                $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'widgetmedium' );
                if($img_src[0]!='') {
                    $thumbnail = $img_src[0];
                }
                else {
                    $thumbnail = get_template_directory_uri().'/images/no-image-available.png';
                }


                ?>
                <div class="fl mr10 artohtitm ovh">
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                        <div class="pos_rel">
                            <img src="<?php echo $thumbnail;?>" width="163" height="113" class="shou2" alt="<?php echo esc_attr( get_the_title() ); ?>">
                        </div>
                    </a>
                    <div><h3 class="f14"><a href="<?php echo esc_url( get_the_permalink() ); ?>" class="f14" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h3></div>
                </div><!--.post.excerpt-->
            <?php } echo '<div class="cl2"></div></div></div>';
            wp_reset_postdata();
        }
    }
}

?>
