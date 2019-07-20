<?php

add_action('init', 'video_register');

	
	function video_register() {

	$labels = array(
    'name' => _x('Berita Video', 'post type general name'),
    'singular_name' => _x('Berita Video', 'post type singular name'),
    'add_new' => _x('Tambah Video', 'video'),
    'add_new_item' => __('Tambah Video'),
    'edit_item' => __('Edit Video'),
    'new_item' => __('Tambah Video'),
    'all_items' => __('List Video'),
    'view_item' => __('Video Lihat'),
    'search_items' => __('Cari Video'),
    'not_found' =>  __('No Video Found'),
    'not_found_in_trash' => __('No Video In a Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Berita Video'
  );
	
	register_post_type( 'video',
		array(
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
        'publicly_queryable' => true,
		'exclude_from_search' => false,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'video','with_front' => false),
		'query_var' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author', 'comments','thumbnail' ),
		'taxonomies' => array('category','post_tag'),
		'labels' => $labels,
		'menu_icon' => 'dashicons-video-alt3', 
		//'menu_position' => 26,
		)
	);
	
	}
/*
	
    register_taxonomy( 'video_category',
        array('video'),
        array(
            'hierarchical' => true,
            'labels' => array(
                    'name' => __( 'Video Category', 'tuxtheme'),
                    'singular_name' => __( 'Video Category', 'tuxtheme'),
                    'search_items' =>  __( 'Search video Category', 'tuxtheme'),
                    'all_items' => __( 'All Video Category', 'tuxtheme'),
                    'parent_item' => __( 'Parent Video Category', 'tuxtheme'),
                    'parent_item_colon' => __( 'Parent Video Category:', 'tuxtheme'),
                    'edit_item' => __( 'Edit Video Category', 'tuxtheme'),
                    'update_item' => __( 'Update Video Category', 'tuxtheme'),
                    'add_new_item' => __( 'Add New Video Category', 'tuxtheme'),
                    'new_item_name' => __( 'New Video Category', 'tuxtheme')
            ),
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'video-category', 'with_front' => false ),
        )
    );


 register_taxonomy( 'video_tags',
        array('video'),
        array(
            'hierarchical' => false,
            'labels' => array(
                    'name' => __( 'Video Tags', 'tuxtheme'),
                    'singular_name' => __( 'Video Tags', 'tuxtheme'),
                    'search_items' =>  __( 'Search Video Tags', 'tuxtheme'),
                    'all_items' => __( 'All Video Tags', 'tuxtheme'),
                    'parent_item' => __( 'Parent Video Tag', 'tuxtheme'),
                    'parent_item_colon' => __( 'Parent Video Tag:', 'tuxtheme'),
                    'edit_item' => __( 'Edit Video Tag', 'tuxtheme'),
                    'update_item' => __( 'Update Video Tag', 'tuxtheme'),
                    'add_new_item' => __( 'Add New Video Tag', 'tuxtheme'),
                    'new_item_name' => __( 'New Video Tag', 'tuxtheme')
            ),
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'video-tag' ),
        )
    );
*/
?>