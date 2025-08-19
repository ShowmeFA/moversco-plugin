<?php

class MVCO_Settings {
    private $option_name = 'moversco_form_settings';

    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
    }

    // Register settings
    function register_settings() {
        
        register_setting('moversco_styles_options', 'moversco_form_background_color');
        register_setting('moversco_styles_options', 'moversco_buttons_color');
        register_setting('moversco_styles_options', 'moversco_buttons_hover_color');
        register_setting('moversco_styles_options', 'moversco_button_text_color');
        register_setting('moversco_styles_options', 'moversco_text_hover_color'); // New field for Text Hover Color
        register_setting('moversco_styles_options', 'moversco_border_color');
        register_setting('moversco_styles_options', 'moversco_border_hover_color');
        register_setting('moversco_styles_options', 'moversco_font_size');
        register_setting('moversco_form_settings_group', 'moversco_email_for_customer');
        register_setting('moversco_form_settings_group', 'moversco_email_subject_for_customer');
        register_setting('moversco_form_settings_group', 'moversco_email_subject_for_staff');
        register_setting('moversco_form_settings_group', 'checkout_page_url');
        register_setting('moversco_form_settings_group', 'moversco_emails_for_notifications');
        register_setting('moversco_form_gdpr_group', 'privacy_toestemming');
        register_setting('moversco_form_gdpr_group', 'voorwaarden_kennisname');
        register_setting('moversco_postcode_api_group', 'moversco_postcode_api_key');

    }

}
