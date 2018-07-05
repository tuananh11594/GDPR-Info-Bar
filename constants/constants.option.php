<?php

    require_once('constants.php');

    define('GDPR_FONT_FAMILY_TEXT_OPTION', isset( $this->options['gdpr_info_bar_font_family_text'] ) ? esc_attr( $this->options['gdpr_info_bar_font_family_text']) : GDPR_FONT_FAMILY_TEXT);
    
    define('GDPR_FONT_FAMILY_BUTTON_OPTION', isset( $this->options['gdpr_info_bar_font_family_button'] ) ? esc_attr( $this->options['gdpr_info_bar_font_family_button']) : GDPR_FONT_FAMILY_BUTTON);
    
    define('GDPR_URL_OPTION', isset( $this->options['gdpr_info_bar_url'] ) ? esc_attr( $this->options['gdpr_info_bar_url']) : GDPR_URL);
    
    define('GDPR_ELEMENT_NODE_OPTION', isset( $this->options['gdpr_element_node'] ) ? esc_attr( $this->options['gdpr_element_node']) : GDPR_ELEMENT_NODE);
    
    define('GDPR_INSERT_BEFORE_ELEMENT_OPTION', isset( $this->options['gdpr_info_bar_insert_before_element'] ) ? esc_attr( $this->options['gdpr_info_bar_insert_before_element']) : GDPR_INSERT_BEFORE_ELEMENT);
   
    define('GDPR_CUSTOM_CSS_OPTION', isset( $this->options['gdpr_info_bar_custom_css'] ) ? esc_attr( $this->options['gdpr_info_bar_custom_css']) : GDPR_INSERT_CUSTOM_CSS);    

    define('GDPR_CUSTOM_SCRIPT_OPEN_INFO_BAR_OPTION', isset( $this->options['gdpr_info_bar_custom_script_open_info_bar'] ) ? esc_attr( $this->options['gdpr_info_bar_custom_script_open_info_bar']) : GDPR_INSERT_CUSTOM_SCRIPT_OPEN_INFO_BAR);    
    
    define('GDPR_CUSTOM_SCRIPT_CLOSE_INFO_BAR_OPTION', isset( $this->options['gdpr_info_bar_custom_script_close_info_bar'] ) ? esc_attr( $this->options['gdpr_info_bar_custom_script_close_info_bar']) : GDPR_INSERT_CUSTOM_SCRIPT_CLOSE_INFO_BAR);

    define('GDPR_CHECK_CONTENT_PADDING_TOP_OPTION', isset( $this->options['gdpr_info_bar_check_content_padding_top'] ) ? esc_attr( $this->options['gdpr_info_bar_check_content_padding_top']) : GDPR_CHECK_CONTENT_PADDING_TOP);
    
    define('GDPR_CSS_CONTENT_OPTION', isset( $this->options['gdpr_info_bar_css_content'] ) ? esc_attr( $this->options['gdpr_info_bar_css_content']) : GDPR_CSS_CONTENT);
    
    define('GDPR_PADDING_TOP_OPEN_INFO_BAR_OPTION', isset( $this->options['gdpr_info_bar_content_padding_top_open_info_bar'] ) ? esc_attr( $this->options['gdpr_info_bar_content_padding_top_open_info_bar']) : GDPR_PADDING_TOP_OPEN_INFO_BAR);
    
    define('GDPR_FONT_SIZE_BUTTON_OPTION', isset( $this->options['gdpr_info_bar_font_size_button'] ) ? esc_attr( $this->options['gdpr_info_bar_font_size_button']) : GDPR_FONT_SIZE_BUTTON);
    
    define('GDPR_FONT_SIZE_TEXT_OPTION', isset( $this->options['gdpr_info_bar_font_size_text'] ) ? esc_attr( $this->options['gdpr_info_bar_font_size_text']) : GDPR_FONT_SIZE_TEXT);
    
?>
