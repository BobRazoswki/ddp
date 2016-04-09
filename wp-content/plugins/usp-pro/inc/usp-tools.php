<?php // USP Pro - Tools (Settings Tab)

if (!defined('ABSPATH')) die();

/*
	Tools - Reset Default Settings
*/
if (!function_exists('usp_tools_reset')) : 
function usp_tools_reset() {
	
	$tools_reset  = '<p>'. __('To restore USP Pro default settings:', 'usp') .'</p>'; 
	$tools_reset .= '<ol>';
	$tools_reset .= '<li>'. __('Check the box below and click &ldquo;Save Changes&rdquo;.', 'usp') .'</li>';
	$tools_reset .= '<li><a href="'. get_admin_url() .'options-general.php?page=usp_options&tab=usp_license">'. __('Deactivate your USP License', 'usp') .'</a> '. __('(make a note of your License Key before deactivation; you will need it to reactivate the plugin).', 'usp') .'</li>';
	$tools_reset .= '<li>'. __('Deactivate and then reactivate the plugin to make it so.', 'usp') .'</li>';
	$tools_reset .= '</ol>';
	$tools_reset .= '<p><strong>'. __('Note: ', 'usp') .'</strong> '. __('restoring default settings does not affect any submitted post data or existing USP Forms.', 'usp') .'</p>';
	
	return $tools_reset;
}
endif;

/*
	Tools - Display Resources
*/
if (!function_exists('usp_tools_display')) : 
function usp_tools_display() {
	
	$tools_display  = '<div class="usp-pro-tools-display">';
	
	$tools_display .= '<h3><a id="usp-toggle-s1" class="usp-toggle-s1" href="#usp-toggle-s1" title="'. __('Show/Hide Backup &amp; Restore', 'usp') .'">'. __('Backup &amp; Restore', 'usp') .'</a></h3>';
	$tools_display .= '<div class="usp-s1 usp-toggle default-hidden">'. usp_display_import_export() .'</div>';
	
	$tools_display .= '<h3><a id="usp-toggle-s2" class="usp-toggle-s2" href="#usp-toggle-s2" title="'. __('Show/Hide USP Shortcodes', 'usp') .'">'. __('USP Shortcodes', 'usp') .'</a></h3>';
	$tools_display .= '<div class="usp-s2 usp-toggle default-hidden">'. usp_tools_shortcodes() .'</div>';
	
	$tools_display .= '<h3><a id="usp-toggle-s3" class="usp-toggle-s3" href="#usp-toggle-s3" title="'. __('Show/Hide USP Template Tags', 'usp') .'">'. __('USP Template Tags', 'usp') .'</a></h3>';
	$tools_display .= '<div class="usp-s3 usp-toggle default-hidden">'. usp_tools_tags() .'</div>';
	
	$tools_display .= '<h3><a id="usp-toggle-s4" class="usp-toggle-s4" href="#usp-toggle-s4" title="'. __('Show/Hide Helpful Resources', 'usp') .'">'. __('Helpful Resources', 'usp') .'</a></h3>';
	$tools_display .= '<div class="usp-s4 usp-toggle default-hidden">'. usp_tools_resources() .'</div>';
	
	$tools_display .= '<h3><a id="usp-toggle-s5" class="usp-toggle-s5" href="#usp-toggle-s5" title="'. __('Show/Hide Tips &amp; Tricks', 'usp') .'">'. __('Tips &amp; Tricks', 'usp') .'</a></h3>';
	$tools_display .= '<div class="usp-s5 usp-toggle default-hidden">'. usp_tools_tips() .'</div>';
	
	$tools_display .= '</div>';
	
	return $tools_display;
}
endif;

