<?php
	/**
	 * Loads Module 
	 */
	class UABB_Modules
	{
		/**
		 * Initializes the class once all plugins have loaded.
		 */
		static public function init() {
			add_action( 'plugins_loaded', __CLASS__.'::setup_hooks' );
		}

		/**
		 * Setup hooks if the builder is installed and activated.
	     */
		static public function setup_hooks() {
			if ( !class_exists( 'FLBuilder' ) ) {
				return ;
			}

			add_action( 'init', __CLASS__ . '::load_modules' );

		}

		/**
		 * Loads our custom modules.
		 */
		static public function load_modules() {
			require_once BBHF_DIR.'modules/uabb-copyright/uabb-copyright.php';
			require BBHF_DIR .'modules/uabb-copyright/class-uabb-copyright-shortcode.php';
		}
	}
	UABB_Modules::init();

	?>