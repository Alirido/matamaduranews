<?php
define( 'TUX_SERVER', 'http://www.tuxtheme.com/' );
define( 'TUX_THEME_NAME', 'Khobar' );
define( 'TUX_PRODUCT_NAME', 'Khobar' );
define( 'TUX_PRODUCT_DESC', 'Theme Wordpress Untuk Portal Berita Professional' );
define( 'TUX_PRODUCT_VERSION', '1.1' );
define( 'TUX_SERVER_RESPONSE', 5 );
define( 'TUX_DOC', TUX_SERVER.'panduan/khobar' );
define( 'TUX_SUP', TUX_SERVER.'bantuan' );

//require_once( dirname( __FILE__ ) . '/theme-options.php' );
//require_once( dirname( __FILE__ ) . '/inc/tux.cli.php' );
//tuxvalidator_go(__FILE__);

$tux_option = get_option(TUX_THEME_NAME);

function tuxtheme_opt() {
}

//require_once( 'inc/theme-actions.php' );


/*require_once( 'inc/easy-image-gallery/easy-image-gallery.php' );

require_once( 'inc/custompost/custom-gallery.php' );
require_once( 'inc/custompost/custom-video.php' );
require_once( 'inc/meta-box.php' );


require_once( 'inc/slider.php' );
require_once( 'inc/terbaru.php' );
require_once( 'inc/terkomentari.php' );
//require_once( 'inc/terpopuler.php' );


//widget
require_once( 'inc/widget/widget-catpost.php' );
require_once( 'inc/widget/widget-terpopuler.php' );
require_once( 'inc/widget/widget-text-html.php' );
require_once( 'inc/widget/widget-topik.php' );
require_once( 'inc/widget/widget-posterbaru.php' );
*/
// Add navigation menus
register_nav_menus( array(
	'primary'	=> __( 'Menu Utama', 'tuxtheme' ),
	'secondary'	=> __( 'Top Menu', 'tuxtheme' ),
    'footer'	=> __( 'Menu Footer', 'tuxtheme' ),
) );

add_action('admin_menu', 'custom_menu');

/*function wpb_adding_scripts() {

    //wp_register_script('quick-guide', get_template_directory_uri() . '/quick-guide.js');

    wp_enqueue_script('quick-guide', get_template_directory_uri() . '/quick-guide.js', '', '', true);
}

add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );*/

function page_callback_function() {
    //esc_html_e('testr');
    require_once('tes.php');
    //return 'tes';
}

function custom_menu() {

    add_menu_page(
        'Page Title',
        'Voting',
        'edit_posts',
        'menu_slug',
        'page_callback_function',
        'dashicons-media-spreadsheet'
        // posisi menu
       );
  }

add_theme_support( 'post-thumbnails' );
add_image_size( 'widgetthumb', 90, 60, true ); //widget
add_image_size( 'widgetmedium', 163, 113, true ); //sidebar full width
add_image_size( 'postmedium', 228, 148, true ); //sidebar full width
//add_image_size( 'videopilihan', 520, 292, true ); //sidebar full width
add_image_size( 'postlarge', 730, 480, true ); //sidebar full width
add_image_size( 'home-thumb-foto', 351, 228, true ); //sidebar full width
add_image_size( 'post-slider-medium', 735, 493, true ); //featured post 1
add_image_size( 'post-slider-small', 188, 124, true ); //featured post 1


