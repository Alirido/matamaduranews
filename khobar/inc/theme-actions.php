<?php
$tux_options = get_option(TUX_THEME_NAME);
if ( ! function_exists( 'dev_info' ) ||  ! function_exists( 'tuxvalidator_add_pages' )) :
return;
endif;
/*------------[ Meta ]-------------*/
function tux_meta(){
	global $tux_options, $post;
?>
<?php if ( !empty( $tux_options['tux_favicon'] ) ) { ?>
<link rel="icon" href="<?php echo esc_url( $tux_options['tux_favicon'] ); ?>" type="image/x-icon" />
<?php } ?>
<?php if ( !empty( $tux_options['tux_metro_icon'] ) ) { ?>
    <!-- IE10 Tile.-->
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?php echo esc_attr( $tux_options['tux_metro_icon'] ); ?>">
<?php } ?>
<!--iOS/android/handheld specific -->
<?php if ( !empty( $tux_options['tux_touch_icon'] ) ) { ?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( $tux_options['tux_touch_icon'] ); ?>" />
<?php } ?>
<?php //if ( ! empty( $tux_options['tux_responsive'] ) ) { ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php //} ?>
<?php if($tux_options['tux_prefetching'] == '1') { ?>
<?php if (is_front_page()) { ?>
	<?php $my_query = new WP_Query('posts_per_page=1'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<link rel="prefetch" href="<?php the_permalink(); ?>">
	<link rel="prerender" href="<?php the_permalink(); ?>">
	<?php endwhile; wp_reset_postdata(); ?>
<?php } elseif (is_singular()) { ?>
	<link rel="prefetch" href="<?php echo esc_url( home_url() ); ?>">
	<link rel="prerender" href="<?php echo esc_url( home_url() ); ?>">
<?php } ?>
<?php } ?>
    <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
    <meta itemprop="url" content="<?php echo esc_attr( site_url() ); ?>" />
    <?php if ( is_singular() ) { ?>
    <meta itemprop="creator accountablePerson" content="<?php $user_info = get_userdata($post->post_author); echo $user_info->first_name.' '.$user_info->last_name; ?>" />
    <?php } ?>
<?php }

/*------------[ Head ]-------------*/
function tux_head() {
	global $tux_options;
?>
<?php echo $tux_options['tux_header_code']; ?>
<?php }
add_action('wp_head', 'tux_head');

/*------------[ Copyrights ]-------------*/
function tux_copyrights_credit() { 
	global $tux_options
?>
<!--start copyrights-->
<div class="row" id="copyright-note">
<span><a href="<?php echo esc_url( trailingslashit( home_url() ) ); ?>" title="<?php bloginfo('description'); ?>" rel="nofollow"><?php bloginfo('name'); ?></a> Copyright &copy; <?php echo date("Y") ?>.</span>
<div class="to-top"><?php echo $tux_options['tux_copyrights']; ?></div>
</div>
<!--end copyrights-->
<?php }

/*------------[ footer ]-------------*/
function tux_footer() { 
	global $tux_options;
?>
<?php if ($tux_options['tux_analytics_code'] != '') { ?>
<?php echo $tux_options['tux_analytics_code']; ?>
<?php } ?>
<?php }
add_action('wp_footer', 'tux_footer');
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
}
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

/*------------[ pagination ]-------------*/

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
                echo '<div class="pagination pagination-numeric"><ul>';
                
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


/*------------[ Related Posts by Categories ]-------------*/
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
					<h3><a href="<?php echo esc_url( get_the_permalink() ); ?>" class="f14" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h3>
                </div><!--.post.excerpt-->
    			<?php } echo '<div class="cl2"></div></div></div>';
				wp_reset_postdata();
   				}
			}
}

/*------------[ Related Posts ]-------------*/
function tux_related_posts() {
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

function tux_latest_post() {
		global $post; ?>

	<li>
		<div class="box-text">
			<h5 class="kanal"><?php echo get_the_category_list( ', ' ); ?></h5>
			<h5 class="waktu"><?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
			echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);
			?> WIB</h5>
			<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
		</div>
	</li>	
		
   
        <?php 
    }

