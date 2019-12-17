<?php
	/**
	 * Loads Module 
	 */
	class BB_Modules
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
			require_once BBHF_DIR.'modules/bb-copyright/bb-copyright.php';
		}
	}
	BB_Modules::init();

	?>