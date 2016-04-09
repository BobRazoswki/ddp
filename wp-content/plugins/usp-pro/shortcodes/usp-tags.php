<?php // USP Pro - Tag Shortcode

if (!defined('ABSPATH')) die();

/*
	Shortcode: Tags
	Displays tags input field
	Syntax: [usp_tags class="aaa,bbb,ccc" placeholder="Post Tags" label="Post Tags" required="yes" max="99" tags="" size="3" multiple="no"]
	Attributes:
		type        = specifies the type of field to use for displaying the tags (dropdown, checkbox, input) (default = General > Tag settings)
		class       = comma-sep list of classes
		placeholder = text for input placeholder
		label       = text for input label
		default     = specifies the text used for the "Please select.." default option, may by any string or "null" to exclude
		required    = specifies if input is required (data-required attribute)
		max         = sets maximum number of allowed characters (maxlength attribute)
		tags        = specifies any default tags that should always be include with the form
		size        = specifies value for the size attribute of the select tag when using the select menu
		multiple    = specifies whether users should be allowed to select multiple tags
		include     = overrides global tags to specify local tags (comma-separated list of tag IDs), OR specifies to include all non-empty tags via "all", OR all tags including empty via "all_include_empty"
		exclude     = specifies any tags that should be excluded from the form (comma separated)
		custom      = any attributes or custom code
		fieldset    = enable auto-fieldset: true, false, or custom class name for fieldset (default true)
*/

if (!function_exists('usp_input_tags')) :
 
