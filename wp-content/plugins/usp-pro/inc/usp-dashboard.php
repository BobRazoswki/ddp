<?php // USP Pro - Dashboard Widget

if (!defined('ABSPATH')) die();

function usp_pro_dashboard_widget_draft_posts() {
	
	global $post, $usp_advanced;
	
	$userid = apply_filters('usp_widget_drafts_user', get_current_user_id());
	
	$posts_per_page = apply_filters('usp_widget_drafts_number', -1);
	
	$existing_post_type = (isset($usp_advanced['other_type']) && !empty($usp_advanced['other_type'])) ? $usp_advanced['other_type'] : null;
	
	$custom_post_type = apply_filters('usp_widget_drafts_type', 'book');
	
	$args = array(
		'author'         => $userid,
		'posts_per_page' => $posts_per_page,
		'post_type'      => array('post', 'page', 'usp_post', $existing_post_type, $custom_post_type),
		'post_status'    => array('draft', 'future', 'pending'),
		'meta_key'       => 'is_submission',
		'meta_value'     => '1'
	);
	
	$submitted_posts = get_posts($args);
	$post_count = count($submitted_posts);
	
	echo '<style>';
	echo '.metabox-prefs .usp-pro-dashboard-widget { display: none; } ';
	echo '.postbox .usp-pro-dashboard-widget { padding-left: 5px; color: #ccc; font-size: 90%; font-weight: lighter; }';
	echo '</style>';
	
	if (isset($post_count) && (int) $post_count > 0) {
		
		echo '<p>'. __('Submitted posts waiting to be published:', 'usp') .'</p>';
		echo '<ul>';
		
		foreach ($submitted_posts as $post) {
			
			setup_postdata($post);
			
			$post_author    = get_the_author();
			$post_title     = get_the_title();
			$post_edit      = get_edit_post_link();
			
			$post_schedule  = apply_filters('usp_widget_drafts_time', get_the_time('l, F j, Y @ h:i:s a'));
			$post_date      = get_post_meta(get_the_ID(), 'usp-post-time', true) ? get_post_meta(get_the_ID(), 'usp-post-time', true) : $post_schedule;
			$post_status    = get_post_status() === 'future' ? __(' Scheduled: ', 'usp') . $post_schedule : ucfirst(get_post_status());
			
			$post_type      = get_post_type();
			$post_type_obj  = get_post_type_object($post_type);
			$post_type_name = is_object($post_type_obj) ? $post_type_obj->labels->singular_name : ucwords(str_replace('_', ' ', $post_type));
			$post_type_name = strcasecmp($post_type_name, 'usp post') == 0 ? 'USP Post' : $post_type_name;
			
			if (current_user_can('edit_posts') && !empty($post_edit)) {
				
				$post_link = '<a href="'. $post_edit .'" title="'. __('Edit this post', 'usp') .'">'. $post_title .'</a>';
				
			} else {
				
				$post_link = $post_title;
				
			}
			
			echo '<li>';
			echo '<strong>'. $post_link .'</strong> &ndash; <small><em>'. $post_status .'</em></small><br />';
			echo '<small>'. $post_type_name . __(' submitted by ', 'usp') . $post_author . __(' on ', 'usp') . $post_date .'</small>';
			echo '</li>';
			
		}
		
		echo '</ul>';
		
	} else {
		
		echo '<p>'. __('No submitted posts waiting to be published.', 'usp') .'</p>';
		
	}
	
	wp_reset_postdata();
		
}

function usp_pro_dashboard_widgets() {
	
	wp_add_dashboard_widget(
		'usp_pro_dashboard_widget_draft_posts', 
		__('Submitted Post Queue', 'usp') .' <span class="usp-pro-dashboard-widget">USP Pro</span>', 
		'usp_pro_dashboard_widget_draft_posts'
	);
	
}
