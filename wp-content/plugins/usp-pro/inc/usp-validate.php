<?php // USP Pro - Settings Validation

if (!defined('ABSPATH')) die();

function validate_general($input) {

	$cats_menu = cats_menu_options();
	if (!isset($input['cats_menu'])) $input['cats_menu'] = null;
	if (!array_key_exists($input['cats_menu'], $cats_menu)) $input['cats_menu'] = null;
	
	$tags_order = tags_order_options();
	if (!isset($input['tags_order'])) $input['tags_order'] = null;
	if (!array_key_exists($input['tags_order'], $tags_order)) $input['tags_order'] = null;
	
	$tags_menu = tags_menu_options();
	if (!isset($input['tags_menu'])) $input['tags_menu'] = null;
	if (!array_key_exists($input['tags_menu'], $tags_menu)) $input['tags_menu'] = null;
	
	$recaptcha = recaptcha_options();
	if (!isset($input['recaptcha_version'])) $input['recaptcha_version'] = null;
	if (!array_key_exists($input['recaptcha_version'], $recaptcha)) $input['recaptcha_version'] = null;
	
	if (isset($input['categories'])) $input['categories'] = is_array($input['categories']) && !empty($input['categories']) ? array_unique($input['categories']) : array(get_option('default_category'));
	if (isset($input['number_approved'])) $input['number_approved'] = is_numeric($input['number_approved']) ? intval($input['number_approved']) : - 1;
	if (isset($input['tags'])) $input['tags'] = is_array($input['tags']) && !empty($input['tags']) ? array_unique($input['tags']) : array();
	
	if (isset($input['tags_number']))       $input['tags_number']       = sanitize_text_field($input['tags_number']);
	if (isset($input['redirect_post']))     $input['redirect_post']     = sanitize_text_field($input['redirect_post']);
	if (isset($input['character_max']))     $input['character_max']     = sanitize_text_field($input['character_max']);
	if (isset($input['character_min']))     $input['character_min']     = sanitize_text_field($input['character_min']);
	if (isset($input['captcha_question']))  $input['captcha_question']  = sanitize_text_field($input['captcha_question']);
	if (isset($input['captcha_response']))  $input['captcha_response']  = sanitize_text_field($input['captcha_response']);
	if (isset($input['recaptcha_public']))  $input['recaptcha_public']  = sanitize_text_field($input['recaptcha_public']);
	if (isset($input['recaptcha_private'])) $input['recaptcha_private'] = sanitize_text_field($input['recaptcha_private']);
	if (isset($input['enable_stats']))      $input['enable_stats']      = sanitize_text_field($input['enable_stats']);
	if (isset($input['use_cat_id']))        $input['use_cat_id']        = sanitize_text_field($input['use_cat_id']);
	if (isset($input['assign_author']))     $input['assign_author']     = sanitize_text_field($input['assign_author']);
	if (isset($input['assign_role']))       $input['assign_role']       = sanitize_text_field($input['assign_role']);
	if (isset($input['custom_status']))     $input['custom_status']     = sanitize_text_field($input['custom_status']);
	if (isset($input['submit_form_ids']))   $input['submit_form_ids']   = sanitize_text_field($input['submit_form_ids']);
	if (isset($input['register_form_ids'])) $input['register_form_ids'] = sanitize_text_field($input['register_form_ids']);
	if (isset($input['contact_form']))      $input['contact_form']      = sanitize_text_field($input['contact_form']);

	if (!isset($input['hidden_tags'])) $input['hidden_tags'] = null;
	$input['hidden_tags'] = ($input['hidden_tags'] == 1 ? 1 : 0);
	
	if (!isset($input['tags_empty'])) $input['tags_empty'] = null;
	$input['tags_empty'] = ($input['tags_empty'] == 1 ? 1 : 0);
	
	if (!isset($input['tags_multiple'])) $input['tags_multiple'] = null;
	$input['tags_multiple'] = ($input['tags_multiple'] == 1 ? 1 : 0);
	
	if (!isset($input['captcha_casing'])) $input['captcha_casing'] = null;
	$input['captcha_casing'] = ($input['captcha_casing'] == 1 ? 1 : 0);
	
	if (!isset($input['use_author'])) $input['use_author'] = null;
	$input['use_author'] = ($input['use_author'] == 1 ? 1 : 0);
	
	if (!isset($input['replace_author'])) $input['replace_author'] = null;
	$input['replace_author'] = ($input['replace_author'] == 1 ? 1 : 0);
	
	if (!isset($input['use_cat'])) $input['use_cat'] = null;
	$input['use_cat'] = ($input['use_cat'] == 1 ? 1 : 0);
	
	if (!isset($input['hidden_cats'])) $input['hidden_cats'] = null;
	$input['hidden_cats'] = ($input['hidden_cats'] == 1 ? 1 : 0);
	
	if (!isset($input['cats_multiple'])) $input['cats_multiple'] = null;
	$input['cats_multiple'] = ($input['cats_multiple'] == 1 ? 1 : 0);
	
	if (!isset($input['cats_nested'])) $input['cats_nested'] = null;
	$input['cats_nested'] = ($input['cats_nested'] == 1 ? 1 : 0);
	
	if (!isset($input['sessions_on'])) $input['sessions_on'] = null;
	$input['sessions_on'] = ($input['sessions_on'] == 1 ? 1 : 0);
	
	if (!isset($input['sessions_scope'])) $input['sessions_scope'] = null;
	$input['sessions_scope'] = ($input['sessions_scope'] == 1 ? 1 : 0);
	
	if (!isset($input['sessions_default'])) $input['sessions_default'] = null;
	$input['sessions_default'] = ($input['sessions_default'] == 1 ? 1 : 0);
	
	if (!isset($input['titles_unique'])) $input['titles_unique'] = null;
	$input['titles_unique'] = ($input['titles_unique'] == 1 ? 1 : 0);
	
	if (!isset($input['content_unique'])) $input['content_unique'] = null;
	$input['content_unique'] = ($input['content_unique'] == 1 ? 1 : 0);
	
	if (!isset($input['enable_form_lock'])) $input['enable_form_lock'] = null;
	$input['enable_form_lock'] = ($input['enable_form_lock'] == 1 ? 1 : 0);
	
	return $input;
	
}