function usp_input_tags($args) {
	global $usp_general;
	
	// cookie value
	$value = (isset($_SESSION['usp_form_session']['usp-tags']) && isset($_COOKIE['remember'])) ? $_SESSION['usp_form_session']['usp-tags'] : '';
	
	// display type
	$display_tags = $usp_general['tags_menu'];
	if     (isset($args['type']) && $args['type'] === 'checkbox') $display_tags = 'checkbox';
	elseif (isset($args['type']) && $args['type'] === 'dropdown') $display_tags = 'dropdown';
	elseif (isset($args['type']) && $args['type'] === 'input')    $display_tags = 'input';
	
	// custom atts
	$custom = '';
	if (isset($args['custom']) && !empty($args['custom'])) {
		$custom = ($display_tags == 'checkbox' || $display_tags == 'input') ? sanitize_text_field($args['custom']) .' ' : ' '. sanitize_text_field($args['custom']);
	}
	
	// default options
	$default = __('Please select..', 'usp');
	if     (isset($args['default']) && !empty($args['default']) && $args['default'] !== 'null') $default = sanitize_text_field($args['default']);
	elseif (isset($args['default']) && !empty($args['default']) && $args['default'] === 'null') $default = false;
	$default_html = ($default) ? '<option value="">'. $default .'</option>'. "\n" : "\n";
	
	// multiple select
	$multiple = ''; 
	$brackets = '';
	if (isset($args['multiple']) && !empty($args['multiple'])) {
		if ($args['multiple'] == 'yes' || $args['multiple'] == 'true' || $args['multiple'] == 'on') {
			$multiple = ' multiple="multiple"';
			$brackets = '[]';
		}
	} else {
		if ($usp_general['tags_multiple']) {
			$multiple = ' multiple="multiple"';
			$brackets = '[]';
		}
	}
	
	// attributes
	$field = 'usp_error_4';
	$placeholder = usp_placeholder($args, $field);
	$required    = usp_required($args);
	$label       = usp_label($args, $field);
	$max         = usp_max_att($args, '99');
	
	// fieldset
	$fieldset_custom = (isset($args['fieldset'])) ? sanitize_text_field($args['fieldset']) : '';
	$fieldset = usp_fieldset($fieldset_custom);
	$fieldset_before = $fieldset['fieldset_before'];
	$fieldset_after = $fieldset['fieldset_after'];
	
	// parsley
	$parsley = ($required == 'true') ? 'required="required" ' : '';
	
	// select size
	$size = (isset($args['size']) && !empty($args['size']) && $multiple == ' multiple="multiple"') ? ' size="'. $args['size'] .'"' : '';
	
	// input class
	$class = isset($args['class']) ? 'usp-input,usp-input-tags,'. $args['class'] : 'usp-input,usp-input-tags';
	$classes = usp_classes($class, '4');
	
	// hidden tags
	$tags = isset($args['tags']) ? usp_tags($args['tags']) : '';
	
	// global tags
	$tag_array = isset($usp_general['tags']) ? $usp_general['tags'] : array();
	
	// local tags
	if (isset($args['include']) && !empty($args['include'])) {
		if ($args['include'] === 'all') {
			$include_tags = get_tags();
			foreach ($include_tags as $include_tag) {
				$tag_array[] = $include_tag->term_id;
			}
		} elseif ($args['include'] === 'all_include_empty') {
			$include_tags = get_tags(array('hide_empty' => false));
			foreach ($include_tags as $include_tag) {
				$tag_array[] = $include_tag->term_id;
			}
		} else {
			$include_tags = trim($args['include']);
			$include_tags = explode(',', $include_tags);
			foreach ($include_tags as $include_tag) {
				$include_tag = intval(trim($include_tag));
				$tag_exists = term_exists($include_tag, 'post_tag');
				if (!empty($tag_exists)) $tag_array[] = $include_tag;
				else unset($include_tags[$include_tag]);
			}
		}
	}
	
	// exclude tags
	$excluded_tags = array();
	if (isset($args['exclude']) && !empty($args['exclude'])) {
		$exclude = trim($args['exclude']);
		$excluded = explode(',', $exclude);
		foreach($excluded as $exclude) {
			$excluded_tags[] = trim($exclude);
		}
		foreach($tag_array as $key => $val) {
			if (in_array($val, $excluded_tags)) unset($tag_array[$key]);
		}
	}
	
	// remove duplicates
	$tag_array = array_unique(array_map('intval', $tag_array));
	sort($tag_array, SORT_NUMERIC);
	
	// display tags
	if (isset($usp_general['hidden_tags']) && !empty($usp_general['hidden_tags'])) {
		
		return (!empty($tags)) ? '<input name="usp-tags-default" value="'. $tags .'" type="hidden" />'. "\n" : '';
		
	} else {
		
		if ($display_tags == 'checkbox') {
			
			$content = (!empty($label)) ? '<label for="usp-tags[]" class="usp-label usp-label-tags">'. $label .'</label>'. "\n" : '';
			
			foreach ((array) $tag_array as $tag) {
				
				$the_tag = get_term_by('id', $tag, 'post_tag');
				if (!$the_tag) continue;
				
				$checked = '';
				if (is_array($value)) {
					if (in_array($tag, $value)) $checked = ' checked';
				}
				
				$content .= '<span class="usp-checkbox usp-tag">';
				$content .= '<input type="checkbox" name="usp-tags[]" value="'. $tag .'" data-required="'. $required .'" class="'. $classes .'"'. $checked .' '. $custom .'/> '. esc_html($the_tag->name);
				$content .= '</span>'. "\n";
			}
			
		} elseif ($display_tags == 'input') {
			
			$content = (!empty($label)) ? '<label for="usp-tags" class="usp-label usp-label-tags">'. $label .'</label>'. "\n" : '';
			
			$content .= '<input name="usp-tags" type="text" value="'. esc_attr($value) .'" data-required="'. $required .'" '. $parsley .'maxlength="'. $max .'" placeholder="'. $placeholder .'" class="'. $classes .'" '. $custom .'/>'. "\n";
			
		} else {
			
			$content = (!empty($label)) ? '<label for="usp-tags'. $brackets .'" class="usp-label usp-label-tags">'. $label .'</label>'. "\n" : '';
			
			$content .= '<select name="usp-tags'. $brackets .'" '. $parsley .'data-required="'. $required .'"'. $size . $multiple .' class="'. $classes .' usp-select"'. $custom .'>'. "\n";
			$content .= $default_html;
			
			foreach ((array) $tag_array as $tag) {
				
				$the_tag = get_term_by('id', $tag, 'post_tag');
				if (!$the_tag) continue;
				
				$selected = '';
				if (is_array($value)) {
					foreach ($value as $val) {
						if (intval($tag) === intval($val)) $selected = ' selected';
					}
				} else {
					if (intval($tag) === intval($value)) $selected = ' selected';
				}
				
				$content .= '<option value="'. $the_tag->term_id .'"'. $selected .'>'. esc_html($the_tag->name) .'</option>'. "\n";
			}
			
			$content .= '</select>'. "\n";
		}
		
		// hidden fields
		if ($required == 'true') $content .= '<input name="usp-tags-required" value="1" type="hidden" />'. "\n";
		if (!empty($tags)) $content .= '<input name="usp-tags-default" value="'. $tags .'" type="hidden" />'. "\n";
		
		return $fieldset_before . $content . $fieldset_after;
	}
}

add_shortcode('usp_tags', 'usp_input_tags');

endif;