/*------------[ Video Lainnya ]-------------*/
function tux_random_video() {
		global $post;
		$args_vid=array(
					'post_type' => 'video',
					'post__not_in' => array($post->ID), 
					'ignore_sticky_posts'=>1,
					'posts_per_page'=>5,
					'orderby' => 'rand',
					);
			$loop_vid = new WP_Query($args_vid);
			if($loop_vid->have_posts()) {
			echo '<div class="blocking m5-b off" style="margin: 0px;"><h2 class="title small">Video Lainnya</h2>
			<ul class="terkait-img">';
			
			while ( $loop_vid->have_posts() ) : $loop_vid->the_post();	
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'postmedium' );
			
			$youtube_url = get_post_meta( $post->ID, 'youtube_url' );
			if($img_src[0]!='') {
				$thumbnail = $img_src[0];
			}
			elseif($youtube_url[0]!='') {
				//$thumbnail = 'http://i.ytimg.com/vi_webp/'.$youtube_url[0].'/maxresdefault.webp';
				$thumbnail = 'https://i.ytimg.com/vi/'.$youtube_url[0].'/hqdefault.jpg';
			}
			else {
			$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
			}	
								
				?>
				<li>
				
					<div class="main_vidieo">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
					<img src="<?php echo $thumbnail; ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="img100" title="<?php echo esc_attr( get_the_title() ); ?>" srcset="" style="width: 150px; height: 85px;">
					<span class="td-video-play-ico">
					<img width="40" height="40" class="td-retina" src="<?php echo get_template_directory_uri();?>/images/ico-video-large.png" alt="video">
					</span>
					</a>
					</div>
					<h4><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
				</li>
				<?php
				endwhile;
				
			echo '</ul></div>';
			}						
	}

function tux_the_postinfo( $section = 'home' ) {
        $tux_options = get_option( TUX_THEME_NAME );
        $opt_key = 'tux_'.$section.'_headline_meta_info';
        
        if ( isset( $tux_options[ $opt_key ] ) && is_array( $tux_options[ $opt_key ] ) && array_key_exists( 'enabled', $tux_options[ $opt_key ] ) ) {
            $headline_meta_info = $tux_options[ $opt_key ]['enabled'];
        } else {
            $headline_meta_info = array();
        }
        if ( ! empty( $headline_meta_info ) ) { ?>
			<div class="block-tanggal">
			<ul>
                <?php if ( !isset( $headline_meta_info['date'] ) ) { // datePublished is reqired in schema ?>
                    <meta itemprop="datePublished" content="<?php the_time( get_option( 'date_format' ) ); ?>">
                <?php } ?>
                <?php foreach( $headline_meta_info as $key => $meta ) { tux_the_postinfo_item( $key ); } ?>
			</ul>
			</div>
		<?php }
    }

function tux_the_postinfo_item( $item ) {
	global $post,$tux_option;
$tipe=$tux_option['tux_layout'];
        switch ( $item ) {
            case 'author':

$author='Author';
if($tipe!='blog') { $author='Reporter';}

            ?>
            <li class="theauthor"><?php echo $author;?>: <span itemprop="author"><?php the_author_posts_link(); ?></li>
            <?php
            break;            
	    case 'date':
            ?>
                <li class="thetime"><span itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></li>
            <?php
            break;
			
			case 'indo_date':
            ?>
                <li class="indo_date">
				<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
				echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);
				 ?>
				</li>
            <?php
            break;
			case 'hijri_date':
            ?>
                <li class="hijri_date">
				<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
				echo ' / '.tux_hijri_date($my_date);
				 ?>
				</li>
            <?php
            break;
            case 'category':
            ?>
                <?php tux_the_category(', ') ?>
            <?php
            break;
            case 'comment':
            ?>
                <li class="thecomment"><a rel="nofollow" href="<?php echo esc_url( get_comments_link() ); ?>" itemprop="interactionCount"><?php comments_number();?></a>
				</li>
			<?php
            break;
            case 'kunjungan':
            ?>	
				<li class="kunjungan"><?php setPostViews($post->ID); echo 'Dibaca : '.get_post_meta($post->ID,'views',true).' kali'; ?></li>
            <?php
            break;
        }
    }

