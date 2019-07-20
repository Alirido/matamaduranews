<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Easy_Image_Gallery' ) ) {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	*/
	class Easy_Image_Gallery {

		public function __construct() {
			//add_action( 'init', array( $this, 'constants' ));
			add_action( 'init', array( $this, 'includes' ) );
			//add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'easy_image_gallery_plugin_action_links' );
		}



		/**
		* Loads the initial files needed by the plugin.
		*
		* @since 1.0
		*/
		public function includes() {

			require_once( 'includes/template-functions.php' );
			require_once( 'includes/scripts.php' );
			require_once( 'includes/metabox.php' );
			//require_once( 'includes/admin-page.php' );

		}

	}
}

$easy_image_gallery = new Easy_Image_Gallery();