/*
	Tools - Shortcodes
*/
if (!function_exists('usp_tools_shortcodes')) : 
function usp_tools_shortcodes() {
	
	$tools_shortcodes = '<p class="toggle-intro">' . __('USP Pro provides shortcodes that make it easy to display forms and submitted content virtually anywhere. ', 'usp');
	$tools_shortcodes .= __('To get started,', 'usp') . ' <a href="http://codex.wordpress.org/Shortcode_API" target="_blank">' . __('learn how to use Shortcodes', 'usp') . '</a> ';
	$tools_shortcodes .= __('and then include USP Shortcodes as needed in your Posts and Pages.', 'usp') .'</p>';
	$tools_shortcodes .= '<p><a href="https://plugin-planet.com/usp-pro-shortcodes/" target="_blank">'. __('Check out the complete list of USP Shortcodes &raquo;', 'usp') .'</a></p>';
	$tools_shortcodes .= '<p>' . __('In addition to those provided by USP Pro, there are numerous', 'usp') . ' <a href="http://codex.wordpress.org/Shortcode" target="_blank">' . __('default WP shortcodes', 'usp') . '</a>, ';
	$tools_shortcodes .= __('as well as any shortcodes that may be included with your theme and/or plugin(s). Also, FYI, more information about shortcodes may be found in the USP source code (as inline comments), ', 'usp');
	$tools_shortcodes .= __('specifically see', 'usp') . ' <code>/inc/usp-functions.php</code>.</p>';
	return $tools_shortcodes;	
}
endif;

/*
	Tools - Template Tags
*/
if (!function_exists('usp_tools_tags')) : 
function usp_tools_tags() {
	
	$tools_tags = '<p class="toggle-intro">' . __('USP Pro provides template tags for displaying submitted post content, author information, file uploads and more. ', 'usp');
	$tools_tags .= __('To get started,', 'usp') . ' <a href="http://codex.wordpress.org/Template_Tags" target="_blank">' . __('learn how to use Template Tags', 'usp') . '</a> ';
	$tools_tags .= __('and then include USP Template Tags as needed in your theme template.', 'usp') . '</p>';
	$tools_tags .= '<p><a href="https://plugin-planet.com/usp-pro-template-tags/" target="_blank">'. __('Check out the complete list of USP Template Tags &raquo;', 'usp') .'</a></p>';
	$tools_tags .= '<p>' . __('In addition to those provided by USP Pro, there are a great many template tags provided by WordPress, making it possible to display just about any information anywhere on your site. ', 'usp');
	$tools_tags .= __('Also, FYI, more information about each of these template tags may be found in the USP source code (as inline comments), specifically see', 'usp') . ' <code>/inc/usp-functions.php</code>.</p>';
	
	return $tools_tags;
}
endif;

/*
	Tools - Helpful Resources
*/
if (!function_exists('usp_tools_resources')) : 
function usp_tools_resources() {
	
	$tools_resources  = '<p class="toggle-intro">'. __('Here are some useful resources for working with USP Pro and WordPress.', 'usp') .'</p>';
	
	$tools_resources .= '<h3>'. __('Useful resources and places to get help', 'usp') .'</h3>';
	$tools_resources .= '<ul>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/docs/usp/">'.                         __('USP Pro Docs', 'usp')                                 .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/tuts/">'.                             __('USP Pro Tutorials', 'usp')                            .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/forum/usp/">'.                        __('USP Pro Forum', 'usp')                                .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/news/">'.                             __('USP Pro News', 'usp')                                 .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/usp-pro/#contact">'.                  __('Bug reports, help requests, and feedback', 'usp')     .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/wp/wp-login.php">'.                   __('Log in to your account for current downloads', 'usp') .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://digwp.com/2011/09/where-to-get-help-with-wordpress/">'. __('Where to Get Help with WordPress', 'usp')             .'</a></li>';
	$tools_resources .= '</ul>';
	
	$tools_resources .= '<h3>'. __('Key resources at the WordPress Codex', 'usp') .'</h3>';
	$tools_resources .= '<ul>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/Templates">'.         __('WP Theme Templates', 'usp')       .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/WordPress_Widgets">'. __('WP Widgets', 'usp')               .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/Shortcode_API">'.     __('WP Shortcodes', 'usp')            .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/Template_Tags">'.     __('WP Template Tags', 'usp')         .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/Quicktags_API">'.     __('WP Quicktags', 'usp')             .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/Post_Types">'.        __('WP Custom Post Types', 'usp')     .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/The_Loop">'.          __('The WordPress Loop', 'usp')       .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://codex.wordpress.org/Troubleshooting">'.   __('WP Troubleshooting Guide', 'usp') .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="http://www.wordpress.org/support/">'.            __('WP Help Forum', 'usp')            .'</a></li>';
	$tools_resources .= '</ul>';
	
	$tools_resources .= '<h3>'. __('More WordPress plugins by Jeff Starr', 'usp') .'</h3>';
	$tools_resources .= '<ul>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/bbq-pro/">'. __('BBQ Pro - Advanced WordPress Firewall', 'usp') .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://plugin-planet.com/ses-pro/">'. __('SES Pro - Simple Ajax Signup Forms', 'usp') .'</a></li>';
	$tools_resources .= '</ul>';
	
	$tools_resources .= '<h3>'. __('WordPress books and resources by Jeff Starr', 'usp') .'</h3>';
	$tools_resources .= '<ul>';
	$tools_resources .= '<li><a target="_blank" href="https://digwp.com/">'.                        __('Digging Into WordPress, by Chris Coyier and Jeff Starr', 'usp')                      .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://wp-tao.com/">'.                       __('The Tao of WordPress &ndash; Complete guide for users, admins, and everyone', 'usp') .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://wp-tao.com/wordpress-themes-book/">'. __('WordPress Themes In Depth &ndash; Complete guide to building awesome themes', 'usp') .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://htaccessbook.com/">'.                 __('.htaccess made easy &ndash; Configure, optimize, and secure your site', 'usp')       .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://perishablepress.com/">'.              __('Perishable Press &ndash; WordPress, Web Design, Code &amp; Tutorials', 'usp')        .'</a></li>';
	$tools_resources .= '<li><a target="_blank" href="https://wp-mix.com/">'.                       __('WP-Mix &ndash; Useful code snippets for WordPress and more', 'usp')                  .'</a></li>';
	$tools_resources .= '</ul>';
	
	return $tools_resources;	
}
endif;

