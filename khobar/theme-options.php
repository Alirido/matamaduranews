<?php

defined('ABSPATH') or die;

/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
require_once( dirname( __FILE__ ) . '/options/options.php' );
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'tuxtheme'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'tuxtheme'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;
//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
//$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'tuxtheme');

//Setup custom links in the footer for share icons
$args['share_icons']['twitter'] = array(
										'link' => 'http://twitter.com/tuxtheme',
										'title' => 'Follow Us on Twitter', 
										'img' => 'fa fa-twitter'
										);
$args['share_icons']['facebook'] = array(
										'link' => 'http://www.facebook.com/tuxtheme',
										'title' => 'Like us on Facebook', 
										'img' => 'fa fa-facebook'
										);

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = TUX_THEME_NAME;

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'tuxtheme');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Theme Options', 'tuxtheme');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 62;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Support', 'tuxtheme'),
							'content' => __('<p>If you are facing any problem with our theme or theme option panel, head over to our <a href="http://community.tuxtheme.com/">Support Forums.</a></p>', 'tuxtheme')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Earn Money', 'tuxtheme'),
							'content' => __('<p>Earn 70% commision on every sale by refering your friends and readers. Join our <a href="http://tuxtheme.com/affiliate-program/">Affiliate Program</a>.</p>', 'tuxtheme')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'tuxtheme');

$tux_patterns = array(
	'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
	'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
	'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
	'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
	'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
	'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
	'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
	'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
	'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
	'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
	'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
	'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
	'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
	'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
	'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
	'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
	'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
	'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
	'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
	'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
	'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
	'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
	'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
	'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
	'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
	'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
	'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
	'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
	'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
	'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
	'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
	'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
	'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
	'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
	'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
	'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
	'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
	'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
	'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
	'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
	'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
	'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
	'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
	'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
	'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
	'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
	'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
	'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
	'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
	'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
	'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
	'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
	'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
	'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
	'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
	'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
	'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
	'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
	'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
	'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
	'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
	'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
	'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
	'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
);

$sections = array();