function tux_social_buttons() {
        $tux_options = get_option( TUX_THEME_NAME );

        if ( isset( $tux_options['tux_social_buttons'] ) && is_array( $tux_options['tux_social_buttons'] ) && array_key_exists( 'enabled', $tux_options['tux_social_buttons'] ) ) {
            $buttons = $tux_options['tux_social_buttons']['enabled'];
        } else {
            $buttons = array();
        }

        if ( ! empty( $buttons ) ) {
        ?>
    		<!-- Start Share Buttons -->
			<div class="share-konten m20-b m30-t <?php echo $tux_options['tux_social_button_position']; ?>">
			<ul class="share-big">
                <?php foreach( $buttons as $key => $button ) { tux_social_button( $key ); } ?>
    		</ul>
			</div>
    		<!-- end Share Buttons -->
    	<?php
        }
    }

function tux_social_button( $button ) {
	global $post;
	if ( '' != get_the_post_thumbnail( $post->ID ) ) {
		$pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$pinImage = $pinterestimage[0];
	} else {
		$pinImage = '';
	}
	
        $tux_options = get_option( TUX_THEME_NAME );
        switch ( $button ) {
            case 'twitter':
            ?>
                <!-- Twitter -->
                <li class="twitter sbutton twitter-cresta-share float withCount" id="twitter-cresta">
				<a rel="nofollow" href="http://twitter.com/share?text=<?php echo htmlspecialchars(urlencode(html_entity_decode(the_title_attribute( array( 'echo' => 0, 'post' => $post->ID ) ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>&amp;url=<?php echo urlencode(get_permalink( $post->ID ));?>&amp;via=tuxtheme" title="Share to Twitter" onClick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-twitter"></i> <span class="text">Tweet</span></a></li>
            <?php
            break;
            case 'gplus':
            ?>
                <!-- GPlus -->
               <li class="google sbutton googleplus-cresta-share float" id="googleplus-cresta">
			   <a rel="nofollow" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink( $post->ID ));?>" title="Share to Google Plus" onClick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-google-plus"></i> <span class="text">Google+</span></a></li>
            <?php
            break;
            case 'facebook':
            ?>
             <li class="fb sbutton facebook-cresta-share float" id="facebook-cresta">
			 <a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink( $post->ID ));?>&amp;t=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>" title="Bagikan ke facebook" onClick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-facebook"></i> <span class="text">Facebook</span></a></li>
            <?php
            break;
            case 'pinterest':
                global $post;
            ?>
                <!-- Pinterest -->
                <li class="pinterest sbutton pinterest-cresta-share float" id="pinterest-cresta">
				<a rel="nofollow" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo urlencode(get_permalink( $post->ID ));?>&amp;media=<?php echo $pinImage;?>&amp;description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>" title="Share to Pinterest" onClick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-pinterest"></i> <span class="text">Pin it!</span></a></li>
            <?php
            break;
            case 'linkedin':
            ?>
                <!--Linkedin -->
               <li class="linkedin sbutton linkedin-cresta-share float" id="linkedin-cresta">
			   <a rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink( $post->ID ));?>&amp;title=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>&amp;source=<?php echo esc_url( home_url( '/' ));?>" title="Share to LinkedIn" onClick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="cs c-icon-cresta-linkedin"></i> <span class="text">Linkedin</span></a></div>
            <?php
            break;
            case 'stumble':
            ?>
                <!-- Stumble -->
                <span class="share-item stumblebtn">
                    <su:badge layout="1"></su:badge>
                </span>
            <?php
            break;
        }
    }

/*------------[ Class attribute for <article> element ]-------------*/
function tux_article_class() {
        $tux_options = get_option( TUX_THEME_NAME );
        $class = '';
        
        // sidebar or full width
        if ( tux_custom_sidebar() == 'tux_nosidebar' ) {
            $class = 'ss-full-width';
        } else {
            $class = 'article';
        }
        
        echo $class;

    }

/*------------[ Class attribute for #page element ]-------------*/
function tux_single_page_class() {
        $class = '';

        if ( is_single() || is_page() ) {

            $class = 'single';

            $header_animation = tux_get_post_header_effect();
            if ( !empty( $header_animation )) $class .= ' '.$header_animation;
        }

        echo $class;
    }