function validate_style($input) {
	
	$form_style = style_options();
	if (!isset($input['form_style'])) $input['form_style'] = null;
	if (!array_key_exists($input['form_style'], $form_style)) $input['form_style'] = null;
	
	if (isset($input['style_simple'])) $input['style_simple'] = sanitize_text_field($input['style_simple']);
	if (isset($input['style_min']))    $input['style_min']    = sanitize_text_field($input['style_min']);
	if (isset($input['style_small']))  $input['style_small']  = sanitize_text_field($input['style_small']);
	if (isset($input['style_large']))  $input['style_large']  = sanitize_text_field($input['style_large']);
	if (isset($input['style_custom'])) $input['style_custom'] = sanitize_text_field($input['style_custom']);
	if (isset($input['include_url']))  $input['include_url']  = sanitize_text_field($input['include_url']);
	
	if (isset($input['script_custom'])) $input['script_custom'] = htmlspecialchars($input['script_custom'], ENT_QUOTES, get_option('blog_charset', 'UTF-8'));
	
	if (!isset($input['include_css'])) $input['include_css'] = null;
	$input['include_css'] = ($input['include_css'] == 1 ? 1 : 0);
	
	if (!isset($input['include_js'])) $input['include_js'] = null;
	$input['include_js'] = ($input['include_js'] == 1 ? 1 : 0);
	
	return $input;
	
}

function validate_uploads($input) {
	
	global $usp_uploads;
	
	$display_images = display_images_options();
	if (!isset($input['post_images'])) $input['post_images'] = null;
	if (!array_key_exists($input['post_images'], $display_images)) $input['post_images'] = null;
	
	$display_sizes = display_size_options();
	if (!isset($input['display_size'])) $input['display_size'] = null;
	if (!array_key_exists($input['display_size'], $display_sizes)) $input['display_size'] = null;
	
	if (isset($input['min_files'])) $input['min_files'] = is_numeric($input['min_files']) ? intval($input['min_files']) : $usp_uploads['min_files'];
	if (isset($input['max_files'])) $input['max_files'] = is_numeric($input['max_files']) ? intval($input['max_files']) : $usp_uploads['max_files'];
	
	if (isset($input['min_width']))  $input['min_width']  = is_numeric($input['min_width'])  ? intval($input['min_width'])  : $usp_uploads['min_width'];
	if (isset($input['min_height'])) $input['min_height'] = is_numeric($input['min_height']) ? intval($input['min_height']) : $usp_uploads['min_height'];

	if (isset($input['max_width']))  $input['max_width']  = is_numeric($input['max_width'])  ? intval($input['max_width'])  : $usp_uploads['max_width'];
	if (isset($input['max_height'])) $input['max_height'] = is_numeric($input['max_height']) ? intval($input['max_height']) : $usp_uploads['max_height'];

	if (isset($input['max_size'])) $input['max_size'] = is_numeric($input['max_size']) ? intval($input['max_size']) : $usp_uploads['max_size'];
	if (isset($input['min_size'])) $input['min_size'] = is_numeric($input['min_size']) ? intval($input['min_size']) : $usp_uploads['min_size'];
	
	if (isset($input['files_allow']))  $input['files_allow']  = sanitize_text_field($input['files_allow']);
	if (isset($input['featured_key'])) $input['featured_key'] = sanitize_text_field($input['featured_key']);
	
	if (!isset($input['featured_image'])) $input['featured_image'] = null;
	$input['featured_image'] = ($input['featured_image'] == 1 ? 1 : 0);
	
	if (!isset($input['unique_filename'])) $input['unique_filename'] = null;
	$input['unique_filename'] = ($input['unique_filename'] == 1 ? 1 : 0);
	
	if (!isset($input['user_shortcodes'])) $input['user_shortcodes'] = null;
	$input['user_shortcodes'] = ($input['user_shortcodes'] == 1 ? 1 : 0);
	
	if (!isset($input['enable_media'])) $input['enable_media'] = null;
	$input['enable_media'] = ($input['enable_media'] == 1 ? 1 : 0);
	
	if (!isset($input['square_image'])) $input['square_image'] = null;
	$input['square_image'] = ($input['square_image'] == 1 ? 1 : 0);
	
	return $input;
	
}