add_action( 'wp_enqueue_scripts', 'tux_enqueue_css', 99 );
function tux_enqueue_css() {
$tux_options = get_option( TUX_THEME_NAME );
    wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/css/main.css', 'style' );
	wp_enqueue_style( 'sticky-menu', get_stylesheet_directory_uri() . '/css/sticky-menu.css', 'style' );
    wp_enqueue_style( 'paginate-ajax', get_stylesheet_directory_uri() . '/css/paginate-ajax.css', 'style' );

	$tipe=$tux_options['tux_layout'];

    wp_enqueue_style( 'tux-tab', get_stylesheet_directory_uri() . '/css/jquery.fancybox.min.css', 'stylesheet' );
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', 'stylesheet' );

	//wp_enqueue_style( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css', 'stylesheet' );

	$handle = 'stylesheet';

	$tux_bg = '';
	if ( $tux_options['tux_bg_pattern_upload'] != '' ) {
		$tux_bg = $tux_options['tux_bg_pattern_upload'];
	} else {
		if( !empty( $tux_options['tux_bg_pattern']) && ($tux_options['tux_bg_pattern']!='nobg' )) {
			$tux_bg = get_template_directory_uri().'/options/img/patterns/'.$tux_options['tux_bg_pattern'].'.png';
		}
	}
	$custom_css ="";
	$custom_css .= ".single-video .pages-col .double-block { margin-left:0px;}
	.single-video ul.terkait-img li { width:21%; height:auto; margin-right: 3%;}
	.single-video ul.terkait-img li img { height:100%!important; width:100%!important;}
	.single-video ul.terkait-img li:nth-child(4n+4) {margin-right: 0!important; clear: right!important;}";
	if ( $tux_options['tux_bg_color'] != '' ) {
		$custom_css .= "body {background-color:{$tux_options['tux_bg_color']}; }";
	}
	if ( $tux_bg != '' ) {
		$custom_css .= "body {background-image: url( {$tux_bg} );}";
	}
	if ( $tux_options['tux_color_scheme'] != '' ) {
		$custom_css .= "
		a{color:{$tux_options['tux_color_scheme']}; }
		#bx-pager .active, #bx-pager a:hover,.tagcloud a,
		.pagination li a,.bgred,.tux-load-more{background-color:{$tux_options['tux_color_scheme']}!important; }
		.bdrblue{border-bottom:3px solid {$tux_options['tux_color_scheme']}!important; }
		.blue, .blue a,.blue2, .blue2 a{color:{$tux_options['tux_color_scheme']}!important; }
		.hlover_topix a{border-right:4px solid {$tux_options['tux_color_scheme']}!important; }
		.red, .red a{color:{$tux_options['tux_color_scheme']}!important;}
		.navthumb{border-top:2px solid {$tux_options['tux_color_scheme']}!important; }
		.bsht:after, .title_content:after{border-bottom:5px solid {$tux_options['tux_color_scheme']}!important; }
		";
		}

	if ( $tux_options['tux_color_scheme2'] != '' ) {
		$custom_css .= ".most_count{background-color:{$tux_options['tux_color_scheme2']}!important; }
		";
		}
	if ( $tux_options['tux_custom_css'] != '' ) {
		$custom_css .= $tux_options['tux_custom_css'];
	}
	wp_add_inline_style( $handle, $custom_css );
}

function tux_add_scripts() {
global $tux_option;
$pgn=$tux_option['tux_paginate'];
$paging_type=$tux_option['tux_ajax_paginate'];

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$ajax_invinite_load[1] = array(
    'theme_defaults' => 'Khobar',
    'posts_wrapper' => '.site-main',
    'post_wrapper' => '.post',
    'pagination_wrapper' => '.navigation',
    'next_page_selector' => '.nav-links a.next',
    'paging_type' => $paging_type,//infinite-scroll, load-more, pagination
    'infinite_scroll_buffer' => '20',
    'ajax_loader' => '<img src="'.get_template_directory_uri().'/images/loader.gif'.'"/>',
    'load_more_button_text' => 'Load More Posts',
    'loading_more_posts_text' => 'Loading...',
    'callback_function' => '',
	);
	if($pgn==1) {
		wp_register_script(
				'tux-ajax-pagination-main-js',
				get_template_directory_uri() . '/js/paginate-main.js',
				array( 'jquery' ),
				NULL,
				true
		);

		wp_localize_script( 'tux-ajax-pagination-main-js', 'tuxSettings', $ajax_invinite_load );
		wp_enqueue_script( 'tux-ajax-pagination-main-js' );
	}
}

add_action( 'wp_enqueue_scripts', 'tux_add_scripts' );


function tux_get_thumbnail_url( $size = 'full' ) {
    global $post;
    if (has_post_thumbnail( $post->ID ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
        return $image[0];
    }

    // use first attached image
    $images = get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
    if (!empty($images)) {
        $image = reset($images);
        $image_data = wp_get_attachment_image_src( $image->ID, $size );
        return $image_data[0];
    }

    // use no preview fallback
    if ( file_exists( get_template_directory().'/images/nothumb-'.$size.'.png' ) )
        return get_template_directory_uri().'/images/nothumb-'.$size.'.png';
    else
        return '';
}

function tux_get_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
   // echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
	echo '<!-- end single img --><div class="deskripsi">'.$thumbnail_image[0]->post_excerpt.'</div><!-- end deskripsi -->';
  }
}



/*-----------------------------------------------------------------------------------*/
/*	Excerpt
/*-----------------------------------------------------------------------------------*/

// Increase max length
function tux_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'tux_excerpt_length', 20 );