function tux_archive_post( $j,$layout = '' ) {
		global $post,$tux_option, $wp_query;
		$excerpt_text = short_by_word( get_the_excerpt(), 20 );
		$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'widgetmedium' );
		
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
		
		//$split = array('ada','disini','berita','tambahannya','ucing');
		$feat = $tux_option['tux_home_section'];
		$cs = count($feat);
		$z = ($no/3)-1;		
		//for($i=0;$i<4;$i++){
		if($no%3==''&&$z<$cs) { 
		?>
	
		<?php 
		$int = (int)$z;
		$ftipe = $feat[$int+1]['select_post_type'];
		$fcat = $feat[$int+1]['tux_featured_category'];
		$fnum = $feat[$int+1]['tux_num_box'];
		$fhtml = $feat[$int+1]['tux_html_box'];
		
		section_home($ftipe,$fcat,$fnum,$fhtml);

		}
        ?>
	<li <?php post_class('p1520 art-list pos_rel'); ?> data-sort="1">
	<div class="fr mt5 pos_rel">
		<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
			<img src="<?php echo $thumbnail; ?>" class="shou2 bgwhite" height="113" width="163" alt="<?php echo get_the_title(); ?>" />
		</a>
	</div>
	<div class='mr180'>
		<h3><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="f20 ln24 fbo txt-oev-2"><?php echo get_the_title(); ?></a></h3>
		<div class="grey2 pt5 f13 ln18 txt-oev-2"><?php echo $excerpt_text; ?></div>
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
wp_reset_postdata();
    }

// arsip 2
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
		<div class="pos_abs ovh hlover">
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
	<div class="fr mt5 pos_rel">
		<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
			<img src="<?php echo $thumbnail; ?>" class="shou2 bgwhite" height="111" width="148" alt="teluk-borgo_20161004_111126.jpg" />
		</a>
	</div>
	<div class='mr180'>
		<h3><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="f20 ln24 fbo txt-oev-2"><?php echo get_the_title(); ?></a></h3>
		<div class="grey2 pt5 f13 ln18 txt-oev-2"><?php echo $excerpt_text; ?></div>
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

function buangstiki($query){
if ( $query->is_home() && $query->is_main_query() && !is_admin() ) {
    $query->set( 'post__not_in', get_option( 'sticky_posts' ) );
    }
}
add_action( 'pre_get_posts', 'buangstiki' );

function section_home($tipe,$cat,$num,$html) {
global $post;
if($tipe=='video'){
	$args=array(
	'post_type' => 'video',
	'cat' => $cat,
	//'post__not_in' => get_option( 'sticky_posts' ),
	'posts_per_page'=>$num,
	);
	$loop = new WP_Query($args);	
	$count =0;
	?>
	<li <?php post_class('p1520 pos_rel images-1 cindex'); ?>>
		<h2 class="fbo mb10 f16 blue2"><?php echo get_cat_name($cat); ?></h2>
		<div class="ovh">
			<ul class="lsi-h al">	
		<?php if ($loop->have_posts()) : while ( $loop->have_posts() ) : $loop->the_post(); $count++;
		$excerpt_text = short_by_word( get_the_excerpt(), 20 );
		$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-thumb-foto' );
		if($img_src[0]!='') {
		$thumbnail = $img_src[0];
		}
		else {
		$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
		}
		?>	
			<li class="dip fl bdr0 video">
					<div class="ovh pos_rel wfull">
						<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="show"> 	
						<img class="home-thumb-video" src="<?php echo $thumbnail; ?>" width="351" height="228" alt="<?php echo get_the_title(); ?>">	
							<i class="fa fa-play fa-3x playoverlay playoverlay-c" style="border-radius:35px;padding:10px 10px 10px 20px;"></i>
							<div class="cl2"></div>
						</a>
						</div>
					<h3><a href="<?php the_permalink(); ?>" class="fbo2 f14 al txt-oev-2" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
				</li>
		<?php endwhile; endif; ?>		
			</ul>
		</div>
	</li>
	<?php 
	wp_reset_postdata();
}

elseif($tipe=='photo'){
	$args=array(
	'post_type' => 'gallery',
	'cat' => $cat,
	'post__not_in' => get_option( 'sticky_posts' ),
	'posts_per_page'=>$num,
	);
	$loop = new WP_Query($args);	
	$count =0;
?>
<li <?php post_class('p1520 pos_rel images-1 cindex'); ?>>
	<h2 class="fbo mb10 f16 blue2"><?php echo get_cat_name($cat); ?></h2>
	<div class="ovh">
		<ul class="lsi-h al">
	<?php if ($loop->have_posts()) : while ( $loop->have_posts() ) : $loop->the_post(); $count++;
	$excerpt_text = short_by_word( get_the_excerpt(), 20 );
	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-thumb-foto' );
	if($img_src[0]!='') {
	$thumbnail = $img_src[0];
	}
	else {
	$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
	}
  	?>
		<li class="dip fl bdr0 foto">
				<div class="ovh pos_rel wfull">
	  		 	  	<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"> 	
					<img src="<?php echo $thumbnail; ?>" width="351" height="228" alt="<?php echo get_the_title(); ?>">	
						<i class="fa fa-camera fa-lg playoverlay " style="border-radius:0px;padding:10px"></i>
						<div class="cl2"></div>
	        		</a>
					</div>
		        <h3><a href="<?php the_permalink(); ?>" class="fbo2 f14 al txt-oev-2" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
			</li>
	<?php endwhile; endif; ?>
	</ul>
	</div>
</li>
<?php 
wp_reset_postdata();
} 

elseif($tipe=='category'){
 $args=array(
 'cat' => $cat,
 'post__not_in' => get_option( 'sticky_posts' ),
 'posts_per_page'=>$num,
 
 );
  $cat_query = new WP_Query($args);
  $count = 0;
?>
<li <?php post_class('p1520 pos_rel ts-2 cindex'); ?>>
	<h2 class="fbo mb10 f16 blue2"><?php echo get_cat_name($cat); ?></h2>
	<div class="ovh">
	<!--div class="ovh" style="max-height:161px"-->
	<ul class="lsi-h al">
	<?php if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); $count++;
	$excerpt_text = short_by_word( get_the_excerpt(), 20 );
	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'postmedium' );
	if($img_src[0]!='') {
	$thumbnail = $img_src[0];
	}
	else {
	$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
	}
  ?>
		<li class="dip fl bdr0 berita <?php if($count%3!=0){echo 'pr25';}?>" style="width:228px;">
				<div class="ovh pos_rel wfull" style="height:148px">
	  		 	  	<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="show"> 	
					<img class="home-thumb-foto" src="<?php echo $thumbnail; ?>" width="228" height="148" alt="<?php echo get_the_title(); ?>">	
					<div class="cl2"></div>
	        		</a>
				</div>
		        <h3>
					<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="fbo2 f14 al txt-oev-3">
					<?php echo get_the_title(); ?>
					</a>
				</h3>
			</li>
		<?php endwhile; endif; ?>
		</ul>
	</div>