function validate_admin($input) {
	
	$send_mail = send_mail_options();
	if (!isset($input['send_mail'])) $input['send_mail'] = null;
	if (!array_key_exists($input['send_mail'], $send_mail)) $input['send_mail'] = null;
	
	$mail_format = mail_format();
	if (!isset($input['mail_format'])) $input['mail_format'] = null;
	if (!array_key_exists($input['mail_format'], $mail_format)) $input['mail_format'] = null;
	
	// dealing with kses
	$allowed_atts = array(
		'align'    => array(), 
		'class'    => array(), 
		'type'     => array(), 
		'id'       => array(), 
		'dir'      => array(), 
		'lang'     => array(), 
		'style'    => array(), 
		'xml:lang' => array(), 
		'src'      => array(), 
		'alt'      => array(),
		'href'     => array(), 
		'rel'      => array(), 
		'target'   => array(),
	);
	$allowedposttags['script'] = $allowed_atts;
	$allowedposttags['strong'] = $allowed_atts;
	$allowedposttags['small']  = $allowed_atts;
	$allowedposttags['span']   = $allowed_atts;
	$allowedposttags['abbr']   = $allowed_atts;
	$allowedposttags['code']   = $allowed_atts;
	$allowedposttags['div']    = $allowed_atts;
	$allowedposttags['img']    = $allowed_atts;
	$allowedposttags['h1']     = $allowed_atts;
	$allowedposttags['h2']     = $allowed_atts;
	$allowedposttags['h3']     = $allowed_atts;
	$allowedposttags['h4']     = $allowed_atts;
	$allowedposttags['h5']     = $allowed_atts;
	$allowedposttags['ol']     = $allowed_atts;
	$allowedposttags['ul']     = $allowed_atts;
	$allowedposttags['li']     = $allowed_atts;
	$allowedposttags['em']     = $allowed_atts;
	$allowedposttags['p']      = $allowed_atts;
	$allowedposttags['a']      = $allowed_atts;
	
	if (isset($input['custom_content']))          $input['custom_content']          = wp_kses_post($input['custom_content']);
	if (isset($input['post_alert_user']))         $input['post_alert_user']         = wp_kses_post($input['post_alert_user']);
	if (isset($input['post_alert_admin']))        $input['post_alert_admin']        = wp_kses_post($input['post_alert_admin']);
	if (isset($input['approval_message']))        $input['approval_message']        = wp_kses_post($input['approval_message']);
	if (isset($input['approval_message_admin']))  $input['approval_message_admin']  = wp_kses_post($input['approval_message_admin']);
	if (isset($input['denied_message']))          $input['denied_message']          = wp_kses_post($input['denied_message']);
	if (isset($input['denied_message_admin']))    $input['denied_message_admin']    = wp_kses_post($input['denied_message_admin']);
	if (isset($input['scheduled_message_admin'])) $input['scheduled_message_admin'] = wp_kses_post($input['scheduled_message_admin']);
	if (isset($input['scheduled_message']))       $input['scheduled_message']       = wp_kses_post($input['scheduled_message']);
	
	if (isset($input['alert_subject_user']))      $input['alert_subject_user']      = sanitize_text_field($input['alert_subject_user']);
	if (isset($input['alert_subject_admin']))     $input['alert_subject_admin']     = sanitize_text_field($input['alert_subject_admin']);
	if (isset($input['approval_subject']))        $input['approval_subject']        = sanitize_text_field($input['approval_subject']);
	if (isset($input['approval_subject_admin']))  $input['approval_subject_admin']  = sanitize_text_field($input['approval_subject_admin']);
	if (isset($input['denied_subject']))          $input['denied_subject']          = sanitize_text_field($input['denied_subject']);
	if (isset($input['denied_subject_admin']))    $input['denied_subject_admin']    = sanitize_text_field($input['denied_subject_admin']);
	if (isset($input['scheduled_subject']))       $input['scheduled_subject']       = sanitize_text_field($input['scheduled_subject']);
	if (isset($input['scheduled_subject_admin'])) $input['scheduled_subject_admin'] = sanitize_text_field($input['scheduled_subject_admin']);
	
	if (isset($input['contact_sub_prefix'])) $input['contact_sub_prefix'] = sanitize_text_field($input['contact_sub_prefix']);
	if (isset($input['contact_subject']))    $input['contact_subject']    = sanitize_text_field($input['contact_subject']);
	if (isset($input['contact_cc']))         $input['contact_cc']         = sanitize_text_field($input['contact_cc']);
	if (isset($input['contact_cc_note']))    $input['contact_cc_note']    = sanitize_text_field($input['contact_cc_note']);
	if (isset($input['admin_email']))        $input['admin_email']        = sanitize_text_field($input['admin_email']);
	if (isset($input['admin_from']))         $input['admin_from']         = sanitize_text_field($input['admin_from']);
	if (isset($input['admin_name']))         $input['admin_name']         = sanitize_text_field($input['admin_name']);
	if (isset($input['cc_submit']))          $input['cc_submit']          = sanitize_text_field($input['cc_submit']);
	if (isset($input['cc_approval']))        $input['cc_approval']        = sanitize_text_field($input['cc_approval']);
	if (isset($input['cc_denied']))          $input['cc_denied']          = sanitize_text_field($input['cc_denied']);
	if (isset($input['cc_scheduled']))       $input['cc_scheduled']       = sanitize_text_field($input['cc_scheduled']);
	if (isset($input['contact_from']))       $input['contact_from']       = sanitize_text_field($input['contact_from']);
	if (isset($input['custom_contact_1']))   $input['custom_contact_1']   = sanitize_text_field($input['custom_contact_1']);
	if (isset($input['custom_contact_2']))   $input['custom_contact_2']   = sanitize_text_field($input['custom_contact_2']);
	if (isset($input['custom_contact_3']))   $input['custom_contact_3']   = sanitize_text_field($input['custom_contact_3']);
	if (isset($input['custom_contact_4']))   $input['custom_contact_4']   = sanitize_text_field($input['custom_contact_4']);
	if (isset($input['custom_contact_5']))   $input['custom_contact_5']   = sanitize_text_field($input['custom_contact_5']);
	
	if (!isset($input['send_mail_admin'])) $input['send_mail_admin'] = null;
	$input['send_mail_admin'] = ($input['send_mail_admin'] == 1 ? 1 : 0);
	
	if (!isset($input['send_mail_user'])) $input['send_mail_user'] = null;
	$input['send_mail_user'] = ($input['send_mail_user'] == 1 ? 1 : 0);
	
	if (!isset($input['send_approval_user'])) $input['send_approval_user'] = null;
	$input['send_approval_user'] = ($input['send_approval_user'] == 1 ? 1 : 0);
	
	if (!isset($input['send_approval_admin'])) $input['send_approval_admin'] = null;
	$input['send_approval_admin'] = ($input['send_approval_admin'] == 1 ? 1 : 0);
	
	if (!isset($input['send_denied_user'])) $input['send_denied_user'] = null;
	$input['send_denied_user'] = ($input['send_denied_user'] == 1 ? 1 : 0);
	
	if (!isset($input['send_denied_admin'])) $input['send_denied_admin'] = null;
	$input['send_denied_admin'] = ($input['send_denied_admin'] == 1 ? 1 : 0);
	
	if (!isset($input['send_scheduled_admin'])) $input['send_scheduled_admin'] = null;
	$input['send_scheduled_admin'] = ($input['send_scheduled_admin'] == 1 ? 1 : 0);
	
	if (!isset($input['send_scheduled_user'])) $input['send_scheduled_user'] = null;
	$input['send_scheduled_user'] = ($input['send_scheduled_user'] == 1 ? 1 : 0);
	
	if (!isset($input['contact_cc_user'])) $input['contact_cc_user'] = null;
	$input['contact_cc_user'] = ($input['contact_cc_user'] == 1 ? 1 : 0);
	
	if (!isset($input['contact_stats'])) $input['contact_stats'] = null;
	$input['contact_stats'] = ($input['contact_stats'] == 1 ? 1 : 0);
	
	if (!isset($input['contact_custom'])) $input['contact_custom'] = null;
	$input['contact_custom'] = ($input['contact_custom'] == 1 ? 1 : 0);
	
	return $input;
	
}

