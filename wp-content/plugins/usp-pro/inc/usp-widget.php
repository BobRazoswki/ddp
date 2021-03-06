<?php // USP Pro - Form Widget

if (!defined('ABSPATH')) die();

/*
	Class: USP Form
	Displays USP Form as widget
	@ https://codex.wordpress.org/Widgets_API
*/
if (!class_exists('USP_Form_Widget')) :

class USP_Form_Widget extends WP_Widget {
	
	public function __construct() {
		
		$args = array('classname' => 'usppro', 'description' => __('Display any USP Form as a widget', 'usp'));
		parent::__construct('usp_form_widget', __('USP Form Widget', 'usp'), $args);
		
	}
	
	public function widget($args, $instance) {
		
		extract($args);
		
		$id    = $instance['id'];
		$class = $instance['class'];
		$title = $instance['title'];
		
		$postID  = trim($instance['postID']);
		$postIDs = explode(',', $postID);
		
		$usp_args = array('id' => $id, 'class' => $class, 'title' => $title, 'widget' => true);
		
		if (!empty($postID)) {
			
			foreach ($postIDs as $ID) {
				$ID = trim($ID);
				if (is_single($ID) || is_page($ID)) {
					echo usp_form($usp_args);
				}
			}
			
		} else {
			
			echo usp_form($usp_args);
		}
		
	}
	
	public function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['id']     = $new_instance['id'];
		$instance['class']  = $new_instance['class'];
		$instance['postID'] = $new_instance['postID'];
		$instance['title']  = strip_tags($new_instance['title']);
		
		return $instance;
		
	}
	
	public function form($instance) {
		
		if ($instance) {
			
			$instance = wp_parse_args((array) $instance, array('title' => ''));
			$id       = esc_attr($instance['id']);
			$class    = esc_attr($instance['class']);
			$postID   = esc_attr($instance['postID']);
			$title    = strip_tags($instance['title']);
			
		} else {
			
			$id     = '';
			$class  = '';
			$postID = '';
			$title  = '';
			
		} ?>
		
		<p>
			<strong><?php _e('Widget Title', 'usp'); ?></strong><br />
			<input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /><br />
			<small><label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Enter an optional title for this widget (useful when using multiple form widgets). Displayed only on the widget panel here in the Admin Area.', 'usp'); ?>
			</label></small>
		</p>
		<p>
			<strong><?php _e('USP Form ID', 'usp'); ?></strong><br />
			<input name="<?php echo $this->get_field_name('id'); ?>" id="<?php echo $this->get_field_id('id'); ?>" type="text" value="<?php echo esc_attr($id); ?>" /><br />
			<small><label for="<?php echo $this->get_field_id('id'); ?>">
				<?php _e('Enter the ID of a published USP Form. Make sure the form is published and not saved as a draft or pending. Check the form&rsquo;s shortcode for its ID. (Required)', 'usp'); ?>
			</label></small>
		</p>
		<p>
			<strong><?php _e('Custom CSS Classes', 'usp'); ?></strong><br />
			<input name="<?php echo $this->get_field_name('class'); ?>" id="<?php echo $this->get_field_id('class'); ?>" type="text" value="<?php echo esc_attr($class); ?>" /><br />
			<small><label for="<?php echo $this->get_field_id('class'); ?>">
				<?php _e('Optional custom classes for the form. Use commas to separate each class, like so: class1,class2,class3', 'usp'); ?>
			</label></small>
		</p>
		<p>
			<strong><?php _e('Limit Form to Post/Page', 'usp'); ?></strong><br />
			<input name="<?php echo $this->get_field_name('postID'); ?>" id="<?php echo $this->get_field_id('postID'); ?>" type="text" value="<?php echo esc_attr($postID); ?>" /><br />
			<small><label for="<?php echo $this->get_field_id('postID'); ?>">
				<?php _e('Enter the ID of a specific post or page; leave blank to display on all posts/pages. Separate multiple IDs with a comma.', 'usp'); ?>
			</label></small>
		</p>
		
<?php }

}

add_action('widgets_init', create_function('', 'register_widget("USP_Form_Widget");'));

endif;


