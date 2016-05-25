<?php
/*
Plugin Name: Ajax Load More: Previous Post
Plugin URI: https://connekthq.com/plugins/ajax-load-more/add-ons/previous-post/
Description: Ajax Load More extension for infinite scrolling single posts
Author: Darren Cooney
Twitter: @KaptonKaos
Author URI: https://connekthq.com
Version: 1.1.5
License: GPL
Copyright: Darren Cooney & Connekt Media
*/


define('ALM_PREV_POST_PATH', plugin_dir_path(__FILE__));
define('ALM_PREV_POST_URL', plugins_url('', __FILE__));
define('ALM_PREV_POST_VERSION', '1.1.5');
define('ALM_PREV_POST_RELEASE', 'May 4, 2016');


/*
*  alm_prev_post_install
*  
*  Activation hook
*
*  @since 1.0
*/

register_activation_hook( __FILE__, 'alm_prev_post_install' );
function alm_prev_post_install() {   
   //if Ajax Load More is activated
   if(!is_plugin_active('ajax-load-more/ajax-load-more.php')){	
   	die('You must install and activate <a href="https://wordpress.org/plugins/ajax-load-more/">Ajax Load More</a> before installing the ALM Previous Post Add-on.');
	}	
}



if( !class_exists('ALMPREVPOST') ):

   class ALMPREVPOST{	   
   	function __construct(){			
      	
   		add_action( 'alm_prev_post_installed', array(&$this, 'alm_prev_post_installed') );
      	add_action( 'wp_ajax_alm_query_previous_post', array(&$this, 'alm_query_previous_post') );
   		add_action( 'wp_ajax_nopriv_alm_query_previous_post', array(&$this, 'alm_query_previous_post') );
   		
   	   add_filter( 'alm_prev_post_inc', array(&$this, 'alm_prev_post_inc' ), 10, 5 );	
   	   add_filter( 'alm_prev_post_args', array(&$this, 'alm_prev_post_args' ), 10, 2 );	
      	
   		add_filter( 'alm_prev_post_shortcode', array(&$this, 'alm_prev_post_shortcode'), 10, 4 );	
   			
   		add_action( 'alm_prev_post_settings', array(&$this, 'alm_prev_post_settings') );		
   		
   		add_action( 'wp_enqueue_scripts', array(&$this, 'alm_prev_post_enqueue_scripts' ));   		
   	}   	  
      
      
      
      /*
   	*  alm_prev_post_enqueue_scripts
   	*  Enqueue our scripts
   	*
   	*  @since 1.0
   	*/
   
   	function alm_prev_post_enqueue_scripts(){
   		//wp_register_script( 'ajax-load-more-previous-post', plugins_url( '/js/alm-previous-post.js', __FILE__ ), array('ajax-load-more'),  ALM_PREV_POST_VERSION, true );
   		wp_register_script( 'ajax-load-more-previous-post', plugins_url( '/js/alm-previous-post.min.js', __FILE__ ), array('ajax-load-more'),  ALM_PREV_POST_VERSION, true );
   	}
   	
   	
   	
   	/*
		*  alm_query_previous_post
		*  Get the post id and return the next post ID
		*
		*  @return JSON
		*  @since 1.0
		*/		
   		
   	
   	function alm_query_previous_post(){           	
         $id = (isset($_GET['id'])) ? $_GET['id'] : '';  
         $taxonomy = (isset($_GET['taxonomy'])) ? $_GET['taxonomy'] : '';         
         if($id){         
            global $post;
            
            // Store the existing post object for later so we don't lose it
				$oldGlobal = $post;
				
				// Get the post object for the specified post and place it in the global variable
				$post = get_post($id);
				
				if($taxonomy !== '' && !empty($taxonomy)){
               $previous_post = get_previous_post(true, '', $taxonomy);
            }else{
               $previous_post = get_previous_post();               
            }
            
            // Reset our global object
				$post = $oldGlobal;
            
            $data = '';            
               
            if($previous_post) {
               $data['has_previous_post'] = true;
               $data['prev_id'] = $previous_post->ID;
		         $data['prev_permalink'] = get_permalink($previous_post->ID);
		         $data['prev_title'] = get_the_title($previous_post->ID);
            } else {
               $data['has_previous_post'] = false;
            }            
            
            $data['current_id'] = $id;
	         $data['permalink'] = get_permalink($id);
	         $data['title'] = get_the_title($id);
            echo json_encode($data);            
            die();
         }
      } 
   	
   	
   	
   	/*
   	*  alm_prev_post_args
   	*  Set the next_post args
   	*
   	* @return $args
   	*  @since 1.0
   	*/
   	
   	function alm_prev_post_args($id, $post_type){
      	$args = array(
         	'post__in' => array($id),
            'post_type' => $post_type,
   			'posts_per_page' => 1,       
         );
         return $args;
   	}
   	
   	
   	
   	/*
   	*  alm_prev_post_inc
   	*  Get the next_post include file
   	*
   	* @return ob_get_contents()
   	*  @since 1.0
   	*/
   	
   	function alm_prev_post_inc($repeater, $repeater_type, $theme_repeater, $id, $post_type){
      	
      	$previous_post_args = array(
         	'post__in' => array($id),
            'post_type' => $post_type,
   			'posts_per_page' => 1,       
         );
         $alm_prev_post_query = new WP_Query($previous_post_args);
         
         //if ($alm_prev_post_query->have_posts()) :
            //while ($alm_prev_post_query->have_posts()) : $alm_prev_post_query->the_post();
            
               $alm_item = 1;
               $alm_current = 1;
      	   	$alm_found_posts = 1;
      	   	$alm_page = 1;
               ob_start();	   	
      	   	if($theme_repeater != 'null' && has_filter('alm_get_theme_repeater')){ 
         	   	// If is Theme Repeater
      				do_action('alm_get_theme_repeater', $theme_repeater, $alm_found_posts, $alm_page, $alm_item, $alm_current); // Returns an include file
      			}else{ 
         			// Standard Repeaters
      				$file = alm_get_current_repeater($repeater, $repeater_type);
                  include($file);
      			}
      			
      			$return = ob_get_contents();
      			ob_end_clean();
            
            //endwhile; wp_reset_query();
			//endif;   	
			
			return $return;
			
	   }
   	
      
            
      /*
   	*  alm_prev_post_shortcode
   	*  Build Next Post shortcode params and send back to core ALM
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_prev_post_shortcode($id, $tax, $options){
   		$return = ' data-previous-post="true"';
		   $return .= ' data-previous-post-id="'.$id.'"';
		   $return .= ' data-previous-post-taxonomy="'.$tax.'"';
		   
		   // Get scroll speed and scrolltop
		   $prev_post_scroll_speed = '1000';
		   $prev_post_scrolltop = '30';
   		if(isset($options['_alm_prev_post_speed']))
   			$prev_post_scroll_speed = ''.$options['_alm_prev_post_speed'];
   
   		if(isset($options['_alm_prev_post_scrolltop']))
   			$prev_post_scrolltop = ''.$options['_alm_prev_post_scrolltop'];
   		
		   // Enabled Scrolling			
			$prev_post_enable_scroll = $options['_alm_prev_post_scroll'];
   		if(!isset($prev_post_enable_scroll)){
   			$prev_post_enable_scroll = 'true';   
         }else{	
      		if($prev_post_enable_scroll == '1'){
      		   $prev_post_enable_scroll = 'true';
            }else{
      		   $prev_post_enable_scroll = 'false';
      		}
   		}		
   		
   		// Page Title
   		$prev_post_title_template = '';
   		if(isset($options['_alm_prev_post_title'])){
	   		$prev_post_title_template = $options['_alm_prev_post_title'];
   		}
		   
		   // GA send Pageview			
   		if(!isset($options['_alm_prev_post_ga'])){
   			$prev_post_send_pageview = 'true';   
         }else{	
            $prev_post_send_pageview = $options['_alm_prev_post_ga'];
      		if($prev_post_send_pageview == '1'){
      		   $prev_post_send_pageview = 'true';
            }else{
      		   $prev_post_send_pageview = 'false';
      		}
   		}
   		
			$return .= ' data-previous-post-title-template="'.$prev_post_title_template.'"';
			$return .= ' data-previous-post-site-title="'.get_bloginfo('name').'"';
			$return .= ' data-previous-post-site-tagline="'.get_bloginfo('description').'"';
			$return .= ' data-previous-post-scroll="'.$prev_post_enable_scroll.'"';
			$return .= ' data-previous-post-scroll-speed="'.$prev_post_scroll_speed.'"';
			$return .= ' data-previous-post-scrolltop="'.$prev_post_scrolltop.'"';
		   $return .= ' data-previous-post-pageview="'.$prev_post_send_pageview.'"';
		   
		   return $return;
   	}	
   		
   	
   	
   	/*
   	*  alm_prev_post_installed
   	*  an empty function to determine if Next Post is true.
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_prev_post_installed(){
   	   //Empty return
   	}   	
   	
   	
   	
   	/*
   	*  alm_prev_post_settings
   	*  Create the Previous Post settings panel.
   	*
   	*  @since 1.2
   	*/
   	
   	function alm_prev_post_settings(){
      	
      	register_setting(
      		'alm_prev_post_license', 
      		'alm_prev_post_license_key', 
      		'alm_prev_post_sanitize_license'
      	);
      	
   	   add_settings_section( 
	   		'alm_prev_post_settings',  
	   		'Previous Post Settings', 
	   		'alm_prev_post_callback', 
	   		'ajax-load-more' 
	   	);	   
	   	
	   	add_settings_field( 
	   		'_alm_prev_post_title', 
	   		__('Page Title Template', ALM_NAME ), 
	   		'alm_prev_post_title_callback', 
	   		'ajax-load-more', 
	   		'alm_prev_post_settings' 
	   	);		
	   	
	   	add_settings_field( 
	   		'_alm_prev_post_ga', 
	   		__('Google Analytics', ALM_NAME ), 
	   		'alm_prev_post_ga_callback', 
	   		'ajax-load-more', 
	   		'alm_prev_post_settings' 
	   	);	
	   	
	   	add_settings_field( 
	   		'_alm_prev_post_scroll', 
	   		__('Scroll to Post', ALM_NAME ), 
	   		'alm_prev_post_scroll_callback', 
	   		'ajax-load-more', 
	   		'alm_prev_post_settings' 
	   	);	
	   	
	   	add_settings_field( 
	   		'_alm_prev_post_speed', 
	   		__('Scroll Speed', ALM_NAME ), 
	   		'alm_prev_post_speed_callback', 
	   		'ajax-load-more', 
	   		'alm_prev_post_settings' 
	   	);	
	   	
	   	add_settings_field( 
	   		'_alm_prev_post_scrolltop', 
	   		__('Scroll Top', ALM_NAME ), 
	   		'alm_prev_post_scrolltop_callback', 
	   		'ajax-load-more', 
	   		'alm_prev_post_settings' 
	   	);	
   	}	
   	
   } 
   
   


	
	/*
   *  alm_prev_post_sanitize_license
   *  Sanitize our license activation
   *
   *  @since 1.0.0
   */
   
   function alm_prev_post_sanitize_license( $new ) {
   	$old = get_option( 'alm_prev_post_license_key' );
   	if( $old && $old != $new ) {
   		delete_option( 'alm_prev_post_license_status' ); // new license has been entered, so must reactivate
   	}
   	return $new;
   }
   
   
   /* Next Post Settings (Displayed in ALM Core) */


	/*
	*  alm_prev_post_callback
	*  Next Post Setting Heading
	*
	*  @since 1.0
	*/
	
	function alm_prev_post_callback() {
	   $html = '<p>' . __('Customize your installation of the <a href="http://connekthq.com/plugins/ajax-load-more/add-ons/previous-post/">Previous Post</a> add-on.', ALM_NAME) . '</p>';
	   
	   echo $html;
	}
	
	
	
	/*
	*  alm_prev_post_ga_callback
	*  Send pageviews to Google Analytics
	*
	*  @since 1.0
	*/
	
	function alm_prev_post_ga_callback(){
		$options = get_option( 'alm_settings' );
		if(!isset($options['_alm_prev_post_ga'])) 
		   $options['_alm_prev_post_ga'] = '1';
		
		$html = '<input type="hidden" name="alm_settings[_alm_prev_post_ga]" value="0" /><input type="checkbox" id="_alm_prev_post_ga" name="alm_settings[_alm_prev_post_ga]" value="1"'. (($options['_alm_prev_post_ga']) ? ' checked="checked"' : '') .' />';
		$html .= '<label for="_alm_prev_post_ga">'.__('Send pageviews to Google Analytics.', ALM_NAME).'<br/><span>Each time a post is loaded it will count as a pageview. You must have a reference to your Google Analytics tracking code on the page.</span></label>';	
		
		echo $html;
	}
	
	
	
	/*
	*  alm_prev_post_title_callback
	*  Update the page title
	*
	*  @since 1.0
	*/
	
	function alm_prev_post_title_callback(){
		$options = get_option( 'alm_settings' );
		if(!isset($options['_alm_prev_post_title'])) 
		   $options['_alm_prev_post_title'] = '';
		
		$html = '<label for="_alm_prev_post_title">'.__('The page title template is used to update the browser title each time a new post is loaded.<br/><span>If empty the page title will <u>NOT</u> be updated</span>', ALM_NAME).'</label><br/>';
		$html .= '<input type="text" class="full" id="_alm_prev_post_title" name="alm_settings[_alm_prev_post_title]" value="'.$options['_alm_prev_post_title'].'" placeholder="{post-title} - {site-title}" /> ';
		$html .= '<div class="template-tags"><h4>'.__('Template Tags', ALM_NAME).'</h4>';
		$html .= '<ul>';
		$html .= '<li>'.__('<pre>{post-title}</pre> Title of Post', ALM_NAME).'</li>';
		$html .= '<li>'.__('<pre>{site-title}</pre> Site Title', ALM_NAME).'</li>';
		$html .= '<li>'.__('<pre>{tagline}</pre> Site Tagline', ALM_NAME).'</li>';
		$html .= '</ul>';
		
		$html .= '</ul>';
			
		
		echo $html;
	}
	
	
	
	/*
	*  alm_prev_post_scroll_callback
	*  Allow window scrolling
	*
	*  @since 1.0
	*/
	
	function alm_prev_post_scroll_callback(){
		$options = get_option( 'alm_settings' );
		
		if(!isset($options['_alm_prev_post_scroll'])) 
		   $options['_alm_prev_post_scroll'] = '1';
		
		$html = '<input type="hidden" name="alm_settings[_alm_prev_post_scroll]" value="0" />';
		$html .= '<input type="checkbox" name="alm_settings[_alm_prev_post_scroll]" id="alm_prev_scroll_page" value="1"'. (($options['_alm_prev_post_scroll']) ? ' checked="checked"' : '') .' />';
		$html .= '<label for="alm_prev_scroll_page">'.__('Enable window scrolling.<br/><span>With scrolling enabled users will be automatically scrolled to the current post on \'Load More\' button click and while interacting with the forward and back browser buttons.</span>', ALM_NAME).'</label>';	
		
		echo $html;
	}
	
	
	
	/*
	*  alm_prev_post_speed_callback
	*  Set the speed of windw scroll
	*
	*  @since 1.0
	*/
		
	function alm_prev_post_speed_callback() {
	 
	   $options = get_option( 'alm_settings' );
	    
	   if(!isset($options['_alm_prev_post_speed'])) 
		   $options['_alm_prev_post_speed'] = '500';
	     
			
		$html = '<label for="alm_settings[_alm_prev_post_speed]">'.__('Set the scrolling speed of the page in milliseconds. <br/><span>e.g. 1 second = 1000</span>', ALM_NAME).'</label><br/>';
		$html .= '<input type="number" class="sm" id="alm_settings[_alm_prev_post_speed]" name="alm_settings[_alm_prev_post_speed]" step="50" min="0" value="'.$options['_alm_prev_post_speed'].'" placeholder="500" /> ';	
		
		echo $html;
		  
	}
	
	
	
	/*
	*  alm_prev_post_scrolltop_callback
	*  Set the scrolltop value
	*
	*  @since 1.0
	*/
		
	function alm_prev_post_scrolltop_callback() {
	 
	    $options = get_option( 'alm_settings' );
	    if(!isset($options['_alm_prev_post_scrolltop'])) 
		   $options['_alm_prev_post_scrolltop'] = '30';
	     
			
		$html = '<label for="alm_settings[_alm_prev_post_scrolltop]">'.__('Set the scrolltop position of the window when scrolling to post.', ALM_NAME).'</label><br/>';
		$html .= '<input type="number" class="sm" id="alm_settings[_alm_prev_post_scrolltop]" name="alm_settings[_alm_prev_post_scrolltop]" step="1" min="0" value="'.$options['_alm_prev_post_scrolltop'].'" placeholder="30" /> ';	
		
		echo $html;
		
		?>
		<script>
			// Check if Scroll to Page  != true
			if(!jQuery('input#alm_prev_scroll_page').is(":checked")){ 
		      jQuery('input#alm_prev_scroll_page').parent().parent('tr').next('tr').hide();
		      jQuery('input#alm_prev_scroll_page').parent().parent('tr').next('tr').next('tr').hide();
	    	}
	    	jQuery('input#alm_prev_scroll_page').change(function() {
	    		var el = jQuery(this);
		      if(el.is(":checked")) {
		      	el.parent().parent('tr').next('tr').show();
		      	el.parent().parent('tr').next('tr').next('tr').show();
		      }else{		      
		      	el.parent().parent('tr').next('tr').hide();
		      	el.parent().parent('tr').next('tr').next('tr').hide();
		      }
		   });
		   
	    </script>
	<?php  
	}
   
   
   
   /*
   *  alm_prev_post_activate_license
   *  Activate the license
   *
   *  @since 1.0
   */
   
   function alm_prev_post_activate_license() {        	
   	
   	// listen for our activate button to be clicked
   	if( isset( $_POST['alm_prev_post_license_activate'] ) ) { 
   
   		// run a quick security check 
   	 	if( ! check_admin_referer( 'alm_prev_post_license_nonce', 'alm_prev_post_license_nonce' ) ) 	
   			return; // get out if we didn't click the Activate button
   
   		// retrieve the license from the database
   		$license = trim( get_option( 'alm_prev_post_license_key' ) );
   		
   
   		// data to send in our API request
   		$api_params = array( 
   			'edd_action'=> 'activate_license', 
   			'license' 	=> $license, 
   			'item_id'   => ALM_PREV_POST_ITEM_NAME, // the name of our product in EDD
   			'url'       => home_url()
   		);
   		
   		// Call the custom API.
         $response = wp_remote_post( ALM_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
   
   		// make sure the response came back okay
   		if ( is_wp_error( $response ) )
   			return false;
   
   		// decode the license data
   		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
   		
   		// $license_data->license will be either "valid" or "invalid"
   
   		update_option( 'alm_prev_post_license_status', $license_data->license );
   
   	}
   }
   add_action('admin_init', 'alm_prev_post_activate_license');
   
   
   
   /*
   *  alm_prev_post_deactivate_license
   *  Deactivate license
   *
   *  @since 1.0
   */
   
   function alm_prev_post_deactivate_license() {

   	// listen for our activate button to be clicked
   	if( isset( $_POST['alm_prev_post_license_deactivate'] ) ) {
   
   		// run a quick security check 
   	 	if( ! check_admin_referer( 'alm_prev_post_license_nonce', 'alm_prev_post_license_nonce' ) ) 	
   			return; // get out if we didn't click the Activate button
   
   		// retrieve the license from the database
   		$license = trim( get_option( 'alm_prev_post_license_key' ) );   			
   
   		// data to send in our API request
   		$api_params = array( 
   			'edd_action'=> 'deactivate_license', 
   			'license' 	=> $license, 
   			'item_id'   => urlencode(ALM_PREV_POST_ITEM_NAME), // the name of our product in EDD
   			'url'       => home_url()
   		); 
   		
   		// Call the custom API.
   		$response = wp_remote_post( ALM_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
   
   		// make sure the response came back okay
   		if ( is_wp_error( $response ) )
   			return false;
   
   		// decode the license data
   		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
   		
   		// $license_data->license will be either "deactivated" or "failed"
   		if( $license_data->license == 'deactivated' )
   			delete_option( 'alm_prev_post_license_status' );
   
   	}
   }
   add_action('admin_init', 'alm_prev_post_deactivate_license');  
     	
   	
   	
   /*
   *  ALMPREVPOST
   *  The main function responsible for returning Ajax Load More Previous Post.
   *
   *  @since 1.0
   */	
   
   function ALMPREVPOST(){
   	global $ALMPREVPOST;
   
   	if( !isset($ALMPREVPOST) )
   	{
   		$ALMPREVPOST = new ALMPREVPOST();
   	}
   
   	return $ALMPREVPOST;
   }
      
   
   // initialize
   ALMPREVPOST();

endif; // class_exists check


/* Software Licensing */

//define('ALM_PREV_POST_ITEM_NAME', '9686' ); // EDD CONSTANT - Item Name
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include( dirname( __FILE__ ) . '/vendor/EDD_SL_Plugin_Updater.php' );
}

function alm_prev_plugin_updater() {	
	$license_key = trim( get_option( 'alm_prev_post_license_key' ) ); // retrieve our license key from the DB
	$edd_updater = new EDD_SL_Plugin_Updater( ALM_STORE_URL, __FILE__, array( 
			'version' 	=> ALM_PREV_POST_VERSION,
			'license' 	=> $license_key,
			'item_id'   => ALM_PREV_POST_ITEM_NAME, // Found in core ALM
			'author' 	=> 'Darren Cooney'
		)
	);
}
add_action( 'admin_init', 'alm_prev_plugin_updater', 0 );	

/* End Software Licensing */
