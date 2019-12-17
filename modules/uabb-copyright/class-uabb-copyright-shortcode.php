<?php 

/**
 * 
 */
class UABB_Copyright_Shortcode
{
	
	public function __construct()
	{
		add_shortcode( 'hfbb_current_year',  __CLASS__.'::get_year' );
		add_shortcode( 'hfbb_site_name', __CLASS__.'::get_site_title' );
	}

	static public function get_year() {
		$hfbb_current_year = gmdate("Y");
		$hfbb_current_year = do_shortcode( shortcode_unautop( $hfbb_current_year ) ); //Ensures that shortcodes are not wrapped in <p>...</p>.
		if( !empty( $hfbb_current_year ) ) {
			return $hfbb_current_year;
		}
	}

	static public function get_site_title() {
		$hfbb_site_name = get_bloginfo( 'name' );
		$hfbb_site_name = do_shortcode( shortcode_unautop( $hfbb_site_name ) ); //Ensures that shortcodes are not wrapped in <p>...</p>.
		if( !empty( $hfbb_site_name ) ) {
			return $hfbb_site_name;
		}
	}
}

new UABB_Copyright_Shortcode();