</li>		
<?php 
wp_reset_postdata();
} 

elseif($tipe=='html') {
?>
<li <?php post_class('p1520 art-list pos_rel html-box'); ?> data-sort="1">
<?php 
echo do_shortcode($html); ?>
</li>
<?php
}
else {}

}


function tux_cat_post( $layout = '' ) {
		global $post, $count;
        $tux_options = get_option(TUX_THEME_NAME);
		$excerpt_text = short_by_word( get_the_excerpt(), 10 );
		$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'widgetmini' );
		$img_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'widgetfull' );
			if($img_src[0]!='') {
				$thumbnail = $img_src[0];
				$thumbnail2 = $img_src2[0];
			}
			else {
				$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
				$thumbnail2 = get_template_directory_uri().'/images/no-image-available.png';
			}	
        ?>
	<?php 
	if ($layout == 'vertical') { 
	if($count==1) :
	?>
	<li class="first-cat">
		<div class="inner-content">
		<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<img src="<?php echo $thumbnail2; ?>" alt="<?php echo get_the_title(); ?>" width="328" height="190">
		</a>
		</div><!-- post-thumbnail /-->
		<div class="box-text">
		<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
		<h5 class="waktu">
		<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
		echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);
		?> WIB
		</h5> 				
		<p><?php echo $excerpt_text; ?></p>
		</div>
	</li>
	<?php else: ?>
	<li class="other-cat">
		<div class="inner-content">
		<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>" width="120" height="69">
		</a>
		</div><!-- post-thumbnail /-->
		<div class="box-text">
		<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
		<h5 class="waktu">
		<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
		echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);
		?> WIB
		</h5>
		
		</div>
	</li>				
	<?php endif; ?>				

	<?php }
	elseif ($layout == 'horizontal') { 
	if($count==1) :
	?>
	<li class="first-cat">
		<div class="inner-content">
		<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<img src="<?php echo $thumbnail2; ?>" alt="<?php echo get_the_title(); ?>" width="328" height="190">
		</a>
		</div><!-- post-thumbnail /-->
		<div class="box-text">
		<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
		<h5 class="waktu">
		<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
		echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);
		?> WIB
		</h5> 				
		<p><?php echo $excerpt_text; ?></p>
		</div>
	</li>
	<?php else: ?>
	<li class="other-cat">
		<div class="inner-content">
		<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>" width="120" height="69">
		</a>
		</div><!-- post-thumbnail /-->
		<div class="box-text">
		<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
		<h5 class="waktu">
		<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
		echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);
		?> WIB
		</h5>
		
		</div>
	</li>				
	<?php endif; ?>				

	<?php }
	elseif ($layout == 'grid') { ?> 

	<li>
		<div class="inner-content">
		<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
		</a>
		</div><!-- post-thumbnail /-->
		<div class="box-text">
		<h5 class="waktu">
		<?php $my_date = get_the_time('Y-m-d', '', '', FALSE);
		echo tux_indo_date($my_date).' | ' .get_the_time('H:i', '', '', FALSE);
		?> WIB
		</h5>		
		<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
		
		</div>
	</li>				

	<?php }
	else {  ?>
	<li>
		<div class="box-gambar">
		<a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
			<img class="img-150" src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
		</a>
		</div>
		<div class="box-text">
			<h5 class="kanal"><?php echo get_the_category_list( ', ' ); ?></h5>
			<h5 class="waktu"><?php echo get_the_date(); ?></h5>
			<h3><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
			<p><?php echo $excerpt_text; ?></p>
		</div>
	</li>	
	<?php } ?>	
   
        <?php 
    
	
	}

