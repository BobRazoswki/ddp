<?php // USP Pro - Settings Callbacks

if (!defined('ABSPATH')) die();

function callback_input_text_label($id) {
	
	$label = __('Undefined', 'usp');
	
	if     ($id == 'submit_text')            $label = __('Text for submit button when &ldquo;Auto-Include&rdquo; setting is enabled', 'usp');
	elseif ($id == 'html_content')           $label = __('HTML tags that should be allowed in submitted post content.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-enable-post-formatting/">'. __('Learn more &raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_1')            $label = __('Name for the &ldquo;Your Name&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-name">'. __('Learn more &raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_2')            $label = __('Name for the &ldquo;Post URL&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-url">'. __('Learn more &raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_3')            $label = __('Name for the &ldquo;Post Title&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-title">'. __('Learn more &raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_4')            $label = __('Name for the &ldquo;Post Tags&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-tags">'. __('Learn more &raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_5')            $label = __('Name for the &ldquo;Challenge Question&rdquo; and &ldquo;reCAPTCHA&rdquo; fields.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-captcha">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_6')            $label = __('Name for the &ldquo;Post Category&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-category">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_7')            $label = __('Name for the &ldquo;Post Content&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-content">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_8')            $label = __('Name for the &ldquo;File(s)&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-files">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_9')            $label = __('Name for the &ldquo;Email Address&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-email">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_10')           $label = __('Name for the &ldquo;Email Subject&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#usp-subject">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_11')           $label = __('Name for the &ldquo;Alt Text&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-metadata-for-submitted-files/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_12')           $label = __('Name for the &ldquo;Caption&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-metadata-for-submitted-files/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_13')           $label = __('Name for the &ldquo;Description&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-metadata-for-submitted-files/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_14')           $label = __('Name for the &ldquo;Taxonomy&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#custom-taxonomy">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_15')           $label = __('Name for the &ldquo;Post Format&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#post-format">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_16')           $label = __('Name for the &ldquo;Media Title&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-metadata-for-submitted-files/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_17')           $label = __('Name for the &ldquo;File Name&rdquo; field.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-metadata-for-submitted-files/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_a')            $label = __('Name for the &ldquo;User Nicename&rdquo; field', 'usp');
	elseif ($id == 'usp_error_b')            $label = __('Name for the &ldquo;User Display Name&rdquo; field', 'usp');
	elseif ($id == 'usp_error_c')            $label = __('Name for the &ldquo;User Nickname&rdquo; field', 'usp');
	elseif ($id == 'usp_error_d')            $label = __('Name for the &ldquo;User First Name&rdquo; field', 'usp');
	elseif ($id == 'usp_error_e')            $label = __('Name for the &ldquo;User Last Name&rdquo; field', 'usp');
	elseif ($id == 'usp_error_f')            $label = __('Name for the &ldquo;User Description&rdquo; field', 'usp');
	elseif ($id == 'usp_error_g')            $label = __('Name for the &ldquo;User Password&rdquo; field (deprecated)', 'usp');
	elseif ($id == 'contact_sub_prefix')     $label = __('Custom text to prepend to the Subject line', 'usp');
	elseif ($id == 'contact_subject')        $label = __('Default Subject line (when not using', 'usp') .' <code>[usp_subject]</code> '. __('shortcode)', 'usp');
	elseif ($id == 'contact_from')           $label = __('Default &ldquo;From&rdquo; address (when not using', 'usp') .' <code>[usp_email]</code> '. __('shortcode)', 'usp');
	elseif ($id == 'contact_cc')             $label = __('Email addresses that should be carbon copied (comma-separated)', 'usp');
	elseif ($id == 'redirect_success')       $label = __('Where should visitors go after successful form submission? Enter any complete URL (e.g.,', 'usp') .' <code>http://example.com</code>'. __(') or leave blank to redirect to the current page. Note that you can', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-redirects/">'. __('override this setting on any form', 'usp') .'</a>. '. __('Important: this option is for advanced users; recommended to leave blank. See', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-error-messages-custom-redirects/">'. __('this post', 'usp') .'</a> '. __('for more info.', 'usp');
	elseif ($id == 'redirect_failure')       $label = __('Where should visitors go after failed form submission? Enter any complete URL (e.g.,', 'usp') .' <code>http://example.com</code>'. __(') or leave blank to redirect to the current page. Important: this option is for advanced users; recommended to leave blank. See', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-error-messages-custom-redirects/">'. __('this post', 'usp') .'</a> '. __('for more info.', 'usp');
	elseif ($id == 'captcha_question')       $label = __('This question is displayed when', 'usp') .' <code>[usp_captcha]</code> '. __('is added to any form', 'usp');
	elseif ($id == 'captcha_response')       $label = __('Enter the <em>only</em> correct answer to the previous &ldquo;Challenge Question&rdquo;', 'usp');
	elseif ($id == 'recaptcha_public')       $label = __('To use Google reCAPTCHA instead of the Challenge Question, enter your Public &amp; Private Keys', 'usp');
	elseif ($id == 'recaptcha_private')      $label = __('To use Google reCAPTCHA instead of the Challenge Question, enter your Public &amp; Private Keys', 'usp');
	elseif ($id == 'use_cat_id')             $label = __('Automatically include these category IDs for all submitted posts (comma-separated)', 'usp');
	elseif ($id == 'admin_email')            $label = __('Messages from contact forms and email alerts will be sent to this address', 'usp');
	elseif ($id == 'admin_name')             $label = __('Email alerts will be addressed to this name', 'usp');
	elseif ($id == 'admin_from')             $label = __('Email alerts will use this address as the &ldquo;From&rdquo; header', 'usp');
	elseif ($id == 'alert_subject_admin')    $label = __('Subject line for submission alerts sent to the admin', 'usp');
	elseif ($id == 'approval_subject_admin') $label = __('Subject line for approval alerts sent to the admin', 'usp');
	elseif ($id == 'denied_subject_admin')   $label = __('Subject line for denied alerts sent to the admin', 'usp');
	elseif ($id == 'alert_subject_user')     $label = __('Subject line for submission alerts sent to the user', 'usp');
	elseif ($id == 'approval_subject')       $label = __('Subject line for approval alerts sent to the user', 'usp');
	elseif ($id == 'denied_subject')         $label = __('Subject line for denied alerts sent to the user', 'usp');
	elseif ($id == 'cc_submit')              $label = __('Additional addresses for submission alerts (comma-separated)', 'usp');
	elseif ($id == 'cc_approval')            $label = __('Additional addresses for approval alerts (comma-separated)', 'usp');
	elseif ($id == 'cc_denied')              $label = __('Additional addresses for denied alerts (comma-separated)', 'usp');
	elseif ($id == 'character_min')          $label = __('Minimum number of characters required for the post content field (leave set at 0 for no minimum)', 'usp');
	elseif ($id == 'character_max')          $label = __('Maximum number of characters allowed for the post content field (leave set at 0 for no maximum)', 'usp');
	elseif ($id == 'post_type_slug')         $label = __('Slug to use when &ldquo;USP Posts&rdquo; is selected for the setting, &ldquo;Submitted Post Type&rdquo;. Note: this setting is for advanced users. Recommended to use the default value,', 'usp') .' <code>usp_post</code>.';
	elseif ($id == 'other_type')             $label = __('Slug to use when &ldquo;Existing Post Type&rdquo; is selected for the setting, &ldquo;Submitted Post Type&rdquo;. Note: the Custom Post Type specified here must be provided by your theme.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-unlimited-custom-post-types/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'tags_number')            $label = __('Number of tags that should be displayed for the &ldquo;Post Tags&rdquo; setting (use', 'usp') .' <code>-1</code> '. __('or', 'usp') .' <code>all</code> '. __('to display all tags)', 'usp');
	elseif ($id == 'min_size')               $label = __('Min size (in bytes) for uploaded files (applies to all file types). Default:', 'usp') .' <code>25600</code> (25 KB)';
	elseif ($id == 'max_size')               $label = __('Max size (in bytes) for uploaded files (applies to all file types). Default:', 'usp') .' <code>5242880</code> (5 MB)';
	elseif ($id == 'min_width')              $label = __('Minimum width (in pixels) for uploaded images', 'usp');
	elseif ($id == 'max_width')              $label = __('Maximum width (in pixels) for uploaded images', 'usp');
	elseif ($id == 'min_height')             $label = __('Minimum height (in pixels) for uploaded images', 'usp');
	elseif ($id == 'max_height')             $label = __('Maximum height (in pixels) for uploaded images', 'usp');
	elseif ($id == 'files_allow')            $label = __('Allowed file types (comma-separated) for any USP Form.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-allowed-file-types/">Learn more&nbsp;&raquo;</a>';
	elseif ($id == 'contact_cc_note')        $label = __('Message displayed on the contact form (when the setting &ldquo;CC User&rdquo; is enabled)', 'usp');
	elseif ($id == 'featured_key')           $label = __('Image to use as the Featured Image (when &ldquo;Featured Images&rdquo; setting is enabled).', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-featured-image-key/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'include_url')            $label = __('Comma-separated list of URLs (leave blank to load CSS/JS on all pages)', 'usp');
	elseif ($id == 'custom_status')          $label = __('Applies when &ldquo;Default Post Status&rdquo; is set to &ldquo;Always moderate via Custom Status&rdquo;', 'usp');
	elseif ($id == 'custom_contact_1')       $label = __('Email address for Custom Recipient 1', 'usp');
	elseif ($id == 'custom_contact_2')       $label = __('Email address for Custom Recipient 2', 'usp');
	elseif ($id == 'custom_contact_3')       $label = __('Email address for Custom Recipient 3', 'usp');
	elseif ($id == 'custom_contact_4')       $label = __('Email address for Custom Recipient 4', 'usp');
	elseif ($id == 'custom_contact_5')       $label = __('Email address for Custom Recipient 5', 'usp');
	elseif ($id == 'custom_prefix')          $label = __('Unique prefix for Custom Fields (leave blank to disable)', 'usp');
	elseif ($id == 'custom_optional')        $label = __('Optional Custom Fields (leave blank to disable)', 'usp');
	elseif ($id == 'custom_required')        $label = __('Required Custom Fields (leave blank to disable)', 'usp');
	elseif ($id == 'default_title')          $label = __('Default Post Title for submitted posts', 'usp');
	elseif ($id == 'form_atts')              $label = __('Custom attributes that should be included in the', 'usp') .' <code>&lt;form&gt;</code> '. __('tag', 'usp');
	elseif ($id == 'submit_form_ids')        $label = __('Form IDs of any post-submission forms', 'usp');
	elseif ($id == 'register_form_ids')      $label = __('Form IDs of any user-registration forms', 'usp');
	elseif ($id == 'contact_form')           $label = __('Form IDs of any contact forms', 'usp');
	
	return  $label;
}

function callback_textarea_label($id) {
	
	$label = __('Undefined', 'usp');
	
	if     ($id == 'custom_before')          $label = __('Text/markup to be included before all USP Forms', 'usp');
	elseif ($id == 'custom_after')           $label = __('Text/markup to be included after all USP Forms', 'usp');
	elseif ($id == 'post_alert_admin')       $label = __('Message for submission alerts sent to the admin', 'usp');
	elseif ($id == 'post_alert_user')        $label = __('Message for submission alerts sent to the user', 'usp');
	elseif ($id == 'approval_message_admin') $label = __('Message for approval alerts sent to the admin', 'usp');
	elseif ($id == 'approval_message')       $label = __('Message for approval alerts sent to the user', 'usp');
	elseif ($id == 'denied_message_admin')   $label = __('Message for denied alerts sent to the admin', 'usp');
	elseif ($id == 'denied_message')         $label = __('Message for denied alerts sent to the user', 'usp');
	elseif ($id == 'custom_content')         $label = __('Custom content that should be appended to messages sent via contact form', 'usp');
	elseif ($id == 'success_reg')            $label = __('Message displayed when a user is registered successfully', 'usp');
	elseif ($id == 'success_post')           $label = __('Message displayed when a post is submitted successfully', 'usp');
	elseif ($id == 'success_both')           $label = __('Message displayed when user is registered and post is submitted', 'usp');
	elseif ($id == 'success_contact')        $label = __('Message displayed when email is sent via contact form', 'usp');
	elseif ($id == 'success_email_reg')      $label = __('Message displayed when email is sent and user is registered', 'usp');
	elseif ($id == 'success_email_post')     $label = __('Message displayed when email is sent and post is submitted', 'usp');
	elseif ($id == 'success_email_both')     $label = __('Message displayed when email is sent, user is registered, and post is submitted', 'usp');
	elseif ($id == 'error_before')           $label = __('Custom text/markup to appear before the listed errors', 'usp');
	elseif ($id == 'error_after')            $label = __('Custom text/markup to appear after the listed errors', 'usp');
	elseif ($id == 'success_before')         $label = __('Custom text/markup to appear before the success message', 'usp');
	elseif ($id == 'success_after')          $label = __('Custom text/markup to appear after the success message', 'usp');
	elseif ($id == 'style_min')              $label = __('CSS for Minimal form style (edit as needed to fit your theme)', 'usp');
	elseif ($id == 'style_small')            $label = __('CSS for Small form style (edit as needed to fit your theme)', 'usp');
	elseif ($id == 'style_large')            $label = __('CSS for Large form style (edit as needed to fit your theme)', 'usp');
	elseif ($id == 'style_custom')           $label = __('CSS for Custom form style (edit as needed to fit your theme)', 'usp');
	elseif ($id == 'script_custom')          $label = __('Custom JavaScript, included inline via', 'usp') .' <code>&lt;script&gt;</code> '. __('tag', 'usp');
	elseif ($id == 'default_content')        $label = __('Default Post Content for submitted posts (basic HTML allowed)', 'usp');
	elseif ($id == 'blacklist_terms')        $label = __('Words that are not allowed in any submitted post content (put each word on its own line)', 'usp');
	
	elseif ($id == 'usp_error_1_desc')       $label = __('Name errors &ndash; when using', 'usp') .' <code>[usp_name]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_2_desc')       $label = __('URL errors &ndash; when using', 'usp') .' <code>[usp_url]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_3_desc')       $label = __('Title errors &ndash; when using', 'usp') .' <code>[usp_title]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_4_desc')       $label = __('Tag errors &ndash; when using', 'usp') .' <code>[usp_tags]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_5_desc')       $label = __('Captcha errors &ndash; when using', 'usp') .' <code>[usp_captcha]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_6_desc')       $label = __('Category errors &ndash; when using', 'usp') .' <code>[usp_category]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_7_desc')       $label = __('Content errors &ndash; when using', 'usp') .' <code>[usp_content]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_8_desc')       $label = __('Files errors &ndash; when using', 'usp') .' <code>[usp_files]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_9_desc')       $label = __('Email errors &ndash; when using', 'usp') .' <code>[usp_email]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_10_desc')      $label = __('Subject errors &ndash; when using', 'usp') .' <code>[usp_subject]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_11_desc')      $label = __('Alt Text errors &ndash; when using', 'usp') .' <code>[usp_custom_field]</code> '. __('with', 'usp') .' <code>name#alt-{id}</code>';
	elseif ($id == 'usp_error_12_desc')      $label = __('Caption errors &ndash; when using', 'usp') .' <code>[usp_custom_field]</code> '. __('with', 'usp') .' <code>name#caption-{id}</code>';
	elseif ($id == 'usp_error_13_desc')      $label = __('Description errors &ndash; when using', 'usp') .' <code>[usp_custom_field]</code> '. __('with', 'usp') .' <code>name#desc-{id}</code>';
	elseif ($id == 'usp_error_14_desc')      $label = __('Taxonomy errors &ndash; when using', 'usp') .' <code>[usp_taxonomy]</code> '. __('shortcode', 'usp');
	elseif ($id == 'usp_error_15_desc')      $label = __('Post Format errors &ndash; when using', 'usp') .' <code>[usp_custom_field]</code>. <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#post-format">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'usp_error_16_desc')      $label = __('Media Title errors &ndash; when using', 'usp') .' <code>[usp_custom_field]</code> '. __('with', 'usp') .' <code>name#mediatitle-{id}</code>';
	elseif ($id == 'usp_error_17_desc')      $label = __('File Name errors &ndash; when using', 'usp') .' <code>[usp_custom_field]</code> '. __('with', 'usp') .' <code>name#filename-{id}</code>';
	
	elseif ($id == 'usp_error_a_desc')       $label = __('Errors for the &ldquo;User Nicename&rdquo; field', 'usp');
	elseif ($id == 'usp_error_b_desc')       $label = __('Errors for the &ldquo;User Display Name&rdquo; field', 'usp');
	elseif ($id == 'usp_error_c_desc')       $label = __('Errors for the &ldquo;User Nickname&rdquo; field', 'usp');
	elseif ($id == 'usp_error_d_desc')       $label = __('Errors for the &ldquo;User First Name&rdquo; field', 'usp');
	elseif ($id == 'usp_error_e_desc')       $label = __('Errors for the &ldquo;User Last Name&rdquo; field', 'usp');
	elseif ($id == 'usp_error_f_desc')       $label = __('Errors for the &ldquo;User Description&rdquo; field', 'usp');
	elseif ($id == 'usp_error_g_desc')       $label = __('Errors for the &ldquo;User Password&rdquo; field (deprecated)', 'usp');
	
	elseif ($id == 'error_username')         $label = __('User Name errors (when using a form that registers users)', 'usp');
	elseif ($id == 'error_email')            $label = __('User Email errors (when using a form that registers users)', 'usp');
	elseif ($id == 'error_register')         $label = __('Registration Disabled errors (when using a form that registers users)', 'usp');
	elseif ($id == 'user_exists')            $label = __('User Exists errors (when using a form that registers users)', 'usp');
	elseif ($id == 'post_required')          $label = __('Post Required errors (when using a form that submits posts)', 'usp');
	elseif ($id == 'post_duplicate')         $label = __('Duplicate Post errors (when using a form that submits posts)', 'usp');
	elseif ($id == 'name_restrict')          $label = __('Illegal characters in the Name field', 'usp');
	elseif ($id == 'spam_response')          $label = __('Incorrect response for the anti-spam captcha/challenge question', 'usp');
	elseif ($id == 'content_min')            $label = __('Minimum number of characters not met in Post Content field', 'usp');
	elseif ($id == 'content_max')            $label = __('Maximum number of characters not met in Post Content field', 'usp');
	elseif ($id == 'email_restrict')         $label = __('Illegal characters in the Email Address field', 'usp');
	elseif ($id == 'subject_restrict')       $label = __('Illegal characters in the Email Subject field', 'usp');
	elseif ($id == 'form_allowed')           $label = __('Incorrect form type (when &ldquo;Extra Form Security&rdquo; is enabled in General settings)', 'usp');
	elseif ($id == 'content_filter')         $label = __('Forbidden words in Post Content (when &ldquo;Content Filter&rdquo; is enabled in Advanced settings)', 'usp');
	
	elseif ($id == 'files_required')         $label = __('Files required (for multiple-select files)', 'usp');
	elseif ($id == 'file_required')          $label = __('File required (for single-select files)', 'usp');
	elseif ($id == 'file_type_not')          $label = __('File type not allowed', 'usp');
	elseif ($id == 'file_dimensions')        $label = __('File width and height exceed limits', 'usp');
	elseif ($id == 'file_max_size')          $label = __('Maximum file size exceeded', 'usp');
	elseif ($id == 'file_min_size')          $label = __('Minimum file size not met', 'usp');
	elseif ($id == 'file_name')              $label = __('Length of file name exceeds limit', 'usp');
	elseif ($id == 'min_req_files')          $label = __('Minimum number of files not met', 'usp');
	elseif ($id == 'max_req_files')          $label = __('Maximum number of files exceeded', 'usp');
	
	elseif ($id == 'tax_before')             $label = __('Text/markup displayed before each Taxonomy error', 'usp');
	elseif ($id == 'tax_after')              $label = __('Text/markup displayed after each Taxonomy error', 'usp');
	elseif ($id == 'custom_field_before')    $label = __('Text/markup displayed before each Custom Field error', 'usp');
	elseif ($id == 'custom_field_after')     $label = __('Text/markup displayed after each Custom Field error', 'usp');
	elseif ($id == 'error_sep')              $label = __('Text/markup displayed between each error (e.g.,', 'usp') .' <code>,</code> '. __('or', 'usp') .' <code>&lt;span&gt;, &lt;/span&gt;</code>)';
	
	return $label;
}

