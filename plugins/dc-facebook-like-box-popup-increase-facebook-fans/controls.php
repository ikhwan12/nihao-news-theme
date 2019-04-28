<?php
function wp_facebook_popup_settings_get_control($type, $required = false, $label, $id, $name, $value = '',  $data = null, $info = '', $style = 'input widefat') {
	switch($type) {
		case 'text':
			$output = '<p>';
				$output .= '<label for="'.$name.'">'.$label.'</label>:';
				$output .= '<input type="text" '.(($required)?'required':'').' id="'.$id.'" name="'.$name.'" value="'.$value.'" class="multilanguage-input '.$style.'">';
				if($info != '') {
					$output .= '<small>'.$info.'</small>';
				}
			$output .= '</p>';
			break;
		case 'checkbox':
			$output = '<p>';			
				$output .= '<input type="checkbox" '.(($required)?'required':'').' id="'.$id.'" name="'.$name.'" value="1" class="input" '.checked($value, 1, false).' />';
				if($label != '') {
					$output .= '<label for="'.$name.'">'.$label.'</label>';	
				}
				if($info != '') {
					$output .= '<br /><small>'.$info.'</small>';
				}
			$output .= '</p>';
			break;	
		case 'textarea':
			$output = '<p>';
				$output .= '<label for="'.$name.'">'.$label.'</label>:<br />';
				$output .= '<textarea '.(($required)?'required':'').' id="'.$id.'" name="'.$name.'" class="multilanguage-input '.$style.'" style="height: 100px;">'.$value.'</textarea>';	
				if($info != '') {
					$output .= '<small>'.$info.'</small>';
				}
			$output .= '</p>';
			break;
		case 'select':
			$output = '<p>';
				$output .= '<label for="'.$name.'">'.$label.'</label>:';
				$output .= '<select '.(($required)?'required':'').' id="'.$id.'" name="'.$name.'" class="'.$style.'">';
				if($data) {
					foreach($data as $option) {
						$output .= '<option value="'.$option['value'].'" '.selected($value, $option['value'], false).'>'.$option['text'].'</option>';
					}
				}
				$output .= '</select>';
				if($info != '') {
					$output .= '<small>'.$info.'</small>';
				}
			$output .= '</p>';
			break;
		case 'upload':
			$output = '<p>';
				$output .= '<label for="'.$name.'">'.$label.'</label>:<br />';
				$output .= '<input '.(($required)?'required':'').' type="text" id="'.$id.'" name="'.$name.'" value="'.$value.'" class="'.$style.'" style="width: 74%;" />';
				$output .= '<input type="button" value="Upload Image" class="wp_multisite_theme_options_uploader_button" id="upload_image_button" style="width: 25%;" />';
				if($info != '') {
					$output .= '<small>'.$info.'</small>';
				}
			$output .= '</p>';
			break;
		case 'color':
			$output = '<p>';
				$output .= '<label for="'.$name.'">'.$label.'</label>:';
				$output .= '<input type="text" '.(($required)?'required':'').' pattern="^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="'.$id.'" name="'.$name.'" value="'.$value.'" class="colorpicker '.$style.'">';
				if($info != '') {
					$output .= '<small>'.$info.'</small>';
				}
			$output .= '</p>';
			break;
	}
	return $output;
}
?>