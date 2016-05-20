<?php 
/*
	Plugin Name: USP Pro
	Plugin URI: https://plugin-planet.com/usp-pro/
	Description: Create unlimited forms and let visitors submit content, register, and much more from the front-end of your site.
	Tags: community, contact, content, custom fields, files, form, forms, front end, front-end, frontend, generated content, images, login, post, posts, public, publish, register, share, submission, submissions, submit, submitted, upload, user generated, user submit, user submitted, user-generated, user-submit, user-submitted, users
	Author: Jeff Starr
	Author URI: http://monzilla.biz/
	Donate link: http://m0n.co/donate
	Contributors: specialk
	Requires at least: 4.1
	Tested up to: 4.5
	Stable tag: trunk
	Version: 2.3.2
	Text Domain: usp
	Domain Path: /languages/
	
	License: USP Pro is comprised of two parts:
	
	* Part 1: Its PHP code is licensed under the GPL (v2 or later), like WordPress. More info @ http://www.gnu.org/licenses/
	* Part 2: Everything else (e.g., CSS, HTML, JavaScript, images, design) is licensed according to the purchased license. More info @ https://plugin-planet.com/usp-pro/
	
	Without prior written consent from Monzilla Media, you must NOT directly or indirectly: license, sub-license, sell, resell, or provide for free any aspect or component of Part 2.
	
	Further license information is available in the plugin directory, /license/, and online @ https://plugin-planet.com/wp/files/usp-pro/license.txt
	
	Upgrades: Your purchase of USP Pro includes free lifetime upgrades, which include new features, bug fixes, and other improvements. 
	
	Copyright: © 2016 Monzilla Media
*/

if (!defined('ABSPATH')) die();

define('USP_NAME', 'USP Pro');
define('USP_VERSION', '2.3.2');
define('USP_REQUIRES', '4.1');
define('USP_TESTED', '4.5');
define('USP_AUTHOR', 'Jeff Starr');
define('USP_URL', 'https://plugin-planet.com');
define('USP_DOMAIN', '/languages/');
define('USP_CODE', false);
define('USP_PATH', WP_PLUGIN_DIR . '/usp-pro');
define('USP_FILE', plugin_basename(__FILE__));