function validate_advanced($input) {
	
	global $allowedposttags;
	
	// dealing with kses
	$allowed_atts = array(
		'align'    => array(), 
		'class'    => array(), 
		'type'     => array(), 
		'id'       => array(), 
		'dir'      => array(), 
		'lang'     => array(), 
		'style'    => array(), 
		'xml:lang' => array(), 
		'src'      => array(), 
		'alt'      => array(),
		'href'     => array(), 
		'rel'      => array(), 
		'target'   => array(),
	);
	$allowedposttags['script'] = $allowed_atts;
	$allowedposttags['strong'] = $allowed_atts;
	$allowedposttags['small']  = $allowed_atts;
	$allowedposttags['span']   = $allowed_atts;
	$allowedposttags['abbr']   = $allowed_atts;
	$allowedposttags['code']   = $allowed_atts;
	$allowedposttags['div']    = $allowed_atts;
	$allowedposttags['img']    = $allowed_atts;
	$allowedposttags['h1']     = $allowed_atts;
	$allowedposttags['h2']     = $allowed_atts;
	$allowedposttags['h3']     = $allowed_atts;
	$allowedposttags['h4']     = $allowed_atts;
	$allowedposttags['h5']     = $allowed_atts;
	$allowedposttags['ol']     = $allowed_atts;
	$allowedposttags['ul']     = $allowed_atts;
	$allowedposttags['li']     = $allowed_atts;
	$allowedposttags['em']     = $allowed_atts;
	$allowedposttags['p']      = $allowed_atts;
	$allowedposttags['a']      = $allowed_atts;
	
	if (isset($input['custom_before']))      $input['custom_before']      = wp_kses_post($input['custom_before'],      $allowedposttags);
	if (isset($input['custom_after']))       $input['custom_after']       = wp_kses_post($input['custom_after'],       $allowedposttags);
	if (isset($input['success_before']))     $input['success_before']     = wp_kses_post($input['success_before'],     $allowedposttags);
	if (isset($input['success_after']))      $input['success_after']      = wp_kses_post($input['success_after'],      $allowedposttags);
	if (isset($input['error_before']))       $input['error_before']       = wp_kses_post($input['error_before'],       $allowedposttags);
	if (isset($input['error_after']))        $input['error_after']        = wp_kses_post($input['error_after'],        $allowedposttags);
	if (isset($input['success_reg']))        $input['success_reg']        = wp_kses_post($input['success_reg'],        $allowedposttags);
	if (isset($input['success_post']))       $input['success_post']       = wp_kses_post($input['success_post'],       $allowedposttags);
	if (isset($input['success_both']))       $input['success_both']       = wp_kses_post($input['success_both'],       $allowedposttags);
	if (isset($input['success_contact']))    $input['success_contact']    = wp_kses_post($input['success_contact'],    $allowedposttags);
	if (isset($input['success_email_reg']))  $input['success_email_reg']  = wp_kses_post($input['success_email_reg'],  $allowedposttags);
	if (isset($input['success_email_post'])) $input['success_email_post'] = wp_kses_post($input['success_email_post'], $allowedposttags);
	if (isset($input['success_email_both'])) $input['success_email_both'] = wp_kses_post($input['success_email_both'], $allowedposttags);
	if (isset($input['default_content']))    $input['default_content']    = wp_kses_post($input['default_content'],    $allowedposttags);
	
	// errors
	if (isset($input['usp_error_1']))  $input['usp_error_1']  = sanitize_text_field($input['usp_error_1']);
	if (isset($input['usp_error_2']))  $input['usp_error_2']  = sanitize_text_field($input['usp_error_2']);
	if (isset($input['usp_error_3']))  $input['usp_error_3']  = sanitize_text_field($input['usp_error_3']);
	if (isset($input['usp_error_4']))  $input['usp_error_4']  = sanitize_text_field($input['usp_error_4']);
	if (isset($input['usp_error_5']))  $input['usp_error_5']  = sanitize_text_field($input['usp_error_5']);
	if (isset($input['usp_error_6']))  $input['usp_error_6']  = sanitize_text_field($input['usp_error_6']);
	if (isset($input['usp_error_7']))  $input['usp_error_7']  = sanitize_text_field($input['usp_error_7']);
	if (isset($input['usp_error_8']))  $input['usp_error_8']  = sanitize_text_field($input['usp_error_8']);
	if (isset($input['usp_error_9']))  $input['usp_error_9']  = sanitize_text_field($input['usp_error_9']);
	if (isset($input['usp_error_10'])) $input['usp_error_10'] = sanitize_text_field($input['usp_error_10']);
	if (isset($input['usp_error_11'])) $input['usp_error_11'] = sanitize_text_field($input['usp_error_11']);
	if (isset($input['usp_error_12'])) $input['usp_error_12'] = sanitize_text_field($input['usp_error_12']);
	if (isset($input['usp_error_13'])) $input['usp_error_13'] = sanitize_text_field($input['usp_error_13']);
	if (isset($input['usp_error_14'])) $input['usp_error_14'] = sanitize_text_field($input['usp_error_14']);
	if (isset($input['usp_error_15'])) $input['usp_error_15'] = sanitize_text_field($input['usp_error_15']);
	if (isset($input['usp_error_16'])) $input['usp_error_16'] = sanitize_text_field($input['usp_error_16']);
	if (isset($input['usp_error_17'])) $input['usp_error_17'] = sanitize_text_field($input['usp_error_17']);
	if (isset($input['usp_error_18'])) $input['usp_error_18'] = sanitize_text_field($input['usp_error_18']);
	
	if (isset($input['usp_error_a']))  $input['usp_error_a']  = sanitize_text_field($input['usp_error_a']);
	if (isset($input['usp_error_b']))  $input['usp_error_b']  = sanitize_text_field($input['usp_error_b']);
	if (isset($input['usp_error_c']))  $input['usp_error_c']  = sanitize_text_field($input['usp_error_c']);
	if (isset($input['usp_error_d']))  $input['usp_error_d']  = sanitize_text_field($input['usp_error_d']);
	if (isset($input['usp_error_e']))  $input['usp_error_e']  = sanitize_text_field($input['usp_error_e']);
	if (isset($input['usp_error_f']))  $input['usp_error_f']  = sanitize_text_field($input['usp_error_f']);
	if (isset($input['usp_error_g']))  $input['usp_error_g']  = sanitize_text_field($input['usp_error_g']);
	
	// custom fields
	foreach ($input as $key => $value) {
		if (preg_match("/^usp_label_c([0-9]+)$/i", $key, $match)) {
			if (isset($input['usp_label_c'. $match[1]])) $input['usp_label_c'. $match[1]] = sanitize_text_field($input['usp_label_c'. $match[1]]);
			
		} elseif (preg_match("/^usp_custom_label_([0-9a-z_-]+)$/i", $key, $match)) {
			$custom_merged = usp_merge_custom_fields();
			if (in_array($match[1], $custom_merged)) $input['usp_custom_label_'. $match[1]] = sanitize_text_field($input['usp_custom_label_'. $match[1]]);
		}
	}
	
	if (isset($input['custom_prefix']))   $input['custom_prefix']   = preg_replace('/[^0-9a-z_-]+/i',  '', sanitize_text_field($input['custom_prefix']));
	if (isset($input['custom_optional'])) $input['custom_optional'] = preg_replace('/[^0-9a-z,_-]+/i', '', sanitize_text_field($input['custom_optional']));
	if (isset($input['custom_required'])) $input['custom_required'] = preg_replace('/[^0-9a-z,_-]+/i', '', sanitize_text_field($input['custom_required']));
	
	if (isset($input['submit_text']))      $input['submit_text']      = sanitize_text_field($input['submit_text']);
	if (isset($input['html_content']))     $input['html_content']     = sanitize_text_field($input['html_content']);
	if (isset($input['other_type']))       $input['other_type']       = sanitize_text_field($input['other_type']);
	if (isset($input['post_type_slug']))   $input['post_type_slug']   = sanitize_text_field($input['post_type_slug']);
	if (isset($input['redirect_success'])) $input['redirect_success'] = sanitize_text_field($input['redirect_success']);
	if (isset($input['redirect_failure'])) $input['redirect_failure'] = sanitize_text_field($input['redirect_failure']);
	if (isset($input['blacklist_terms']))  $input['blacklist_terms']  = sanitize_text_field($input['blacklist_terms']);
	if (isset($input['form_atts']))        $input['form_atts']        = sanitize_text_field($input['form_atts']);
	if (isset($input['default_title']))    $input['default_title']    = sanitize_text_field($input['default_title']);
	if (isset($input['custom_fields']))    $input['custom_fields']    = sanitize_text_field($input['custom_fields']);
	
	$post_type = post_type_options();
	if (!isset($input['post_type'])) $input['post_type'] = null;
	if (!array_key_exists($input['post_type'], $post_type)) $input['post_type'] = null;
	
	if (isset($input['post_type_role'])) $input['post_type_role'] = is_array($input['post_type_role']) && !empty($input['post_type_role']) ? array_unique($input['post_type_role']) : array();
	if (isset($input['form_type_role'])) $input['form_type_role'] = is_array($input['form_type_role']) && !empty($input['form_type_role']) ? array_unique($input['form_type_role']) : array();
	
	if (!isset($input['success_form'])) $input['success_form'] = null;
	$input['success_form'] = ($input['success_form'] == 1 ? 1 : 0);
	
	if (!isset($input['enable_autop'])) $input['enable_autop'] = null;
	$input['enable_autop'] = ($input['enable_autop'] == 1 ? 1 : 0);

	if (!isset($input['submit_button'])) $input['submit_button'] = null;
	$input['submit_button'] = ($input['submit_button'] == 1 ? 1 : 0);

	if (!isset($input['fieldsets'])) $input['fieldsets'] = null;
	$input['fieldsets'] = ($input['fieldsets'] == 1 ? 1 : 0);
	
	if (!isset($input['form_demos'])) $input['form_demos'] = null;
	$input['form_demos'] = ($input['form_demos'] == 1 ? 1 : 0);
	
	if (!isset($input['post_demos'])) $input['post_demos'] = null;
	$input['post_demos'] = ($input['post_demos'] == 1 ? 1 : 0);
	
	return $input;
	
}

