<?php // USP Pro - Taxonomy Shortcode

if (!defined('ABSPATH')) die();

/*
	Shortcode: Taxonomy
	Displays taxonomy input field
	Syntax: [usp_taxonomy class="aaa,bbb,ccc" label="Post Taxonomy" required="yes" tax="" size="3" multiple="no" terms="123,456,789" type="checkbox"]
	Attributes:
		type        = specifies the type of field to display (checkbox or dropdown)
		class       = comma-sep list of classes
		placeholder = text for input placeholder
		label       = text for input label
		default     = specifies the text used for the "Please select.." default option, may by any string or "null" to exclude
		required    = specifies if input is required (data-required attribute)
		tax         = specifies the taxonomy
		size        = specifies value for the size attribute of the select tag when using the select menu
		multiple    = specifies whether users should be allowed to select multiple terms
		terms       = specifies which tax terms to include (comma-separated list of term IDs), 
					  OR specifies to include all non-empty terms via "all", OR all terms including empty via "all_include_empty"
		exclude     = specifies any cats that should be excluded from the form (comma separated)
		custom      = any attributes or custom code
		fieldset    = enable auto-fieldset: true, false, or custom class name for fieldset (default true)
*/

if (!function_exists('usp_input_taxonomy')) : 

function usp_input_taxonomy($args) {

	// taxonomy
	$taxonomy = (isset($args['tax'])) ? $args['tax'] : 'undefined';
	
	// cookie value
	$value = '';
	if (isset($_SESSION['usp_form_session']) && isset($_COOKIE['remember'])) {
		foreach($_SESSION['usp_form_session'] as $session_key => $session_value) {
			if (preg_match("/^usp-taxonomy-$taxonomy$/i", $session_key, $match)) {
				$value = $session_value;
			}
		}
	}
	
	// display type
	$type = (isset($args['type'])) ? $args['type'] : 'dropdown';
	
	// custom atts
	$custom = '';
	if (isset($args['custom'])) {
		$custom = ($type == 'checkbox') ? sanitize_text_field($args['custom']) .' ' : ' '. sanitize_text_field($args['custom']);
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
	}
	
	// attributes
	$field       = $taxonomy;
	$placeholder = usp_placeholder($args, $field);
	$required    = usp_required($args);
	$label       = usp_label($args, $field);
	
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
	$class = isset($args['class']) ? 'usp-input,usp-input-taxonomy,'. $args['class'] : 'usp-input,usp-input-taxonomy';
	$classes = usp_classes($class, 'usp_error_14');
	
	// local tax
	$tax_terms = array();
	if (isset($args['terms'])) {
		if ($args['terms'] === 'all') {
			$terms = get_terms($taxonomy);
			foreach ($terms as $term) {
				$tax_terms[] = (array) $term;
			}
		} elseif ($args['terms'] === 'all_include_empty') {
			$terms = get_terms($taxonomy, array('hide_empty' => false));
			foreach ($terms as $term) {
				$tax_terms[] = (array) $term;
			}
		} else {
			$tax_terms = array();
			$terms = trim($args['terms']);
			$terms = explode(",", $terms);
			foreach($terms as $term) {
				$term = trim($term);
				$get_term = get_term($term, $taxonomy, ARRAY_A);
				if (!is_wp_error($get_term)) {
					$term_exists = term_exists($get_term['term_id'], $taxonomy);
					if ($term_exists !== 0 && $term_exists !== null) $tax_terms[] = $get_term; 
				}
			}
		}
	}
	
	// exclude tax
	if (isset($args['exclude']) && !empty($args['exclude'])) {
		$exclude = trim($args['exclude']);
		$excluded = explode(",", $exclude);
		foreach($excluded as $exclude) {
			$excluded_tax[] = trim($exclude);
		}
		foreach($tax_terms as $key => $val) {
			foreach($val as $k => $v) {
				if (in_array($v, $excluded_tax)) unset($tax_terms[$key]);
			}
		}
	}
	
	// display tax
	if (!empty($tax_terms)) {
		
		if ($type == 'checkbox') {
			
			$content = (!empty($label)) ? '<div class="usp-label usp-label-taxonomy">'. esc_html($label) .'</div>'. "\n" : '';
			
			foreach ($tax_terms as $tax) {
				
				$checked = '';
				if (is_array($value)) {
					if (in_array($tax['term_id'], $value)) $checked = ' checked';
				} else {
					if (intval($tax['term_id']) === intval($value)) $checked = ' checked';
				}
				
				$content .= '<label for="usp-taxonomy-'. esc_attr($taxonomy) .'" class="usp-checkbox usp-tax">';
				$content .= '<input type="checkbox" name="usp-taxonomy-'. esc_attr($taxonomy) .'[]" id="usp-taxonomy-'. esc_attr($taxonomy) .'" ';
				$content .= 'value="'. esc_attr($tax['term_id']) .'" data-required="'. esc_attr($required) .'" class="'. esc_attr($classes) .'" ';
				$content .= $checked .' '. $custom .'/> '. esc_html($tax['name']) .'</label>' . "\n";
				
			}
			
		} else {
			
			$content = (!empty($label)) ? '<label for="usp-taxonomy-'. esc_attr($taxonomy) .'" class="usp-label usp-label-taxonomy">'. esc_html($label) .'</label>'. "\n" : '';
			
			$content .= '<select name="usp-taxonomy-'. esc_attr($taxonomy) . $brackets .'" id="usp-taxonomy-'. esc_attr($taxonomy) .'" ';
			$content .= $parsley .'data-required="'. esc_attr($required) .'"'. $size . $multiple .' class="'. esc_attr($classes) .' usp-select"';
			$content .= $custom .'>'. "\n" . $default_html;
			
			foreach ($tax_terms as $tax) {
				
				$selected = '';
				if (is_array($value)) {
					if (in_array($tax['term_id'], $value)) $selected = ' selected';
				} else {
					if (intval($tax['term_id']) === intval($value)) $selected = ' selected';
				}
				
				$content .= '<option value="'. esc_attr($tax['term_id']) .'"'. esc_attr($selected) .'>'. esc_html($tax['name']) .'</option>'. "\n";
			}
			
			$content .= '</select>'. "\n";
		}
		
		if ($required == 'true') $content .= '<input type="hidden" name="usp-taxonomy-'. esc_attr($taxonomy) .'-required" value="1" />'. "\n";
		
	} else {
		
		$content = __('No terms found for ', 'usp') . esc_html($taxonomy);
	}
	
	return $fieldset_before . $content . $fieldset_after;
}

add_shortcode('usp_taxonomy', 'usp_input_taxonomy');

endif;