$sections[] = array(
				'icon' => 'fa fa-cogs',
				'title' => __('Pengaturan Dasar', 'tuxtheme'),
				'desc' => __('<p class="description">Tab ini mengatur pengaturan umum untuk situs anda.</p>', 'tuxtheme'),
				'fields' => array(
						
				
					array(
						'id' => 'tux_logo',
						'type' => 'upload',
						'std' => get_template_directory_uri().'/images/logo.png',
						'title' => __('Logo Image', 'tuxtheme'), 
						'sub_desc' => __('Logo utama untuk situs Anda.', 'tuxtheme')
						),

					array(
						'id' => 'tux_favicon',
						'type' => 'upload',
						'title' => __('Favicon', 'tuxtheme'), 
						'sub_desc' => __('Upload favicon dengan ukuran <strong>32 x 32 px</strong>.', 'tuxtheme')
						),
						
				/*
				 array(
                        'id'        => 'tux_topik_terhangat',
                        'type'      => 'group',
                        'title'     => __('Popular Tag', 'tuxtheme'), 
                        'sub_desc'  => __('Tentukan tag terpopuler', 'tuxtheme'),
                        'groupname' => __('Section', 'tuxtheme'), // Group name
                        'subfields' => 
                            array(
		
								
                                array(
                                    'id' => 'tux_topik_terhangat_judul',
            						'type' => 'text',
                                    //'class' => 'small-text',
            						'title' => __('Judul Topik', 'tuxtheme'), 
            						'sub_desc' => __('Tentukan judul topik', 'tuxtheme') 
									),
								 array(
                                    'id' => 'tux_topik_terhangat_url',
            						'type' => 'tags_select',
                                    //'class' => 'small-text',
            						'title' => __('Pilih Tag', 'tuxtheme'), 
            						'sub_desc' => __('Tentukan Tag Terkait untuk topik ini', 'tuxtheme'), 
            						),
                            ),
            				'std' => array(
            					'1' => array(
            						'group_title' => 'Judul Topik',
            						'group_sort' => '1',
            						'tux_topik_terhangat_judul' => 'Judul Topik',
            						'tux_topik_terhangat_url' => '#',
            					)
            				)
                        ),
					*/	
					array(
						'id' => 'tux_paginate',
						'type' => 'button_set_hide_below',
						'title' => __('Tipe Paginasi', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Pilih tipe paginasi (ajax/statis)', 'tuxtheme'),
						'std' => '0',
						'args' => array('hide' => '2')
						),
							
					array(
						'id' => 'tux_ajax_paginate',
						'type' => 'select',
						'options' => array('infinite-scroll' => 'Infinite Load','load-more' => 'Load Button'),
						'std' => 'infinite-scroll',
						'title' => __('Paginasi Ajax', 'tuxtheme'),
						'sub_desc' => __('Pilih tipe paginasi mode ajax', 'tuxtheme'),
						),
					array(
						'id' => 'tux_load_img',
						'type' => 'upload',
						'std' => get_template_directory_uri().'/images/loader.gif',
						'title' => __('Loading Image', 'tuxtheme'), 
						'sub_desc' => __('Upload gambar untuk status loading..', 'tuxtheme')
						),
							
					array(
						'id' => 'tux_header_code',
						'type' => 'textarea',
						'title' => __('Header Code', 'tuxtheme'), 
						'sub_desc' => __('Masukan kode HTML untuk google webmaster, bing, alexa, dll', 'tuxtheme')
						),
					array(
						'id' => 'tux_analytics_code',
						'type' => 'textarea',
						'title' => __('Footer Code', 'tuxtheme'), 
						'sub_desc' => __('Masukan kode HTML. <strong>(contoh: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, dll.)</strong>.', 'tuxtheme')
						),
					array(
						'id' => 'tux_copyrights',
						'type' => 'textarea',
						'title' => __('Copyrights Text', 'tuxtheme'), 
						'sub_desc' => __('Anda bisa mengganti text copyright. (Terimakasih jika mencantumkan link tuxtheme)', 'tuxtheme'),
						'std' => 'Theme by <a href="http://tuxtheme.com/" rel="nofollow">Tuxtheme</a>'
						),
					
					)
				);
$sections[] = array(
				'icon' => 'fa fa-adjust',
				'title' => __('Layout Situs', 'tuxtheme'),
				'desc' => __('<p class="description">Atur warna, background serta custom css untuk situs Anda.</p>', 'tuxtheme'),
				'fields' => array(
					array(
						'id' => 'tux_color_scheme',
						'type' => 'color',
						'title' => __('Warna 1', 'tuxtheme'), 
						'sub_desc' => __('Pilih warna dasar untuk situs Anda.', 'tuxtheme'),
						'std' => '#3ca5dd'
						),
					array(
						'id' => 'tux_color_scheme2',
						'type' => 'color',
						'title' => __('Warna 2', 'tuxtheme'), 
						'sub_desc' => __('Pilih warna dasar 2 untuk situs Anda.', 'tuxtheme'),
						'std' => '#71c4d6'
						),					
					array(
						'id' => 'tux_bg_color',
						'type' => 'color',
						'title' => __('Background Color', 'tuxtheme'), 
						'sub_desc' => __('Pick a color for the site background color.', 'tuxtheme'),
						'std' => '#ffffff'
						),
/*					array(
						'id' => 'tux_bg_pattern',
						'type' => 'radio_img',
						'title' => __('Background Pattern', 'tuxtheme'), 
						'sub_desc' => __('Pilih <strong>63</strong> background pattern  standar tuxtheme.', 'tuxtheme'),
						'options' => $tux_patterns,
						'std' => 'nobg'
						),
					array(
						'id' => 'tux_bg_pattern_upload',
						'type' => 'upload',
						'title' => __('Custom Background Image', 'tuxtheme'), 
						'sub_desc' => __('Upload custom background image atau background pattern yang Anda inginkan.', 'tuxtheme')
						),
*/						
					array(
						'id' => 'tux_custom_css',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'tuxtheme'), 
						'sub_desc' => __('Anda bisa mengkostumasi css melalui form ini.', 'tuxtheme')
						),
					)
				);
