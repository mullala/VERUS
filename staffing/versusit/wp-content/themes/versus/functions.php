<?php
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {     
    $optionsframework_settings = get_option('optionsframework');     
    // Gets the unique option id
    $option_name = $optionsframework_settings['id'];   
    if ( get_option($option_name) ) {
        $options = get_option($option_name);
    }
    
    if ( isset($options[$name]) ) {
        return $options[$name];
    } else {
        return $default;
    }
}
}
?>