// Remove [...] and shortcodes
function tux_custom_excerpt( $output ) {
  return preg_replace( '/\[[^\]]*]/', '', $output );
}
add_filter( 'get_the_excerpt', 'tux_custom_excerpt' );

// Truncate string to x letters/words
function tux_truncate( $str, $length = 40, $units = 'letters', $ellipsis = '&nbsp;&hellip;' ) {
    if ( $units == 'letters' ) {
        if ( mb_strlen( $str ) > $length ) {
            return mb_substr( $str, 0, $length ) . $ellipsis;
        } else {
            return $str;
        }
    } else {
        $words = explode( ' ', $str );
        if ( count( $words ) > $length ) {
            return implode( " ", array_slice( $words, 0, $length ) ) . $ellipsis;
        } else {
            return $str;
        }
    }
}

if ( ! function_exists( 'tux_excerpt' ) ) {
    function tux_excerpt( $limit = 40 ) {
      return esc_html( tux_truncate( get_the_excerpt(), $limit, 'words' ) );
    }
}

/* WALKER MENU */

class SelectBox_Menu_Walker extends Walker_Nav_Menu {

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
                global $wp_query;
                $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                $selected = in_array('current-menu-item',$classes) ? 'selected="selected"' : '';
                $output .= '<option '.$selected.' value="'.$item->url.'">';
                $output .= $item->title;
        }
        function end_el( &$output, $item, $depth = 0, $args = array() ) {
                $output .= "</option>";
        }
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Comments template
/*-----------------------------------------------------------------------------------*/
function tux_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
    $tux_options = get_option( TUX_THEME_NAME ); ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" itemscope itemtype="http://schema.org/UserComments">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
				<?php printf( '<span class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person"><span itemprop="name">%s</span></span>', get_comment_author_link() ) ?>
				<?php if (!empty( $tux_options['tux_comment_date'] ) ) { ?>
					<span class="ago">
					<?php
					$my_date = get_comment_date('Y-m-d', '', '', FALSE);
					echo tux_indo_date($my_date);

					//comment_date( get_option( 'date_format' ) ); ?>
					</span>
				<?php } ?>
				<span class="comment-meta">
					<?php edit_comment_link( __( '( Edit )', 'tuxtheme' ), '  ', '' ) ?>
				</span>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'tuxtheme' ) ?></em>
				<br />
			<?php endif; ?>
			<div class="commentmetadata">
		                <div class="commenttext" itemprop="commentText">
				    <?php comment_text() ?>
		                </div>
				<div class="reply">
                    <i class="fa fa-reply"></i>
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] )) ) ?>
				</div>
			</div>
		</div>
	<!-- WP adds </li> -->
<?php }

/*-----------------------------------------------------------------------------------*/
/*  Site Title
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'title-tag' );
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() { ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php }
	add_action( 'wp_head', 'theme_slug_render_title' );
}


//fungsi penunjang
//potong teks
if ( ! function_exists( 'short_by_word' ) ) :
	function short_by_word( $text, $limit )
	{
		if ( intval( $limit ) && intval( $limit ) < str_word_count( $text ) ) {
				$text = explode( ' ', $text );
				$text = implode( ' ', array_slice( $text, 0, ( intval( $limit ) ) ) );
				$text = force_balance_tags( $text );
		}
		return $text;
	}
endif;

//meta view
add_action( 'transition_view_post', 'setPostViews', 10, 4 );
function setPostViews($postID) {

    $user_ip = $_SERVER['REMOTE_ADDR']; //retrieve the current IP address of the visitor
    $key = $user_ip . 'x' . $postID; //combine post ID & IP to form unique key
    $value = array($user_ip, $postID); // store post ID & IP as separate values (see note)
    $visited = get_transient($key); //get transient and store in variable

    //check to see if the Post ID/IP ($key) address is currently stored as a transient
    if ( false === ( $visited ) ) {

        //store the unique key, Post ID & IP address for 12 hours if it does not exist
        set_transient( $key, $value, 60*60*12 );

        // now run post views function
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '1');
        }

		else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }

		$postx = get_post( (int) $postID );
		$post_author = $postx->post_author;

		// Award points to author
		/*mycred_add(
		'view_post', // reference
		$post_author, // who to get points
		0.15, // number of points to award
		'Kunjungan pada <a href=%post_url%>%post_title%</a>', // log template to use
		$postID, // save comment id as reference id
		array( 'ref_type' => 'post' ) // enable support for comment related template tags
		);*/
    }

}


