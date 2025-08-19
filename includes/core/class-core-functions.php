<?php
/**
 * Core Functions Class
 *
 * @package MoversCoForm
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class MoversCoForm_Core_Functions {
    
    /**
     * Initialize the class
     */
    public function __construct() {
        register_activation_hook(MOVERSCO_FORM_FILE, array($this, 'activate'));
        add_action('wp_ajax_Form_moversco_submit', [$this, 'moversco_handle_ajax_request']);
        add_action('wp_ajax_nopriv_Form_moversco_submit', [$this, 'moversco_handle_ajax_request']);
    }

    /**
     * Activation handler
     */
    public function activate() {
        $this->create_tables();
    }

    /**
     * Create required database tables
     */
    private function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        // Table names with WordPress prefix
        $table_moving_orders = $wpdb->prefix . 'moving_orders';
        $table_addresses = $wpdb->prefix . 'addresses';

        // SQL to create the moving orders table
        $sql_moving_orders = "CREATE TABLE $table_moving_orders (
            order_id INT NOT NULL AUTO_INCREMENT,
            session_id VARCHAR(255) NOT NULL,
            first_name VARCHAR(100) NOT NULL,
            sur_name VARCHAR(100) NOT NULL,
            telephone VARCHAR(20),
            number_of_addresses VARCHAR(255),
            submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            email_address VARCHAR(255),
            salutation VARCHAR(50),
            typeklant VARCHAR(50),
            businessname VARCHAR(255),
            preferred_date VARCHAR(255),
            comments TEXT,
            verhuislift VARCHAR(255) DEFAULT 'No',
            Verhuizers VARCHAR(20) DEFAULT 'Yes',
            total_products VARCHAR(255) DEFAULT NULL,
            total_area DOUBLE,
            number_of_items INT,
            Verhuiswagen VARCHAR(20) DEFAULT 'Yes',
            packing_boxes VARCHAR(20) DEFAULT 'No',
            total_boxes VARCHAR(20),
            moving_lift VARCHAR(255) DEFAULT 'No',
            disassembly_work VARCHAR(255) DEFAULT 'No',
            disassembly_products TEXT,
            products TEXT,
            form_link TEXT,
            privacy_toestemming VARCHAR(20) DEFAULT 'No',
            voorwaarden_kennisname VARCHAR(20) DEFAULT 'No',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (order_id)
        ) $charset_collate;";

        // SQL to create the addresses table
        $sql_addresses = "CREATE TABLE $table_addresses (
            address_id INT NOT NULL AUTO_INCREMENT,
            order_id INT NOT NULL,
            address_type ENUM('startadres', 'eindadres', 'tussenadres-1', 'tussenadres-2') NOT NULL,
            full_address VARCHAR(255) NOT NULL,
            property_type VARCHAR(100),
            house_floor VARCHAR(155),
            lift VARCHAR(155) DEFAULT 'No',
            distance_from_parking VARCHAR(20),
            latitude DECIMAL(10,7),
            longitude DECIMAL(10,7),
            country VARCHAR(100),
            postal VARCHAR(20),
            housenumber VARCHAR(20),
            plaats VARCHAR(100),
            straat VARCHAR(100),
            PRIMARY KEY (address_id),
            UNIQUE KEY unique_address_type_per_order (order_id, address_type),
            KEY order_id (order_id),
            CONSTRAINT fk_order FOREIGN KEY (order_id) REFERENCES $table_moving_orders(order_id) ON DELETE CASCADE
        ) $charset_collate;";

        // Include WordPress upgrade functions
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Create/update tables
        dbDelta($sql_moving_orders);
        dbDelta($sql_addresses);

        // Log any errors
        if (!empty($wpdb->last_error)) {
            error_log("MoversCoForm table creation error: " . $wpdb->last_error);
        }
    }

    public function moversco_handle_ajax_request() {

        global $wpdb;

        $form_data = $_POST['formData'];

        // 1) Grab the order ID and table name
        $order_id     = $form_data['formID'];
        $orders_table = $wpdb->prefix . 'moving_orders';

        // 2) Define labels for your order fields
        $order_map = [
            'first_name'           => 'Naam',
            'sur_name'             => 'Achternaam',
            'telephone'            => 'Telefoon',
            'email_address'        => 'E-mail adres',
            'salutation'           => 'Aanhef',
            'typeklant'            => 'Type klant',
            'businessname'         => 'Bedrijfsnaam',
            'preferred_date'       => 'Voorkeursverhuisdatum',
            'comments'             => 'Vragen of opmerkingen',
            'verhuislift'          => 'Verhuislift nodig?',
            'Verhuizers'           => 'Verhuiswagen nodig?',
            'Verhuiswagen'         => 'Verhuizers nodig?',
            'packing_boxes'        => 'Inpakken in dozen?',
            'total_boxes'          => 'Aantal dozen',
            'disassembly_work'     => '(De)montagewerk',
            'products'             => 'Inventarislijst',
            'disassembly_products' => '(De)montagewerk items',
            'number_of_addresses'  => 'Aantal adresstops',
            'submission_date'      => 'Datum van aanvraag',
            'total_products'       => 'Totaal aantal producten',
            'number_of_items'      => 'Aantal artikelen',
            'total_area'           => 'Kubieke meters (m³)',
            'voorwaarden_kennisname' => 'Voorwaarden Kennisname',
            'privacy_toestemming'   => 'Privacy Toestemming',
            'form_link'            => 'form_link',
        ];
        
        // 3) Define labels for your address fields
        $address_map = [
            'full_address'          => 'Volledig adres',
            'property_type'         => 'Type woning',
            'house_floor'           => 'Verdieping(en)',
            'lift'                  => 'Interne lift aanwezig?',
            'distance_from_parking' => 'Afstand parkeerplek–voordeur',
            'latitude'              => 'Latitude',
            'longitude'             => 'Longitude',
            'country'               => 'Land',
            'postal'                => 'Postcode',
            'housenumber'           => 'Huisnummer',
            'plaats'                => 'Plaatsnaam',
            'straat'                => 'Straatnaam',
        ];

        // 4) Fetch the main order record
        $record = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM `{$orders_table}` WHERE order_id = %d",
                $order_id
            ),
            ARRAY_A
        );
        if ( ! $record || empty( $record['email_address'] ) ) {
            return;
        }
            // 5) Fetch all related addresses
        $addr_types = [ 'startadres', 'tussenadres-1', 'tussenadres-2', 'eindadres' ];
        $rows = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM `{$wpdb->prefix}addresses` WHERE order_id = %d",
                $order_id
            ),
            ARRAY_A
        );
        $addresses = [];
        foreach ( $rows as $r ) {
            $addresses[ $r['address_type'] ] = $r;
        }

        // 6) Load your raw template from options
        $template = get_option( 'moversco_email_for_customer', '' );
        $subject = get_option( 'moversco_email_subject_for_customer', '' );
        $subjectStaff = get_option('moversco_email_subject_for_staff', '');
        $checkoutURL = get_option( 'checkout_page_url', '' );

        // 7) Pre-generate the two HTML blocks for products and disassembly
        $products_html  = '';
        $dismantle_html = '';

        if ( strpos( $template, '{products}' ) !== false ) {
            $inv = maybe_unserialize( $record['products'] );
            if ( is_array( $inv ) ) {
                $products_html .= '<h3>Inventarislijst</h3><ul>';
                foreach ( $inv as $item ) {
                    $n = esc_html( get_the_title( $item['ProductID'] ) );
                    $q = intval( $item['ProductQuantity'] );
                    $a = esc_html( $item['ProductArea'] );
                    $products_html .= "<li>{$n} — {$q} stuks, {$a} m³</li>";
                }
                $products_html .= '</ul>';
            }
        }

        if ( strpos( $template, '{disassembly_products}' ) !== false ) {
            $dis = maybe_unserialize( $record['disassembly_products'] );
            if ( is_array( $dis ) ) {
                $dismantle_html .= '<h3>(De)montagewerk items</h3><ul>';
                foreach ( $dis as $item ) {
                    $n = esc_html( $item['productName'] );
                    $q = intval( $item['quantity'] );
                    $dismantle_html .= "<li>{$n} — {$q} stuks</li>";
                }
                $dismantle_html .= '</ul>';
            }
        }

        // 8) Build the merge context, skipping serialized fields
        $context = [];

        $serialized_order_fields = ['verhuislift']; // Add other serialized fields if needed


        foreach ( $order_map as $field_key => $label ) {
            if ( in_array( $field_key, ['products','disassembly_products'], true ) ) {
                continue;
            }
            
            //error_log(print_r($field_key, true)); 
            
            $value = $record[ $field_key ] ?? '';
        
            if ( in_array( $field_key, $serialized_order_fields, true ) ) {
                // Check if it's a JSON array string
                if ( is_string( $value ) && $decoded = json_decode( $value, true ) ) {
                    if ( is_array( $decoded ) ) {
                        $value = implode(', ', $decoded);
                    }
                }
                
            }
            
            if ( in_array($field_key, ['privacy_toestemming', 'voorwaarden_kennisname']) && $value === '' ) {
                $value = 'Nee';
            }
            
            // Format the submission_date
            if ( $field_key === 'submission_date' ) {
                //$value is 2025-06-27 01:25:59
                $timestamp = strtotime($value);
                $value = date('d-m-Y H:i', $timestamp);
            }
            
            $context[ $field_key ] = $value;
        }

        // 8b) Address fields
        foreach ( $addr_types as $type ) {
            if ( isset( $addresses[ $type ] ) ) {
                foreach ( $address_map as $field_key => $label ) {
        
                    $value = $addresses[ $type ][ $field_key ] ?? '';
        
                    // Unserialize 'house_floor' if it's serialized
                    if ( $field_key === 'house_floor' ) {
                        $unserialized = maybe_unserialize( $value );
        
                        // Convert array to comma-separated string
                        if ( is_array( $unserialized ) ) {
                            $value = implode( ', ', $unserialized );
                        } else {
                            $value = $unserialized;
                        }
                    }
                    
                    if($field_key == 'full_address'){
                        $value = stripslashes($value); // remove ALL backslashes  
                    }
                    
                    if($field_key == 'plaats'){
                        $value = stripslashes($value); // remove ALL backslashes  
                    }
        
                    $context[ "{$type}_{$field_key}" ] = $value;
                }
            }
        }


        // 8c) Inject our HTML blocks into context
        $context['products']               = $products_html;
        $context['disassembly_products']   = $dismantle_html;

        // 8d) Extra values
        $context['order_id']        = intval( $order_id );
        //$context['submission_date'] = $record['submission_date'] ?? '';


        // 9) Merge all placeholders into one message
        $message = preg_replace_callback(
            '/\{([a-z0-9_\-]+)\}/i',
            function( $matches ) use ( $context ) {
                $key = $matches[1];
                if ( isset( $context[ $key ] ) ) {
                    return in_array( $key, ['products','disassembly_products'], true )
                        ? $context[ $key ]
                        : esc_html( $context[ $key ] );
                }
                return ''; // Replace unknown placeholders with empty string
            },
            $template
        );

        // 10) Wrap in HTML and send
        $full_email  = '<html><body>' . $message . '</body></html>';
        $admin_email = get_option('admin_email'); // Get the administrator's email
        $emailsToSend = get_option('moversco_emails_for_notifications', '');
        $emailArray = array_map('trim', explode(',', $emailsToSend));

        // Send email to the customer
        wp_mail(
            $record['email_address'],
            $subject,
            $full_email,
            [
                'Content-Type: text/html; charset=UTF-8',
                'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
            ]
        );
        
        
        // Send email notifications to to the administrator staff
        foreach($emailArray as $email){
            
            if (!is_email($email)) {
                continue; // Skip invalid email
            }
            
            wp_mail(
                $email,
                $subjectStaff,
                $full_email,
                [
                    'Content-Type: text/html; charset=UTF-8',
                    'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
                ]
            ); 
        }
        
        
        
        wp_send_json_success(['message' => 'API error: ' . (isset($response_data['message']) ? 'message' : 'Unknown error.'), 'checkoutURL' => $checkoutURL]);

        wp_die(); // Properly terminate the script

    }


}