<?php

class MoversCoFormShortcode
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
        add_shortcode('moverscoform', [$this, 'renderForm']);

    }

    public function generate_form() {
        global $wpdb;
        // Define the table name
        $table_name = $wpdb->prefix . 'moving_orders';

        // Generate a random session ID
        $session_id = uniqid('session_', true);  // Example: session_64acdc5bc8b9a3.12805985

        // Insert empty data into the table, including the session_id
        $data = array(
            'session_id' => $session_id, // Add the session ID to the data
            'disassembly_work' => '',
            'disassembly_products' => '',
            'packing_boxes' => '',
            'total_boxes' => '',
            'moving_lift' => '',
            'preferred_date' => null, // You can use NULL for date fields
            'total_products' => 0,
            'products' => '',
            'number_of_items' => 0,
            'total_area' => 0.0,
            'salutation' => '',
            'first_name' => '',
            'sur_name' => '',
            'telephone' => '',
            'email_address' => '',
            'comments' => '',
        );

        // Insert the data and check if it was successful
        $inserted = $wpdb->insert($table_name, $data);
        $url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        if ($inserted) {
            // Get the ID of the newly inserted row
            $new_row_id = $wpdb->insert_id;
            $params = [
                'id' => $new_row_id,
                'session_id' => $session_id
            ];
            // Build the new URL with query parameters
            $newUrl = add_query_arg($params, $url);

            // Redirect to the new URL
            echo "<script>window.location.href = " . json_encode($newUrl) . ";</script>";
            exit;

        } else {
            echo 'Error While Creating Form';
        }
    }


    /**
     * Fetch a single moving_orders row by order_id + session_id.
     *
     * @param int    $order_id
     * @param string $session_id
     * @return object|null WP_Row or null if not found.
     */
    protected function fetch_order(int $order_id, string $session_id)
    {
        global $wpdb;

        $table = $wpdb->prefix . 'moving_orders';
        return $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE order_id = %d AND session_id = %s",
                $order_id,
                $session_id
            ),
            OBJECT
        );
    }

    /**
     * Fetch all rows from the addresses table for a given order.
     *
     * @param int $order_id
     * @return array List of associative arrays, one per address row.
     */
    protected function fetch_addresses_table(int $order_id): array
    {
        global $wpdb;

        $table = $wpdb->prefix . 'addresses';
        return $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE order_id = %d",
                $order_id
            ),
            ARRAY_A
        );
    }

    /**
     * Take that serialized `addresses_information` JSON/string and turn it
     * into six structured address arrays (startadres, eindadres, etc.)
     *
     * @param string|null $raw Serialized data from $order->addresses_information
     * @return array{
     *   startadres: array,
     *   eindadres: array,
     *   tussenadres: array,
     *   'tussenadres-2': array,
     *   'tussenadres-3': array,
     *   'tussenadres-4': array,
     * }
     */
    protected function parse_serialized_addresses(?string $raw): array
    {
        // default structure for each slot
        $empty = [
            'formTitle' => '',
            'fullAddress' => '',
            'propertyType' => '',
            'houseFloor' => [],
            'lift' => '',
            'distanceFromParkingToDoor' => '',
        ];

        $slots = [
            'startadres' => $empty,
            'eindadres' => $empty,
            'tussenadres' => $empty,
            'tussenadres-2' => $empty,
            'tussenadres-3' => $empty,
            'tussenadres-4' => $empty,
        ];

        // unserialize/maybe JSON-decode
        $addresses = maybe_unserialize($raw);
        if (is_array($addresses)) {
            foreach ($addresses as $addr) {
                $key = $addr['formTitle'] ?? '';
                if (isset($slots[$key])) {
                    // decode nested houseFloor if needed
                    $houseFloor = $addr['houseFloor'] ?? '';
                    $houseFloor = maybe_unserialize($houseFloor);

                    $slots[$key] = [
                        'formTitle' => $key,
                        'fullAddress' => $addr['fullAddress'] ?? '',
                        'propertyType' => $addr['propertyType'] ?? '',
                        'houseFloor' => is_array($houseFloor) ? $houseFloor : [],
                        'lift' => $addr['lift'] ?? '',
                        'distanceFromParkingToDoor' => $addr['distanceFromParkingToDoor'] ?? '',
                    ];
                }
            }
        }

        return $slots;
    }


    protected function get_order($id, $session_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'moving_orders';

        // Fetch the order based on ID and session ID
        $order = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE id = %d AND session_id = %s",
                $id,
                $session_id
            )
        );

        return $order;
    }

    /**
     * Register styles & scripts so WP knows about them,
     * but don't enqueue yet.
     */
    public function register_assets()
	{
		// Styles
		wp_register_style(
			'flatpickr-css',
			'https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css',
			[],
			'4.6.13'
		);

		wp_register_style(
			'moversco-form-css',
			MOVERSCO_URL . 'assets/css/moversco-form.css',
			[],
			'1.0'
		);

		// ✅ Font Awesome 6 CSS
		wp_register_style(
			'fontawesome6',
			'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
			[],
			'6.5.1'
		);

		// Scripts
		wp_register_script(
			'flatpickr',
			'https://cdn.jsdelivr.net/npm/flatpickr',
			['jquery'],
			'4.6.13',
			true
		);
		wp_register_script(
			'flatpickr-nl',
			'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/nl.js',
			['flatpickr'],
			'4.6.13',
			true
		);
		wp_register_script(
			'google-maps',
			'https://maps.googleapis.com/maps/api/js?key=' . esc_attr(get_option('moversco_google_maps_api_key')),
			[],
			null,
			true
		);
		wp_register_script(
			'moversco-form-js',
			MOVERSCO_URL . 'assets/js/form-handler.js',
			['jquery', 'flatpickr', 'google-maps'],
			'1.0',
			true
		);

		wp_localize_script('moversco-form-js', 'moversco_ajax', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('moversco_nonce'),
		]);

		wp_enqueue_script(
			'sweetalert2',
			'https://cdn.jsdelivr.net/npm/sweetalert2@11',
			[],
			null,
			true
		);
		
		// Flag Icon CSS (CDN)
		wp_register_style(
			'flag-icon-css',
			'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css',
			[],
			'6.6.6'
		);

		wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', ['jquery'], null, true);
		wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');

		// Enqueue All
		wp_enqueue_style('flatpickr-css');
		wp_enqueue_style('moversco-form-css');
		wp_enqueue_style('fontawesome6'); // ✅ Enqueue Font Awesome
		wp_enqueue_script('flatpickr');
		wp_enqueue_script('flatpickr-nl');
		wp_enqueue_script('google-maps');
		wp_enqueue_script('moversco-form-js');
		wp_enqueue_style('flag-icon-css');

	}


    public function renderForm($atts = [], $content = null)
    {
        global $wpdb;
        $id = sanitize_text_field($_GET['id'] ?? '');
        $session_id = sanitize_text_field($_GET['session_id'] ?? '');
        ob_start();
        // If we have an ID and session_id, fetch the order
        if ($id && $session_id) {
            $order = $this->fetch_order($id, $session_id);
            if ($order) {
                // Set Order Data For the Form
                $addresses = !empty($order->addresses_information) ? $order->addresses_information : '';
                $unserializedAddresses = maybe_unserialize($addresses);
                $SerialVerhuislift = !empty($order->verhuislift) ? $order->verhuislift : '';
                $movingLift = json_decode($SerialVerhuislift);
                $Movers = !empty($order->Verhuizers) ? $order->Verhuizers : 'Yes';
                $MovingTruck = !empty($order->Verhuiswagen) ? $order->Verhuiswagen : 'Yes';
                $disassembly_work = !empty($order->disassembly_work) ? $order->disassembly_work : 'No';
                $disassembly_products_serialized = !empty($order->disassembly_products) ? $order->disassembly_products : '';
                $disassemblyProducts = maybe_unserialize($disassembly_products_serialized);
                $packingOption = !empty($order->packing_boxes) ? $order->packing_boxes : 'No';
                $totalBoxes = !empty($order->total_boxes) ? $order->total_boxes : '';
                $moving_lift = !empty($order->moving_lift) ? $order->moving_lift : '';
                $preferred_date = !empty($order->preferred_date) ? $order->preferred_date : date('d-m-Y');
                $theProducts = !empty($order->products) ? $order->products : '';
                $addedProducts = maybe_unserialize($theProducts);
                $salutation = !empty($order->salutation) ? $order->salutation : '';
                $typeklant = !empty($order->typeklant) ? $order->typeklant : '';
                $businessname = !empty($order->businessname) ? $order->businessname : '';
                $first_name = !empty($order->first_name) ? $order->first_name : '';
                $sur_name = !empty($order->sur_name) ? $order->sur_name : '';
                $telephone = !empty($order->telephone) ? $order->telephone : '';
                $email_address = !empty($order->email_address) ? $order->email_address : '';
                $commentz = !empty($order->comments) ? $order->comments : '';
                $privacyConsent = !empty($order->voorwaarden_kennisname) ? $order->voorwaarden_kennisname : 'No';
                $termsAcknowledgment = !empty($order->privacy_toestemming) ? $order->privacy_toestemming : 'No'; 
                $numberOfAddresses = !empty($order->number_of_addresses) ? $order->number_of_addresses : '2 addresses';

                // raw table rows (if you still need them)
                $raw_addresses = $this->fetch_addresses_table($id);
                $unserialized_addresses = $raw_addresses->addresses_information ?? '';
                $serialized_addresses = maybe_unserialize($unserialized_addresses);

                // Initialize all addresses with default empty values
                $address1 = [
                    'fullAddress' => '',
                    'propertyType' => '',
                    'houseFloor' => [],
                    'lift' => '',
                    'distanceFromParkingToDoor' => ''
                ];

                $address2 = [
                    'fullAddress' => '',
                    'propertyType' => '',
                    'houseFloor' => [],
                    'lift' => '',
                    'distanceFromParkingToDoor' => ''
                ];

                $address3 = [
                    'fullAddress' => '',
                    'propertyType' => '',
                    'houseFloor' => [],
                    'lift' => '',
                    'distanceFromParkingToDoor' => ''
                ];

                $address4 = [
                    'fullAddress' => '',
                    'propertyType' => '',
                    'houseFloor' => [],
                    'lift' => '',
                    'distanceFromParkingToDoor' => ''
                ];

                $address5 = [
                    'fullAddress' => '',
                    'propertyType' => '',
                    'houseFloor' => [],
                    'lift' => '',
                    'distanceFromParkingToDoor' => ''
                ];

                $address6 = [
                    'fullAddress' => '',
                    'propertyType' => '',
                    'houseFloor' => [],
                    'lift' => '',
                    'distanceFromParkingToDoor' => ''
                ];

                // parse the serialized block into 6 logical slots
                $address_map = $this->parse_serialized_addresses($serialized_addresses);

                ob_start();
                // now we can render the form with the data
                require_once MOVERSCO_FORM_DIR . 'includes/shortcodes/views/moversco-form.php';
                return ob_get_clean();

            }
        } else {
            $this->generate_form();
        }
        return ob_get_clean();
    }


}

new MoversCoFormShortcode();