if (!class_exists('USP_Pro')) {
	class USP_Pro {
		
		private $settings_about    = 'usp_about';
		private $settings_admin    = 'usp_admin';
		private $settings_advanced = 'usp_advanced';
		private $settings_general  = 'usp_general';
		private $settings_license  = 'usp_license';
		private $settings_style    = 'usp_style';
		private $settings_tools    = 'usp_tools';
		private $settings_uploads  = 'usp_uploads';
		private $settings_more     = 'usp_more';
		
		private $settings_page = 'usp_options';
		private $settings_tabs = array();

		public function __construct() {
			
			$target_page = isset($_REQUEST['_wp_http_referer']) ? strpos($_REQUEST['_wp_http_referer'], 'page=usp_options') : false;
	
			if ((isset($_GET['page']) && $_GET['page'] === 'usp_options') || $target_page !== false) { 
				
				add_action('admin_init', array(&$this, 'register_general_settings'));
				add_action('admin_init', array(&$this, 'register_style_settings'));
				add_action('admin_init', array(&$this, 'register_uploads_settings'));
				add_action('admin_init', array(&$this, 'register_admin_settings'));
				add_action('admin_init', array(&$this, 'register_advanced_settings'));
				add_action('admin_init', array(&$this, 'register_more_settings'));
				add_action('admin_init', array(&$this, 'register_tools_settings'));
				add_action('admin_init', array(&$this, 'register_about_settings'));
				add_action('admin_init', array(&$this, 'register_license_settings'));
				
				add_action('admin_init', array(&$this, 'load_settings'));
				
				require_once(sprintf("%s/inc/usp-about.php",     dirname(__FILE__)));
				require_once(sprintf("%s/inc/usp-backup.php",    dirname(__FILE__)));
				require_once(sprintf("%s/inc/usp-callbacks.php", dirname(__FILE__)));
				require_once(sprintf("%s/inc/usp-options.php",   dirname(__FILE__)));
				require_once(sprintf("%s/inc/usp-settings.php",  dirname(__FILE__)));
				require_once(sprintf("%s/inc/usp-tools.php",     dirname(__FILE__)));
				require_once(sprintf("%s/inc/usp-validate.php",  dirname(__FILE__)));
			}
			
			if (isset($_GET['activate']) && $_GET['activate'] === 'true') {
				add_action('admin_init', array(&$this, 'require_wp_version'));
			}
			
			add_action('plugins_loaded', array(&$this, 'usp_i18n_init'));
			
			add_action('admin_init', array(&$this, 'register_post_status'));
			add_action('parse_query', array(&$this, 'add_status_clause'));
			add_filter('post_stati', array(&$this, 'add_post_status'));
			add_action('restrict_manage_posts', array(&$this, 'add_post_filter_button'));
			
			add_filter('the_author', array(&$this, 'usp_replace_author'));
			add_filter('author_link', array(&$this, 'usp_replace_author_link'), 10, 3);
			
			add_action('admin_menu', array(&$this, 'add_admin_menus'));
			add_filter('plugin_action_links', array(&$this, 'plugin_link_settings'), 10, 2);
			add_filter('plugin_row_meta', array(&$this, 'add_plugin_links'), 10, 2);
			add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_scripts'));
			add_action('admin_enqueue_scripts', array(&$this, 'add_admin_styles'));
			
			require_once(sprintf("%s/inc/usp-shortcodes.php", dirname(__FILE__)));
			$USP_Custom_Fields = new USP_Custom_Fields();
			
			require_once(sprintf("%s/inc/usp-forms.php", dirname(__FILE__)));
			$USP_Pro_Forms = new USP_Pro_Forms();
			
			require_once(sprintf("%s/inc/usp-posts.php", dirname(__FILE__)));
			$USP_Pro_Posts = new USP_Pro_Posts();
			
			require_once(sprintf("%s/inc/usp-process.php", dirname(__FILE__)));
			$USP_Pro_Process = new USP_Pro_Process();
			
			require_once(sprintf("%s/inc/usp-functions.php", dirname(__FILE__)));
			require_once(sprintf("%s/inc/usp-widget.php", dirname(__FILE__)));
			require_once(sprintf("%s/updates/usp-updates.php", dirname(__FILE__)));
			
			require_once(sprintf("%s/inc/usp-dashboard.php", dirname(__FILE__)));
			add_action('wp_dashboard_setup', 'usp_pro_dashboard_widgets');
			
		}
		
		public static function deactivate() {
			
			flush_rewrite_rules();
			
		}
		
		public static function activate() {
			
			require_once(sprintf("%s/inc/usp-forms.php", dirname(__FILE__)));
			USP_Pro_Forms::create_post_type();
			flush_rewrite_rules();
			
			require_once(sprintf("%s/inc/usp-posts.php", dirname(__FILE__)));
			USP_Pro_Posts::create_post_type();
			flush_rewrite_rules();
			
			$role_obj = get_role('administrator');
			$caps_form = USP_Pro_Forms::default_caps();
			$caps_post = USP_Pro_Posts::default_caps();
			
			foreach ($caps_form as $cap) $role_obj->add_cap($cap);
			foreach ($caps_post as $cap) $role_obj->add_cap($cap);
			
		}
		
		function load_settings() {
			
			$this->admin_settings    = (array) get_option($this->settings_admin);
			$this->advanced_settings = (array) get_option($this->settings_advanced);
			$this->general_settings  = (array) get_option($this->settings_general);
			$this->style_settings    = (array) get_option($this->settings_style);
			$this->uploads_settings  = (array) get_option($this->settings_uploads);
			$this->more_settings     = (array) get_option($this->settings_more);
			$this->tools_settings    = (array) get_option($this->settings_tools);
			//
			$this->admin_settings    = wp_parse_args($this->admin_settings,    $this->admin_defaults());
			$this->advanced_settings = wp_parse_args($this->advanced_settings, $this->advanced_defaults());
			$this->general_settings  = wp_parse_args($this->general_settings,  $this->general_defaults());
			$this->style_settings    = wp_parse_args($this->style_settings,    $this->style_defaults());
			$this->uploads_settings  = wp_parse_args($this->uploads_settings,  $this->uploads_defaults());
			$this->more_settings     = wp_parse_args($this->more_settings,     $this->more_defaults());
			$this->tools_settings    = wp_parse_args($this->tools_settings,    $this->tools_defaults());
			
		}
		
		function require_wp_version() {
			global $wp_version;
			if (version_compare($wp_version, USP_REQUIRES, '<')) {
				if (is_plugin_active(USP_FILE)) {
					deactivate_plugins(USP_FILE);
					$msg = '<strong>'. USP_NAME .'</strong> '. __('has been deactivated because it requires WordPress version ', 'usp') . USP_REQUIRES . __(' or higher. ', 'usp');
					$msg .= __('Please', 'usp') .' <a href="'. admin_url() .'">'. __('return to the Admin Area', 'usp') .'</a> '. __('to upgrade WordPress and try again.', 'usp');
					wp_die($msg);
				}
			}
		}
		
		function usp_i18n_init() {
			load_plugin_textdomain('usp', false, dirname(plugin_basename(__FILE__)) .'/languages/');
		}
		
		function register_post_status(){
			global $usp_general;
			$custom_status = __('Undefined', 'usp');
			if (!empty($usp_general['custom_status'])) {
				$custom_status = $usp_general['custom_status'];
			}
			$enable_status = $usp_general['number_approved'];
			if ($enable_status == -3) {
				register_post_status($custom_status, array(
					'label'                     => $custom_status,
					'public'                    => true,
					'exclude_from_search'       => false,
					'show_in_admin_all_list'    => true,
					'show_in_admin_status_list' => true,
					'label_count'               => _n_noop($custom_status .' <span class="count">(%s)</span>', $custom_status .' <span class="count">(%s)</span>'),
					// note: Custom Post Status is not yet fully implemented in WP, see: https://codex.wordpress.org/Function_Reference/register_post_status
					// at this point, we can register CPS and use them for submitted posts, but they will not be displayed in the Admin Area until WP adds it	 
				));
			}
		}
		
		function add_status_clause($wp_query) {
			global $usp_general, $pagenow;
			
			if (!is_admin()) return;
			if ($pagenow !== 'edit.php') return;
			
			if (isset($_GET['user_submitted']) && $_GET['user_submitted'] === '1') {
				set_query_var('meta_key', 'is_submission');
				set_query_var('meta_value', 1);
			}
		}
		
		function add_post_status($postStati) {
			$postStati['submitted'] = array(__('Submitted', 'usp'), __('User Submitted Posts', 'usp'), _n_noop('Submitted', 'Submitted'));
			return $postStati;
		}
		
		function add_post_filter_button() {
			global $usp_advanced, $pagenow, $typenow, $post_status;
			
			if (!is_admin()) return;
			if ($pagenow !== 'edit.php') return;
			if ($post_status === 'trash') return;
			
			if (($typenow === 'post' || $typenow === 'page' || $typenow === 'usp_post') || (isset($usp_advanced['post_type']) && $usp_advanced['post_type'] === $typenow)) {
				echo '<a id="usp-admin-filter" class="button" href="'. admin_url('edit.php?user_submitted=1') .'">'. __('USP', 'usp') .'</a>';
			}
		}
		
		function usp_replace_author($author) {
			global $post, $usp_general;
			$is_submission = get_post_meta($post->ID, 'is_submission', true);
			$usp_author    = get_post_meta($post->ID, 'usp-author', true);
			if ($usp_general['replace_author']) {
				if ($is_submission && !empty($usp_author)) return $usp_author;
			}
			return $author;
		}
		
		function usp_replace_author_link($link, $author_id, $author_nicename) {
			global $post, $usp_general;
			$is_submission = get_post_meta($post->ID, 'is_submission', true);
			$usp_url       = get_post_meta($post->ID, 'usp-url', true);
			if ($usp_general['replace_author']) {
				if ($is_submission && !empty($usp_url)) return $usp_url;
			}
			return $link;
		}
		
		public static function get_user_infos() {
			global $current_user;
			if ($current_user) $admin_id = $current_user->ID;
			else $admin_id = '1';
			$admin_name  = get_bloginfo('name');
			$admin_email = get_bloginfo('admin_email');
			$admin_url   = home_url();
			$user_info = array('admin_id' => $admin_id, 'admin_name' => $admin_name, 'admin_email' => $admin_email, 'admin_url' => $admin_url);
			return $user_info;
		}
		
		public static function admin_defaults() {
			$user_info = USP_Pro::get_user_infos();
			$defaults = array(
				'admin_email'             => $user_info['admin_email'],
				'admin_from'              => $user_info['admin_email'],
				'admin_name'              => $user_info['admin_name'],
				'cc_submit'               => '',
				'cc_approval'             => '',
				'cc_denied'               => '',
				'cc_scheduled'            => '',
				'send_mail'               => 'wp_mail',
				'mail_format'             => 'text',
				'send_mail_admin'         => 1,
				'send_mail_user'          => 1,
				'send_approval_admin'     => 1,
				'send_approval_user'      => 1,
				'send_denied_admin'       => 1,
				'send_denied_user'        => 1, 
				'send_scheduled_admin'    => 1,
				'send_scheduled_user'     => 1,
				'alert_subject_admin'     => __('New User Submitted Post!', 'usp'),
				'post_alert_admin'        => __('New user-submitted post at ', 'usp') . $user_info['admin_name'] . __('! URL: ', 'usp') . $user_info['admin_url'],
				'alert_subject_user'      => __('Thank you for your submitted post!', 'usp'),
				'post_alert_user'         => __('Thank you for your submission at ', 'usp') . $user_info['admin_name'] . __('! If submissions require approval, you\'ll receive an email once it\'s approved.', 'usp'),
				'approval_subject_admin'  => __('Submitted Post Approved!', 'usp'),
				'approval_message_admin'  => __('Congratulations, a submitted post has been approved at '. $user_info['admin_name'] .'!', 'usp'),
				'approval_subject'        => __('Submitted Post Approved!', 'usp'),
				'approval_message'        => __('Congratulations, your submitted post has been approved at '. $user_info['admin_name'] .'!', 'usp'),
				'denied_subject_admin'    => __('Submitted Post Denied', 'usp'),
				'denied_message_admin'    => __('A submitted post has been denied at '. $user_info['admin_name'], 'usp'),
				'denied_subject'          => __('Submitted Post Denied', 'usp'),
				'denied_message'          => __('Sorry, but your submission has been denied.', 'usp'),
				'scheduled_subject_admin' => __('Submitted Post Scheduled', 'usp'),
				'scheduled_message_admin' => __('A submitted post has been scheduled for publishing at '. $user_info['admin_name'] .'.', 'usp'),
				'scheduled_subject'       => __('Submitted Post Scheduled', 'usp'),
				'scheduled_message'       => __('Your submitted post has been scheduled for publishing at '. $user_info['admin_name'] .'.', 'usp'),
				'contact_sub_prefix'      => __('Message sent from ', 'usp') . $user_info['admin_name'] . ': ',
				'contact_subject'         => __('Email Subject', 'usp'),
				'contact_cc'              => $user_info['admin_email'],
				'contact_cc_user'         => 0,
				'contact_cc_note'         => __('A copy of this message will be sent to the specified email address.', 'usp'),
				'contact_stats'           => 0,
				'contact_from'            => $user_info['admin_email'],
				'contact_custom'          => 1,
				'custom_content'          => '',
				'custom_contact_1'        => '',
				'custom_contact_2'        => '',
				'custom_contact_3'        => '',
				'custom_contact_4'        => '',
				'custom_contact_5'        => '',
			);
			return $defaults;
		}
		
		public static function advanced_defaults() {
			$defaults = array(
				'enable_autop'       => 0,
				'submit_button'      => 1,
				'submit_text'        => __('Submit Post', 'usp'),
				'html_content'       => '',
				'fieldsets'          => 1,
				'form_demos'         => 1,
				'post_demos'         => 1,
				'post_type'          => 'post',
				'post_type_role'     => array('administrator'), 
				'form_type_role'     => array('administrator'), 
				'other_type'         => '',
				'post_type_slug'     => 'usp_post',
				'form_atts'          => 'data-validate="parsley" data-persist="garlic" novalidate',
				'redirect_success'   => '',
				'redirect_failure'   => '',
				'blacklist_terms'    => '',
				'default_title'      => 'Post Title',
				'default_content'    => 'Post Content',
				
				'custom_before'      => '<div class="usp-pro-form">',
				'custom_after'       => '</div>',
				'error_before'       => '<div class="usp-errors"><div class="usp-errors-heading"><strong>Important!</strong> Please fix the following issues:</div>',
				'error_after'        => '</div>',
				'success_post'       => __('Success! You have successfully submitted a post.', 'usp'),
				'success_reg'        => __('Congratulations, you have been registered with the site.', 'usp'),
				'success_both'       => __('Registration successful! Post Submission successful! You&rsquo;re golden.', 'usp'),
				'success_contact'    => __('Email sent! We&rsquo;ll get back to you as soon as possible.', 'usp'),
				'success_email_reg'  => __('Registration successful! Email sent! We&rsquo;ll get back to you as soon as possible.', 'usp'),
				'success_email_post' => __('Post Submitted! Email sent! We&rsquo;ll get back to you as soon as possible.', 'usp'),
				'success_email_both' => __('Post Submitted! Registration successful! Email sent! We&rsquo;ll get back to you as soon as possible.', 'usp'),
				'success_before'     => '<div class="usp-success">',
				'success_after'      => '</div>',
				'success_form'       => 0,
				
				'custom_fields'      => 3,
				'custom_names'       => '', // no default for usp_label_c{n}
				'custom_prefix'      => 'prefix_',
				'custom_optional'    => '',
				'custom_required'    => '',
				'custom_field_names' => '', // no default for usp_custom_field_{n}
				
				'usp_error_1'        => __('Your Name', 'usp'),
				'usp_error_2' 	     => __('Post URL', 'usp'),
				'usp_error_3' 	     => __('Post Title', 'usp'),
				'usp_error_4' 	     => __('Post Tags', 'usp'),
				'usp_error_5' 	     => __('Challenge Question', 'usp'),
				'usp_error_6' 	     => __('Post Category', 'usp'),
				'usp_error_7' 	     => __('Post Content', 'usp'),
				'usp_error_8' 	     => __('File(s)', 'usp'),
				'usp_error_9' 	     => __('Email Address', 'usp'),
				'usp_error_10'       => __('Email Subject', 'usp'),
				'usp_error_11'       => __('Alt text', 'usp'), 
				'usp_error_12'       => __('Caption', 'usp'), 
				'usp_error_13'       => __('Description', 'usp'), 
				'usp_error_14'       => __('Taxonomy', 'usp'),
				'usp_error_15'       => __('Post Format', 'usp'),
				'usp_error_16'       => __('Media Title', 'usp'),
				'usp_error_17'       => __('File Name', 'usp'),
				'usp_error_18'       => __('I agree to the terms', 'usp'),
				
				// not used
				'usp_error_a'        => __('User Nicename', 'usp'),
				'usp_error_b'        => __('User Display Name', 'usp'),
				'usp_error_c'        => __('User Nickname', 'usp'),
				'usp_error_d'        => __('User First Name', 'usp'),
				'usp_error_e'        => __('User Last Name', 'usp'),
				'usp_error_f'        => __('User Description', 'usp'),
				'usp_error_g'        => __('User Password', 'usp'),
			);
			return $defaults;
		}
		
		public static function more_defaults() {
			$defaults = array(
				'tax_before'          => '<div class="usp-error usp-error-taxonomy">' . __('Required field: ', 'usp'),
				'tax_after'           => '</div>',
				'custom_field_before' => '<div class="usp-error usp-error-custom">' . __('Required field: ', 'usp'),
				'custom_field_after'  => '</div>',
				'error_sep'           => '',
				
				'usp_error_1_desc'    => '<div class="usp-error">' . __('Required field: Your Name', 'usp') . '</div>',
				'usp_error_2_desc'    => '<div class="usp-error">' . __('Required field: Post URL', 'usp') . '</div>',
				'usp_error_3_desc'    => '<div class="usp-error">' . __('Required field: Post Title', 'usp') . '</div>',
				'usp_error_4_desc'    => '<div class="usp-error">' . __('Required field: Post Tags', 'usp') . '</div>',
				'usp_error_5_desc'    => '<div class="usp-error">' . __('Required field: Challenge Question', 'usp') . '</div>',
				'usp_error_6_desc'    => '<div class="usp-error">' . __('Required field: Post Category', 'usp') . '</div>',
				'usp_error_7_desc'    => '<div class="usp-error">' . __('Required field: Post Content', 'usp') . '</div>',
				'usp_error_8_desc'    => '<div class="usp-error">' . __('Required field: File(s)', 'usp') . '</div>',
				'usp_error_9_desc'    => '<div class="usp-error">' . __('Required field: Email Address', 'usp') . '</div>',
				'usp_error_10_desc'   => '<div class="usp-error">' . __('Required field: Email Subject', 'usp') . '</div>',
				'usp_error_11_desc'   => '<div class="usp-error">' . __('Required field: Alt text', 'usp') . '</div>', 
				'usp_error_12_desc'   => '<div class="usp-error">' . __('Required field: Caption', 'usp') . '</div>', 
				'usp_error_13_desc'   => '<div class="usp-error">' . __('Required field: Description', 'usp') . '</div>', 
				'usp_error_14_desc'   => '<div class="usp-error">' . __('Required field: Taxonomy', 'usp') . '</div>',
				'usp_error_15_desc'   => '<div class="usp-error">' . __('Required field: Post Format', 'usp') . '</div>',
				'usp_error_16_desc'   => '<div class="usp-error">' . __('Required field: Media Title', 'usp') . '</div>',
				'usp_error_17_desc'   => '<div class="usp-error">' . __('Required field: File Name', 'usp') . '</div>',
				'usp_error_18_desc'   => '<div class="usp-error">' . __('Required field: Agree to Terms', 'usp') . '</div>',
				
				'usp_error_a_desc'    => '<div class="usp-error">' . __('Required field: User Nicename', 'usp') . '</div>',
				'usp_error_b_desc'    => '<div class="usp-error">' . __('Required field: User Display Name', 'usp') . '</div>',
				'usp_error_c_desc'    => '<div class="usp-error">' . __('Required field: User Nickname', 'usp') . '</div>',
				'usp_error_d_desc'    => '<div class="usp-error">' . __('Required field: User First Name', 'usp') . '</div>',
				'usp_error_e_desc'    => '<div class="usp-error">' . __('Required field: User Last Name', 'usp') . '</div>',
				'usp_error_f_desc'    => '<div class="usp-error">' . __('Required field: User Description', 'usp') . '</div>',
				'usp_error_g_desc'    => '<div class="usp-error">' . __('Required field: User Password', 'usp') . '</div>',
				
				'error_username'      => '<div class="usp-error">' . __('Username already registered. If that is your username, please log in to submit posts. Otherwise, please choose a different username.', 'usp') . '</div>',
				'error_email'         => '<div class="usp-error">' . __('Email already registered. If that is your address, please log in to submit content. Otherwise, please choose a different email address.', 'usp') . '</div>',
				'error_register'      => '<div class="usp-error">' . __('User-registration is currently disabled. Please contact the admin if you need help.', 'usp') . '</div>',
				'user_exists'         => '<div class="usp-error">' . __('You are already registered with this site. Please contact the admin if you need help.', 'usp') . '</div>',
				'post_required'       => '<div class="usp-error">' . __('Post-submission required. Please try again or contact the admin if you need help.', 'usp') . '</div>',
				'post_duplicate'      => '<div class="usp-error">' . __('Duplicate post detected. Please enter a unique post title and unique post content.', 'usp') . '</div>',
				'form_allowed'        => '<div class="usp-error">' . __('Incorrect form type. Please notify the administrator.', 'usp') . '</div>',
				
				'name_restrict'       => '<div class="usp-error">' . __('Restricted characters found in Name field. Please try again.', 'usp') . '</div>',
				'spam_response'       => '<div class="usp-error">' . __('Incorrect response for the spam check. Please try again.', 'usp') . '</div>',
				'content_min'         => '<div class="usp-error">' . __('Minimum number of characters not met in content field. Please try again.', 'usp') . '</div>',
				'content_max'         => '<div class="usp-error">' . __('Number of characters in content field exceeds maximum allowed. Please try again.', 'usp') . '</div>',
				'email_restrict'      => '<div class="usp-error">' . __('Restricted characters found in Email address. Please try again.', 'usp') . '</div>',
				'subject_restrict'    => '<div class="usp-error">' . __('Restricted characters found in Subject field. Please try again.', 'usp') . '</div>',
				'content_filter'      => '<div class="usp-error">' . __('Restricted terms found in Content field. Please try again.', 'usp') . '</div>',
				
				'files_required'      => '<div class="usp-error">' . __('File(s) required. Please check any required file(s) and try again.', 'usp') . '</div>',
				'file_type_not'       => '<div class="usp-error">' . __('File type not allowed. Please check the allowed file types and try again.', 'usp') . '</div>',
				'file_dimensions'     => '<div class="usp-error">' . __('Image dimensions (width/height) exceed set limits. Please check the requirements and try again.', 'usp') . '</div>',
				'file_max_size'       => '<div class="usp-error">' . __('Maximum file-size limit exceeded. Please check the file requirements and try again.', 'usp') . '</div>',
				'file_min_size'       => '<div class="usp-error">' . __('Minimum file-size not met. Please check the file requirements and try again.', 'usp') . '</div>',
				'file_required'       => '<div class="usp-error">' . __('File(s) required. Please check any required file(s) and try again.', 'usp') . '</div>',
				'file_name'           => '<div class="usp-error">' . __('Length of filename exceeds allowed limit. Please check the requirements and try again.', 'usp') . '</div>',
				'min_req_files'       => '<div class="usp-error">' . __('Please ensure that you have met the minimum number of required files, and that any specific requirements have been met (e.g., size, dimensions).', 'usp') . '</div>',
				'max_req_files'       => '<div class="usp-error">' . __('Please ensure that you have not exceeded the maximum number of files, and that any specific requirements have been met (e.g., size, dimensions).', 'usp') . '</div>',
				'file_square'         => '<div class="usp-error">' . __('A square image is required. Please check the requirements and try again.', 'usp') . '</div>',
			);
			return $defaults;
		}
		
		public static function general_defaults() {
			$user_info = USP_Pro::get_user_infos();
			$defaults = array(
				'number_approved'    => -1,
				'custom_status'      => 'Custom',
				'categories'         => array(get_option('default_category')),
				'hidden_cats'        => 0,
				'cats_menu'          => 'dropdown',
				'cats_multiple'      => 0,
				'cats_nested'        => 1,
				'tags'               => array(),
				'hidden_tags'        => 0,
				'tags_order'         => 'name_asc',
				'tags_number'        => '-1',
				'tags_empty'         => 0,
				'tags_menu'          => 'dropdown',
				'tags_multiple'      => 0,
				'redirect_post'      => 0,
				'enable_stats'       => 0,
				'character_max'      => 0,
				'character_min'      => 0,
				'titles_unique'      => 1,
				'content_unique'     => 1,
				'sessions_on'        => 1,
				'sessions_scope'     => 0,
				'sessions_default'   => 1,
				'captcha_question'   => '1 + 1 =',
				'captcha_response'   => '2',
				'captcha_casing'     => 0,
				'recaptcha_public'   => '',
				'recaptcha_private'  => '',
				'recaptcha_version'  => 'v1',
				'assign_role'        => 'subscriber',
				'assign_author'      => $user_info['admin_id'],
				'use_author'         => 0,
				'replace_author'     => 0,
				'use_cat'            => 0,
				'use_cat_id'         => '',
				'submit_form_ids'    => 'classic, preview, submit, starter',
				'register_form_ids'  => 'register',
				'contact_form'       => 'contact',
				'enable_form_lock'   => 0,
			);
			return $defaults;
		}
		
		public static function style_defaults() {
			$defaults = array(
				'form_style'    => 'simple',
				
				'style_simple'  => '.usp-pro .usp-fieldset, .usp-pro fieldset { border: 0; margin: 10px 0; padding: 0; }
.usp-pro .usp-label, .usp-pro .usp-input, .usp-pro .usp-textarea, .usp-pro textarea, .usp-pro .usp-select, .usp-pro .usp-input-files, .usp-pro .usp-checkbox, .usp-pro .usp-checkboxes label, .usp-pro .usp-radio label, .usp-pro .usp-preview, .usp-pro .usp-contact-cc { float: none; clear: both; display: block; width: 99%; box-sizing: border-box; }
.usp-pro .usp-checkbox .usp-input, .usp-pro .usp-checkboxes input[type="checkbox"], .usp-pro .usp-input-agree, .usp-pro .usp-remember, .usp-pro .usp-label-agree, .usp-pro .usp-label-remember { float: none; clear: none; display: inline-block; width: auto; box-sizing: border-box; vertical-align: middle; }
.usp-pro .usp-files, .usp-pro .usp-agree { margin: 5px 0; }
.usp-pro .usp-contact-cc, .usp-pro .usp-submit { margin: 10px 0; }
.usp-pro .usp-agree-toggle, .usp-pro .usp-add-another { cursor: pointer; }
.usp-pro .usp-agree-toggle:hover { text-decoration: underline; }
.usp-pro .usp-agree-terms { padding: 5px 0; font-size: 90%; }
.usp-pro .usp-preview { overflow: hidden; }
.usp-pro .usp-preview div { float: left; width: 150px; height: 75px; overflow: hidden; margin: 5px 10px 5px 0; }
.usp-pro .usp-preview div a { display: block; width: 100%; height: 100%; }
.usp-pro .usp-input-files { margin: 5px 0; line-height: 1; }
.usp-pro .usp-form-errors { margin: 0 0 20px 0; }
.usp-pro .usp-error { color: #cc6666; }
.usp-pro .usp-error-field { border-color: #cc6666; background-color: #fef9f9; }
.usp-hidden { display: none; }',
				
				'style_min'     => '.usp-pro .usp-fieldset, .usp-pro fieldset { border: 0; margin: 10px 0; padding: 0; }
.usp-pro .usp-label, .usp-pro .usp-input, .usp-pro .usp-textarea, .usp-pro textarea, .usp-pro .usp-select, .usp-pro .usp-input-files, .usp-pro .usp-checkbox, .usp-pro .usp-checkboxes label, .usp-pro .usp-radio label, .usp-pro .usp-preview, .usp-pro .usp-contact-cc { float: none; clear: both; display: block; width: 99%; box-sizing: border-box; font-size: 14px; }
.usp-pro .usp-checkbox .usp-input, .usp-pro .usp-checkboxes input[type="checkbox"], .usp-pro .usp-input-agree, .usp-pro .usp-remember, .usp-pro .usp-label-agree, .usp-pro .usp-label-remember { float: none; clear: none; display: inline-block; width: auto; box-sizing: border-box; vertical-align: middle; font-size: 14px; }
.usp-pro .usp-files, .usp-pro .usp-agree { margin: 5px 0; font-size: 14px; }
.usp-pro .usp-contact-cc, .usp-pro .usp-submit { margin: 10px 0; font-size: 14px; }
.usp-pro .usp-agree-toggle, .usp-pro .usp-add-another { cursor: pointer; font-size: 13px; }
.usp-pro .usp-agree-toggle:hover { text-decoration: underline; }
.usp-pro .usp-agree-terms { padding: 5px 0; font-size: 12px; }
.usp-pro .usp-preview { overflow: hidden; }
.usp-pro .usp-preview div { float: left; width: 150px; height: 75px; overflow: hidden; margin: 5px 10px 5px 0; }
.usp-pro .usp-preview div a { display: block; width: 100%; height: 100%; }
.usp-pro .usp-input-files { margin: 5px 0; line-height: 1; font-size: 13px; }
.usp-pro .usp-form-errors { margin: 0 0 20px 0; font-size: 14px; }
.usp-pro .usp-error { color: #cc6666; }
.usp-pro .usp-error-field { border-color: #cc6666; background-color: #fef9f9; }
.usp-pro, .usp-pro ul, .usp-pro p, .usp-pro code { font-size: 14px; }
.usp-pro .usp-contact-cc { font-size: 13px; }
.usp-hidden { display: none; }',
				
				'style_small'   => '.usp-pro .usp-fieldset, .usp-pro fieldset { border: 0; margin: 5px 0; padding: 0; }
.usp-pro .usp-label, .usp-pro .usp-input, .usp-pro .usp-textarea, .usp-pro textarea, .usp-pro .usp-select, .usp-pro .usp-input-files, .usp-pro .usp-checkbox, .usp-pro .usp-checkboxes label, .usp-pro .usp-radio label, .usp-pro .usp-preview, .usp-pro .usp-contact-cc { float: none; clear: both; display: block; width: 70%; box-sizing: border-box; font-size: 12px; }
.usp-pro .usp-checkbox .usp-input, .usp-pro .usp-checkboxes input[type="checkbox"], .usp-pro .usp-input-agree, .usp-pro .usp-remember, .usp-pro .usp-label-agree, .usp-pro .usp-label-remember { float: none; clear: none; display: inline-block; width: auto; box-sizing: border-box; vertical-align: middle; font-size: 12px; }
.usp-pro .usp-files, .usp-pro .usp-agree { margin: 5px 0; font-size: 12px; }
.usp-pro .usp-contact-cc, .usp-pro .usp-submit { margin: 10px 0; font-size: 12px; }
.usp-pro .usp-agree-toggle, .usp-pro .usp-add-another { cursor: pointer; font-size: 11px; }
.usp-pro .usp-agree-toggle:hover { text-decoration: underline; }
.usp-pro .usp-agree-terms { padding: 5px 0; font-size: 10px; }
.usp-pro .usp-preview { overflow: hidden; }
.usp-pro .usp-preview div { float: left; width: 100px; height: 50px; overflow: hidden; margin: 5px 5px 0 0; }
.usp-pro .usp-preview div a { display: block; width: 100%; height: 100%; }
.usp-pro .usp-input-files { margin: 3px 0; line-height: 1; font-size: 12px; }
.usp-pro .usp-form-errors { margin: 10px 0; font-size: 12px; }
.usp-pro .usp-error { color: #cc6666; }
.usp-pro .usp-error-field { border-color: #cc6666; background-color: #fef9f9; }
.usp-pro, .usp-pro ul, .usp-pro p, .usp-pro code { font-size: 12px; }
.usp-pro .usp-contact-cc { font-size: 11px; }
.usp-hidden { display: none; }',
				
				'style_large'   => '.usp-pro .usp-fieldset, .usp-pro fieldset { border: 0; margin: 20px 0; padding: 0; }
.usp-pro .usp-label, .usp-pro .usp-input, .usp-pro .usp-textarea, .usp-pro textarea, .usp-pro .usp-select, .usp-pro .usp-input-files, .usp-pro .usp-checkbox, .usp-pro .usp-checkboxes label, .usp-pro .usp-radio label, .usp-pro .usp-preview, .usp-pro .usp-contact-cc { float: none; clear: both; display: block; width: 99%; box-sizing: border-box; font-size: 16px; }
.usp-pro .usp-checkbox .usp-input, .usp-pro .usp-checkboxes input[type="checkbox"], .usp-pro .usp-input-agree, .usp-pro .usp-remember, .usp-pro .usp-label-agree, .usp-pro .usp-label-remember { float: none; clear: none; display: inline-block; width: auto; box-sizing: border-box; vertical-align: middle; font-size: 16px; }
.usp-pro .usp-contact-cc { margin: 20px 0; font-size: 16px; }
.usp-pro .usp-submit { margin: 10px 0; font-size: 16px; }
.usp-pro .usp-agree-toggle, .usp-pro .usp-add-another { margin: 5px 0 0 0; cursor: pointer; font-size: 14px; }
.usp-pro .usp-agree-toggle:hover { text-decoration: underline; }
.usp-pro .usp-agree-terms { padding: 10px 0; font-size: 13px; }
.usp-pro .usp-preview { overflow: hidden; }
.usp-pro .usp-preview div { float: left; width: 200px; height: 100px; overflow: hidden; margin: 10px 10px 0 0; }
.usp-pro .usp-preview div a { display: block; width: 100%; height: 100%; }
.usp-pro .usp-input-files { margin: 5px 0; line-height: 1; font-size: 14px; }
.usp-pro .usp-form-errors { margin: 20px 0; font-size: 16px; }
.usp-pro .usp-error { color: #cc6666; }
.usp-pro .usp-error-field { border-color: #cc6666; background-color: #fef9f9; }
.usp-pro, .usp-pro ul, .usp-pro p, .usp-pro code { font-size: 16px; }
.usp-pro .usp-contact-cc { font-size: 14px; }
.usp-hidden { display: none; }',
				
				'style_custom'  => '',
				'include_css'   => 0,
				'include_js'    => 1,
				'script_custom' => '',
				'include_url'   => '',
			);
			return $defaults;
		}
		
		public static function uploads_defaults() {
			$defaults = array(
				'post_images'      => 'before',
				'min_files'        => 0,
				'max_files'        => 3,
				'max_height'       => 1500,
				'min_height'       => 0,
				'max_width'        => 1500,
				'min_width'        => 0,
				'max_size'         => 5242880, // bytes = 5 MB
				'min_size'         => 5, // = 5 bytes
				'files_allow'      => 'bmp, gif, ico, jpe, jpeg, jpg, png, tif, tiff',
				'featured_image'   => 1,
				'featured_key'     => '1',
				'unique_filename'  => 1,
				'user_shortcodes'  => 0,
				'display_size'     => 'thumbnail',
				'enable_media'     => false,
				'square_image'     => 0,
			);
			return $defaults;
		}
		
		public static function tools_defaults() {
			$defaults = array(
				'default_options' => 0,
			);
			return $defaults;
		}
		
		
		
		// GENERAL SETTINGS
		
		function register_general_settings() {
			
			$this->settings_tabs[$this->settings_general] = __('General', 'usp');
			register_setting($this->settings_general, $this->settings_general, 'validate_general');
			add_settings_section('section_general_0', '', 'section_general_0_desc', $this->settings_general);
			
			// 1
			add_settings_section('section_general_1', __('Basic Settings', 'usp'), 'section_general_1_desc', $this->settings_general);
			add_settings_field('number_approved',  __('Default Post Status', 'usp'),      array(&$this, 'callback_dropdown'),   $this->settings_general, 'section_general_1', array('id' => 'number_approved',  'type' => 'general'));
			add_settings_field('custom_status',    __('Custom Post Status', 'usp'),       array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_1', array('id' => 'custom_status',    'type' => 'general'));
			add_settings_field('redirect_post',    __('Redirect to Post', 'usp'),         array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_1', array('id' => 'redirect_post',    'type' => 'general'));
			add_settings_field('enable_stats',     __('Enable Basic Statistics', 'usp'),  array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_1', array('id' => 'enable_stats',     'type' => 'general'));
			add_settings_field('character_min',    __('Min Character Limit', 'usp'),      array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_1', array('id' => 'character_min',    'type' => 'general'));
			add_settings_field('character_max',    __('Max Character Limit', 'usp'),      array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_1', array('id' => 'character_max',    'type' => 'general'));
			add_settings_field('titles_unique',    __('Unique Post Titles', 'usp'),       array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_1', array('id' => 'titles_unique',    'type' => 'general'));
			add_settings_field('content_unique',   __('Unique Post Content', 'usp'),      array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_1', array('id' => 'content_unique',   'type' => 'general'));
			// 2
			add_settings_section('section_general_2', __('Memory Settings', 'usp'), 'section_general_2_desc', $this->settings_general);
			add_settings_field('sessions_on',      __('Remember Form Values', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_2', array('id' => 'sessions_on',      'type' => 'general'));
			add_settings_field('sessions_scope',   __('Memory Duration', 'usp'),          array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_2', array('id' => 'sessions_scope',   'type' => 'general'));
			add_settings_field('sessions_default', __('Memory Default', 'usp'),           array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_2', array('id' => 'sessions_default', 'type' => 'general'));
			// 3
			add_settings_section('section_general_3', __('User Settings', 'usp'), 'section_general_3_desc', $this->settings_general);
			add_settings_field('assign_author',   __('Default Assigned Author', 'usp'),  array(&$this, 'callback_dropdown'), $this->settings_general, 'section_general_3', array('id' => 'assign_author',   'type' => 'general'));
			add_settings_field('assign_role',     __('Default Assigned Role', 'usp'),    array(&$this, 'callback_dropdown'), $this->settings_general, 'section_general_3', array('id' => 'assign_role',     'type' => 'general'));
			add_settings_field('use_author',      __('Use Registered Author', 'usp'),    array(&$this, 'callback_checkbox'), $this->settings_general, 'section_general_3', array('id' => 'use_author',      'type' => 'general'));
			add_settings_field('replace_author',  __('Replace Author &amp; URL', 'usp'), array(&$this, 'callback_checkbox'), $this->settings_general, 'section_general_3', array('id' => 'replace_author',  'type' => 'general'));
			// 4
			add_settings_section('section_general_4', __('Antispam/Captcha', 'usp'), 'section_general_4_desc', $this->settings_general);
			add_settings_field('captcha_question',  __('Challenge Question', 'usp'),    array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_4', array('id' => 'captcha_question',  'type' => 'general'));
			add_settings_field('captcha_response',  __('Challenge Response', 'usp'),    array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_4', array('id' => 'captcha_response',  'type' => 'general'));
			add_settings_field('captcha_casing',    __('Case-sensitivity', 'usp'),      array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_4', array('id' => 'captcha_casing',    'type' => 'general'));
			add_settings_field('recaptcha_public',  __('reCAPTCHA Public Key', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_4', array('id' => 'recaptcha_public',  'type' => 'general'));
			add_settings_field('recaptcha_private', __('reCAPTCHA Private Key', 'usp'), array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_4', array('id' => 'recaptcha_private', 'type' => 'general'));
			add_settings_field('recaptcha_version', __('reCAPTCHA Version', 'usp'),     array(&$this, 'callback_select'),     $this->settings_general, 'section_general_4', array('id' => 'recaptcha_version', 'type' => 'general'));
			// 5
			add_settings_section('section_general_5', __('Category Settings', 'usp'), 'section_general_5_desc', $this->settings_general);
			add_settings_field('cats_menu',     __('Category Menu', 'usp'),         array(&$this, 'callback_radio'),      $this->settings_general, 'section_general_5', array('id' => 'cats_menu',     'type' => 'general'));
			add_settings_field('cats_multiple', __('Multiple Categories', 'usp'),   array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_5', array('id' => 'cats_multiple', 'type' => 'general'));
			add_settings_field('cats_nested',   __('Nested Categories', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_5', array('id' => 'cats_nested',   'type' => 'general'));
			add_settings_field('hidden_cats',   __('Hide Category Field', 'usp'),   array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_5', array('id' => 'hidden_cats',   'type' => 'general'));
			add_settings_field('use_cat',       __('Required Categories', 'usp'),   array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_5', array('id' => 'use_cat',       'type' => 'general'));
			add_settings_field('use_cat_id',    __('Required Category IDs', 'usp'), array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_5', array('id' => 'use_cat_id',    'type' => 'general'));
			add_settings_field('categories',    __('Post Categories', 'usp'),       array(&$this, 'callback_checkboxes'), $this->settings_general, 'section_general_5', array('id' => 'categories',    'type' => 'general'));
			// 6
			add_settings_section('section_general_6', __('Tag Settings', 'usp'), 'section_general_6_desc', $this->settings_general);
			add_settings_field('tags_menu',     __('Tag Menu', 'usp'),            array(&$this, 'callback_radio'),      $this->settings_general, 'section_general_6', array('id' => 'tags_menu',     'type' => 'general'));
			add_settings_field('tags_multiple', __('Allow Multiple Tags', 'usp'), array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_6', array('id' => 'tags_multiple', 'type' => 'general'));
			add_settings_field('hidden_tags',   __('Hide Tags Field', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_6', array('id' => 'hidden_tags',   'type' => 'general'));
			add_settings_field('tags_order',    __('Tag Order', 'usp'),           array(&$this, 'callback_radio'),      $this->settings_general, 'section_general_6', array('id' => 'tags_order',    'type' => 'general'));
			add_settings_field('tags',          __('Post Tags', 'usp'),           array(&$this, 'callback_checkboxes'), $this->settings_general, 'section_general_6', array('id' => 'tags',          'type' => 'general'));
			add_settings_field('tags_number',   __('Number of Tags', 'usp'),      array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_6', array('id' => 'tags_number',   'type' => 'general'));
			add_settings_field('tags_empty',    __('Hide Empty Tags', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_6', array('id' => 'tags_empty',    'type' => 'general'));
			// 7
			add_settings_section('section_general_7', __('Extra Form Security', 'usp'), 'section_general_7_desc', $this->settings_general);
			add_settings_field('enable_form_lock',  __('Enable this feature', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_general, 'section_general_7', array('id' => 'enable_form_lock',  'type' => 'general'));
			add_settings_field('submit_form_ids',   __('Post-Submission Forms', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_7', array('id' => 'submit_form_ids',   'type' => 'general'));
			add_settings_field('register_form_ids', __('User-Registration Forms', 'usp'), array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_7', array('id' => 'register_form_ids', 'type' => 'general'));
			add_settings_field('contact_form',      __('Contact Forms', 'usp'),           array(&$this, 'callback_input_text'), $this->settings_general, 'section_general_7', array('id' => 'contact_form',      'type' => 'general'));
		
		}
		
		// STYLE SETTINGS
		
		function register_style_settings() {
			
			$this->settings_tabs[$this->settings_style] = __('CSS/JS', 'usp');
			register_setting($this->settings_style, $this->settings_style, 'validate_style');
			add_settings_section('section_style_0', '', 'section_style_0_desc', $this->settings_style);
			
			// 1
			add_settings_section('section_style_1', 'CSS/Styles', 'section_style_1_desc', $this->settings_style);
			add_settings_field('form_style',   __('Select Form Style', 'usp'),   array(&$this, 'callback_radio'),    $this->settings_style, 'section_style_1', array('id' => 'form_style',   'type' => 'style'));
			add_settings_field('style_simple', __('Simple Style', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_style, 'section_style_1', array('id' => 'style_simple', 'type' => 'style'));
			add_settings_field('style_min',    __('Minimal Style', 'usp'),       array(&$this, 'callback_textarea'), $this->settings_style, 'section_style_1', array('id' => 'style_min',    'type' => 'style'));
			add_settings_field('style_small',  __('Smaller Form', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_style, 'section_style_1', array('id' => 'style_small',  'type' => 'style'));
			add_settings_field('style_large',  __('Larger Form', 'usp'),         array(&$this, 'callback_textarea'), $this->settings_style, 'section_style_1', array('id' => 'style_large',  'type' => 'style'));
			add_settings_field('style_custom', __('Custom Style', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_style, 'section_style_1', array('id' => 'style_custom', 'type' => 'style'));
			add_settings_field('include_css',  __('External Stylesheet', 'usp'), array(&$this, 'callback_checkbox'), $this->settings_style, 'section_style_1', array('id' => 'include_css',  'type' => 'style'));
			// 2
			add_settings_section('section_style_2', 'JavaScript/jQuery', 'section_style_2_desc', $this->settings_style);
			add_settings_field('include_js',  __('Include USP JavaScript', 'usp'), array(&$this, 'callback_checkbox'), $this->settings_style, 'section_style_2', array('id' => 'include_js',    'type' => 'style'));
			add_settings_field('script_custom', __('Custom JavaScript', 'usp'),    array(&$this, 'callback_textarea'), $this->settings_style, 'section_style_2', array('id' => 'script_custom', 'type' => 'style'));
			// 3
			add_settings_section('section_style_3', 'Optimization', 'section_style_3_desc', $this->settings_style);
			add_settings_field('include_url', __('Targeted Loading', 'usp'), array(&$this, 'callback_input_text'), $this->settings_style, 'section_style_3', array('id' => 'include_url', 'type' => 'style'));
		
		}
		
		// UPLOADS SETTINGS
		
		function register_uploads_settings() {
			
			$this->settings_tabs[$this->settings_uploads] = __('Uploads', 'usp');
			register_setting($this->settings_uploads, $this->settings_uploads, 'validate_uploads');
			add_settings_section('section_uploads_0', '', 'section_uploads_0_desc', $this->settings_uploads);
			
			add_settings_section('section_uploads_1', 'File Uploads', 'section_uploads_1_desc', $this->settings_uploads);
			add_settings_field('post_images',     __('Auto-Display Images', 'usp'),   array(&$this, 'callback_radio'),      $this->settings_uploads, 'section_uploads_1', array('id' => 'post_images',     'type' => 'uploads'));
			add_settings_field('display_size',    __('Auto-Display Size', 'usp'),     array(&$this, 'callback_select'),     $this->settings_uploads, 'section_uploads_1', array('id' => 'display_size',    'type' => 'uploads'));
			add_settings_field('min_files',       __('Min number of files', 'usp'),   array(&$this, 'callback_select'),     $this->settings_uploads, 'section_uploads_1', array('id' => 'min_files',       'type' => 'uploads'));
			add_settings_field('max_files',       __('Max number of files', 'usp'),   array(&$this, 'callback_select'),     $this->settings_uploads, 'section_uploads_1', array('id' => 'max_files',       'type' => 'uploads'));
			add_settings_field('files_allow',     __('Allowed File Types', 'usp'),    array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'files_allow',     'type' => 'uploads'));
			add_settings_field('min_size',        __('Minimum file size', 'usp'),     array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'min_size',        'type' => 'uploads'));
			add_settings_field('max_size',        __('Maximum file size', 'usp'),     array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'max_size',        'type' => 'uploads'));
			add_settings_field('min_width',       __('Min width for images', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'min_width',       'type' => 'uploads'));
			add_settings_field('max_width',       __('Max width for images', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'max_width',       'type' => 'uploads'));
			add_settings_field('min_height',      __('Min height for images', 'usp'), array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'min_height',      'type' => 'uploads'));
			add_settings_field('max_height',      __('Max height for images', 'usp'), array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'max_height',      'type' => 'uploads'));
			add_settings_field('featured_image',  __('Featured Images', 'usp'),       array(&$this, 'callback_checkbox'),   $this->settings_uploads, 'section_uploads_1', array('id' => 'featured_image',  'type' => 'uploads'));
			add_settings_field('featured_key',    __('Featured Image Key', 'usp'),    array(&$this, 'callback_input_text'), $this->settings_uploads, 'section_uploads_1', array('id' => 'featured_key',    'type' => 'uploads'));
			add_settings_field('unique_filename', __('Unique File Names', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_uploads, 'section_uploads_1', array('id' => 'unique_filename', 'type' => 'uploads'));
			add_settings_field('user_shortcodes', __('User Shortcodes', 'usp'),       array(&$this, 'callback_checkbox'),   $this->settings_uploads, 'section_uploads_1', array('id' => 'user_shortcodes', 'type' => 'uploads'));
			add_settings_field('enable_media',    __('Non-Admin Media', 'usp'),       array(&$this, 'callback_checkbox'),   $this->settings_uploads, 'section_uploads_1', array('id' => 'enable_media',    'type' => 'uploads'));
			add_settings_field('square_image',    __('Require Square Images', 'usp'), array(&$this, 'callback_checkbox'),   $this->settings_uploads, 'section_uploads_1', array('id' => 'square_image',    'type' => 'uploads'));
			
		}
		
		// ADMIN SETTINGS
		
		function register_admin_settings() {
			
			$this->settings_tabs[$this->settings_admin] = __('Admin', 'usp');
			register_setting($this->settings_admin, $this->settings_admin, 'validate_admin');
			add_settings_section('section_admin_0', '', 'section_admin_0_desc', $this->settings_admin);
			
			// 1
			add_settings_section('section_admin_1', 'Email Settings', 'section_admin_1_desc', $this->settings_admin);
			add_settings_field('admin_email', __('Admin Email To', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_1', array('id' => 'admin_email', 'type' => 'admin'));
			add_settings_field('admin_from',  __('Admin Email From', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_1', array('id' => 'admin_from',  'type' => 'admin'));
			add_settings_field('admin_name',  __('Admin Email Name', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_1', array('id' => 'admin_name',  'type' => 'admin'));
			// 2
			add_settings_section('section_admin_2', 'Email Alerts', 'section_admin_2_desc', $this->settings_admin);
			add_settings_field('send_mail',   __('Email Alerts', 'usp'), array(&$this, 'callback_radio'),  $this->settings_admin, 'section_admin_2', array('id' => 'send_mail',   'type' => 'admin'));
			add_settings_field('mail_format', __('Email Format', 'usp'), array(&$this, 'callback_select'), $this->settings_admin, 'section_admin_2', array('id' => 'mail_format', 'type' => 'admin'));
			// 3
			add_settings_section('section_admin_3', 'Email Alerts for Admin', 'section_admin_3_desc', $this->settings_admin);
			add_settings_field('send_mail_admin',         __('Submission Alerts', 'usp'),        array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_3', array('id' => 'send_mail_admin',         'type' => 'admin'));
			add_settings_field('send_approval_admin',     __('Approval Alerts', 'usp'),          array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_3', array('id' => 'send_approval_admin',     'type' => 'admin'));
			add_settings_field('send_denied_admin',       __('Denied Alerts', 'usp'),            array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_3', array('id' => 'send_denied_admin',       'type' => 'admin'));
			add_settings_field('send_scheduled_admin',    __('Scheduled Alerts', 'usp'),         array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_3', array('id' => 'send_scheduled_admin',    'type' => 'admin'));
			add_settings_field('alert_subject_admin',     __('Submission Alert Subject', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'alert_subject_admin',     'type' => 'admin'));
			add_settings_field('post_alert_admin',        __('Submission Alert Message', 'usp'), array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_3', array('id' => 'post_alert_admin',        'type' => 'admin'));
			add_settings_field('approval_subject_admin',  __('Approval Alert Subject', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'approval_subject_admin',  'type' => 'admin'));
			add_settings_field('approval_message_admin',  __('Approval Alert Message', 'usp'),   array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_3', array('id' => 'approval_message_admin',  'type' => 'admin'));
			add_settings_field('denied_subject_admin',    __('Denied Alert Subject', 'usp'),     array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'denied_subject_admin',    'type' => 'admin'));
			add_settings_field('denied_message_admin',    __('Denied Alert Message', 'usp'),     array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_3', array('id' => 'denied_message_admin',    'type' => 'admin'));
			add_settings_field('scheduled_subject_admin', __('Scheduled Alert Subject', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'scheduled_subject_admin', 'type' => 'admin'));
			add_settings_field('scheduled_message_admin', __('Scheduled Alert Message', 'usp'),  array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_3', array('id' => 'scheduled_message_admin', 'type' => 'admin'));
			add_settings_field('cc_submit',               __('CC Submission Alerts', 'usp'),     array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'cc_submit',               'type' => 'admin'));
			add_settings_field('cc_approval',             __('CC Approval Alerts', 'usp'),       array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'cc_approval',             'type' => 'admin'));
			add_settings_field('cc_denied',               __('CC Denied Alerts', 'usp'),         array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'cc_denied',               'type' => 'admin'));
			add_settings_field('cc_scheduled',            __('CC Scheduled Alerts', 'usp'),      array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_3', array('id' => 'cc_scheduled',            'type' => 'admin'));
			// 4
			add_settings_section('section_admin_4', 'Email Alerts for User', 'section_admin_4_desc', $this->settings_admin);
			add_settings_field('send_mail_user',      __('Submission Alerts', 'usp'),        array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_4', array('id' => 'send_mail_user',      'type' => 'admin'));
			add_settings_field('send_approval_user',  __('Approval Alerts', 'usp'),          array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_4', array('id' => 'send_approval_user',  'type' => 'admin'));
			add_settings_field('send_denied_user',    __('Denied Alerts', 'usp'),            array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_4', array('id' => 'send_denied_user',    'type' => 'admin'));
			add_settings_field('send_scheduled_user', __('Scheduled Alerts', 'usp'),         array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_4', array('id' => 'send_scheduled_user', 'type' => 'admin'));
			add_settings_field('alert_subject_user',  __('Submission Alert Subject', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_4', array('id' => 'alert_subject_user',  'type' => 'admin'));
			add_settings_field('post_alert_user',     __('Submission Alert Message', 'usp'), array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_4', array('id' => 'post_alert_user',     'type' => 'admin'));
			add_settings_field('approval_subject',    __('Approval Alert Subject', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_4', array('id' => 'approval_subject',    'type' => 'admin'));
			add_settings_field('approval_message',    __('Approval Alert Message', 'usp'),   array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_4', array('id' => 'approval_message',    'type' => 'admin'));
			add_settings_field('denied_subject',      __('Denied Alert Subject', 'usp'),     array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_4', array('id' => 'denied_subject',      'type' => 'admin'));
			add_settings_field('denied_message',      __('Denied Alert Message', 'usp'),     array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_4', array('id' => 'denied_message',      'type' => 'admin'));
			add_settings_field('scheduled_subject',   __('Scheduled Alert Subject', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_4', array('id' => 'scheduled_subject',   'type' => 'admin'));
			add_settings_field('scheduled_message',   __('Scheduled Alert Message', 'usp'),  array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_4', array('id' => 'scheduled_message',   'type' => 'admin'));
			// 5
			add_settings_section('section_admin_5', 'Contact Form', 'section_admin_5_desc', $this->settings_admin);
			add_settings_field('contact_sub_prefix', __('Subject Line Prefix', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_5', array('id' => 'contact_sub_prefix', 'type' => 'admin'));
			add_settings_field('contact_subject',    __('Subject Line', 'usp'),          array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_5', array('id' => 'contact_subject',    'type' => 'admin'));
			add_settings_field('contact_from',       __('Email From', 'usp'),            array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_5', array('id' => 'contact_from',       'type' => 'admin'));
			add_settings_field('custom_content',     __('Custom Content', 'usp'),        array(&$this, 'callback_textarea'),   $this->settings_admin, 'section_admin_5', array('id' => 'custom_content',     'type' => 'admin'));
			add_settings_field('contact_cc',         __('CC Emails', 'usp'),             array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_5', array('id' => 'contact_cc',         'type' => 'admin'));
			add_settings_field('contact_cc_user',    __('CC User', 'usp'),               array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_5', array('id' => 'contact_cc_user',    'type' => 'admin'));
			add_settings_field('contact_cc_note',    __('CC User Message', 'usp'),       array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_5', array('id' => 'contact_cc_note',    'type' => 'admin'));
			add_settings_field('contact_stats',      __('Include User Stats', 'usp'),    array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_5', array('id' => 'contact_stats',      'type' => 'admin'));
			add_settings_field('contact_custom',     __('Include Custom Fields', 'usp'), array(&$this, 'callback_checkbox'),   $this->settings_admin, 'section_admin_5', array('id' => 'contact_custom',     'type' => 'admin'));
			// 6
			add_settings_section('section_admin_6', 'Custom Recipients', 'section_admin_6_desc', $this->settings_admin);
			add_settings_field('custom_contact_1', __('Custom Recipient 1', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_6', array('id' => 'custom_contact_1', 'type' => 'admin'));
			add_settings_field('custom_contact_2', __('Custom Recipient 2', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_6', array('id' => 'custom_contact_2', 'type' => 'admin'));
			add_settings_field('custom_contact_3', __('Custom Recipient 3', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_6', array('id' => 'custom_contact_3', 'type' => 'admin'));
			add_settings_field('custom_contact_4', __('Custom Recipient 4', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_6', array('id' => 'custom_contact_4', 'type' => 'admin'));
			add_settings_field('custom_contact_5', __('Custom Recipient 5', 'usp'), array(&$this, 'callback_input_text'), $this->settings_admin, 'section_admin_6', array('id' => 'custom_contact_5', 'type' => 'admin'));
			
		}
		
		// ADVANCED SETTINGS
		
		function register_advanced_settings() {
			global $usp_advanced;
			
			$this->settings_tabs[$this->settings_advanced] = __('Advanced', 'usp');
			register_setting($this->settings_advanced, $this->settings_advanced, 'validate_advanced');
			add_settings_section('section_advanced_0', '', 'section_advanced_0_desc', $this->settings_advanced);
			
			// 1
			add_settings_section('section_advanced_1', __('Form Configuration', 'usp'), 'section_advanced_1_desc', $this->settings_advanced);
			add_settings_field('enable_autop',     __('Enable Auto-Formatting', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_advanced, 'section_advanced_1', array('id' => 'enable_autop',     'type' => 'advanced'));
			add_settings_field('fieldsets',        __('Auto-Include Fieldsets', 'usp'),     array(&$this, 'callback_checkbox'),   $this->settings_advanced, 'section_advanced_1', array('id' => 'fieldsets',        'type' => 'advanced'));
			add_settings_field('form_demos',       __('Auto-Generate Form Demos', 'usp'),   array(&$this, 'callback_checkbox'),   $this->settings_advanced, 'section_advanced_1', array('id' => 'form_demos',       'type' => 'advanced'));
			add_settings_field('post_demos',       __('Auto-Generate Post Demos', 'usp'),   array(&$this, 'callback_checkbox'),   $this->settings_advanced, 'section_advanced_1', array('id' => 'post_demos',       'type' => 'advanced'));
			add_settings_field('submit_button',    __('Auto-Include Submit Button', 'usp'), array(&$this, 'callback_checkbox'),   $this->settings_advanced, 'section_advanced_1', array('id' => 'submit_button',    'type' => 'advanced'));
			add_settings_field('submit_text',      __('Text for Submit Button', 'usp'),     array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_1', array('id' => 'submit_text',      'type' => 'advanced'));
			add_settings_field('html_content',     __('Post Formatting', 'usp'),            array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_1', array('id' => 'html_content',     'type' => 'advanced'));
			add_settings_field('form_atts',        __('Custom Form Attributes', 'usp'),     array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_1', array('id' => 'form_atts',        'type' => 'advanced'));
			add_settings_field('redirect_success', __('Redirect URL for Success', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_1', array('id' => 'redirect_success', 'type' => 'advanced'));
			add_settings_field('redirect_failure', __('Redirect URL for Failure', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_1', array('id' => 'redirect_failure', 'type' => 'advanced'));
			add_settings_field('blacklist_terms',  __('Content Filter', 'usp'),             array(&$this, 'callback_textarea'),   $this->settings_advanced, 'section_advanced_1', array('id' => 'blacklist_terms',  'type' => 'advanced'));
			// 2
			add_settings_section('section_advanced_2', __('Custom Post Type', 'usp'), 'section_advanced_2_desc', $this->settings_advanced);
			add_settings_field('post_type',      __('Submitted Post Type', 'usp'),         array(&$this, 'callback_radio'),      $this->settings_advanced, 'section_advanced_2', array('id' => 'post_type',      'type' => 'advanced'));
			add_settings_field('post_type_slug', __('Slug for USP Post', 'usp'),           array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_2', array('id' => 'post_type_slug', 'type' => 'advanced'));
			add_settings_field('other_type',     __('Slug for Existing Post Type', 'usp'), array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_2', array('id' => 'other_type',     'type' => 'advanced'));
			add_settings_field('post_type_role', __('Roles for USP Posts', 'usp'),         array(&$this, 'callback_checkboxes'), $this->settings_advanced, 'section_advanced_2', array('id' => 'post_type_role', 'type' => 'advanced'));
			add_settings_field('form_type_role', __('Roles for USP Forms', 'usp'),         array(&$this, 'callback_checkboxes'), $this->settings_advanced, 'section_advanced_2', array('id' => 'form_type_role', 'type' => 'advanced'));
			// 3
			add_settings_section('section_advanced_3', __('Default Form Fields', 'usp'), 'section_advanced_3_desc', $this->settings_advanced);
			add_settings_field('default_title',   __('Default Post Title', 'usp'),   array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_3', array('id' => 'default_title',   'type' => 'advanced'));
			add_settings_field('default_content', __('Default Post Content', 'usp'), array(&$this, 'callback_textarea'),   $this->settings_advanced, 'section_advanced_3', array('id' => 'default_content', 'type' => 'advanced'));
			// 4
			add_settings_section('section_advanced_4', __('Before/After USP Forms', 'usp'), 'section_advanced_4_desc', $this->settings_advanced);
			add_settings_field('custom_before', __('Custom Before Forms', 'usp'), array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_4', array('id' => 'custom_before', 'type' => 'advanced'));
			add_settings_field('custom_after',  __('Custom After Forms', 'usp'),  array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_4', array('id' => 'custom_after',  'type' => 'advanced'));
			// 5
			add_settings_section('section_advanced_5', __('Success Message', 'usp'), 'section_advanced_5_desc', $this->settings_advanced);
			add_settings_field('success_reg',        __('Register User', 'usp'),                array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_reg',        'type' => 'advanced'));
			add_settings_field('success_post',       __('Submit Post', 'usp'),                  array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_post',       'type' => 'advanced'));
			add_settings_field('success_both',       __('Register and Submit', 'usp'),          array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_both',       'type' => 'advanced'));
			add_settings_field('success_contact',    __('Contact Form', 'usp'),                 array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_contact',    'type' => 'advanced'));
			add_settings_field('success_email_reg',  __('Contact Form and Register', 'usp'),    array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_email_reg',  'type' => 'advanced'));
			add_settings_field('success_email_post', __('Contact Form and Post', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_email_post', 'type' => 'advanced'));
			add_settings_field('success_email_both', __('Contact, Register, and Post', 'usp'),  array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_email_both', 'type' => 'advanced'));
			add_settings_field('success_before',     __('Custom Before Message', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_before',     'type' => 'advanced'));
			add_settings_field('success_after',      __('Custom After Message', 'usp'),         array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_after',      'type' => 'advanced'));
			add_settings_field('success_form',       __('Display Form on Success', 'usp'),      array(&$this, 'callback_checkbox'), $this->settings_advanced, 'section_advanced_5', array('id' => 'success_form',       'type' => 'advanced'));
			// 6
			add_settings_section('section_advanced_6', __('Error Message', 'usp'), 'section_advanced_6_desc', $this->settings_advanced);
			add_settings_field('error_before', __('Custom Before Errors', 'usp'), array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_6', array('id' => 'error_before', 'type' => 'advanced'));
			add_settings_field('error_after',  __('Custom After Errors', 'usp'),  array(&$this, 'callback_textarea'), $this->settings_advanced, 'section_advanced_6', array('id' => 'error_after',  'type' => 'advanced'));
			// 7
			add_settings_section('section_advanced_7', __('Primary Form Fields', 'usp'), 'section_advanced_7_desc', $this->settings_advanced);
			for ( $i = 1; $i < 19; $i++ ) {
				add_settings_field('usp_error_'. strval($i), __('Primary Field ', 'usp'). strval($i), array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_7', array('id' => 'usp_error_'. strval($i), 'type' => 'advanced'));
			}
			// 8
			add_settings_section('section_advanced_8', __('User-Registration Fields', 'usp'), 'section_advanced_8_desc', $this->settings_advanced);
			$user_fields = array('a' => __('Nicename', 'usp'), 'b' => __('Display Name', 'usp'), 'c' => __('Nickname', 'usp'), 'd' => __('First Name', 'usp'), 'e' => __('Last Name', 'usp'), 'f' => __('Description', 'usp'), 'g' => __('Password', 'usp'));
			foreach ($user_fields as $key => $value) {
				add_settings_field('usp_error_'. $key, $value, array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_8', array('id' => 'usp_error_'. $key, 'type' => 'advanced'));
			}
			// 9
			add_settings_section('section_advanced_9', __('Custom Fields', 'usp'), 'section_advanced_9_desc', $this->settings_advanced);
			add_settings_field('custom_fields', __('Custom Fields', 'usp'), array(&$this, 'callback_number'), $this->settings_advanced, 'section_advanced_9', array('id' => 'custom_fields', 'type' => 'advanced'));
			// 10
			add_settings_section('section_advanced_10', __('Custom Field Names', 'usp'), 'section_advanced_10_desc', $this->settings_advanced);
			if (isset($usp_advanced['custom_fields']) && is_numeric($usp_advanced['custom_fields'])) {
				$max = 1 + intval($usp_advanced['custom_fields']);
				if ($max > 0) {
					for ($i = 1; $i < $max; $i++) {
						add_settings_field('usp_label_c'. strval($i), __('Custom Field ', 'usp'). strval($i), array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_10', array('id' => 'usp_label_c'. strval($i), 'type' => 'advanced'));
					}
				}
			}
			// 11
			add_settings_section('section_advanced_11', __('Custom Field Prefix', 'usp'), 'section_advanced_11_desc', $this->settings_advanced);
			add_settings_field('custom_prefix', __('Custom Prefix', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_11', array('id' => 'custom_prefix', 'type' => 'advanced'));
			// 12
			add_settings_section('section_advanced_12', __('Custom Custom Fields', 'usp'), 'section_advanced_12_desc', $this->settings_advanced);
			add_settings_field('custom_optional', __('Optional Fields', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_12', array('id' => 'custom_optional', 'type' => 'advanced'));
			add_settings_field('custom_required', __('Required Fields', 'usp'),  array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_12', array('id' => 'custom_required', 'type' => 'advanced'));
			// 13
			add_settings_section('section_advanced_13', __('Custom Custom Field Names', 'usp'), 'section_advanced_13_desc', $this->settings_advanced);
			$custom_merged = usp_merge_custom_fields();
			if ($custom_merged) {
				foreach($custom_merged as $value) {
					$label_val = $value;
					if (strlen($value) > 24) $label_val = substr($value, 0, 25) .'&hellip;';
					add_settings_field('usp_custom_label_'. $value, 'Custom Field: '. __($label_val, 'usp'), array(&$this, 'callback_input_text'), $this->settings_advanced, 'section_advanced_13', array('id' => 'usp_custom_label_'. $value, 'type' => 'advanced'));
				}
			}
		}
		
		// MORE SETTINGS
		
		function register_more_settings() {
			global $usp_more;
			
			$this->settings_tabs[$this->settings_more] = __('More', 'usp');
			register_setting($this->settings_more, $this->settings_more, 'validate_more');
			add_settings_section('section_more_0', '', 'section_more_0_desc', $this->settings_more);
			
			// 1
			add_settings_section('section_more_1', __('Primary Field Errors', 'usp'), 'section_more_1_desc', $this->settings_more);
			add_settings_field('usp_error_1_desc',  __('Name', 'usp'),           array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_1_desc',  'type' => 'more'));
			add_settings_field('usp_error_2_desc',  __('URL', 'usp'),            array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_2_desc',  'type' => 'more'));
			add_settings_field('usp_error_3_desc',  __('Title', 'usp'),          array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_3_desc',  'type' => 'more'));
			add_settings_field('usp_error_4_desc',  __('Tags', 'usp'),           array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_4_desc',  'type' => 'more'));
			add_settings_field('usp_error_5_desc',  __('Captcha', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_5_desc',  'type' => 'more'));
			add_settings_field('usp_error_6_desc',  __('Category', 'usp'),       array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_6_desc',  'type' => 'more'));
			add_settings_field('usp_error_7_desc',  __('Content', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_7_desc',  'type' => 'more'));
			add_settings_field('usp_error_8_desc',  __('Files', 'usp'),          array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_8_desc',  'type' => 'more'));
			add_settings_field('usp_error_9_desc',  __('Email Address', 'usp'),  array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_9_desc',  'type' => 'more'));
			add_settings_field('usp_error_10_desc', __('Email Subject', 'usp'),  array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_10_desc', 'type' => 'more'));
			add_settings_field('usp_error_11_desc', __('Alt Text', 'usp'),       array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_11_desc', 'type' => 'more'));
			add_settings_field('usp_error_12_desc', __('Caption', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_12_desc', 'type' => 'more'));
			add_settings_field('usp_error_13_desc', __('Description', 'usp'),    array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_13_desc', 'type' => 'more'));
			add_settings_field('usp_error_14_desc', __('Taxonomy', 'usp'),       array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_14_desc', 'type' => 'more'));
			add_settings_field('usp_error_15_desc', __('Post Format', 'usp'),    array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_15_desc', 'type' => 'more'));
			add_settings_field('usp_error_16_desc', __('Media Title', 'usp'),    array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_16_desc', 'type' => 'more'));
			add_settings_field('usp_error_17_desc', __('File Name', 'usp'),      array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_17_desc', 'type' => 'more'));
			add_settings_field('usp_error_18_desc', __('Agree to Terms', 'usp'), array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_1', array('id' => 'usp_error_18_desc', 'type' => 'more'));
			// 2
			add_settings_section('section_more_2', __('Form Submission Errors', 'usp'), 'section_more_2_desc', $this->settings_more);
			add_settings_field('error_username', __('Username Error', 'usp'),          array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'error_username',   'type' => 'more'));
			add_settings_field('error_email',    __('User Email Error', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'error_email',      'type' => 'more'));
			add_settings_field('user_exists',    __('User Exists', 'usp'),             array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'user_exists',      'type' => 'more'));
			add_settings_field('error_register', __('Registration Disabled', 'usp'),   array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'error_register',   'type' => 'more'));
			add_settings_field('post_required',  __('Post Required', 'usp'),           array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'post_required',    'type' => 'more'));
			add_settings_field('post_duplicate', __('Duplicate Post', 'usp'),          array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'post_duplicate',   'type' => 'more'));
			add_settings_field('name_restrict',    __('Name Restriction', 'usp'),      array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'name_restrict',    'type' => 'more'));
			add_settings_field('spam_response',    __('Incorrect Captcha', 'usp'),     array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'spam_response',    'type' => 'more'));
			add_settings_field('content_min',      __('Content Minimum', 'usp'),       array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'content_min',      'type' => 'more'));
			add_settings_field('content_max',      __('Content Maximum', 'usp'),       array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'content_max',      'type' => 'more'));
			add_settings_field('email_restrict',   __('Address Restriction', 'usp'),   array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'email_restrict',   'type' => 'more'));
			add_settings_field('subject_restrict', __('Subject Restriction', 'usp'),   array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'subject_restrict', 'type' => 'more'));
			add_settings_field('form_allowed',     __('Incorrect Form Type', 'usp'),   array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'form_allowed',     'type' => 'more'));
			add_settings_field('content_filter',   __('Content Filter', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_2', array('id' => 'content_filter',   'type' => 'more'));
			// 3
			add_settings_section('section_more_3', __('File Submission Errors', 'usp'), 'section_more_3_desc', $this->settings_more);
			add_settings_field('files_required',  __('Files Required', 'usp'),        array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'files_required',  'type' => 'more'));
			add_settings_field('file_required',   __('File Required', 'usp'),         array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'file_required',   'type' => 'more'));
			add_settings_field('file_type_not',   __('File Type Not Allowed', 'usp'), array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'file_type_not',   'type' => 'more'));
			add_settings_field('file_dimensions', __('File Dimensions', 'usp'),       array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'file_dimensions', 'type' => 'more'));
			add_settings_field('file_max_size',   __('Maximum File Size', 'usp'),     array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'file_max_size',   'type' => 'more'));
			add_settings_field('file_min_size',   __('Minimum File Size', 'usp'),     array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'file_min_size',   'type' => 'more'));
			add_settings_field('file_name',       __('File Name Length', 'usp'),      array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'file_name',       'type' => 'more'));
			add_settings_field('min_req_files',   __('Min Number of Files', 'usp'),   array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'min_req_files',   'type' => 'more'));
			add_settings_field('max_req_files',   __('Max Number of Files', 'usp'),   array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'max_req_files',   'type' => 'more'));
			add_settings_field('file_square',     __('Require Square Images', 'usp'), array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_3', array('id' => 'file_square',     'type' => 'more'));
			// 4
			add_settings_section('section_more_4', __('User Registration Errors', 'usp'), 'section_more_4_desc', $this->settings_more);
			$user_fields = array('a' => __('Nicename', 'usp'), 'b' => __('Display Name', 'usp'), 'c' => __('Nickname', 'usp'), 'd' => __('First Name', 'usp'), 'e' => __('Last Name', 'usp'), 'f' => __('Description', 'usp'), 'g' => __('Password', 'usp'));
			foreach ($user_fields as $key => $value) {
				add_settings_field('usp_error_'.$key.'_desc', $value, array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_4', array('id' => 'usp_error_'.$key.'_desc', 'type' => 'more'));
			}
			// 5
			add_settings_section('section_more_5', __('Miscellaneous Errors', 'usp'), 'section_more_5_desc', $this->settings_more);
			add_settings_field('error_sep',           __('Error Separator', 'usp'),     array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_5', array('id' => 'error_sep',           'type' => 'more'));
			add_settings_field('tax_before',          __('Before Taxonomy', 'usp'),     array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_5', array('id' => 'tax_before',          'type' => 'more'));
			add_settings_field('tax_after',           __('After Taxonomy', 'usp'),      array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_5', array('id' => 'tax_after',           'type' => 'more'));
			add_settings_field('custom_field_before', __('Before Custom Field', 'usp'), array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_5', array('id' => 'custom_field_before', 'type' => 'more'));
			add_settings_field('custom_field_after',  __('After Custom Field', 'usp'),  array(&$this, 'callback_textarea'), $this->settings_more, 'section_more_5', array('id' => 'custom_field_after',  'type' => 'more'));
			
		}
		
		// TOOLS SETTINGS
		
		function register_tools_settings() {
			global $usp_tools;
			
			$this->settings_tabs[$this->settings_tools] = __('Tools', 'usp');
			register_setting($this->settings_tools, $this->settings_tools, 'validate_tools');
			add_settings_section('section_tools_0', '', 'section_tools_0_desc', $this->settings_tools);
			
			// 1
			add_settings_section('section_tools_1', __('Restore Default Settings', 'usp'), 'section_tools_1_desc', $this->settings_tools);
			add_settings_field('default_options',  __('Restore Default Settings', 'usp'), array(&$this, 'callback_checkbox'), $this->settings_tools, 'section_tools_1', array('id' => 'default_options', 'type' => 'tools'));
			
		}
		
		// ABOUT SETTINGS
		
		function register_about_settings() {
			$this->settings_tabs[$this->settings_about] = __('About', 'usp');
		}
		
		// LICENSE SETTINGS
		
		function register_license_settings() {
			$this->settings_tabs[$this->settings_license] = __('License', 'usp');
		}
		
		
		
		// CALLBACKS
		
		function callback_input_text($args) {
			global $usp_advanced;
			
			$id   = $args['id'];
			$type = $args['type'];
			
			$label = callback_input_text_label($id);
			
			if ($type == 'admin') {
				
				if ($id == 'cc_submit' || $id == 'contact_cc') {
					
					$cc_submit_emails = trim(esc_attr($this->admin_settings[$id]));
					$cc_submit_emails = explode(',', $cc_submit_emails);
					$cc_submit_list = '';
					
					foreach ($cc_submit_emails as $email) $cc_submit_list .= trim($email) . ', ';
					$value = rtrim(trim($cc_submit_list), ',');
					
				} else {
					
					$value = esc_attr($this->admin_settings[$id]);
				}
				
			} elseif ($type == 'advanced') {
				
				if     (preg_match("/^usp_label_c([0-9]+)$/i",            $id, $match)) $label = __('Name for Custom Field #', 'usp') . $match[1];
				elseif (preg_match("/^usp_custom_label_([0-9a-z_-]+)$/i", $id, $match)) $label = __('Name for Custom Field:', 'usp') .' <code>'. $match[1] .'</code>';
				
				if (isset($this->advanced_settings[$id])) $value = esc_attr($this->advanced_settings[$id]);
				else $value = '';
				
			} elseif ($type == 'general') {
				
				if ($id == 'use_cat_id') {
					
					$cat_ids = trim(esc_attr($this->general_settings[$id]));
					$cat_ids = explode(',', $cat_ids);
					$cat_id_list = '';
					
					foreach ($cat_ids as $cat_id) $cat_id_list .= trim($cat_id) . ', ';
					$value = rtrim(trim($cat_id_list), ',');
					
				} else {
					
					$value = esc_attr($this->general_settings[$id]);
				}
				
			} elseif ($type == 'uploads') {
				
				$value = esc_attr($this->uploads_settings[$id]);
				
			} elseif ($type == 'style') {
				
				$value = esc_attr($this->style_settings[$id]);
			}
			
			$width     = 'width:377px;';
			$break     = '<br />';
			$form_type = 'text';
			$form_min  = '';
			
			if ($id == 'use_cat_id' || $id == 'custom_status') {
				
				$width = 'width:77px;';
				$break = ' ';
			
			} elseif ($id == 'character_min' || $id == 'character_max' || $id == 'tags_number') {
				
				$width     = 'width:77px;';
				$break     = ' ';
				$form_type = 'number';
				$form_min  = ' min="-1"';
				
			}
			
			echo '<input name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" type="'. $form_type .'" value="'. $value .'" style="'. $width .'"'. $form_min .' />';
			echo $break .'<label for="usp_'. $type .'['. $id .']">'. $label .'</label>';
		}
		
		function callback_textarea($args) {
			
			$id   = $args['id'];
			$type = $args['type'];
			
			$label = callback_textarea_label($id);
			
			if ($type == 'admin') {
				echo '<textarea name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" rows="3" cols="70">'. esc_attr(stripslashes($this->admin_settings[$id])) .'</textarea>';
			
			} elseif ($type === 'advanced') {
				echo '<textarea name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" rows="3" cols="70">'. esc_attr(stripslashes($this->advanced_settings[$id])) .'</textarea>';
			
			} elseif ($type === 'general') {
				echo '<textarea name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" rows="3" cols="70">'. esc_attr(stripslashes($this->general_settings[$id])) .'</textarea>';
			
			} elseif ($type === 'style') {
				echo '<textarea name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" rows="17" cols="70" style="width:97%;">'. esc_attr(stripslashes($this->style_settings[$id])) .'</textarea>';
			
			} elseif ($type === 'more') {
				echo '<textarea name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" rows="3" cols="70">'. esc_attr(stripslashes($this->more_settings[$id])) .'</textarea>';
			}
			
			echo '<br /><label for="usp_'. $type .'['. $id .']">'. $label .'</label>';
		}
		
		function callback_select($args) {
			
			$id = $args['id'];
			
			$label = callback_select_label($id);
			
			if ($id == 'min_files' || $id == 'max_files') {
				echo '<select name="usp_uploads['. $id .']" id="usp_uploads['. $id .']">';
				echo '<option value="-1">'. __('No Limit', 'usp') .'</option>';
				foreach(range(0, 99) as $number) {
					echo '<option '. selected($number, $this->uploads_settings[$id], false) .' value="'. $number .'">'. $number .'</option>';
				}
				echo '</select> <label for="usp_uploads['. $id .']">'. $label .'</label>';
				
			} elseif ($id == 'display_size') {
				echo '<select name="usp_uploads['. $id .']" id="usp_uploads['. $id .']">';
				$display_sizes = display_size_options();
				foreach ($display_sizes as $value) {
					echo '<option '. selected($value['value'], $this->uploads_settings[$id], false) .' value="'. $value['value'] .'">'. $value['label'] .'</option>';
				}
				echo '</select> <label for="usp_uploads['. $id .']">'. $label .'</label>';
				
			} elseif ($id == 'mail_format') {
				echo '<select name="usp_admin['. $id .']" id="usp_admin['. $id .']">';
				$mail_format = mail_format();
				foreach ($mail_format as $value) {
					echo '<option '. selected($value['value'], $this->admin_settings[$id], false) .' value="'. $value['value'] .'">'. $value['label'] .'</option>';
				}
				echo '</select> <label for="usp_admin['. $id .']">'. $label .'</label>';
				
			} elseif ($id == 'recaptcha_version') {
				echo '<select name="usp_general['. $id .']" id="usp_general['. $id .']">';
				$recaptcha = recaptcha_options();
				foreach ($recaptcha as $value) {
					echo '<option '. selected($value['value'], $this->general_settings[$id], false) .' value="'. $value['value'] .'">'. $value['label'] .'</option>';
				}
				echo '</select> <label for="usp_general['. $id .']">'. $label .'</label>';
				
			}
			
		}
		
		function callback_checkboxes($args) {
			global $usp_general;
			
			$id = $args['id'];
			
			if ($id == 'tags') {
				
				if (isset($usp_general['tags_order'])) $tags_order = $usp_general['tags_order'];
				else $tags_order = 'name_asc';
				if ($tags_order == 'id_asc' || $tags_order == 'name_asc' || $tags_order == 'count_asc') $order = 'ASC';
				else $order = 'DESC';

				if     ($tags_order == 'id_asc' || $tags_order == 'id_desc') $order_by = 'id';
				elseif ($tags_order == 'name_asc' || $tags_order == 'name_desc') $order_by = 'name';
				elseif ($tags_order == 'count_asc' || $tags_order == 'count_desc') $order_by = 'count';
				else $order_by = 'name';
				
				if (isset($usp_general['tags_number'])) $number = $usp_general['tags_number'];
				else $number = '-1';
				if ($number == '-1' || $number == '0' || $number == 'all') $number = '';
				
				if (isset($usp_general['tags_empty'])) $empty = $usp_general['tags_empty'];
				else $empty = 0;

				$args = array(
					'orderby'    => $order_by,
					'order'      => $order,
					'number'     => $number,
					'hide_empty' => $empty, 
				); 
				$tags = get_terms('post_tag', $args);
				
				echo '<p><label>' . __('Select which tags may be assigned to submitted posts (see next two options). ', 'usp');
				echo '<a id="usp-toggle-tags" class="usp-toggle-tags" href="#usp-toggle-tags">'. __('Show/Hide Tags&nbsp;&raquo;', 'usp') .'</a></label></p>';
				echo '<div class="usp-tags default-hidden"><ul>';
				foreach ((array) $tags as $tag) {
					echo '<li><input type="checkbox" name="usp_general[tags][]" id="usp_general[tags][]" value="'. esc_attr($tag->term_id) .'" '. checked(true, in_array($tag->term_id, $this->general_settings['tags']), false) .' /> ';
					echo '<label for="usp_general[tags][]"><a href="'. get_tag_link($tag->term_id) .'" title="Tag ID: '. esc_attr($tag->term_id) .'" target="_blank">'. sanitize_text_field($tag->name) .'</a></label></li>';
				}
				echo '</ul></div>';
				
			} elseif ($id == 'categories') {
				
				$usp_cats = array();
				$cats = get_categories(array('parent' => 0, 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 0));
				if (!empty($cats)) {
					echo '<style type="text/css">ul.usp-cats ul { margin: 5px 0 5px 30px; } ul.usp-cats li { margin: 0; }</style>';
					echo '<p><label>'. __('Select which categories may be assigned to submitted posts. ', 'usp');
					echo '<a id="usp-toggle-cats" class="usp-toggle-cats" href="#usp-toggle-cats">'. __('Show/Hide Categories&nbsp;&raquo;', 'usp') .'</a></label></p>';
					echo '<div class="usp-cats default-hidden"><ul>';
					foreach ($cats as $c) {

						// parents
						echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c->term_id) .'" '. checked(true, in_array($c->term_id, $this->general_settings['categories']), false) .' /> ';
						echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c->term_id)) .'" title="Cat ID: '. esc_attr($c->term_id) .'" target="_blank">'. sanitize_text_field($c->name) .'</a></label></li>';
						$usp_cats['c'][] = array('id' => esc_attr($c->term_id), 'c1' => array());
						$children = get_terms('category', array('parent' => esc_attr($c->term_id), 'hide_empty' => 0));
						if (!empty($children)) {
							echo '<li><ul>';
							foreach ($children as $c1) {

								// children
								$usp_cats['c'][]['c1'][] = array('id' => esc_attr($c1->term_id), 'c2' => array());
								$grandchildren = get_terms('category', array('parent' => esc_attr($c1->term_id), 'hide_empty' => 0));
								if (!empty($grandchildren)) {
									echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c1->term_id) .'" '. checked(true, in_array($c1->term_id, $this->general_settings['categories']), false) .' /> ';
									echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c1->term_id)) .'" title="Cat ID: '. esc_attr($c1->term_id) .'" target="_blank">'. sanitize_text_field($c1->name) .'</a></label>';
									echo '<ul>';
									foreach ($grandchildren as $c2) {

										// grandchildren
										$usp_cats['c'][]['c1'][]['c2'][] = array('id' => esc_attr($c2->term_id), 'c3' => array());
										$great_grandchildren = get_terms('category', array('parent' => esc_attr($c2->term_id), 'hide_empty' => 0));
										if (!empty($great_grandchildren)) {
											echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c2->term_id) .'" '. checked(true, in_array($c2->term_id, $this->general_settings['categories']), false) .' /> ';
											echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c2->term_id)) .'" title="Cat ID: '. esc_attr($c2->term_id) .'" target="_blank">'. sanitize_text_field($c2->name) .'</a></label>';
											echo '<ul>';
											foreach ($great_grandchildren as $c3) {
												
												// great enkelkinder
												$usp_cats['c'][]['c1'][]['c2'][]['c3'][] = array('id' => esc_attr($c3->term_id), 'c4' => array());
												$great_great_grandchildren = get_terms('category', array('parent' => esc_attr($c3->term_id), 'hide_empty' => 0));
												if (!empty($great_great_grandchildren)) {
													echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c3->term_id) .'" '. checked(true, in_array($c3->term_id, $this->general_settings['categories']), false) .' /> ';
													echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c3->term_id)) .'" title="Cat ID: '. esc_attr($c3->term_id) .'" target="_blank">'. sanitize_text_field($c3->name) .'</a></label>';
													echo '<ul>';
													foreach ($great_great_grandchildren as $c4) {
														
														// great great grandchildren
														$usp_cats['c'][]['c1'][]['c2'][]['c3'][]['c4'][] = array('id' => esc_attr($c4->term_id));
														echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c4->term_id) .'" '. checked(true, in_array($c4->term_id, $this->general_settings['categories']), false) .' /> ';
														echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c4->term_id)) .'" title="Cat ID: '. esc_attr($c4->term_id) .'" target="_blank">'. sanitize_text_field($c4->name) .'</a></label></li>';
													}
													echo '</ul></li>'; // great great grandchildren
												} else {
													echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c3->term_id) .'" '. checked(true, in_array($c3->term_id, $this->general_settings['categories']), false) .' /> ';
													echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c3->term_id)) .'" title="Cat ID: '. esc_attr($c3->term_id) .'" target="_blank">'. sanitize_text_field($c3->name) .'</a></label></li>';
												}
											}
											echo '</ul></li>'; // great grandchildren
										} else {
											echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c2->term_id) .'" '. checked(true, in_array($c2->term_id, $this->general_settings['categories']), false) .' /> ';
											echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c2->term_id)) .'" title="Cat ID: '. esc_attr($c2->term_id) .'" target="_blank">'. sanitize_text_field($c2->name) .'</a></label></li>';
										}
									}
									echo '</ul></li>'; // grandchildren
								} else {
									echo '<li><input type="checkbox" name="usp_general[categories][]" id="usp_general[categories][]" value="'. esc_attr($c1->term_id) .'" '. checked(true, in_array($c1->term_id, $this->general_settings['categories']), false) .' /> ';
									echo '<label for="usp_general[categories][]"><a href="'. esc_url(get_category_link($c1->term_id)) .'" title="Cat ID: '. esc_attr($c1->term_id) .'" target="_blank">'. sanitize_text_field($c1->name) .'</a></label></li>';
								}
							}
							echo '</ul></li>'; // children
						}
					}
					echo '</ul></div>'; // parents
				}
				
			} elseif ($id == 'post_type_role') {
				
				$roles = array('administrator', 'editor', 'author', 'contributor');
				echo '<p><label>' . __('Which user roles should have access to USP Posts (when applicable): ', 'usp') . '</label></p>';
				echo '<ul>';
				foreach ($roles as $role) {
					echo '<li><input type="checkbox" name="usp_advanced[post_type_role][]" id="usp_advanced[post_type_role][]" value="'. $role .'" '. checked(true, in_array($role, $this->advanced_settings['post_type_role']), false) .' /> ';
					echo '<label for="usp_advanced[post_type_role][]">'. ucfirst(sanitize_text_field($role)) .'</label></li>';
				}
				echo '</ul>';
				
			} elseif ($id == 'form_type_role') {
				
				$roles = array('administrator', 'editor', 'author', 'contributor');
				echo '<p><label>' . __('Which user roles should have access to USP Forms: ', 'usp') . '</label></p>';
				echo '<ul>';
				foreach ($roles as $role) {
					echo '<li><input type="checkbox" name="usp_advanced[form_type_role][]" id="usp_advanced[form_type_role][]" value="'. $role .'" '. checked(true, in_array($role, $this->advanced_settings['form_type_role']), false) .' /> ';
					echo '<label for="usp_advanced[form_type_role][]">'. ucfirst(sanitize_text_field($role)) .'</label></li>';
				}
				echo '</ul>';
				
			}
		}
		
		function callback_checkbox($args) {
			
			$id   = $args['id'];
			$type = $args['type'];
			
			$label = callback_checkbox_label($id);
			
			if     ($type == 'admin')    $checked = checked($this->admin_settings[$id],    1, false);
			elseif ($type == 'style')    $checked = checked($this->style_settings[$id],    1, false);
			elseif ($type == 'advanced') $checked = checked($this->advanced_settings[$id], 1, false);
			elseif ($type == 'general')  $checked = checked($this->general_settings[$id],  1, false);
			elseif ($type == 'uploads')  $checked = checked($this->uploads_settings[$id],  1, false);
			elseif ($type == 'more')     $checked = checked($this->more_settings[$id],     1, false);
			elseif ($type == 'tools')    $checked = checked($this->tools_settings[$id],    1, false);
			
			echo '<input name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" type="checkbox" value="1" '. $checked .' /> <label for="usp_'. $type .'['. $id .']">'. $label .'</label>';
		}
		
		function callback_number($args) {
			
			$id   = $args['id'];
			$type = $args['type'];
			
			$label = callback_number_label($id);
			
			$value = $this->advanced_settings[$id];
			
			echo '<input name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']" type="number" step="1" min="0" max="999" maxlength="3" value="'. $value .'" /> <label for="usp_'. $type .'['. $id .']">'. $label .'</label>';
		}
		
		function callback_dropdown($args) {
			global $wpdb, $wp_roles;
			
			$id   = $args['id'];
			$type = $args['type'];
			
			$label = callback_dropdown_label($id);
			
			echo '<select name="usp_'. $type .'['. $id .']" id="usp_'. $type .'['. $id .']">';
			
			if ($id == 'assign_author') {
				
				$args_authors = apply_filters('usp_settings_author_list_args', array());
				$list_authors = get_users($args_authors);
				
				foreach ($list_authors as $author) {
					echo '<option '. selected($this->general_settings[$id], $author->ID, false) .' value="'. esc_attr($author->ID) .'">'. esc_attr($author->display_name) .'</option>';		
				}
				
				echo '</select> <label for="usp_'. $type .'['. $id .']">'. $label .'</label>';
				
			} elseif ($id == 'assign_role') { 
				
				$roles = $wp_roles->roles;
				
				foreach ($roles as $key => $value) {
					echo '<option '. selected($this->general_settings[$id], strtolower($key), false) .' value="'. strtolower($key) .'">'. $value['name'] .'</option>';		
				}
				
				echo '</select> <label for="usp_'. $type .'['. $id .']">'. $label .'</label>';
				
			} elseif ($id == 'number_approved') {
				
				echo '<option '. selected(-6, $this->general_settings[$id], false) .' value="-6">'. __('Future (Scheduled Post)', 'usp') . '</option>';
				echo '<option '. selected(-5, $this->general_settings[$id], false) .' value="-5">'. __('Always publish (via Password)', 'usp') . '</option>';
				echo '<option '. selected(-4, $this->general_settings[$id], false) .' value="-4">'. __('Always publish (via Private)', 'usp') . '</option>';
				echo '<option '. selected(-3, $this->general_settings[$id], false) .' value="-3">'. __('Always moderate (via Custom Status, defined below)', 'usp') . '</option>';
				echo '<option '. selected(-2, $this->general_settings[$id], false) .' value="-2">'. __('Always moderate (via Pending)', 'usp') . '</option>';
				echo '<option '. selected(-1, $this->general_settings[$id], false) .' value="-1">'. __('Always moderate (via Draft)', 'usp') . '</option>';
				echo '<option '. selected( 0, $this->general_settings[$id], false) .' value="0">'.  __('Always publish immediately', 'usp') .'</option>';
				
				foreach(range(1, 20) as $value) {
					echo '<option '. selected($value, $this->general_settings[$id], false) .' value="'. $value .'">'. $value .'</option>';
				}
				
				echo '</select><br /><label for="usp_'. $type .'['. $id .']">'. $label .'</label>';
			}
		}
		
		function callback_radio($args) {
			global $usp_admin, $usp_advanced, $usp_general, $usp_uploads;
			
			$id   = $args['id'];
			$type = $args['type'];
			
			$label = callback_radio_label($id);
			
			if ($id == 'send_mail') {
				$radio_options = send_mail_options();
				if (isset($usp_admin['send_mail'])) $default = $usp_admin['send_mail'];
				else $default = $this->admin_settings[$id];
				
			} elseif ($id == 'post_type') {
				$radio_options = post_type_options();
				if (isset($usp_advanced['post_type'])) $default = $usp_advanced['post_type'];
				else $default = $this->advanced_settings[$id];
				
			} elseif ($id == 'cats_menu') {
				$radio_options = cats_menu_options();
				if (isset($usp_general['cats_menu'])) $default = $usp_general['cats_menu'];
				else $default = $this->general_settings[$id];
				
			} elseif ($id == 'tags_order') {
				$radio_options = tags_order_options();
				if (isset($usp_general['tags_order'])) $default = $usp_general['tags_order'];
				else $default = $this->general_settings[$id];
				
			} elseif ($id == 'tags_menu') {
				$radio_options = tags_menu_options();
				if (isset($usp_general['tags_menu'])) $default = $usp_general['tags_menu'];
				else $default = $this->general_settings[$id];
				
			} elseif ($id == 'form_style') {
				$radio_options = style_options();
				if (isset($usp_style['form_style'])) $default = $usp_style['form_style'];
				else $default = $this->style_settings[$id];
				
			} elseif ($id == 'post_images') {
				$radio_options = display_images_options();
				if (isset($usp_uploads['post_images'])) $default = $usp_uploads['post_images'];
				else $default = $this->uploads_settings[$id];
			}
			
			echo '<p><label for="usp_' . $type . '['. $id .']">' . $label . '</label></p>';
			if (!isset($checked)) $checked = '';
			echo '<ul>';
			foreach ($radio_options as $radio_option) {
				if ($default) {
					$radio_setting = $default;
				} else {
					if ($type == 'admin') {
						$radio_setting = $this->admin_settings[$id];
					} elseif ($type == 'advanced') {
						$radio_setting = $this->advanced_settings[$id];
					} elseif ($type == 'general') {
						$radio_setting = $this->general_settings[$id];
					} elseif ($type == 'style') {
						$radio_setting = $this->style_settings[$id];
					} elseif ($type == 'uploads') {
						$radio_setting = $this->uploads_settings[$id];
					}
				}
				if ($radio_setting == $radio_option['value']) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}
				echo '<li><input type="radio" name="usp_' . $type .'['. $id .']" id="usp_' . $type .'['. $id .']" value="'. esc_attr($radio_option['value']) .'"'. $checked .' /> '. $radio_option['label'] .'</li>';
			}
			echo '<ul>';
		}
		
		
		
		// SETTINGS PAGE
		
		function plugin_link_settings($links, $file) {
			if ($file == USP_FILE) {
				$usp_links = '<a href="'. get_admin_url() .'options-general.php?page='. $this->settings_page .'">'. __('Settings', 'usp') .'</a>';
				array_unshift($links, $usp_links);
			}
			return $links;
		}
		
		function add_plugin_links($links, $file) {
			if ($file == plugin_basename(__FILE__)) {
				$links[]  = '<a target="_blank" href="https://plugin-planet.com/usp-pro-quick-start/" title="USP Pro Quick Start Guide">Getting started</a>';
			}
			return $links;
		}
		
		function add_admin_menus() {
			add_options_page('USP Pro', 'USP Pro', 'manage_options', $this->settings_page, array(&$this, 'plugin_options_page'));
		}
		
		function plugin_options_tabs() {
			$current_tab = isset($_GET['tab']) ? $_GET['tab'] : $this->settings_general;
			
			foreach ($this->settings_tabs as $tab_key => $tab_caption) {
				$active = ($current_tab == $tab_key) ? 'nav-tab-active' : '';
				echo '<a class="nav-tab '. $active .'" href="?page='. $this->settings_page .'&tab=' . $tab_key .'">'. $tab_caption .'</a>';	
			}
		}
		
		function enqueue_admin_scripts($hook) {
			global $post_type;
			if ('usp_form' === $post_type) {
				wp_enqueue_script('usp_quicktags', WP_PLUGIN_URL .'/'. basename(dirname(__FILE__)) .'/js/usp-quicktags.js', array('jquery'), USP_VERSION, false);
			}
		}
		
		function add_admin_styles() {
			global $usp_advanced, $pagenow, $current_screen, $post_type;
			
			if (!is_admin()) return;
			
			if (
				($current_screen->post_type === 'post') || 
				($current_screen->post_type === 'page') || 
				($current_screen->post_type === 'usp_post') || 
				(isset($usp_advanced['post_type']) && $usp_advanced['post_type'] === $current_screen->post_type) || 
				(isset($_GET['page']) && $_GET['page'] === 'usp-pro-license') || 
				(isset($_GET['page']) && $_GET['page'] === 'usp_options')
				
			) {
				wp_enqueue_style('usp_style_admin', WP_PLUGIN_URL .'/'. basename(dirname(__FILE__)) .'/css/usp-admin.css', false, USP_VERSION, 'all');
			}
			
			if ('usp_form' === $post_type) {
				wp_enqueue_style('usp_quicktags', WP_PLUGIN_URL .'/'. basename(dirname(__FILE__)) .'/css/usp-quicktags.css', false, USP_VERSION, 'all');
			}
		}
		
		function plugin_options_page() {
			$tab = isset($_GET['tab']) ? $_GET['tab'] : $this->settings_general; 
			$status = get_option('usp_license_status'); ?>
			
			<div class="wrap">
				
				<h1 class="usp-title"><?php _e('USP Pro', 'usp'); ?> <span><?php echo USP_VERSION; ?></span></h1>
				
				<?php if (isset($_GET['settings_restored']) && $_GET['settings_restored'] == 'true') 
						echo '<div class="updated notice is-dismissible"><p><strong>'. __('Your settings have been restored.', 'usp') .'</strong></p></div>'; ?>
				
				<h2 class="nav-tab-wrapper"><?php $this->plugin_options_tabs(); ?></h2>
				
				<?php if ($tab !== 'usp_about' && $tab !== 'usp_license') : ?>
					
					<form method="post" action="options.php">
						
						<?php if ($status === 'valid' || USP_CODE) : ?>
						
							<?php wp_nonce_field('update-options'); ?>
							<?php settings_fields($tab); ?>
							<?php do_settings_sections($tab); ?>
							<?php submit_button(); ?>
							
						<?php else : ?>
							
							<h3><?php _e('Welcome to USP Pro!', 'usp'); ?></h3>
							<p class="intro">
								<?php _e('Thank you for installing USP Pro. To begin using the plugin,', 'usp'); ?> 
								<a href="<?php get_admin_url(); ?>plugins.php?page=usp-pro-license"><?php _e('enter your license key &raquo;', 'usp'); ?></a>
							</p>
							
						<?php endif; ?>
						
					</form>
					
					<?php if ($tab == 'usp_tools') : ?>
						
						<?php echo '<div class="usp-pro-tools">'. usp_tools_display() .'</div>'; ?>
						
					<?php endif; ?>
					
				<?php else : ?>
					
					<?php if ($tab == 'usp_about')   section_about_desc(); ?>
					<?php if ($tab == 'usp_license') section_license_desc(); ?>
					
				<?php endif; ?>
				
			</div>
			
			<script type="text/javascript">
				jQuery(document).ready(function($){
					
					$('.default-hidden').hide();
					
					<?php if ($tab === 'usp_general') : ?>
					
					$('.usp-toggle-cats').click(function(e){ e.preventDefault(); $('.usp-cats').slideToggle(300); });
					$('.usp-toggle-tags').click(function(e){ e.preventDefault(); $('.usp-tags').slideToggle(300); });
					
					<?php elseif ($tab === 'usp_tools' || $tab === 'usp_about') : ?>
					
					$('.usp-toggle-s1').click(function(e){ e.preventDefault(); $('.usp-s1').slideToggle(300); });
					$('.usp-toggle-s2').click(function(e){ e.preventDefault(); $('.usp-s2').slideToggle(300); });
					$('.usp-toggle-s3').click(function(e){ e.preventDefault(); $('.usp-s3').slideToggle(300); });
					$('.usp-toggle-s4').click(function(e){ e.preventDefault(); $('.usp-s4').slideToggle(300); });
					$('.usp-toggle-s5').click(function(e){ e.preventDefault(); $('.usp-s5').slideToggle(300); });
					$('.usp-toggle-s6').click(function(e){ e.preventDefault(); $('.usp-s6').slideToggle(300); });
					
					<?php elseif ($tab === 'usp_admin') : ?>
					
					$('.usp-toggle-regex-1').click(function(e){ e.preventDefault(); $('.usp-regex-1').slideToggle(300); });
					$('.usp-toggle-regex-2').click(function(e){ e.preventDefault(); $('.usp-regex-2').slideToggle(300); });
					$('.usp-toggle-regex-3').click(function(e){ e.preventDefault(); $('.usp-regex-3').slideToggle(300); });
					
					<?php elseif ($tab === 'usp_advanced') : ?>
					
					$('.usp-toggle-a1').click(function(e){ e.preventDefault(); $('.usp-a1').slideToggle(300); });
					$('.usp-toggle-a2').click(function(e){ e.preventDefault(); $('.usp-a2').slideToggle(300); });
					$('.usp-toggle-a3').click(function(e){ e.preventDefault(); $('.usp-a3').slideToggle(300); });
					$('.usp-toggle-a4').click(function(e){ e.preventDefault(); $('.usp-a4').slideToggle(300); });
					$('.usp-toggle-a5').click(function(e){ e.preventDefault(); $('.usp-a5').slideToggle(300); });
					
					<?php endif; ?>
					
				});
			</script>
			
	<?php }
	}
}

if (class_exists('USP_Pro')) {
	function usp_pro_init() { 
		$USP_Pro = new USP_Pro;
	}
	add_action('init', 'usp_pro_init', 0); 
	register_activation_hook  (__FILE__, array('USP_Pro', 'activate'));
	register_deactivation_hook(__FILE__, array('USP_Pro', 'deactivate'));
	//
	$usp_admin    = get_option('usp_admin',    USP_Pro::admin_defaults());
	$usp_advanced = get_option('usp_advanced', USP_Pro::advanced_defaults());
	$usp_general  = get_option('usp_general',  USP_Pro::general_defaults());
	$usp_style    = get_option('usp_style',    USP_Pro::style_defaults());
	$usp_uploads  = get_option('usp_uploads',  USP_Pro::uploads_defaults());
	$usp_more     = get_option('usp_more',     USP_Pro::more_defaults());
	$usp_tools    = get_option('usp_tools',    USP_Pro::tools_defaults());
	//
	function usp_pro_delete_plugin_options() {
		include_once('uninstall.php');
	}
	if ($usp_tools['default_options'] == 1) {
		register_deactivation_hook(__FILE__, 'usp_pro_delete_plugin_options');
	}
	//
	if (!function_exists('exif_imagetype')) {
		function exif_imagetype($filename) {
			if ((list($width, $height, $type, $attr) = getimagesize($filename)) !== false) { 
				return $type;
			} 
			return false; 
		} 
	}
	if (!function_exists('usp_is_session_started')) {
		function usp_is_session_started() {
			if (php_sapi_name() !== 'cli') {
				if (version_compare(phpversion(), '5.4.0', '>=')) {
					return session_status() === PHP_SESSION_NONE ? false : true;
				} else {
					return session_id() === '' ? false : true;
				}
			}
			return false;
		}
	}

}


