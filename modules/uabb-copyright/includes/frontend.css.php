<?php

FLBuilderCSS::typography_field_rule( array(
	'settings'     => $settings,
	'setting_name' => 'copyright_font_type',
	'selector'     => ".fl-node-$id .hfbb-copyright-wrap",
	'prop'         => 'text-align',
) );

FLBuilderCSS::rule( array(
	'selector'	=> ".fl-node-$id .hfbb-copyright-wrap span, .fl-node-$id .hfbb-copyright-wrap a span",
	'props'		=> array(
		'color'	  => $settings->copyright_color,
	),
) );

FLBuilderCSS::typography_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'copyright_font_type',
		'selector'     => ".fl-node-$id .hfbb-copyright-wrap",
	)
);
?>