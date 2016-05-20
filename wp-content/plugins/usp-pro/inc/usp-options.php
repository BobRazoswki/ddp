<?php // USP Pro - Default Options

if (!defined('ABSPATH')) die();

function send_mail_options() {
	$send_mail = array(
		'wp_mail' => array(
			'value' => 'wp_mail',
			'label' => __('WP&rsquo;s', 'usp') .' <code>wp_mail()</code> '. __('function', 'usp')
		),
		'php_mail' => array(
			'value' => 'php_mail',
			'label' => __('PHP&rsquo;s', 'usp') .' <code>mail()</code> '. __('function', 'usp')
		),
		'no_mail' => array(
			'value' => 'no_mail',
			'label' => __('Disable all email alerts', 'usp')
		),
	);
	return $send_mail;
}

function mail_format() {
	$mail_format = array(
		'text' => array(
			'value' => 'text',
			'label' => __('Plain-text format', 'usp')
		),
		'html' => array(
			'value' => 'html',
			'label' => __('HTML format', 'usp')
		),
	);
	return $mail_format;
}

function post_type_options() {
	$post_type = array(
		'post' => array(
			'value' => 'post',
			'label' => __('Regular WP Posts', 'usp') .' <span class="usp-lite-text">'. __('(default)', 'usp') .'</span>',
		),
		'page' => array(
			'value' => 'page',
			'label' => __('Regular WP Pages', 'usp'),
		),
		'usp_post' => array(
			'value' => 'usp_post',
			'label' => __('USP Posts', 'usp') .' <span class="usp-lite-text">'. __('(see related setting, &ldquo;Slug for USP Post&rdquo;)', 'usp') .'</span>',
		),
		'other' => array(
			'value' => 'other',
			'label' => __('Existing Post Type', 'usp') .' <span class="usp-lite-text">'. __('(see related setting, &ldquo;Slug for Existing Post Type&rdquo;)', 'usp') .'</span>',
		),
	);
	return $post_type;
}

function cats_menu_options() {
	$cats_menu = array(
		'dropdown' => array(
			'value' => 'dropdown',
			'label' => __('Dropdown/select menu', 'usp')
		),
		'checkbox' => array(
			'value' => 'checkbox',
			'label' => __('Checkboxes', 'usp')
		),
	);
	return $cats_menu;
}

function tags_menu_options() {
	$tags_menu = array(
		'dropdown' => array(
			'value' => 'dropdown',
			'label' => __('Dropdown/select menu', 'usp')
		),
		'checkbox' => array(
			'value' => 'checkbox',
			'label' => __('Checkboxes', 'usp')
		),
		'input' => array(
			'value' => 'input',
			'label' => __('Text input field', 'usp')
		),
	);
	return $tags_menu;
}

function tags_order_options() {
	$tags_order = array(
		'name_asc' => array(
			'value' => 'name_asc',
			'label' => __('Name, ascending (default)', 'usp')
		),
		'name_desc' => array(
			'value' => 'name_desc',
			'label' => __('Name, descending', 'usp')
		),
		'id_asc' => array(
			'value' => 'id_asc',
			'label' => __('Tag ID, ascending', 'usp')
		),
		'id_desc' => array(
			'value' => 'id_desc',
			'label' => __('Tag ID, descending', 'usp')
		),
		'count_asc' => array(
			'value' => 'count_asc',
			'label' => __('Count, ascending', 'usp')
		),
		'count_desc' => array(
			'value' => 'count_desc',
			'label' => __('Count, descending', 'usp')
		),
	);
	return $tags_order;
}

function style_options() {
	$style_option = array(
		'simple' => array(
			'value' => 'simple',
			'label' => __('Super simple style (default)', 'usp')
		),
		'minimal' => array(
			'value' => 'minimal',
			'label' => __('Clean minimal style', 'usp')
		),
		'small' => array(
			'value' => 'small',
			'label' => __('Smaller form style', 'usp')
		),
		'large' => array(
			'value' => 'large',
			'label' => __('Larger form style', 'usp')
		),
		'custom' => array(
			'value' => 'custom',
			'label' => __('Define custom style', 'usp')
		),
		'disable' => array(
			'value' => 'disable',
			'label' => __('Disable styles', 'usp')
		),
	);
	return $style_option;
}

function display_images_options() {
	$display_images = array(
		'before' => array(
			'value' => 'before',
			'label' => __('Before post content', 'usp')
		),
		'after' => array(
			'value' => 'after',
			'label' => __('After post content', 'usp')
		),
		'disable' => array(
			'value' => 'disable',
			'label' => __('Do not auto-display images', 'usp')
		),
	);
	return $display_images;
}

function display_size_options() {
	$display_sizes = array(
		'thumbnail' => array(
			'value' => 'thumbnail',
			'label' => __('Thumbnail (default)', 'usp')
		),
		'medium' => array(
			'value' => 'medium',
			'label' => __('Medium', 'usp')
		),
		'large' => array(
			'value' => 'large',
			'label' => __('Large', 'usp')
		),
		'full' => array(
			'value' => 'full',
			'label' => __('Full', 'usp')
		),
	);
	return $display_sizes;
}

function recaptcha_options() {
	$recaptcha = array(
		'v1' => array(
			'value' => 'v1',
			'label' => __('Version 1 (Original reCAPTCHA)', 'usp')
		),
		'v2' => array(
			'value' => 'v2',
			'label' => __('Version 2 (noCAPTCHA reCAPTCHA)', 'usp')
		),
	);
	return $recaptcha;
}
