<?php
class AdminMenu {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'MoversCo Settings',
            'MoversCo',
            'manage_options',
            'moversco_settings',
            [$this, 'settings_page'],
            'dashicons-admin-generic',
            100
        );

        add_submenu_page(
            'moversco_settings',
            'API Settings',
            'API Settings',
            'manage_options',
            'moversco_api_settings_page',
            [$this, 'moversco_api_settings_page']
        );

        add_submenu_page(
            'moversco_settings',
            'Google Maps API Settings',
            'Google Maps API',
            'manage_options',
            'moversco_google_maps_api',
            [$this, 'google_maps_api_settings_page']
        );
        
        add_submenu_page(
            'moversco_settings',
            'GDPR Settings',
            'GDPR Settings',
            'manage_options',
            'moversco_gdpr_settings',
            [$this, 'moversco_form_gdpr_page']
        );

        add_submenu_page(
            'moversco_settings',
            'License Activation',
            'License Activation',
            'manage_options',
            'moversco_license_activation',
            [$this, 'moversco_license_page']
        );

        add_submenu_page(
            'moversco_settings',
            'Form Style Settings',
            'Form Style Settings',
            'manage_options',
            'moversco_form_settings',
            [$this, 'moversco_styles_page']
        );

        add_submenu_page(
            'moversco_settings',
            'Postcode API Settings',
            'Postcode API',
            'manage_options',
            'moversco_postcode_api',
            [$this, 'render_settings_page']
        );

    }

    // Callback for Form Settings Page
    function settings_page() {
        // Render the main settings page
        ob_start();
        require_once MOVERSCO_FORM_DIR . 'includes/admin/partials/admin-settings-page.php';
        $content = ob_get_clean();  
        echo $content;    
    }

     public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Postcode API Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('moversco_postcode_api_group');
                $api_key = get_option('moversco_postcode_api_key', '');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">API Key</th>
                        <td><input type="text" name="<?php echo esc_attr('moversco_postcode_api_key'); ?>" value="<?php echo esc_attr($api_key); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    // Callback for API Settings Page
    function moversco_api_settings_page() {
        if (isset($_POST['moversco_save_api_settings'])) {
            update_option('moversco_api_endpoint', sanitize_text_field($_POST['moversco_api_endpoint']));
            update_option('moversco_api_key', sanitize_text_field($_POST['moversco_api_key']));
            echo '<div class="updated"><p>' . esc_html__('API settings saved.', 'moversco-form') . '</p></div>';
        }

        $api_endpoint = get_option('moversco_api_endpoint', '');
        $api_key = get_option('moversco_api_key', '');

        echo '<div class="wrap"><h1>' . esc_html__('API Settings', 'moversco-form') . '</h1>';
        echo '<form method="post">';
        echo '<table class="form-table">';
        echo '<tr><th>' . esc_html__('API Endpoint URL', 'moversco-form') . '</th>';
        echo '<td><input type="text" name="moversco_api_endpoint" value="' . esc_attr($api_endpoint) . '" class="regular-text" /></td></tr>';
        echo '<tr><th>' . esc_html__('API Key', 'moversco-form') . '</th>';
        echo '<td><input type="text" name="moversco_api_key" value="' . esc_attr($api_key) . '" class="regular-text" /></td></tr>';
        echo '</table>';
        echo '<p><input type="submit" name="moversco_save_api_settings" class="button-primary" value="' . esc_attr__('Save Settings', 'moversco-form') . '" /></p>';
        echo '</form></div>';
    }

    function google_maps_api_settings_page() {
        // Ensure the user has the capability to access this page
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        // If the form is submitted, save the API key
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            // Security check: verify the nonce
            check_admin_referer( 'moversco_google_maps_api_save_action', 'moversco_google_maps_api_nonce_field' );

            // Sanitize and save the API key
            $google_maps_api_key = sanitize_text_field( $_POST['moversco_google_maps_api_key'] ?? '' );
            update_option( 'moversco_google_maps_api_key', $google_maps_api_key );

            // Success message
            echo '<div class="updated notice is-dismissible"><p><strong>Google Maps API Key Saved!</strong></p></div>';
        }

        // Retrieve the existing key to display in the form
        $saved_key = get_option( 'moversco_google_maps_api_key', '' );
        ?>

        <div class="wrap">
            <h1>Google Maps API Settings</h1>
            <form method="POST">
                <?php 
                // Generate a nonce field for security
                wp_nonce_field( 'moversco_google_maps_api_save_action', 'moversco_google_maps_api_nonce_field' ); 
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="moversco_google_maps_api_key">Google Maps API Key</label>
                        </th>
                        <td>
                            <input 
                                type="password" 
                                name="moversco_google_maps_api_key" 
                                id="moversco_google_maps_api_key" 
                                value="<?php echo esc_attr( $saved_key ); ?>" 
                                class="regular-text"
                            />
                            <p class="description">Enter your Google Maps API key here.</p>
                        </td>
                    </tr>
                </table>
                <?php submit_button( 'Save Google Maps API Key' ); ?>
            </form>
        </div>

        <?php
    }

    // Callback for Form Settings Page
    function moversco_form_gdpr_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('Form GDPR Settings', 'moversco-form'); ?></h1>
            <form method="post" action="options.php">
                <?php
                // Register settings
                settings_fields('moversco_form_gdpr_group');
                do_settings_sections('moversco_form_gdpr_group');

                // Email for Customer Editor
                ?>
                
                <h2><?php _e('Privacy Toestemming', 'moversco-form'); ?></h2>
                <?php
                    wp_editor(get_option('privacy_toestemming'), 'privacy_toestemming', [
                    'textarea_name' => 'privacy_toestemming',
                    'textarea_rows' => 10,
                    ]);
                ?>

                <h2><?php _e('Voorwaarden Kennisname', 'moversco-form'); ?></h2>

                <?php
                wp_editor(get_option('voorwaarden_kennisname'), 'voorwaarden_kennisname', [
                    'textarea_name' => 'voorwaarden_kennisname',
                    'textarea_rows' => 10,
                ]);
                
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    // Callback for License Page
    function moversco_license_page() {
        if (isset($_POST['moversco_save_license'])) {
            $license_key = sanitize_text_field($_POST['moversco_license_key']); // Replace with the license key you want to check
            $result = moversco_validate_license_key($license_key);
            if($result == 'active'){
            update_option( 'moversco_license_status', $result );
            update_option('moversco_license_key', sanitize_text_field($_POST['moversco_license_key']));
            echo '<div class="updated"><p>' . esc_html__('License key saved and Activated.', 'moversco-form') . '</p></div>';
            }else{
            update_option( 'moversco_license_status', 'Inactive' );
            update_option('moversco_license_key', sanitize_text_field($_POST['moversco_license_key']));
            echo '<div class="error"><p>' . esc_html__('License key is invalid or activation failed.', 'moversco-form') . '</p></div>';

            }
        }

        $license_key = get_option('moversco_license_key', '');
        $lis_status = get_option( 'moversco_license_status', 'Inactive' );

        echo '<div class="wrap"><h1>' . esc_html__('License Activation', 'moversco-form') . '</h1>';
        echo '<form method="post">';
        echo '<table class="form-table">';
        echo '<tr><th>' . esc_html__('License Key', 'moversco-form') . '</th>';
        echo '<td><input type="password" name="moversco_license_key" value="' . esc_attr($license_key) . '" class="regular-text" /></td></tr>';

        echo '<tr><th>' . esc_html__('License Status', 'moversco-form') . '</th>';
        echo '<td>' . esc_attr($lis_status) . '</td></tr>';

        echo '</table>';
        echo '<p><input type="submit" name="moversco_save_license" class="button-primary" value="' . esc_attr__('Activate License', 'moversco-form') . '" /></p>';
        echo '</form></div>';
    }

    // Callback for Styles Page
    function moversco_styles_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Styles Settings', 'moversco-form'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('moversco_styles_options');
            do_settings_sections('moversco_styles_options');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Form Progress Color', 'moversco-form'); ?></th>
                    <td>
                        <input type="color" name="moversco_form_background_color" value="<?php echo esc_attr(get_option('moversco_form_background_color')); ?>" class="color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Buttons Color', 'moversco-form'); ?></th>
                    <td>
                        <input type="color" name="moversco_buttons_color" value="<?php echo esc_attr(get_option('moversco_buttons_color')); ?>" class="color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Buttons Hover Color', 'moversco-form'); ?></th>
                    <td>
                        <input type="color" name="moversco_buttons_hover_color" value="<?php echo esc_attr(get_option('moversco_buttons_hover_color')); ?>" class="color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Button Text Color', 'moversco-form'); ?></th>
                    <td>
                        <input type="color" name="moversco_button_text_color" value="<?php echo esc_attr(get_option('moversco_button_text_color')); ?>" class="color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Text Hover Color', 'moversco-form'); ?></th> <!-- New field for Text Hover Color -->
                    <td>
                        <input type="color" name="moversco_text_hover_color" value="<?php echo esc_attr(get_option('moversco_text_hover_color')); ?>" class="color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Border Color', 'moversco-form'); ?></th>
                    <td>
                        <input type="color" name="moversco_border_color" value="<?php echo esc_attr(get_option('moversco_border_color')); ?>" class="color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Border Hover Color', 'moversco-form'); ?></th>
                    <td>
                        <input type="color" name="moversco_border_hover_color" value="<?php echo esc_attr(get_option('moversco_border_hover_color')); ?>" class="color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('Font Size', 'moversco-form'); ?></th>
                    <td>
                        <input type="number" name="moversco_font_size" value="<?php echo esc_attr(get_option('moversco_font_size')); ?>" class="small-text" /> px
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
    }

}