<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php do_action('fl_head_open'); ?>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php FLTheme::title(); ?>
<?php FLTheme::favicon(); ?>
<?php FLTheme::fonts(); ?>
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->
<?php 

wp_head(); 

FLTheme::head();

?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php 
	
FLTheme::header_code();
	
do_action('fl_body_open'); 

?>
<div class="fl-page">
	<?php
	
	do_action('fl_page_open');
	
	FLTheme::fixed_header();
	
	do_action('fl_before_top_bar');
	
	FLTheme::top_bar();
	
	do_action('fl_after_top_bar');
	do_action('fl_before_header');
	
	Dynamic_Header_Footer::get_header_content();
	
	do_action('fl_after_header');
	do_action('fl_before_content');
	
	?>
	<div class="fl-page-content" itemprop="mainContentOfPage">
	
		<?php do_action('fl_content_open'); ?>