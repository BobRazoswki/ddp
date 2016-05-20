<?php // USP Pro - Settings Section Descriptions

// GENERAL TAB

function section_general_0_desc() {
	echo '<p class="intro">'. __('Welcome to USP Pro! Before diving in,', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-quick-start/">'. __('check out the Quick Start guide &raquo;', 'usp') .'</a></p>'; 
}
function section_general_1_desc() { 
	echo '<p>'. __('These settings control basic form functionality.', 'usp') .'</p>'; 
}
function section_general_2_desc() { 
	echo '<p>'. __('These settings control how forms behave if returned with an error.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-add-remember-me-checkbox/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>'; 
}
function section_general_3_desc() { 
	echo '<p>'. __('These settings determine how users and handled when submitting form content.', 'usp') .'</p>'; 
}
function section_general_4_desc() { 
	echo '<p>'. __('Here you may configure the Google reCAPTCHA and antispam/challenge question.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-add-google-recaptcha/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>'; 
}
function section_general_5_desc() { 
	echo '<p>'. __('These settings determine how categories are handled with submitted content.', 'usp') .'</p>'; 
}
function section_general_6_desc() { 
	echo '<p>'. __('These settings determine how tags are handled with submitted content.', 'usp') .'</p>'; 
}
function section_general_7_desc() { 
	echo '<p>'. __('Optional security measure. After publishing each form, enter its', 'usp') .' <a href="'. plugins_url('img/usp-settings-form-id.jpg', dirname(__FILE__)) .'">'. __('Form ID', 'usp') .'</a> ';
	echo __('in the appropriate field(s) below. See', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-enable-extra-form-security/">'. __('this post', 'usp') .'</a> '. __('for more information.', 'usp') .'</p>'; 
}

// STYLE TAB

function section_style_0_desc() { 
	echo '<p class="intro">'. __('Customize the appearance (CSS) and behavior (JavaScript) of USP Forms.', 'usp'). ' <a target="_blank" href="https://plugin-planet.com/usp-pro-adding-css-javascript/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
}
function section_style_1_desc() { 
	echo '<p>'. __('Here you may customize CSS/styles for your USP Forms.', 'usp') . '</p>';
}
function section_style_2_desc() { 
	echo '<p>'. __('Here you may customize JavaScript for your USP Forms.', 'usp') . '</p>';
}
function section_style_3_desc() { 
	echo '<p>'. __('By default, external CSS &amp; JavaScript files are loaded on every page. Here you can optimize performance by loading resources only on specific URLs.', 'usp') . '</p>';
}

// UPLOADS TAB

function section_uploads_0_desc() { 
	echo '<p class="intro">'. __('Configure file uploads. Advanced configuration is possible via the', 'usp') .' <code>[usp_files]</code> '. __('shortcode and Custom Fields. ', 'usp');
	echo '<a target="_blank" href="https://plugin-planet.com/usp-pro-multiple-file-upload-fields/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
}
function section_uploads_1_desc() { 
	echo '<p>'. __('Here are the main settings for file uploads. If in doubt on anything, go with the default option.', 'usp') .'</p>'; 
}

// ADMIN TAB

function section_admin_0_desc() { 
	echo '<p class="intro">'. __('Customize email alerts and contact forms.', 'usp') .'</p>'; 
}
function section_admin_1_desc() { 
	echo '<p>'. __('Here are you may specify your email settings, which are used for email alerts and contact forms.', 'usp') .'</p>'; 
}
function section_admin_2_desc() { 
	echo '<p>'. __('Here are you may customize email alerts. Note: user-registration email is sent automatically by WordPress and can&rsquo;t be disabled via USP Pro.', 'usp') .'</p>';  
}
function section_admin_3_desc() { 
	echo '<p>'. __('Here are you may customize email alerts that are sent to the admin. You may use ', 'usp');
	echo '<a id="usp-toggle-regex-1" class="usp-toggle-regex-1" href="#usp-toggle-regex-1" title="'. __('Show/Hide Variables', 'usp') .'">'. __('shortcut variables', 'usp') .'</a> ';
	echo __('in your alert messages to display dynamic bits of information.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-email-shortcodes/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<pre class="usp-regex-1 usp-toggle default-hidden">blog url              = %%blog_url%%	
blog name             = %%blog_name%%
admin name            = %%admin_name%%
admin email           = %%admin_email%%
user name             = %%user_name%%
user email            = %%user_email%%
post title            = %%post_title%%
post date             = %%post_date%%
post url              = %%post_url%%
post id               = %%post_id%%
post content          = %%post_content%%
custom fields         = %%post_custom%%
specific custom field = %%__custom-field-key%%
post submitted date   = %%post_submitted_date%%
post scheduled date   = %%post_scheduled_date%%</pre>';
}
function section_admin_4_desc() { 
	echo '<p>'. __('Here are you may customize email alerts that are sent to the user. You may use ', 'usp');
	echo '<a id="usp-toggle-regex-2" class="usp-toggle-regex-2" href="#usp-toggle-regex-2" title="'. __('Show/Hide Variables', 'usp') .'">'. __('shortcut variables', 'usp') .'</a> ';
	echo __('in your alert messages to display dynamic bits of information. ', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-email-shortcodes/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<pre class="usp-regex-2 usp-toggle default-hidden">blog url              = %%blog_url%%	
blog name             = %%blog_name%%
admin name            = %%admin_name%%
admin email           = %%admin_email%%
user name             = %%user_name%%
user email            = %%user_email%%
post title            = %%post_title%%
post date             = %%post_date%%
post url              = %%post_url%%
post id               = %%post_id%%
post content          = %%post_content%%
custom fields         = %%post_custom%%
specific custom field = %%__custom-field-key%%
post submitted date   = %%post_submitted_date%%
post scheduled date   = %%post_scheduled_date%%</pre>';
}
function section_admin_5_desc() { 
	echo '<p>'. __('Here you may customize default', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-make-contact-form/">'. __('contact form', 'usp') .'</a> '. __('functionality. For ', 'usp');
	echo '<a target="_blank" href="https://plugin-planet.com/usp-pro-submit-content-and-send-email/">'. __('Contact/Post Combo Forms', 'usp') .'</a>, '. __('you can use any of the ', 'usp');
	echo '<a id="usp-toggle-regex-3" class="usp-toggle-regex-3" href="#usp-toggle-regex-3" title="'. __('Show/Hide Variables &raquo;', 'usp') .'">'. __('shortcut variables', 'usp') .'</a> '. __('for the &ldquo;Custom Content&rdquo; setting. Note that ', 'usp');
	echo '<a target="_blank" href="https://plugin-planet.com/usp-pro-enable-post-formatting/">'. __('post-formatting', 'usp') .'</a> '. __('must be enabled to send HTML-formatted email.', 'usp') .'</p>';
	echo '<pre class="usp-regex-3 usp-toggle default-hidden">blog url              = %%blog_url%%	
blog name             = %%blog_name%%
admin name            = %%admin_name%%
admin email           = %%admin_email%%
user name             = %%user_name%%
user email            = %%user_email%%
post title            = %%post_title%%
post date             = %%post_date%%
post url              = %%post_url%%
post id               = %%post_id%%
post content          = %%post_content%%
custom fields         = %%post_custom%%
specific custom field = %%__custom-field-key%%
post submitted date   = %%post_submitted_date%%
post scheduled date   = %%post_scheduled_date%%</pre>';
}
function section_admin_6_desc() {
	echo '<p>'. __('Here you may specify custom recipients for any contact form.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-custom-recipients-contact-forms/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
}

// ADVANCED TAB

function section_advanced_0_desc() {
	echo '<p class="intro">'. __('Customize form configuration, post types, custom fields, and more.', 'usp') .'</p>'; 
}
function section_advanced_1_desc() { 
	echo '<p>'. __('Here you may customize formatting, form demos, custom redirects, content filter, and other automatic functionality.', 'usp') .'</p>'; 
}
function section_advanced_2_desc() { 
	echo '<p>'. __('Here you may customize the post types used by USP Pro. The option &ldquo;USP Posts&rdquo; uses a Custom Post Type provided by USP Pro. The option &ldquo;Existing Post Type&rdquo; uses a Custom Post Type that is provided by your theme. If in doubt, use the default option, &ldquo;Regular WP Posts&rdquo;.', 'usp') .'</p>';
}
function section_advanced_3_desc() { 
	echo '<p>'. __('Here you may specify default values for submitted Post Title and Post Content. This enables you to exclude title and content fields on forms and use these values instead. ', 'usp');
	echo __('Note that default fields also may be specified on a per-form basis by', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-set-values-with-hidden-fields/">'. __('setting values with hidden fields', 'usp') .'</a>.</p>'; 
}
function section_advanced_4_desc() { 
	echo '<p>'. __('Here you may specify any custom text and/or markup to appear before and after all USP Forms.', 'usp') .'</p>'; 
}
function section_advanced_5_desc() { 
	echo '<p>'. __('Here you may customize the various success messages. Basic markup allowed.', 'usp') .'</p>'; 
}
function section_advanced_6_desc() { 
	echo '<p>'. __('Here you may customize the error message. Note that individual errors may be customized via the &ldquo;More&rdquo; tab.', 'usp') .'</p>';
}
function section_advanced_7_desc() {
	echo '<p>'. __('Here you may customize default names/labels for primary fields. These values may be customized on a per-form basis via the', 'usp') .' <code>label</code> '. __('attribute.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-change-label-and-placeholder-text/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
}
function section_advanced_8_desc() { 
	echo '<p>'. __('Here you may customize default names/labels for', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#user-registration-attributes">'. __('user-registration fields', 'usp') .'</a>. '. __('These values may be customized on a per-form basis via the', 'usp') .' <code>label</code> '. __('attribute.', 'usp') .' <a target="_blank" href="https://plugin-planet.com/usp-pro-make-registration-form/">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
}
function section_advanced_9_desc() { 
	echo '<p>'. __('Number of Custom Fields to auto-generate for each USP Form.', 'usp') .' <a id="usp-toggle-a1" class="usp-toggle-a1" href="#usp-toggle-a1" title="'. __('Show/Hide Description', 'usp') .'">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<p class="usp-a1 usp-toggle default-hidden">';
	echo __('The number specified below is used for two things: 1) it determines how many Custom Fields are added to newly created forms, and 2) it determines how many options to generate for the next ', 'usp');
	echo __('group of settings, &ldquo;Custom Field Names&rdquo;. So for example, if', 'usp') .' <code>3</code> '. __('is selected for this setting, all new USP Forms will include three Custom Fields, ', 'usp');
	echo __('each with its own option in the following setting, &ldquo;Custom Field Names&rdquo;. Note that unused Custom Fields are fine; the idea is to have them readily available for each form.', 'usp') .'</p>'; 
}
function section_advanced_10_desc() {
	echo '<p>'. __('Here you may define names for Custom Fields (see previous setting).', 'usp') .' <a id="usp-toggle-a2" class="usp-toggle-a2" href="#usp-toggle-a2" title="'. __('Show/Hide Description', 'usp') .'">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<p class="usp-a2 usp-toggle default-hidden">';
	echo __('The names defined in this setting are used for Custom Fields displayed in error messages, contact-form messages, and elsewhere. They apply only to Custom Fields that are named numerically. ', 'usp');
	echo __('For example, the &ldquo;Name for Custom Field #1&rdquo; applies to any custom field that uses', 'usp') .' <code>name#1</code> '. __('as its name attribute.', 'usp') .'</p>'; 
}
function section_advanced_11_desc() {
	echo '<p>'. __('Here you may specify a unique prefix to use for Custom Field names.', 'usp') .' <a id="usp-toggle-a3" class="usp-toggle-a3" href="#usp-toggle-a3" title="'. __('Show/Hide Description', 'usp') .'">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<p class="usp-a3 usp-toggle default-hidden">';
	echo __('For example, if you specify', 'usp') .' <code>foo_</code> '. __('for this setting, you can create unique Custom Fields by including the parameter', 'usp') .' <code>name#foo_whatever</code> '. __('in your custom-field definition. ', 'usp');
	echo __('Note that the custom prefix may contain lowercase/uppercase alphanumeric characters, plus underscores and dashes. ', 'usp');
	echo '<strong>'. __('Important:', 'usp') .'</strong> '. __('do not use', 'usp') .' <code>usp-</code> '. __('or', 'usp') .' <code>usp_</code> '. __('for the custom prefix (these are reserved for default Custom Fields).', 'usp') .'</p>';
}
function section_advanced_12_desc() { 
	echo '<p>'. __('Here you may specify any of your own', 'usp') .' <em>'. __('Custom', 'usp') .'</em> '. __('Custom Field names (separated by commas).', 'usp') .' <a id="usp-toggle-a4" class="usp-toggle-a4" href="#usp-toggle-a4" title="'. __('Show/Hide Description', 'usp') .'">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<p class="usp-a4 usp-toggle default-hidden">';
	echo __('For this setting, there are two types of fields, Optional and Required. Required fields will trigger an error if left empty when the form is submitted; whereas Optional fields will not trigger an error if left empty. ', 'usp');
	echo __('Note that Custom Field names may contain lowercase/uppercase alphanumeric characters, plus underscores and dashes. ', 'usp') .'<strong>' . __('Important:', 'usp') . '</strong> ';
	echo __('your Custom Field names must NOT begin with', 'usp') .' <code>usp-</code> '. __('or', 'usp') .' <code>usp_</code> '. __('(these are reserved for default Custom Fields).', 'usp') .'</p>';
}
function section_advanced_13_desc() { 
	echo '<p>'. __('Here you may define names for any', 'usp') .' <em>'. __('Custom', 'usp') .'</em> '. __('Custom Fields (see previous setting).', 'usp') .' <a id="usp-toggle-a5" class="usp-toggle-a5" href="#usp-toggle-a5" title="'. __('Show/Hide Description', 'usp') .'">'. __('Learn more&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<p class="usp-a5 usp-toggle default-hidden">';
	echo __('The names defined in this setting are used for Custom Custom Fields displayed in error messages, contact-form messages, and elsewhere. ', 'usp');
	echo __('Note: in order to define any names, you first must specify some Custom Fields in the previous setting; then after clicking &ldquo;Save Changes&rdquo;, corresponding name fields automatically will be generated below.', 'usp') .'</p>';
}

// MORE TAB

function section_more_0_desc() {
	echo '<p class="intro">'. __('Here you may customize error messages for USP Pro.', 'usp') .'</p>'; 
}
function section_more_1_desc() { 
	echo '<p>'. __('Here you may customize primary field errors. You may use text and/or basic markup.', 'usp') .'</p>'; 
}
function section_more_2_desc() { 
	echo '<p>'. __('Here you may customize form-submission errors. You may use text and/or basic markup.', 'usp') .'</p>'; 
}
function section_more_3_desc() { 
	echo '<p>'. __('Here you may customize file-submission errors. You may use text and/or basic markup.', 'usp') .'</p>'; 
}
function section_more_4_desc() { 
	echo '<p>'. __('Here you may customize user-registration errors. You may use text and/or basic markup.', 'usp') .'</p>'; 
}
function section_more_5_desc() { 
	echo '<p>'. __('Here you may customize various aspects of miscellaneous errors. You may use text and/or basic markup.', 'usp') .'</p>'; 
}

// TOOLS TAB

function section_tools_0_desc() {
	echo '<p class="intro">'. __('Here you will find a tools for resetting, exporting, and importing options, as well as information on shortcodes, template tags, and other useful resources.', 'usp') .'</p>'; 
}
function section_tools_1_desc() {
	echo usp_tools_reset();
}

// ABOUT TAB

function section_about_desc() {
	echo '<p class="intro">'. __('About USP Pro, WordPress, the server and current user.', 'usp') .'</p>';
	
	echo '<div class="usp-pro-about-display">';
	
	echo '<h3><a id="usp-toggle-s1" class="usp-toggle-s1" href="#usp-toggle-s1" title="'. __('Show/Hide Plugin Info', 'usp') .'">' . __('Plugin Information', 'usp') . '</a></h3>';
	echo '<div class="usp-s1 usp-toggle">' . usp_about_plugin() . '</div>';
	
	echo '<h3><a id="usp-toggle-s2" class="usp-toggle-s2" href="#usp-toggle-s2" title="'. __('Show/Hide WordPress Info', 'usp') .'">' . __('WordPress Information', 'usp') . '</a></h3>';
	echo '<div class="usp-s2 usp-toggle default-hidden">' . usp_about_wp() . '</div>';
	
	echo '<h3><a id="usp-toggle-s3" class="usp-toggle-s3" href="#usp-toggle-s3" title="'. __('Show/Hide WP Contants Info', 'usp') .'">' . __('WordPress Contants', 'usp') . '</a></h3>';
	echo '<div class="usp-s3 usp-toggle default-hidden">' . usp_about_constants() . '</div>';
	
	echo '<h3><a id="usp-toggle-s4" class="usp-toggle-s4" href="#usp-toggle-s4" title="'. __('Show/Hide Server Info', 'usp') .'">' . __('Server Information', 'usp') . '</a></h3>';
	echo '<div class="usp-s4 usp-toggle default-hidden">' . usp_about_server() . '</div>';
	
	echo '<h3><a id="usp-toggle-s5" class="usp-toggle-s5" href="#usp-toggle-s5" title="'. __('Show/Hide User Info', 'usp') .'">' . __('User Information', 'usp') . '</a></h3>';
	echo '<div class="usp-s5 usp-toggle default-hidden">' . usp_about_user() . '</div>';
	
	echo '</div>';
}

// LICENSE TAB

function section_license_desc() {
	
	$license = get_option('usp_license_key');
	$status  = get_option('usp_license_status');
	
	echo '<p class="intro"><a href="'. get_admin_url() .'plugins.php?page=usp-pro-license">'. __('Activate your license', 'usp') .'</a> '. __('to unlock USP Pro and enable free automatic updates. ', 'usp');
	echo '<a target="_blank" href="https://plugin-planet.com/get-license-key/">'. __('Get your License Key&nbsp;&raquo;', 'usp') .'</a></p>';
	echo '<h3>'. __('License Status', 'usp') .'</h3>';
	
	if ($status === 'valid' || USP_CODE) {
		
		echo '<p><strong>'. __('License Status:', 'usp') .'</strong> <span style="color:green;">'. __('Your USP Pro License is currently active.', 'usp') .'</span></p>';
		echo '<p><strong>'. __('License Key:', 'usp') .'</strong> <code style="padding:3px 5px;text-shadow:1px 1px 1px #fff;">'. $license .'</code></p>';
		echo '<p><strong>'. __('License Domain:', 'usp') .'</strong> <code style="padding:3px 5px;text-shadow:1px 1px 1px #fff;">'. sanitize_text_field($_SERVER['SERVER_NAME']) .'</code></p>';
		echo '<p><strong>'. __('License Admin:', 'usp') .'</strong> <code style="padding:3px 5px;text-shadow:1px 1px 1px #fff;">'. get_bloginfo('admin_email') .'</code></p>';
		echo '<p><a href="'. get_admin_url() .'plugins.php?page=usp-pro-license">Deactivate License &raquo;</a></p>';
		
	} else {
		
		echo '<p><strong>'. __('License Status:', 'usp') .'</strong> <span style="color:red;">'. __('Your USP Pro License is currently inactive.', 'usp') .'</span></p>';
		echo '<p><a href="'. get_admin_url() .'plugins.php?page=usp-pro-license">Activate License &raquo;</a></p>';
	}
	
	echo '<br /><h3>'. __('Resources', 'usp') .'</h3>';
	echo '<ul class="list-margin">';
	echo '<li><a target="_blank" href="https://plugin-planet.com/get-license-key/">'. __('Get Your License Key', 'usp') .'</a></li>';
	echo '<li><a target="_blank" href="https://plugin-planet.com/manage-license/">'. __('Manage Licensed Domains', 'usp') .'</a></li>';
	echo '<li><a target="_blank" href="https://plugin-planet.com/download-purchased-plugin/">'. __('Download Current Version', 'usp') .'</a></li>';
	echo '<li><a target="_blank" href="https://plugin-planet.com/download-purchase-receipt/">'. __('Download Purchase Receipt', 'usp') .'</a></li>';
	echo '<li><a target="_blank" href="https://plugin-planet.com/troubleshooting-license-activation/">'. __('Troubleshooting License Activation', 'usp') .'</a></li>';
	echo '</ul>';
}


