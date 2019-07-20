<?php

add_action('init', 'gallery_register');

	
	function gallery_register() {

	$labels = array(
    'name' => _x('Foto Berita', 'post type general name'),
    'singular_name' => _x('Foto Berita', 'post type singular name'),
    'add_new' => _x('Tambah Foto', 'gallery'),
    'add_new_item' => __('Tambah Galeri'),
    'edit_item' => __('Edit Galeri'),
    'new_item' => __('Buat Galeri'),
    'all_items' => __('List Galeri'),
    'view_item' => __('Lihat Galeri'),
    'search_items' => __('Cari Galeri'),
    'not_found' =>  __('No Galeri Found'),
    'not_found_in_trash' => __('No Galeri In a Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Foto Berita'
  );
	
	register_post_type( 'gallery',
		array(
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
        'publicly_queryable' => true,
		'exclude_from_search' => false,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'gallery','with_front' => false),
		'query_var' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author', 'comments','thumbnail' ),
		'taxonomies' => array('category','post_tag'),
		
		'labels' => $labels,
'menu_icon'           => 'dashicons-camera',
		//'menu_icon' => get_template_directory_uri() .'/panel/images/slideshow.png', // 16px16	
		//'menu_position' => 26,
		)
	);
	
	}

/*
    register_taxonomy( 'gallery_category',
        array('gallery'),
        array(
            'hierarchical' => true,
            'labels' => array(
                    'name' => __( 'Category', 'tuxtheme'),
                    'singular_name' => __( 'Category', 'tuxtheme'),
                    'search_items' =>  __( 'Search Category', 'tuxtheme'),
                    'all_items' => __( 'All Category', 'tuxtheme'),
                    'parent_item' => __( 'Parent Category', 'tuxtheme'),
                    'parent_item_colon' => __( 'Parent Category:', 'tuxtheme'),
                    'edit_item' => __( 'Edit Category', 'tuxtheme'),
                    'update_item' => __( 'Update Category', 'tuxtheme'),
                    'add_new_item' => __( 'Add New Category', 'tuxtheme'),
                    'new_item_name' => __( 'New Category', 'tuxtheme')
            ),
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'album', 'with_front' => false ),
        )
    );


 register_taxonomy( 'gallery_tags',
        array('gallery'),
        array(
            'hierarchical' => false,
            'labels' => array(
                    'name' => __( 'Gallery Tags', 'tuxtheme'),
                    'singular_name' => __( 'Gallery Tags', 'tuxtheme'),
                    'search_items' =>  __( 'Search Tags', 'tuxtheme'),
                    'all_items' => __( 'All Tags', 'tuxtheme'),
                    'parent_item' => __( 'Parent Tag', 'tuxtheme'),
                    'parent_item_colon' => __( 'Parent Tag:', 'tuxtheme'),
                    'edit_item' => __( 'Edit Tag', 'tuxtheme'),
                    'update_item' => __( 'Update Tag', 'tuxtheme'),
                    'add_new_item' => __( 'Add New Tag', 'tuxtheme'),
                    'new_item_name' => __( 'New Tag', 'tuxtheme')
            ),
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'gallery-tag' ),
        )
    );
*/
?>