/*
	Tools - Tips & Tricks
*/
if (!function_exists('usp_tools_tips')) : 
function usp_tools_tips() {
	
	$tools_tips = '<p class="toggle-intro">' . __('Here is a growing collection of useful notes, tips &amp; tricks for working with USP Pro.', 'usp') . '</p>';
	$tools_tips .= '<dl>';
	$tools_tips .= '<dt>' . __('Post Type Bug Fix', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('As explained in the ', 'usp') . '<a href="http://codex.wordpress.org/Taxonomies#404_Error" target="_blank">WP Codex</a>' . __(', an extra step is required to get WordPress to recognize theme templates for custom post types ', 'usp');
	$tools_tips .= __('(e.g., &ldquo;single-post_type.php&rdquo; and &ldquo;archive-post_type.php&rdquo;). So if/when you get a 404 &ldquo;Not Found&rdquo; error when trying to view a custom post type ', 'usp');
	$tools_tips .= __('(e.g., at &ldquo;/usp_post/example/&rdquo;), try the well-known fix, which is to simply', 'usp') . ' <a href="' . get_admin_url() . 'options-permalink.php" target="_blank">' . __('visit the WP Permalinks Settings', 'usp') . '</a>. ';
	$tools_tips .= __('After doing that, things should be working normally again. If not, try clicking the &ldquo;Save Changes&rdquo; button on the Permalink Settings page, which is another reported solution. ', 'usp') . '</dd>';
	
	$tools_tips .= '<dt>' . __('Template Tags Best Practice', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('When including template tags provided by a plugin or theme, it&rsquo;s good practice to precede the tag with a conditional check to make sure that the function exists. For example: ', 'usp');
	$tools_tips .= __('Instead of writing this:', 'usp') . ' <code>echo usp_get_images();</code>, ' . __('we can write this:', 'usp') . ' <code>if (function_exists(&quot;usp_get_images&quot;)) echo usp_get_images();</code>. ';
	$tools_tips .= __('The first method works fine, but PHP will throw an error if the plugin is not installed or otherwise available. So to avoid the site-breaking error, the second method is preferred.', 'usp') . '</dd>';
	
	$tools_tips .= '<dt>' . __('Force Forms to Clear Contents', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('If you are savvy with CSS, it is trivial to style forms however and get them to clear preceding/parent elements. If you&rsquo;re new to the game and just want a sure-fire way to get form fields to line up ', 'usp');
	$tools_tips .= __('and look right, here is a well-known snippet of HTML/CSS that you can add to any form:', 'usp') . ' <code>&lt;div style="clear:both;"&gt;&lt;/div&gt;</code>. ' . __('Just add that snippet after the last item in your form.', 'usp');
	$tools_tips .= __('It&rsquo;s not exactly best-practices design-wise, but it&rsquo;s pretty much guaranteed to do the job. Then later on you can replace the snippet with some proper CSS.', 'usp') . '</dd>';
	
	$tools_tips .= '<dt>' . __('Minimum Posting Requirements', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('There are basically four types of USP Forms: user-registration, content posting, contact form, and combo registration/posting. The minimum form requirements (in terms of input fields) for the contact form are ', 'usp');
	$tools_tips .= __('email, subject, and content. The minimum requirements for user registration are name and email address. The minimum for content posting is the content/textarea field. For the combo registration/posting, the minimum ', 'usp');
	$tools_tips .= __('requirements are determined by the plugin settings. Likewise, other requirements may vary depending on how the plugin settings have been configured.', 'usp') . '</dd>';
	
	$tools_tips .= '<dt>' . __('Shortcodes in Widgets', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('By default, shortcodes do not work when included in widgets. To make them work, just add this snippet to your theme&rsquo;s', 'usp') . ' <code>functions.php</code> ' . __('file:', 'usp');
	$tools_tips .= ' <code>add_filter(&quot;widget_text&quot;, &quot;do_shortcode&quot;);</code> ' . __('Nothing more to do, but remember to re-add the snippet if/when you change themes.', 'usp') . '</dd>';
	
	$tools_tips .= '<dt>' . __('On Install, On Uninstall', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('Just FYI: when USP Pro is installed it creates four new options in the wp_options table. That&rsquo;s it. No new database tables are created. While the plugin is active, new content (post data, user info) may ', 'usp');
	$tools_tips .= __('be added to the database, but no other changes are made anywhere by the plugin. Lastly, when the plugin is uninstalled (deleted from the server), the four options it created are removed from the database. ', 'usp');
	$tools_tips .= __('Note that the plugin does not delete any posted/submitted content or registered users. If any posts or users were added, it is up to the admin whether or not to remove them.', 'usp') . '</dd>';
	
	$tools_tips .= '<dt>' . __('Alternate Way to Reset Form', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('USP Pro includes a shortcode/quicktag for a link that will reset the form. To use a button instead, add this code to any form:', 'usp') . ' <code>&lt;input type="reset" value="Reset all form values"&gt;</code>';
	$tools_tips .= __('Note that the shortcode requires the form URL as one of its attributes, but the reset <code>&lt;input&gt;</code> tag works without requiring any URL.', 'usp') . '</dd>';
	
	$tools_tips .= '<dt>' . __('Custom Field Recipes', 'usp') . '</dt>';
	$tools_tips .= '<dd>' . __('USP Pro supports unlimited Custom Fields. Here is a cheatsheet for various types of form elements. Click the links for more details.', 'usp');
	$tools_tips .= '<ul>';
	$tools_tips .= '<li><a target="_blank" href="https://plugin-planet.com/usp-pro-add-custom-textarea/">'. __('Textarea', 'usp') .'</a> &ndash; <code>field#textarea</code></li>';
	$tools_tips .= '<li><a target="_blank" href="https://plugin-planet.com/usp-pro-custom-fields/">'. __('Text Input', 'usp') .'</a> &ndash; <code>type#text|placeholder#Orange|label#Orange</code></li>';
	$tools_tips .= '<li><a target="_blank" href="https://plugin-planet.com/usp-pro-custom-radio-fields/">'. __('Radio Select', 'usp') .'</a> &ndash; <code>type#radio|name#1|for#1|value#Oranges</code></li>';
	$tools_tips .= '<li><a target="_blank" href="https://plugin-planet.com/usp-pro-custom-checkbox-fields/">'. __('Checkbox', 'usp') .'</a> &ndash; <code>type#checkbox|value#Oranges</code></li>';
	$tools_tips .= '<li><a target="_blank" href="https://plugin-planet.com/usp-pro-custom-select-fields/">'. __('Select/option', 'usp') .'</a> &ndash; <code>field#select|options#null:Option 1:Option 2:Option 3|option_default#Please Select..|option_select#null|label#Options</code></li>';
	$tools_tips .= '<li><a target="_blank" href="https://plugin-planet.com/usp-pro-shortcodes/#custom-fields">'. __('Other fields', 'usp') .'</a> &ndash; '. __('(visit link for additional shortcodes)', 'usp') .'</li>';
	$tools_tips .= '</ul></dd>';
	
	return $tools_tips;	
}
endif;