function tux_list_gallery( $layout = '' ) {
		global $post;
		$excerpt_text = short_by_word( get_the_excerpt(), 20 );
		$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'postmedium' );
			if($img_src[0]!='') {
				$thumbnail = $img_src[0];
			}
			else {
				$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
			}	
        ?>

	<li><a target="_parent" class="thumb" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
	<img class="img-fototengah"  src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>" width="199" height="114"></a>
	<h4><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
	</li>	
		
   
        <?php 
    }

function tux_list_video( $layout = '' ) {
		global $post;
		$excerpt_text = short_by_word( get_the_excerpt(), 20 );
		$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'postmedium' );
		$youtube_url = get_post_meta( $post->ID, 'youtube_url' );
			if($img_src[0]!='') {
				$thumbnail = $img_src[0];
			}
			elseif($youtube_url[0]!='') {
				//$thumbnail = 'http://i.ytimg.com/vi_webp/'.$youtube_url[0].'/maxresdefault.webp';
				$thumbnail = 'https://i.ytimg.com/vi/'.$youtube_url[0].'/hqdefault.jpg';
			}
			else {
			$thumbnail = get_template_directory_uri().'/images/no-image-available.png';
			}	
        ?>

	<li>
	<div class="main_vidieo">
	<a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
	<img class="img-fototengah"  src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>" width="199" height="114">
	<span class="td-video-play-ico"><img width="40" height="40" class="td-retina" src="<?php echo get_template_directory_uri();?>/images/ico-video-large.png" alt="video"></span>
	</a>
	</div>
	<h4><a target="_parent" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
	</li>	
		
   
        <?php 
    }


add_theme_support( 'title-tag' );
function theme_slug_render_title() { ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php 
}

add_action( 'wp_head', 'theme_slug_render_title' );
/*------------Indonesian Date-------------*/
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

