=== Ajax Load More: Previous Post ===

Contributors: dcooney
Author: Darren Cooney
Author URI: http://connekthq.com/
Plugin URI: http://connekthq.com/ajax-load-more/add-ons/previous-post/
Requires at least: 3.6.1
Tested up to: 4.5.1
Stable tag: trunk
Homepage: http://connekthq.com/ajax-load-more/
Version: 1.1.5


== Copyright ==
Copyright 2016 Darren Cooney

This software is NOT to be distributed, but can be INCLUDED in WP themes: Premium or Contracted.
This software is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.


== Description ==

The Previous Post add-on will allow you to navigate your single posts with ajax and adjust the browser URL as you do.

http://connekthq.com/plugins/ajax-load-more/previous-post/



== Installation ==

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `ajax-load-more-previous-post.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard


= Using FTP =

1. Download `ajax-load-more-previous-post.zip`.
2. Extract the `ajax-load-more-previous-post` directory to your computer.
3. Upload the `ajax-load-more-previous-post` directory to the `/wp-content/plugins/` directory.
4. Ensure Ajax Load More is installed prior to activating the plugin.
5. Activate the plugin in the Plugin dashboard.


== Changelog ==

= 1.1.5 =
* FIX - Updated alm_prev_post_inc() function that fixes issue with post not rendering in preview mode.

= 1.1.4 =
* UPDATE - Updating URL passed to Google Analytics.

= 1.1.3 =
* UPDATE - Adding Google Analytics support for Yoast GA (__gaTracker()) function.

= 1.1.2 =
* FIX - Fixed issue with popstate javascript function firing on page load in Safari.

= 1.1.1 =
* FIX - Fixing php error with  calling function in Theme Repeater add-on.

= 1.1 =
* NEW - Adding new 'previous_post_taxonomy' parameter to allow for querying posts within same taxonomy.
* NEW - Adding new $.fn.almUrlUpdate(permalink, type) callback function. Dispatched after a URL change.

= 1.0.2 =
* UPDATE - Enqueue Previous Post JS only if Ajax Load More shortcode ([ajax_load_more]) is active on current page.

= 1.0.1 =
* BUG - Fixed issue with fwd and back browser buttons. In webkit browsers the user was not moved to the previous/next post.

= 1.0 =
* Initial Release.
