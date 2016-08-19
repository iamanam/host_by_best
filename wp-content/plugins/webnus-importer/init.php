<?php
/*
Plugin Name: Webnus Importer
Description: Add Webnus Importer to your WordPress website.
Version: 1.0
Author: Webnus
Author URI: http://webnus.net
License: GPL2
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if ( !class_exists( 'Radium_Theme_Demo_Data_Importer' ) ) {

	require_once( dirname( __FILE__ ) . '/importer/radium-importer.php' ); //load admin theme data importer

	class Radium_Theme_Demo_Data_Importer extends Radium_Theme_Importer {

		/**
		 * Set framewok
		 *
		 * options that can be used are 'default', 'radium' or 'optiontree'
		 *
		 * @since 0.0.3
		 *
		 * @var string
		 */
		public $theme_options_framework = 'radium';

		/**
		 * Holds a copy of the object for easy reference.
		 *
		 * @since 0.0.1
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Set the key to be used to store theme options
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $theme_option_name       = 'Easyweb_webnus_options'; //set theme options name here (key used to save theme options). Optiontree option name will be set automatically

		/**
		 * Set name of the theme options file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $theme_options_file_name = 'theme_options.txt';

		/**
		 * Set name of the widgets json file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $widgets_file_name       = 'widgets.json';

		/**
		 * Set name of the slider file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $slider_file_name		= 'slider.zip';

		/**
		 * Set name of the content file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $content_demo_file_name  = 'content.xml';

		/**
		 * Holds a copy of the widget settings
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $widget_import_results;


		/**
		 * Set name of the content file
		 *
		 * @since 0.0.2
		 *
		 * @var array 
		 */
		public $content_demos		= array(
			'Easyweb Host'		=> 'Easywebhost', 
			'Easyweb Seo'		=> 'Easywebseo',
			'Easyweb Design'	=> 'Easywebdesign',
		);

		/**
		 * Constructor. Hooks all interactions to initialize the class.
		 *
		 * @since 0.0.1
		 */
		public function __construct() {

			$this->demo_files_path = dirname(__FILE__) . '/demo-files/';

			self::$instance = $this;
			parent::__construct();

		}

		/**
		 * Add menus - the menus listed here largely depend on the ones registered in the theme
		 *
		 * @since 0.0.1
		 */
		public function set_demo_menus() {

			// Menus to Import and assign - you can remove or add as many as you want
			$top_menu    		= get_term_by('name', 'Topbar Menu', 'nav_menu');
			$main_menu   		= get_term_by('name', 'Header Menu', 'nav_menu');
			$one_page   		= get_term_by('name', 'One Page', 'nav_menu');
			$duplex_left_menu	= get_term_by('name', 'Duplex Menu - Left', 'nav_menu');
			$duplex_right_menu	= get_term_by('name', 'Duplex Menu - Right', 'nav_menu');
			$footer_menu 		= get_term_by('name', 'Footer Menu', 'nav_menu');

			$locations	 = array();
			if ( $top_menu )
				$locations['header-top-menu'] = $top_menu->term_id;

			if ( $main_menu )
				$locations['header-menu'] = $main_menu->term_id;
			
			if ( $one_page )
				$locations['onepage-header-menu'] = $one_page->term_id;

			if ( $duplex_left_menu )
				$locations['duplex-menu-left'] = $duplex_left_menu->term_id;

			if ( $duplex_right_menu )
				$locations['duplex-menu-right'] = $duplex_right_menu->term_id;

			if ( $footer_menu )
				$locations['footer-menu'] = $footer_menu->term_id;


			if ( $locations ) :
				set_theme_mod( 'nav_menu_locations', $locations );
			endif;

			$this->flag_as_imported['menus'] = true;

		}

		/**
		 * Set HomePage
		 *
		 * @since 1.0.0
		 */
		public function set_demo_reading_settings() {

			$home = get_page_by_title( 'Home 1' );
			$blog = get_page_by_title( 'Blog' );

			if ( isset( $home->ID ) ) {
				update_option( 'page_on_front', $home->ID );
				update_option( 'show_on_front', 'page' );
			}

			if ( isset( $blog->ID ) ) {
				update_option( 'page_for_posts', $blog->ID );
			}

			$this->flag_as_imported['reading_settings'] = true;

		}

	}

	new Radium_Theme_Demo_Data_Importer;
}