/*------------Hijri Date-------------*/
function tux_hijri_date($date=null){
	
	$pecah = explode("-", $date);
	$theYear = $pecah[0];
	$theMonth = $pecah[1];
	$hr = $pecah[2];
	

	if (($theYear > 1582) || (($theYear == 1582) && ($theMonth > 10)) || (($theYear == 1582) && ($theMonth == 10) && ($hr > 14))) {
	$zjd = (int)((1461 * ($theYear + 4800 + (int)(($theMonth - 14) / 12))) / 4) + (int)((367 * ($theMonth - 2 - 12 * ((int)(($theMonth - 14) / 12)))) / 12) - (int)((3 * (int)((($theYear + 4900 + (int)(($theMonth - 14) / 12)) / 100))) / 4) + $hr - 32075;
	} else {
	$zjd = 367 * $theYear - (int)((7 * ($theYear + 5001 + (int)(($theMonth - 9) / 7))) / 4) + (int)((275 * $theMonth) / 9) + $hr + 1729777;
	}
	
	$zl            = $zjd - 1948440 + 10632;
	$zn            = (int)(($zl-1)/10631);
	$zl            = $zl - 10631 * $zn + 354;
	$zj            = ((int)((10985 - $zl)/5316))*((int)((50 * $zl)/17719))+((int)($zl/5670))*((int)((43 * $zl)/15238));
	$zl            = $zl-((int)((30 - $zj)/15))*((int)((17719 * $zj)/50))-((int)($zj/16))*((int)((15238 * $zj)/43))+29;
	$theMonth    = (int)((24 * $zl)/709);
	$hijriDay    = $zl-(int)((709 * $theMonth)/24);
	$hijriYear    = 30 * $zn + $zj - 30;
	
	if ($theMonth==1){ $hijriMonthName = "Muharram";}
	if ($theMonth==2){ $hijriMonthName = "Safar";}
	if ($theMonth==3){ $hijriMonthName = "Rabiul Uula";}
	if ($theMonth==4){ $hijriMonthName = "Rabiul Akhir";}
	if ($theMonth==5){ $hijriMonthName = "Jumadil Uula";}
	if ($theMonth==6){ $hijriMonthName = "Jumadil Akhir";}
	if ($theMonth==7){ $hijriMonthName = "Rajab";}
	if ($theMonth==8){ $hijriMonthName = "Sya'ban";}
	if ($theMonth==9){ $hijriMonthName = "Ramadhan";}
	if ($theMonth==10){ $hijriMonthName = "Syawal";}
	if ($theMonth==11){ $hijriMonthName = "Djulqa'dah";}
	if ($theMonth==12){ $hijriMonthName = "Djulhijjah";}

	
	return $hijriDay . ' ' . $hijriMonthName . ' ' . $hijriYear;
}

/*Konversi Waktu*/
function human_time_diff_id( $from, $to = '' ) {
    if ( empty( $to ) ) {
        $to = time();
    }
 

    $diff = (int) abs( $to - $from );

$min_in_sec = 60;
$hour_in_sec = 60 * $min_in_sec; 
$day_in_sec = 24 * $hour_in_sec;
$week_in_sec = 7 * $day_in_sec;
$month_in_sec = 30 * $day_in_sec;
$year_in_sec = 365 * $day_in_sec;

    if ( $diff < $hour_in_sec ) {
        $mins = round( $diff / $min_in_sec );
        if ( $mins <= 1 )
            $mins = 1;
        /* translators: min=minute */
        $since = sprintf( _n( '%s menit', '%s menit', $mins ), $mins );
    } elseif ( $diff < $day_in_sec && $diff >= $hour_in_sec ) {



        $hours = round( $diff / $hour_in_sec );
        if ( $hours <= 1 )
            $hours = 1;
        $since = sprintf( _n( '%s jam', '%s jam', $hours ), $hours );
    } elseif ( $diff < $week_in_sec && $diff >= $day_in_sec ) {
        $days = round( $diff / $day_in_sec );
        if ( $days <= 1 )
            $days = 1;
        $since = sprintf( _n( '%s hari', '%s hari', $days ), $days );
    } elseif ( $diff < $month_in_sec && $diff >= $week_in_sec ) {
        $weeks = round( $diff / $week_in_sec );
        if ( $weeks <= 1 )
            $weeks = 1;
        $since = sprintf( _n( '%s minggu', '%s minggu', $weeks ), $weeks );
    } elseif ( $diff < $year_in_sec && $diff >= $month_in_sec ) {
        $months = round( $diff / $month_in_sec );
        if ( $months <= 1 )
            $months = 1;
        $since = sprintf( _n( '%s bulan', '%s bulan', $months ), $months );
    } elseif ( $diff >= $year_in_sec ) {
        $years = round( $diff / $year_in_sec );
        if ( $years <= 1 )
            $years = 1;
        $since = sprintf( _n( '%s tahun', '%s tahun', $years ), $years );
    }
 
    /**
     * Filter the human readable difference between two timestamps.
     *
     * @since 4.0.0
     *
     * @param string $since The difference in human readable text.
     * @param int    $diff  The difference in seconds.
     * @param int    $from  Unix timestamp from which the difference begins.
     * @param int    $to    Unix timestamp to end the time difference.
     */
    return apply_filters( 'human_time_diff', $since, $diff, $from, $to );
}