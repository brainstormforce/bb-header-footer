	<?php
	/**
	 *  Function that initializes Copyright Module
	 *
	 *  @class BB_Copyright
	 */
	class BB_Copyright extends FLBuilderModule {
		/**
		 * Constructor function that constructs default values for the Copyright Module
		 *
		 * @method __construct
		 */
		public function __construct() {
			parent::__construct(array(
				'name'		   => __( 'Copyright', 'bb-header-footer' ),
				'description'  => __( 'Beaver Builder Copyright Module', 'bb-header-footer'),
				'category'	   => __( 'Basic', 'bb-header-footer'),
				'enabled'	   => true,
				'editor_export'=> true,
			));
		}
	}

	FLBuilder::register_module('BB_Copyright',array(
		'general'	=>	array(
			'title'		=> __('General', 'bb-header-footer'),
			'sections'	=> array(
				'copyright_text_url' =>	array(
					'title'		=> __( 'Copyright & its URL', 'bb-header-footer' ),
					'fields'	=> array(
						'copyright'		=> array(
							'type'	  => 'text',
							'label'   => __( 'Copyright', 'bb-header-footer' ),
							'default' => 'Copyright ©'.gmdate("Y").' '.get_bloginfo( 'name' ).' Powered by '.get_bloginfo( 'name' ),	
							'preview' => array(
								'type'	=> 'text',
								'selector' => '.hfbb-copyright-wrap a span, .hfbb-copyright-wrap span'
							),
						),
						'copyright_url' => array(
							'type'	  => 'link',
							'label'   => __( 'Url', 'bb-header-footer' ),
							'preview' => array(
								'type'	=> 'link',
								'selector' => '.hfbb-copyright-wrap a',
								'property' => 'href',
							),
						),
					),	
				),	
				'copyright_color_section'	=> array(
					'title'		=> __( 'Color', 'bb-header-footer' ),
					'fields'	=> array(
						'copyright_color'     => array(
							'type'	=> 'color',
							'label' => __( 'Color', 'bb-header-footer' ),
							'default' => '',
							'show_reset' => true,
							'preview'	 => array(
								'type' => 'css',
								'selector' => '.hfbb-copyright-wrap a span, .hfbb-copyright-wrap span',
								'property' => 'color',
							),
						),
						
					),
				),
				'copyright_typography'	=> array(
					'title'		=> __( 'Typography', 'bb-header-footer' ),
					'fields'	=> array(
						'copyright_font_type'   => array(
							'type'  => 'typography',
							'label' => __( 'Typography', 'bb-header-footer' ),
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
	));
	?>