function callback_select_label($id) {
	
	$label = __('Undefined', 'usp');
	
	if     ($id == 'min_files')          $label = __('This default value can be overridden via the', 'usp') .' <code>files_min</code> '. __('shortcode attribute', 'usp');
	elseif ($id == 'max_files')          $label = __('This default value can be overridden via the', 'usp') .' <code>files_max</code> '. __('shortcode attribute', 'usp');
	elseif ($id == 'display_size')       $label = __('Size of auto-displayed images', 'usp');                        
	elseif ($id == 'mail_format')        $label = __('Format for all email (contact form and email alerts).', 'usp') .'<br /><strong>'. __('Note:', 'usp') .'</strong> '. __('to allow HTML in contact-form messages, the option &ldquo;Post Formatting&rdquo; must be enabled in Advanced settings.', 'usp');
	elseif ($id == 'recaptcha_version')  $label = __('reCAPTCHA version to display via', 'usp') .' <code>[usp_captcha]</code>';
	
	return $label;
}

function callback_checkbox_label($id) {
	
	$label = __('Undefined', 'usp');
	
	if     ($id == 'send_mail_user')      $label = __('Send post-submission alert to the user', 'usp');
	elseif ($id == 'send_mail_admin')     $label = __('Send post-submission alert to the admin', 'usp');
	elseif ($id == 'send_approval_user')  $label = __('Send post-approval alert to the user (published post)', 'usp');
	elseif ($id == 'send_approval_admin') $label = __('Send post-approval alert to the admin (published post)', 'usp');
	elseif ($id == 'send_denied_user')    $label = __('Send post-denied alert to the user (trashed post)', 'usp');
	elseif ($id == 'send_denied_admin')   $label = __('Send post-denied alert to the admin (trashed post)', 'usp');
	elseif ($id == 'contact_cc_user')     $label = __('Send a copy of the message to the sender (via CC)', 'usp');
	elseif ($id == 'contact_stats')       $label = __('Append user data to messages (e.g., IP address, referrer, request, et al)', 'usp');
	elseif ($id == 'contact_custom')      $label = __('Append any Custom Field data to messages.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-displaying-custom-fields/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'include_js')          $label = __('Include external USP JavaScript file (required for multiple file uploads and thumbnail previews). Note: this file will be overwritten with each plugin upgrade, so if you need to customize or add any JavaScript, use the next option or some other method.', 'usp');
	elseif ($id == 'include_css')         $label = __('Include external CSS file (optional and used for testing purposes). Note: this file is intentionally blank and will be overwritten with each plugin upgrade; so if you need to customize or add any CSS, use the next option or some other method.', 'usp');
	elseif ($id == 'success_form')        $label = __('Display the submission form with the success message', 'usp');
	elseif ($id == 'enable_autop')        $label = __('Apply WP&rsquo;s auto-formatting to form content', 'usp');
	elseif ($id == 'fieldsets')           $label = __('Automatically wrap form inputs with', 'usp') .' <code>&lt;fieldset&gt;</code> '. __('tags', 'usp');
	elseif ($id == 'form_demos')          $label = __('Automatically regenerate the USP Form Demos', 'usp');
	elseif ($id == 'post_demos')          $label = __('Automatically regenerate the USP Post Demos', 'usp');
	elseif ($id == 'submit_button')       $label = __('Automatically include a submit button on all USP Forms', 'usp');
	elseif ($id == 'use_author')          $label = __('Use the registered username as the Post Author.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-use-registered-author/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'replace_author')      $label = __('Use submitted name as Post Author, and submitted URL as Author URL.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-replace-author-name-url/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a>';
	elseif ($id == 'redirect_post')       $label = __('Redirect users to their submitted post, applies when &ldquo;Default Post Status&rdquo; is set to &ldquo;Always publish immediately&rdquo;', 'usp');
	elseif ($id == 'enable_stats')        $label = __('Attach user data (e.g., IP Address, Referrer, Request, et al) to submitted posts as Custom Fields', 'usp');
	elseif ($id == 'captcha_casing')      $label = __('Make the &ldquo;Challenge Response&rdquo; case-sensitive', 'usp');
	elseif ($id == 'cats_nested')         $label = __('Enable nested display of subcategories', 'usp');
	elseif ($id == 'use_cat')             $label = __('Enable required categories for all forms (see next option)', 'usp');
	elseif ($id == 'hidden_cats')         $label = __('Hide Category field when using', 'usp') .' <code>[usp_category]</code>';
	elseif ($id == 'cats_multiple')       $label = __('Allow users to select multiple categories when using the dropdown menu', 'usp');
	elseif ($id == 'tags_empty')          $label = __('Do not display empty tags for the &ldquo;Post Tags&rdquo; setting', 'usp');
	elseif ($id == 'hidden_tags')         $label = __('Hide Tags field when using', 'usp') .' <code>[usp_tags]</code>';
	elseif ($id == 'tags_multiple')       $label = __('Allow users to select multiple tags when using the dropdown menu', 'usp');
	elseif ($id == 'sessions_on')         $label = __('Enable &ldquo;remembering&rdquo; of form data', 'usp');
	elseif ($id == 'sessions_scope')      $label = __('Super strength: remember form values forever, even after successful form submission', 'usp');
	elseif ($id == 'sessions_default')    $label = __('Default state of the &ldquo;remember me&rdquo; checkbox field (checked or unchecked)', 'usp');
	elseif ($id == 'titles_unique')       $label = __('Require Post Titles to be unique', 'usp');
	elseif ($id == 'content_unique')      $label = __('Require Post Content to be unique', 'usp');
	elseif ($id == 'enable_form_lock')    $label = __('Check this box to enable the following three options', 'usp');
	elseif ($id == 'featured_image')      $label = __('Auto-display submitted images as Featured Images (theme support required)', 'usp');
	elseif ($id == 'unique_filename')     $label = __('Make submitted file names unique by prepending a date-based/random string', 'usp');
	elseif ($id == 'user_shortcodes')     $label = __('Check this box to enable User Shortcodes in submitted post content.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-user-shortcodes/">'. __('Learn more &raquo;', 'usp') .'</a>';
	elseif ($id == 'enable_media')        $label = __('Enable non-admin users to upload media via the &ldquo;Add Media&rdquo; button.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-enable-non-admin-users-upload-media/">'. __('Learn more &raquo;', 'usp') .'</a>';
	elseif ($id == 'default_options')     $label = __('Restore plugin settings upon plugin deactivation/reactivation', 'usp');
	
	return $label;
}

function callback_number_label($id) {
	
	$label = __('Undefined', 'usp');
	
	if ($id == 'custom_fields') $label = __('Number of Custom Fields to auto-generate for each USP Form', 'usp');
	
	return $label;
}

function callback_dropdown_label($id) {
	
	$label = __('Undefined', 'usp');
	
	if     ($id == 'assign_author')   $label = __('Default author for user-submitted posts', 'usp');
	elseif ($id == 'assign_role')     $label = __('Role for users registering via USP Form (default: subscriber)', 'usp');
	elseif ($id == 'number_approved') $label = __('Note: this setting', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-post-status/">'. __('can be overridden per form', 'usp') .'</a>';
	
	return $label;
}

function callback_radio_label($id) {
	
	$label = __('Undefined', 'usp');
	
	if     ($id == 'send_mail')   $label = __('Send email alerts using: ', 'usp');
	elseif ($id == 'post_type')   $label = __('Submitted content should be posted as: ', 'usp');
	elseif ($id == 'cats_menu')   $label = __('On the frontend, categories should be displayed as: ', 'usp');
	elseif ($id == 'tags_order')  $label = __('On the frontend, display tags ordered by: ', 'usp');
	elseif ($id == 'tags_menu')   $label = __('On the frontend, tags should be displayed as: ', 'usp');
	elseif ($id == 'form_style')  $label = __('Include the following styles with all USP Forms (included via inline CSS): ', 'usp');
	elseif ($id == 'post_images') $label = __('Automatically display images in submitted posts: ', 'usp');
	
	return $label;
}