/*				
$sections[] = array(
				'icon' => 'fa fa-credit-card',
				'title' => __('Header', 'tuxtheme'),
				'desc' => __('<p class="description">Atur bagian header situs Anda.</p>', 'tuxtheme'),
				'fields' => array(
		
	
						array(
						'id' => 'tux_social_icon_head',
						'type' => 'button_set_hide_below',
						'title' => __('Social Icons', 'tuxtheme'),
						'sub_desc' => __('Anda bisa mengkatifkan/me-nonaktifkan tombol sosial media', 'tuxtheme'),
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1',
						'args' => array('hide' => '2')
						),
						array(
                     	'id' => 'tux_header_social',
                     	'title' => __('Header Social Icons', 'tuxtheme'), 
                     	'sub_desc' => __( 'Tambahkan tombol sosial media pada bagian atas situs Anda.', 'tuxtheme' ),
                     	'type' => 'group',
                     	'groupname' => __('Header Icons', 'tuxtheme'), // Group name
                     	'subfields' => 
                            array(
                                array(
                                    'id' => 'tux_header_icon_title',
            						'type' => 'text',
            						'title' => __('Title', 'tuxtheme'), 
            						),
								array(
                                    'id' => 'tux_header_icon',
            						'type' => 'icon_select',
            						'title' => __('Icon', 'tuxtheme')
            						),
								array(
                                    'id' => 'tux_header_icon_link',
            						'type' => 'text',
            						'title' => __('URL', 'tuxtheme'), 
            						),
			                	),
                        'std' => array(
            					'facebook' => array(
            						'group_title' => 'Facebook',
            						'group_sort' => '1',
            						'tux_header_icon_title' => 'Facebook',
            						'tux_header_icon' => 'facebook',
            						'tux_header_icon_link' => '#',
            					),
            					'twitter' => array(
            						'group_title' => 'Twitter',
            						'group_sort' => '2',
            						'tux_header_icon_title' => 'Twitter',
            						'tux_header_icon' => 'twitter',
            						'tux_header_icon_link' => '#',
            					),
            					'gplus' => array(
            						'group_title' => 'Google Plus',
            						'group_sort' => '3',
            						'tux_header_icon_title' => 'Google Plus',
            						'tux_header_icon' => 'google-plus',
            						'tux_header_icon_link' => '#',
            					),
            					'youtube' => array(
            						'group_title' => 'YouTube',
            						'group_sort' => '4',
            						'tux_header_icon_title' => 'YouTube',
            						'tux_header_icon' => 'youtube-play',
            						'tux_header_icon_link' => '#',
            					)
            				)
                        ),
					
					)
				);	
*/
$sections[] = array(
				'icon' => 'fa fa-home',
				'title' => __('Homepage', 'tuxtheme'),
				'desc' => __('<p class="description">Pengaturan Halaman Depan.</p>', 'tuxtheme'),
				'fields' => array(

				array(
						'id' => 'tux_cat_slider',
						'type' => 'button_set_hide_below',
						'title' => __('Kategori Slider', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Anda bisa memunculkan running text berita pada bagian top bar', 'tuxtheme'),
						'std' => '0'
					),
						array(
						'id' => 'tux_cat_slider_cat',
						'type' => 'cats_multi_select',
						'title' => __('Pilih Kategori', 'tuxtheme'), 
						'sub_desc' => __('Pilih kategori untuk running text breaking news.', 'tuxtheme'),
						),
					   /*
					   array(
					   'id' => 'tux_popular_tags',
					   'type' => 'tags_multi_select',
					   'title' => __('Tag Populer', 'tuxtheme'),
					   'sub_desc' => __('Pilih Tag', 'tuxtheme'),
					   'args' => array('hide_empty' => 0),
					   ), 				
	   					*/
	   				array(
						'id' => 'tux_post_big_slider',
						'type' => 'button_set_hide_below',
						'title' => __('Pos Slider', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('<strong>Enable / Disable</strong> Pos Slider sebagai headline berita.', 'tuxtheme'),
						'std' => '1',
                        'args' => array('hide' => 1)
						),
						 
                    array(
                        'id'        => 'tux_home_section',
                        'type'      => 'group',
                        'title'     => __('Featured Box', 'tuxtheme'), 
                        'sub_desc'  => __('Tambahkan box berita/html diantara berita terbaru', 'tuxtheme'),
                        'groupname' => __('Section', 'tuxtheme'), // Group name
                        'subfields' => 
                            array(
		
								array(
								'id' => 'select_post_type',
								'type' => 'select',
								'title' => __('Pilih Tipe', 'tuxtheme'), 
								'sub_desc' => __('Tentukan tipe pos', 'nhp-opts'),
								'options' => array(
											'' => 'Pilih Tipe Pos',		
											'category' => 'Artikel',								
											'video' => 'Video',
											'photo' => 'Photo',
											'html' => 'Text/HTML',
											),//Must provide key => value(array) pairs for select options
								'std' => ''
								),
                                array(
                                    'id' => 'tux_featured_category',
            						'type' => 'cats_select',
            						'title' => __('Kategori', 'tuxtheme'), 
            						'sub_desc' => __('Pilih Kategori', 'tuxtheme'),
									'std' => 'latest',
                                    //'args' => array('include_latest' => 1, 'hide_empty' => 0),
									'args' => array('hide_empty' => 0),
            						),
                              
								array(
								'id' => 'tux_num_box',
								'type' => 'text',
								'class' => 'small-text',
								'title' => __('Jumlah Pos', 'tuxtheme'),
								'std' => '6',
								'sub_desc' => __('masukan jumlah pos yang ingin ditampilkan'),
								),		
								array(
									'id' => 'tux_html_box',
									'type' => 'textarea',
									'title' => __('Text/HTML', 'tuxtheme'), 
									'sub_desc' => __('Input Text/HTML Disni (Jika anda memilih tipe text/html)', 'tuxtheme')
									),	
                            ),
            				'std' => array(
            					'1' => array(
            						'group_title' => '',
            						'group_sort' => '1',
            						'select_type' => 'category',
            						'tux_featured_category' => 'latest',
									'tux_featured_category_postsnum' => get_option('posts_per_page')
            					)
            				)
                        ),

					)
				);
$sections[] = array(
				'icon' => 'fa fa-file-text',
				'title' => __('Single Post', 'tuxtheme'),
				'desc' => __('<p class="description">Pengaturan Layout Pada Single Post.</p>', 'tuxtheme'),
				'fields' => array(

				array(
						'id' => 'tux_feat_img',
						'type' => 'button_set',
						'title' => __('Featured Image', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('<strong>Enable / Disable</strong> Featured Image diatas postingan.', 'tuxtheme'),
						'std' => '1'
						),
				
				array(
						'id' => 'tux_foto_more',
						'type' => 'button_set',
						'title' => __('Foto Terbaru', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('<strong>Enable / Disable</strong> Foto Terbaru Dibawah Form Komentar.', 'tuxtheme'),
						'std' => '1'
						),				
				array(
						'id' => 'tux_post_more',
						'type' => 'button_set',
						'title' => __('Pos Terbaru', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('<strong>Enable / Disable</strong> Pos Terbaru Dibawah Form Komentar.', 'tuxtheme'),
						'std' => '1'
						),
			
					array(
                        'id'       => 'tux_single_post_layout',
                        'type'     => 'layout2',
                        'title'    => __('Tata Letak', 'tuxtheme'),
                        'sub_desc' => __('Atur Tata Letak Single Post', 'tuxtheme'),
                        'options'  => array(
                            'enabled'  => array(
                                'content'   => array(
                                	'label' 	=> __('Konten/Artikel','tuxtheme'),
                                	'subfields'	=> array(
                                		
                                	)
                                ),
                                'author'   => array(
                                	'label' 	=> __('Author Box','tuxtheme'),
                                	'subfields'	=> array(

                                	)
                                ),
                                'related'   => array(
                                	'label' 	=> __('Artikel Terkait','tuxtheme'),
                                	'subfields'	=> array(
					        			array(
					        				'id' => 'tux_related_posts_taxonomy',
					        				'type' => 'button_set',
					        				'title' => __('Taksonomi', 'tuxtheme') ,
					        				'options' => array(
					        					'tags' => 'Tag',
					        					'categories' => 'Kategori'
					        				) ,
					        				'class' => 'green',
					        				'sub_desc' => __('Artikel terkait berdasarkan tag atau kategori.', 'tuxtheme') ,
					        				'std' => 'categories'
					        			),
					        			array(
					        				'id' => 'tux_related_postsnum',
					        				'type' => 'text',
					        				'class' => 'small-text',
					        				'title' => __('Jumlah', 'tuxtheme') ,
					        				'sub_desc' => __('Jumlah artikel terkait yang ingin ditampilkan', 'tuxtheme') ,
					        				'std' => '4',
					        				'args' => array(
					        					'type' => 'number'
					        				)
					        			),

                                	)
                                ),
                            ),
                            'disabled' => array(
                            	'tags'   => array(
                                	'label' 	=> __('Tag','tuxtheme'),
                                	'subfields'	=> array(
                                	)
                                ),
                            )
                        )
                    ),
					array(
	                    'id'       => 'tux_single_headline_meta_info',
	                    'type'     => 'layout',
	                    'title'    => __('Pos Meta', 'tuxtheme'),
	                    'sub_desc' => __('Atur pos meta yang ingin ditampilkan', 'tuxtheme'),
	                    'options'  => array(
	                        'enabled'  => array(
	                            'author'   => __('Nama Penulis','tuxtheme'),
	                            //'date'     => __('Tanggal','tuxtheme'),
								'indo_date'     => __('Tanggal Indonesia','tuxtheme'),
								'hijri_date'     => __('Tanggal Hijriyah','tuxtheme'),
	                            'category' => __('Kategori','tuxtheme'),
	                            'kunjungan'  => __('Kunjungan','tuxtheme'),
	                            'comment'  => __('Komentar','tuxtheme')
	                        ),
	                        'disabled' => array(
							'category' => __('Kategori','tuxtheme'),
							'comment'  => __('Komentar','tuxtheme')
	                        )
	                    ),
	                    'std'  => array(
	                        'enabled'  => array(
	                            'author'   => __('Nama Penulis','tuxtheme'),
	                            'indo_date'     => __('Tanggal Indonesia','tuxtheme'),
								'hijri_date'     => __('Tanggal Hijriyah','tuxtheme'),
								'kunjungan'  => __('Kunjungan','tuxtheme')
	                            //'category' => __('Kategori','tuxtheme'),
	                            //'comment'  => __('Komentar Count','tuxtheme')
	                        ),
	                        'disabled' => array(
	                        )
	                    )
	                ),
					array(
						'id' => 'tux_breadcrumb',
						'type' => 'button_set',
						'title' => __('Breadcrumb', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Mengktifkan breadcrumb akan menjadikan situs Anda lebih user friendly', 'tuxtheme'),
						'std' => '1'
						),
					/*array(
						'id' => 'tux_author_comment',
						'type' => 'button_set',
						'title' => __('Highlight Author Comment', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to highlight author comments.', 'tuxtheme'),
						'std' => '1'
						),*/
					array(
						'id' => 'tux_comment_date',
						'type' => 'button_set',
						'title' => __('Tanggal Komentar', 'tuxtheme'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Tampilkan tanggal saat komentar dikirim', 'tuxtheme'),
						'std' => '1'
						),
					)
				);
$sections[] = array(
				'icon' => 'fa fa-group',
				'title' => __('Sosial Media', 'tuxtheme'),
				'desc' => __('<p class="description">Pengaturan Tombol Sosial Media Sharing.</p>', 'tuxtheme'),
				'fields' => array(
					array(
						'id' => 'tux_social_button_position',
						'type' => 'button_set',
						'title' => __('Social Sharing', 'tuxtheme'), 
						'options' => array('top' => __('Diatas Konten','tuxtheme'), 'bottom' => __('Dibawah Konten','tuxtheme')),//, 'floating' => __('Floating','tuxtheme')),
						'sub_desc' => __('Pilih Lokasi Penempatan.', 'tuxtheme'),
						'std' => 'bottom',
						'class' => 'green'
					),
					array(
                        'id'       => 'tux_social_buttons',
                        'type'     => 'layout',
                        'title'    => __('Tombol Social Media', 'tuxtheme'),
                        'sub_desc' => __('Pilih Sosial Media Yang Ingin Anda Tampilkan', 'tuxtheme'),
                        'options'  => array(
                            'enabled'  => array(
                                'twitter'   => __('Twitter','tuxtheme'),
                                'gplus'     => __('Google Plus','tuxtheme'),
                                'facebook'  => __('Facebook Like','tuxtheme'),
                                'pinterest' => __('Pinterest','tuxtheme'),
                            ),
                            'disabled' => array(
                            	'linkedin'  => __('LinkedIn','tuxtheme'),
                                'stumble'   => __('StumbleUpon','tuxtheme'),
                            )
                        ),
                        'std'  => array(
                            'enabled'  => array(
                                'twitter'   => __('Twitter','tuxtheme'),
                                'gplus'     => __('Google Plus','tuxtheme'),
                                'facebook'  => __('Facebook Like','tuxtheme'),
                                'pinterest' => __('Pinterest','tuxtheme'),
                            ),
                            'disabled' => array(
                            	'linkedin'  => __('LinkedIn','tuxtheme'),
                                'stumble'   => __('StumbleUpon','tuxtheme'),
                            )
                        )
                    ),
				)
			);
$sections[] = array(
				'icon' => 'fa fa-bar-chart-o',
				'title' => __('Iklan', 'tuxtheme'),
				'desc' => __('<p class="description">Pengaturan Penempatan Iklan.</p>', 'tuxtheme'),
				'fields' => array(
					array(
						'id' => 'tux_header_adcode',
						'type' => 'textarea',
						'title' => __('Iklan Header', 'tuxtheme'), 
						'sub_desc' => __('Iklan akan ditampilkan pada header sebelah kanan.', 'tuxtheme')
						),
					array(
						'id' => 'tux_left_adcode',
						'type' => 'textarea',
						'title' => __('Iklan Samping Kiri', 'tuxtheme'), 
						'sub_desc' => __('Iklan akan ditampilkan sebelah kiri situs.', 'tuxtheme')
						),
					array(
						'id' => 'tux_right_adcode',
						'type' => 'textarea',
						'title' => __('Iklan Samping Kanan', 'tuxtheme'), 
						'sub_desc' => __('Iklan akan ditampilkan sebelah kanan situs.', 'tuxtheme')
						),
					array(
						'id' => 'tux_post_left_adcode',
						'type' => 'textarea',
						'title' => __('Iklan Samping Artikel', 'tuxtheme'), 
						'sub_desc' => __('Iklan akan ditampilkan disamping kiri artikel', 'tuxtheme')
						),
					)
				);
$sections[] = array(
				'icon' => 'fa fa-list-alt',
				'title' => __('Menu / Navigasi', 'tuxtheme'),
				'desc' => __('<p class="description"><div class="controls">Untuk mengatur menu navigasi, silahkan melalui <a href="nav-menus.php"><b>Pengaturan Menu</b></a>.<br></div></p>', 'tuxtheme')
				);
				
				
	$tabs = array();
    
    $args['presets'] = array();
    include('theme-presets.php');
    
	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function

/*--------------------------------------------------------------------
 * 
 * Default Font Settings
 *
 --------------------------------------------------------------------*/
if(function_exists('tux_register_typography')) { 
  tux_register_typography(array(
  	'logo_font' => array(
      'preview_text' => 'Logo Font',
      'preview_color' => 'dark',
      'font_family' => 'Open Sans',
      'font_variant' => '400',
      'font_size' => '25px',
      'font_color' => '#FFF',
      'css_selectors' => '#header h1, #header h2'
    ),
    'navigation_font' => array(
      'preview_text' => 'Navigation Font',
      'preview_color' => 'dark',
      'font_family' => 'Open Sans',
      'font_variant' => 'normal',
      'font_size' => '15px',
      'font_color' => '#FFF',
      'css_selectors' => '.menu li, .menu li a'
    ),
    'home_title_font' => array(
      'preview_text' => 'Home Article Title',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_size' => '20px',
	  'font_variant' => '700',
      'font_color' => '#252525',
      'css_selectors' => '.latestPost .title a, .latestPost-news .title, .latestPost .title'
    ),
    'single_title_font' => array(
      'preview_text' => 'Single Article Title',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_size' => '35px',
	  'font_variant' => '700',
      'font_color' => '#252525',
      'css_selectors' => '.single-title'
    ),
    'content_font' => array(
      'preview_text' => 'Content Font',
      'preview_color' => 'light',
      'font_family' => 'Open Sans',
      'font_size' => '14px',
	  'font_variant' => 'normal',
      'font_color' => '#252525',
      'css_selectors' => 'body'
    ),
    'widget_title_font' => array(
      'preview_text' => 'Widget Title Font',
      'preview_color' => 'light',
      'font_family' => 'Open Sans',
      'font_variant' => '700',
      'font_size' => '15px',
      'font_color' => '#252525',
      'css_selectors' => '.widget h3, .featured-category-title'
    ),
	'sidebar_font' => array(
      'preview_text' => 'Sidebar Font',
      'preview_color' => 'light',
      'font_family' => 'Open Sans',
      'font_variant' => 'normal',
      'font_size' => '14px',
      'font_color' => '#252525',
      'css_selectors' => '#sidebar .widget'
    ),
	'footer_font' => array(
      'preview_text' => 'Footer Font',
      'preview_color' => 'light',
      'font_family' => 'Open Sans',
      'font_variant' => '600',
      'font_size' => '13px',
      'font_color' => '#252525',
      'css_selectors' => '.footer-widgets, footer .widget li a'
    ),
    'h1_headline' => array(
      'preview_text' => 'Content H1',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_variant' => '700',
      'font_size' => '35px',
      'font_color' => '#252525',
      'css_selectors' => 'h1'
    ),
	'h2_headline' => array(
      'preview_text' => 'Content H2',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_variant' => '700',
      'font_size' => '24px',
      'font_color' => '#252525',
      'css_selectors' => 'h2'
    ),
	'h3_headline' => array(
      'preview_text' => 'Content H3',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_variant' => '700',
      'font_size' => '25px',
      'font_color' => '#252525',
      'css_selectors' => 'h3'
    ),
	'h4_headline' => array(
      'preview_text' => 'Content H4',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_variant' => '700',
      'font_size' => '20px',
      'font_color' => '#252525',
      'css_selectors' => 'h4'
    ),
	'h5_headline' => array(
      'preview_text' => 'Content H5',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_variant' => '700',
      'font_size' => '18px',
      'font_color' => '#252525',
      'css_selectors' => 'h5'
    ),
	'h6_headline' => array(
      'preview_text' => 'Content H6',
      'preview_color' => 'light',
      'font_family' => 'Merriweather',
      'font_variant' => '700',
      'font_size' => '16px',
      'font_color' => '#252525',
      'css_selectors' => 'h6'
    )
  ));
}

?>
