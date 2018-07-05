<?php 
/**
 * Plugin Name: GDPR Info Bar
 * Plugin URI: https://niteco.se
 * Description: GDPR Info Bar.
 * Version: 1.0.2
 * Author: Tuan Anh
 * Author URI: https://niteco.se
 */

if( !class_exists('GDPR_Info_Bar' )) {

    class GDPR_Info_Bar {

        function __construct() {
            require_once('constants/constants.php');

            $this->options = get_option( 'gdpr-info-bar-option' );                       
            
            add_action( 'init', array( $this, 'add_shortcode_gdpr_info_bar') );   
            add_action( 'init', array( $this, 'insert_infor_bar_with_element') );               

            add_action( 'admin_menu', array( $this, 'menu_gdpr_info_bar_setting_page' ) );
            add_action( 'admin_init', array( $this, 'page_init' ) );
        }

        function add_shortcode_gdpr_info_bar() {
            add_shortcode('ni_short_code_gdpr_info_bar', array($this, 'show_info_bar'));
        }

        function insert_infor_bar_with_element() {
            if ( is_admin() ) {
                return;
            }
            require_once('constants/constants.option.php');
            if (GDPR_ELEMENT_NODE_OPTION != '') {
                $this->render_gdpr_info_bar();                            
                ?>
                    <script type="text/javascript">
                        insertBeforeElement('<?php echo GDPR_ELEMENT_NODE_OPTION; ?>', '<?php echo GDPR_INSERT_BEFORE_ELEMENT_OPTION; ?>');
                    </script>
                <?php
            }
        }

        function render_gdpr_info_bar() {
            require_once('css/gdpr.css.php');
            require_once('js/gdpr-info-bar-script.php');                        
            ?>
                <div  class="container-fluid container-nav" id="gdpr-nav-element" value="">
		            <div class="gdpr-nav-text">Vi har förtydligat hur vi hanterar personuppgifter och cookies.</div> 
		            <div class="gdpr-nav-button-group">
			            <a href="<?php echo GDPR_URL_OPTION ?>" target="_blank"><input type="button" class="gdpr-nav-button gdpr-nav-button-red" value="Läs mer"></a>
			            <a href="javascript:void(0)"><input type="button" class="gdpr-nav-button js-gdpr-nav-button-close" value="Stäng" id="button-turn-of-info-bar" onClick="closeInfoBar()"></a>			
		            </div>
	            </div> 
            <?php
        }

        function show_info_bar() {
            $this->render_gdpr_info_bar();
            ?>    
            <script>
                showInfoBar();
            </script>
            <?php
        }

        public function menu_gdpr_info_bar_setting_page() {
            add_options_page(
                'Settings Admin', 
                'GDPR Info Bar', 
                'manage_options', 
                'gdpr-info-bar-setting', 
                array( $this, 'create_menu_gdpr_info_bar_page_setting_page' )
            );
        }
            
        public function create_menu_gdpr_info_bar_page_setting_page() {
            ?>
            <style>
                .column-setting-label {
                    margin-left:20px;
                }
                .column-setting-content {
                    margin-left:5px;
                }
            </style>
            <div class="wrap">
                <h1>GDPR Info Bar Settings</h1>
                <form method="post" action="options.php">
                <?php
                    settings_fields( 'gdpr-info-bar-option-group' );
                    do_settings_sections( 'gdpr-info-bar-setting' );
                    submit_button();
                ?>
                </form>
            </div>
            <?php
        }

        public function page_init()
        {        
            register_setting(
                'gdpr-info-bar-option-group', 
                'gdpr-info-bar-option',
                array( $this, 'sanitize' )
            );

            add_settings_section(
                'setting_section_common', 
                'Common',
                null, 
                'gdpr-info-bar-setting' 
            );  

            add_settings_field(
                'gdpr_info_bar_url', 
                'Link GDPR',
                array( $this, 'gdpr_url_callback' ), 
                'gdpr-info-bar-setting',
                'setting_section_common'
            );

            add_settings_field(
                'gdpr_element_node', 
                'Insert info bar inside HTML container Id',
                array( $this, 'gdpr_element_node_callback' ), 
                'gdpr-info-bar-setting',
                'setting_section_common'
            );

            add_settings_field(
                'gdpr_info_bar_insert_before_element', 
                'Insert info bar before HTML element Id',
                array( $this, 'gdpr_insert_before_element_callback' ), 
                'gdpr-info-bar-setting',
                'setting_section_common'
            );

            add_settings_field(
                'gdpr_info_bar_custom_css', 
                'Custom CSS',
                array( $this, 'gdpr_custom_css_callback' ), 
                'gdpr-info-bar-setting',
                'setting_section_common'
            );

            add_settings_field(
                'gdpr_info_bar_custom_script_open_info_bar', 
                'Custom script - after displaying info bar',
                array( $this, 'gdpr_custom_script_open_info_bar_callback' ), 
                'gdpr-info-bar-setting',
                'setting_section_common'
            );

            add_settings_field(
                'gdpr_info_bar_custom_script_close_info_bar', 
                'Custom script - after closing info bar',
                array( $this, 'gdpr_custom_script_close_info_bar_callback' ), 
                'gdpr-info-bar-setting',
                'setting_section_common'
            );

            add_settings_section(
                'content_padding_top', 
                'Main content position adjustment',
                null, 
                'gdpr-info-bar-setting' 
            );  

            add_settings_field(
                'gdpr_info_bar_check_content_padding_top', 
                'Adjust main HTML content position when displaying info bar',
                array( $this, 'gdpr_check_content_pading_top_callback' ), 
                'gdpr-info-bar-setting',
                'content_padding_top'
            );

            add_settings_field(
                'gdpr_info_bar_css_content', 
                'CSS class of main content element to adjust',
                array( $this, 'gdpr_css_content_callback' ), 
                'gdpr-info-bar-setting',
                'content_padding_top'
            );

            add_settings_field(
                'gdpr_info_bar_content_padding_top_open_info_bar', 
                'Adjusted padding top',
                array( $this, 'gdpr_padding_top_open_info_bar_callback' ), 
                'gdpr-info-bar-setting',
                'content_padding_top'
            );

            add_settings_section(
                'setting_style_info_bar', 
                'Style',
                null, 
                'gdpr-info-bar-setting' 
            ); 
            
            add_settings_field(
                'gdpr_info_bar_font_family_text', 
                'Text - Font family',
                array( $this, 'font_family_text_callback' ), 
                'gdpr-info-bar-setting',
                'setting_style_info_bar'
            );

            add_settings_field(
                'gdpr_info_bar_font_size_text', 
                'Text - Font size',
                array( $this, 'gdpr_font_size_text_callback' ), 
                'gdpr-info-bar-setting',
                'setting_style_info_bar'
            );

            add_settings_field(
                'gdpr_info_bar_font_family_button', 
                'Button - Font family',
                array( $this, 'font_family_button_callback' ), 
                'gdpr-info-bar-setting',
                'setting_style_info_bar'
            );

            add_settings_field(
                'gdpr_info_bar_font_size_button', 
                'Button - Font size',
                array( $this, 'gdpr_font_size_button_callback' ), 
                'gdpr-info-bar-setting',
                'setting_style_info_bar'
            );

        }

        public function sanitize( $input ) {
            $new_input = array();

            if( isset( $input['gdpr_info_bar_font_family_button'] ) )
            $new_input['gdpr_info_bar_font_family_button'] = sanitize_text_field( $input['gdpr_info_bar_font_family_button'] );

            if( isset( $input['gdpr_info_bar_font_family_text'] ) )
            $new_input['gdpr_info_bar_font_family_text'] = sanitize_text_field( $input['gdpr_info_bar_font_family_text'] );

            if( isset( $input['gdpr_info_bar_url'] ) )
            $new_input['gdpr_info_bar_url'] = sanitize_text_field( $input['gdpr_info_bar_url'] );

            if( isset( $input['gdpr_element_node'] ) )
            $new_input['gdpr_element_node'] = sanitize_text_field( $input['gdpr_element_node'] );

            if( isset( $input['gdpr_info_bar_insert_before_element'] ) )
            $new_input['gdpr_info_bar_insert_before_element'] = sanitize_text_field( $input['gdpr_info_bar_insert_before_element'] );

            if( isset( $input['gdpr_info_bar_custom_css'] ) )
            $new_input['gdpr_info_bar_custom_css'] = sanitize_text_field( $input['gdpr_info_bar_custom_css'] );

            if( isset( $input['gdpr_info_bar_custom_script_open_info_bar'] ) )
            $new_input['gdpr_info_bar_custom_script_open_info_bar'] = sanitize_text_field( $input['gdpr_info_bar_custom_script_open_info_bar'] );
                       
            if( isset( $input['gdpr_info_bar_custom_script_close_info_bar'] ) )
            $new_input['gdpr_info_bar_custom_script_close_info_bar'] = sanitize_text_field( $input['gdpr_info_bar_custom_script_close_info_bar'] );

            if( isset( $input['gdpr_info_bar_check_content_padding_top'] ) )
            $new_input['gdpr_info_bar_check_content_padding_top'] = isset( $input['gdpr_info_bar_check_content_padding_top'] ) ? absint( $input['gdpr_info_bar_check_content_padding_top'] ) : GDPR_CHECK_CONTENT_PADDING_TOP;

            if( isset( $input['gdpr_info_bar_css_content'] ) )
            $new_input['gdpr_info_bar_css_content'] = sanitize_text_field( $input['gdpr_info_bar_css_content'] );

            if( isset( $input['gdpr_info_bar_content_padding_top_open_info_bar'] ) )
            $new_input['gdpr_info_bar_content_padding_top_open_info_bar'] = sanitize_text_field( $input['gdpr_info_bar_content_padding_top_open_info_bar'] );

            if( isset( $input['gdpr_info_bar_content_padding_top_close_info_bar'] ) )
            $new_input['gdpr_info_bar_content_padding_top_close_info_bar'] = sanitize_text_field( $input['gdpr_info_bar_content_padding_top_close_info_bar'] );

            if( isset( $input['gdpr_info_bar_font_size_text'] ) )
            $new_input['gdpr_info_bar_font_size_text'] = sanitize_text_field( $input['gdpr_info_bar_font_size_text'] );

            if( isset( $input['gdpr_info_bar_font_size_button'] ) )
            $new_input['gdpr_info_bar_font_size_button'] = sanitize_text_field( $input['gdpr_info_bar_font_size_button'] );

            return $new_input;

        }

        public function font_family_button_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_font_family_button" name="gdpr-info-bar-option[gdpr_info_bar_font_family_button]" value="%s" size="90"/>',
                isset( $this->options['gdpr_info_bar_font_family_button'] ) ? esc_attr( $this->options['gdpr_info_bar_font_family_button']) : GDPR_FONT_FAMILY_BUTTON 
            );
        }

        public function font_family_text_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_font_family_text" name="gdpr-info-bar-option[gdpr_info_bar_font_family_text]" value="%s" size="90"/>',
                isset( $this->options['gdpr_info_bar_font_family_text'] ) ? esc_attr( $this->options['gdpr_info_bar_font_family_text']) : GDPR_FONT_FAMILY_TEXT
            );
        }

        public function gdpr_url_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_url" name="gdpr-info-bar-option[gdpr_info_bar_url]" value="%s" size="30"/>',
                isset( $this->options['gdpr_info_bar_url'] ) ? esc_attr( $this->options['gdpr_info_bar_url']) : GDPR_URL
            );
        }

        public function gdpr_element_node_callback() {
            printf(
                '<input type="text" id="gdpr_element_node" name="gdpr-info-bar-option[gdpr_element_node]" value="%s" size="30"/>',
                isset( $this->options['gdpr_element_node'] ) ? esc_attr( $this->options['gdpr_element_node']) : GDPR_INSERT_BEFORE_ELEMENT
            );
        }

        public function gdpr_insert_before_element_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_insert_before_element" name="gdpr-info-bar-option[gdpr_info_bar_insert_before_element]" value="%s" size="30"/>',
                isset( $this->options['gdpr_info_bar_insert_before_element'] ) ? esc_attr( $this->options['gdpr_info_bar_insert_before_element']) : GDPR_INSERT_BEFORE_ELEMENT
            );
        }

        public function gdpr_custom_css_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_custom_css" name="gdpr-info-bar-option[gdpr_info_bar_custom_css]" value="%s" size="100" />',
                isset( $this->options['gdpr_info_bar_custom_css'] ) ? esc_attr( $this->options['gdpr_info_bar_custom_css']) : GDPR_INSERT_CUSTOM_SCRIPT_OPEN_INFO_BAR
            );
        }

        public function gdpr_custom_script_open_info_bar_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_custom_script_open_info_bar" name="gdpr-info-bar-option[gdpr_info_bar_custom_script_open_info_bar]" value="%s" size="100" />',
                isset( $this->options['gdpr_info_bar_custom_script_open_info_bar'] ) ? esc_attr( $this->options['gdpr_info_bar_custom_script_open_info_bar']) : GDPR_INSERT_CUSTOM_SCRIPT_OPEN_INFO_BAR
            );
        }

        public function gdpr_custom_script_close_info_bar_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_custom_script_close_info_bar" name="gdpr-info-bar-option[gdpr_info_bar_custom_script_close_info_bar]" value="%s" size="100"/>',
                isset( $this->options['gdpr_info_bar_custom_script_close_info_bar'] ) ? esc_attr( $this->options['gdpr_info_bar_custom_script_close_info_bar']) : GDPR_INSERT_CUSTOM_SCRIPT_CLOSE_INFO_BAR
            );
        }

        public function gdpr_check_content_pading_top_callback() {
            echo '<input type="checkbox" name="gdpr-info-bar-option[gdpr_info_bar_check_content_padding_top]" ' . checked( isset( $this->options['gdpr_info_bar_check_content_padding_top']) ? $this->options['gdpr_info_bar_check_content_padding_top'] : GDPR_CHECK_CONTENT_PADDING_TOP, 1, false ) . ' value="1">';
        }

        public function gdpr_css_content_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_css_content" name="gdpr-info-bar-option[gdpr_info_bar_css_content]" value="%s" size="30"/>',
                isset( $this->options['gdpr_info_bar_css_content'] ) ? esc_attr( $this->options['gdpr_info_bar_css_content']) : GDPR_CSS_CONTENT
            );
        }

        public function gdpr_padding_top_open_info_bar_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_content_padding_top_open_info_bar" name="gdpr-info-bar-option[gdpr_info_bar_content_padding_top_open_info_bar]" value="%s" size="30"/>',
                isset( $this->options['gdpr_info_bar_content_padding_top_open_info_bar'] ) ? esc_attr( $this->options['gdpr_info_bar_content_padding_top_open_info_bar']) : GDPR_PADDING_TOP_OPEN_INFO_BAR
            );
        }

        public function gdpr_font_size_text_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_font_size_text" name="gdpr-info-bar-option[gdpr_info_bar_font_size_text]" value="%s" size="30"/>',
                isset( $this->options['gdpr_info_bar_font_size_text'] ) ? esc_attr( $this->options['gdpr_info_bar_font_size_text']) : GDPR_FONT_SIZE_TEXT
            );
        }

        public function gdpr_font_size_button_callback() {
            printf(
                '<input type="text" id="gdpr_info_bar_font_size_button" name="gdpr-info-bar-option[gdpr_info_bar_font_size_button]" value="%s" size="30"/>',
                isset( $this->options['gdpr_info_bar_font_size_button'] ) ? esc_attr( $this->options['gdpr_info_bar_font_size_button']) : GDPR_FONT_SIZE_BUTTON
            );
        }

    }
}

new GDPR_Info_Bar();
?>