function validate_more($input) {
	
	global $allowedposttags;
	
	// dealing with kses
	$allowed_atts = array(
		'align'    => array(), 
		'class'    => array(), 
		'type'     => array(), 
		'id'       => array(), 
		'dir'      => array(), 
		'lang'     => array(), 
		'style'    => array(), 
		'xml:lang' => array(), 
		'src'      => array(), 
		'alt'      => array(),
		'href'     => array(), 
		'rel'      => array(), 
		'target'   => array(),
	);
	$allowedposttags['script'] = $allowed_atts;
	$allowedposttags['strong'] = $allowed_atts;
	$allowedposttags['small']  = $allowed_atts;
	$allowedposttags['span']   = $allowed_atts;
	$allowedposttags['abbr']   = $allowed_atts;
	$allowedposttags['code']   = $allowed_atts;
	$allowedposttags['div']    = $allowed_atts;
	$allowedposttags['img']    = $allowed_atts;
	$allowedposttags['h1']     = $allowed_atts;
	$allowedposttags['h2']     = $allowed_atts;
	$allowedposttags['h3']     = $allowed_atts;
	$allowedposttags['h4']     = $allowed_atts;
	$allowedposttags['h5']     = $allowed_atts;
	$allowedposttags['ol']     = $allowed_atts;
	$allowedposttags['ul']     = $allowed_atts;
	$allowedposttags['li']     = $allowed_atts;
	$allowedposttags['em']     = $allowed_atts;
	$allowedposttags['p']      = $allowed_atts;
	$allowedposttags['a']      = $allowed_atts;
	
	// primary field errors
	if (isset($input['usp_error_1_desc']))    $input['usp_error_1_desc']    = wp_kses_post($input['usp_error_1_desc'],    $allowedposttags);
	if (isset($input['usp_error_2_desc']))    $input['usp_error_2_desc']    = wp_kses_post($input['usp_error_2_desc'],    $allowedposttags);
	if (isset($input['usp_error_3_desc']))    $input['usp_error_3_desc']    = wp_kses_post($input['usp_error_3_desc'],    $allowedposttags);
	if (isset($input['usp_error_4_desc']))    $input['usp_error_4_desc']    = wp_kses_post($input['usp_error_4_desc'],    $allowedposttags);
	if (isset($input['usp_error_5_desc']))    $input['usp_error_5_desc']    = wp_kses_post($input['usp_error_5_desc'],    $allowedposttags);
	if (isset($input['usp_error_6_desc']))    $input['usp_error_6_desc']    = wp_kses_post($input['usp_error_6_desc'],    $allowedposttags);
	if (isset($input['usp_error_7_desc']))    $input['usp_error_7_desc']    = wp_kses_post($input['usp_error_7_desc'],    $allowedposttags);
	if (isset($input['usp_error_8_desc']))    $input['usp_error_8_desc']    = wp_kses_post($input['usp_error_8_desc'],    $allowedposttags);
	if (isset($input['usp_error_9_desc']))    $input['usp_error_9_desc']    = wp_kses_post($input['usp_error_9_desc'],    $allowedposttags);
	if (isset($input['usp_error_10_desc']))   $input['usp_error_10_desc']   = wp_kses_post($input['usp_error_10_desc'],   $allowedposttags);
	if (isset($input['usp_error_11_desc']))   $input['usp_error_11_desc']   = wp_kses_post($input['usp_error_11_desc'],   $allowedposttags);
	if (isset($input['usp_error_12_desc']))   $input['usp_error_12_desc']   = wp_kses_post($input['usp_error_12_desc'],   $allowedposttags);
	if (isset($input['usp_error_13_desc']))   $input['usp_error_13_desc']   = wp_kses_post($input['usp_error_13_desc'],   $allowedposttags);
	if (isset($input['usp_error_14_desc']))   $input['usp_error_14_desc']   = wp_kses_post($input['usp_error_14_desc'],   $allowedposttags);
	if (isset($input['usp_error_15_desc']))   $input['usp_error_15_desc']   = wp_kses_post($input['usp_error_15_desc'],   $allowedposttags);
	if (isset($input['usp_error_16_desc']))   $input['usp_error_16_desc']   = wp_kses_post($input['usp_error_16_desc'],   $allowedposttags);
	if (isset($input['usp_error_17_desc']))   $input['usp_error_17_desc']   = wp_kses_post($input['usp_error_17_desc'],   $allowedposttags);
	if (isset($input['usp_error_18_desc']))   $input['usp_error_18_desc']   = wp_kses_post($input['usp_error_18_desc'],   $allowedposttags);
	
	// form submission errors
	if (isset($input['error_username']))      $input['error_username']      = wp_kses_post($input['error_username'],      $allowedposttags);
	if (isset($input['error_email']))         $input['error_email']         = wp_kses_post($input['error_email'],         $allowedposttags);
	if (isset($input['user_exists']))         $input['user_exists']         = wp_kses_post($input['user_exists'],         $allowedposttags);
	if (isset($input['error_register']))      $input['error_register']      = wp_kses_post($input['error_register'],      $allowedposttags);
	if (isset($input['post_required']))       $input['upost_required']      = wp_kses_post($input['post_required'],       $allowedposttags);
	if (isset($input['post_duplicate']))      $input['post_duplicate']      = wp_kses_post($input['post_duplicate'],      $allowedposttags);
	if (isset($input['name_restrict']))       $input['name_restrict']       = wp_kses_post($input['name_restrict'],       $allowedposttags);
	if (isset($input['spam_response']))       $input['spam_response']       = wp_kses_post($input['spam_response'],       $allowedposttags);
	if (isset($input['content_min']))         $input['content_min']         = wp_kses_post($input['content_min'],         $allowedposttags);
	if (isset($input['content_max']))         $input['content_max']         = wp_kses_post($input['content_max'],         $allowedposttags);
	if (isset($input['email_restrict']))      $input['email_restrict']      = wp_kses_post($input['email_restrict'],      $allowedposttags);
	if (isset($input['subject_restrict']))    $input['subject_restrict']    = wp_kses_post($input['subject_restrict'],    $allowedposttags);
	if (isset($input['form_allowed']))        $input['form_allowed']        = wp_kses_post($input['form_allowed'],        $allowedposttags);
	if (isset($input['content_filter']))      $input['content_filter']      = wp_kses_post($input['content_filter'],      $allowedposttags);
	
	// file submission errors
	if (isset($input['files_required']))      $input['files_required']      = wp_kses_post($input['files_required'],      $allowedposttags);
	if (isset($input['file_required']))       $input['file_required']       = wp_kses_post($input['file_required'],       $allowedposttags);
	if (isset($input['file_type_not']))       $input['file_type_not']       = wp_kses_post($input['file_type_not'],       $allowedposttags);
	if (isset($input['file_dimensions']))     $input['file_dimensions']     = wp_kses_post($input['file_dimensions'],     $allowedposttags);
	if (isset($input['file_max_size']))       $input['file_max_size']       = wp_kses_post($input['file_max_size'],       $allowedposttags);
	if (isset($input['file_min_size']))       $input['file_min_size']       = wp_kses_post($input['file_min_size'],       $allowedposttags);
	if (isset($input['file_name']))           $input['file_name']           = wp_kses_post($input['file_name'],           $allowedposttags);
	if (isset($input['min_req_files']))       $input['min_req_files']       = wp_kses_post($input['min_req_files'],       $allowedposttags);
	if (isset($input['max_req_files']))       $input['max_req_files']       = wp_kses_post($input['max_req_files'],       $allowedposttags);
	
	// registration errors
	if (isset($input['usp_error_a_desc']))    $input['usp_error_a_desc']    = wp_kses_post($input['usp_error_a_desc'],    $allowedposttags);
	if (isset($input['usp_error_b_desc']))    $input['usp_error_b_desc']    = wp_kses_post($input['usp_error_b_desc'],    $allowedposttags);
	if (isset($input['usp_error_c_desc']))    $input['usp_error_c_desc']    = wp_kses_post($input['usp_error_c_desc'],    $allowedposttags);
	if (isset($input['usp_error_d_desc']))    $input['usp_error_d_desc']    = wp_kses_post($input['usp_error_d_desc'],    $allowedposttags);
	if (isset($input['usp_error_e_desc']))    $input['usp_error_e_desc']    = wp_kses_post($input['usp_error_e_desc'],    $allowedposttags);
	if (isset($input['usp_error_f_desc']))    $input['usp_error_f_desc']    = wp_kses_post($input['usp_error_f_desc'],    $allowedposttags);
	if (isset($input['usp_error_g_desc']))    $input['usp_error_g_desc']    = wp_kses_post($input['usp_error_g_desc'],    $allowedposttags);
	
	// misc errors
	if (isset($input['error_sep']))           $input['error_sep']           = wp_kses_post($input['error_sep'],           $allowedposttags);
	if (isset($input['tax_before']))          $input['tax_before']          = wp_kses_post($input['tax_before'],          $allowedposttags);
	if (isset($input['tax_after']))           $input['tax_after']           = wp_kses_post($input['tax_after'],           $allowedposttags);
	if (isset($input['custom_field_before'])) $input['custom_field_before'] = wp_kses_post($input['custom_field_before'], $allowedposttags);
	if (isset($input['custom_field_after']))  $input['custom_field_after']  = wp_kses_post($input['custom_field_after'],  $allowedposttags);
	
	return $input;
	
}

function validate_tools($input) {
	
	if (!isset($input['default_options'])) $input['default_options'] = null;
	$input['default_options'] = ($input['default_options'] == 1 ? 1 : 0);
	
	return $input;
}