/*-----------------------------------------------------------------------------------*/
/*	Enable Widgetized sidebar and Footer
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'register_sidebar' ) ) {   
    function tux_register_sidebars() {
        
        // Default sidebar
      /*  register_sidebar( array(
            'name' => __('Home Sidebar (kiri)','tuxtheme'),
            'description'   => __( 'Sidebar untuk halaman depan', 'tuxtheme' ),
            'id' => 'home-left-sidebar',
            'before_widget' => '<div id="%1$s" class="mb20 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="title"><h4 class="f24 f300 title_content">',
            'after_title' => '</h4></div>',
        ) );
		*/	
        // Left sidebar
        register_sidebar( array(
            'name' => __('Home Sidebar (kanan)','tuxtheme'),
            'description'   => __( 'Sidebar untuk halaman depan', 'tuxtheme' ),
            'id' => 'home-right-sidebar',
            'before_widget' => '<div id="%1$s" class="mb20 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="title"><h4 class="f24 f300 title_content">',
            'after_title' => '</h4></div>',
        ) );
		
 
        // Video sidebar
        register_sidebar( array(
            'name' => __('Video Sidebar','tuxtheme'),
            'description'   => __( 'Sidebar untuk halaman video', 'tuxtheme' ),
            'id' => 'video-sidebar',
            'before_widget' => '<div id="%1$s" class="blocking widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="title">',
            'after_title' => '</h4>',
        ) );        

        // Left sidebar
        register_sidebar( array(
            'name' => __('Footer Widget','tuxtheme'),
            'description'   => __( 'Widget untuk footer', 'tuxtheme' ),
            'id' => 'home-footer-widget',
            'before_widget' => '<div id="%1$s" class="col-bs10-2 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>',
        ) );
        
    }
    
    add_action( 'widgets_init', 'tux_register_sidebars' );
}


function get_index() {
	return get_bloginfo('url').'/indeks';
}




// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'tux_get_featured_posts',
		'max_posts' => 6,
	) );


/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function tux_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'tux_content_width' );

/*FEATURED CONTENT LIMIT*/
add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'tux_get_featured_posts',
		'max_posts' => 6,
	) );

function tux_get_featured_posts() {
	return apply_filters( 'tux_get_featured_posts', array() );
}
function tux_has_featured_posts() {
	return ! is_paged() && (bool) tux_get_featured_posts();
}
/*if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}*/

/*Disable Script Version For Fast Loading*/
function tux_remove_script_version( $src ) {
  return remove_query_arg( array('ver','v'), $src );
}
add_filter( 'script_loader_src', 'tux_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'tux_remove_script_version', 15, 1 );

/*Defer Javascript*/
function optimize_jquery() {
if (!is_admin()) {
wp_deregister_script('jquery');
wp_deregister_script('jquery-migrate.min');
//wp_deregister_script('comment-reply.min');
//wp_deregister_script('wp-emoji-release.min');
$protocol='https:';

wp_register_script('jquery', $protocol.'//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js', false, '3.6', true);

wp_enqueue_script('jquery');
}
}
add_action('template_redirect', 'optimize_jquery');

function wpsa_82312_widget_title($title) {
    // Cut the title into two halves.
    $halves = explode(' ', $title, 2);

    // Throw first word inside a span.
    //$title = '<span class="blue2 bdrblue">' . $halves[0] . '</span>';
	$title = $halves[0];

    // Add the remaining words if any.
    if (isset($halves[1])) {
        $title = $title . ' <span class="t2">' . $halves[1].'<span>';
    }
	if (isset($halves[2])) {
        $title = $title . ' <span class="t2">' . $halves[1]. ' ' . $halves[2].'<span>';
    }

    return $title;
}

// Hook our function into the WordPress system.
add_filter('widget_title', 'wpsa_82312_widget_title');

/*Disable WP Emoji*/
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
//add_action( 'init', 'disable_wp_emojicons' );







function dev_info() {
 echo '<p style="text-indent:-9999px;position: absolute;bottom: -999px;width: 1px;height: 1px;"><a href="http://tuxtheme.com">Theme Wordpress</a> Untuk Portal berita Professional</p>';
}

add_action( 'wp_footer', 'dev_info' );

/*remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
*/
function fb_opengraph() {
    global $post;

    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
			$img_src = esc_attr( $thumbnail_src[0] );
            //$img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
        } else {
            $img_src = 'http://matamaduranews.com/wp-content/uploads/2018/02/Logo-Mata-300x80.png';
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>

    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>

<?php
    } else {
        return;
    }
}
add_action('wp_head', 'fb_opengraph', 5);
