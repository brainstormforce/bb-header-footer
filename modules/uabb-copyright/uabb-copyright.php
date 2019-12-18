<?php
/**
 * UABB copyright Module
 *
 * @package  bb-header-footer
 */

/**
 * Class UABB_Copyright
 */
class UABB_Copyright extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Copyright Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Copyright', 'bb-header-footer' ),
				'description'     => __( 'UABB Copyright Module', 'bb-header-footer' ),
				'category'        => __( 'Basic', 'bb-header-footer' ),
				'enabled'         => true,
				'editor_export'   => true,
				'partial_refresh' => true,
			)
		);

		add_shortcode( 'hfbb_current_year', __CLASS__ . '::get_year' );
		add_shortcode( 'hfbb_site_name', __CLASS__ . '::get_site_title' );
	}
	/**
	 * Get_year method to get the current year
	 *
	 * @method get_year
	 */
	public static function get_year() {
		$hfbb_current_year = gmdate( 'Y' );
		$hfbb_current_year = do_shortcode( shortcode_unautop( $hfbb_current_year ) ); // Ensures that shortcodes are not wrapped in <p>...</p>.
		if ( ! empty( $hfbb_current_year ) ) {
			return $hfbb_current_year;
		}
	}
	/**
	 * Get_site_title method to get information of site
	 *
	 * @method get_site_title
	 */
	public static function get_site_title() {
		$hfbb_site_name = get_bloginfo( 'name' );
		$hfbb_site_name = do_shortcode( shortcode_unautop( $hfbb_site_name ) ); // Ensures that shortcodes are not wrapped in <p>...</p>.
		if ( ! empty( $hfbb_site_name ) ) {
			return $hfbb_site_name;
		}
	}

}

FLBuilder::register_module(
	'UABB_Copyright',
	array(
		'general' => array(
			'title'    => __( 'General', 'bb-header-footer' ),
			'sections' => array(
				'copyright_text_url'      => array(
					'title'  => __( 'Copyright & its URL', 'bb-header-footer' ),
					'fields' => array(
						'copyright'     => array(
							'type'    => 'text',
							'label'   => __( 'Copyright', 'bb-header-footer' ),
							'default' => __( 'Copyright © [hfbb_current_year] [hfbb_site_name] | Powered by [hfbb_site_name]', 'bb-header-footer' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.hfbb-copyright-wrap a span, .hfbb-copyright-wrap span',
							),
						),
						'copyright_url' => array(
							'type'    => 'link',
							'label'   => __( 'URL', 'bb-header-footer' ),
							'preview' => array(
								'type'     => 'link',
								'selector' => '.hfbb-copyright-wrap a',
								'property' => 'href',
							),
						),
					),
				),
				'copyright_color_section' => array(
					'title'  => __( 'Color', 'bb-header-footer' ),
					'fields' => array(
						'copyright_color' => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'bb-header-footer' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.hfbb-copyright-wrap a span, .hfbb-copyright-wrap span',
								'property' => 'color',
							),
						),

					),
				),
				'copyright_typography'    => array(
					'title'  => __( 'Typography', 'bb-header-footer' ),
					'fields' => array(
						'copyright_font_type' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'bb-header-footer' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.hfbb-copyright-wrap',
							),
						),
					),
				),
			),
		),
	)
);

