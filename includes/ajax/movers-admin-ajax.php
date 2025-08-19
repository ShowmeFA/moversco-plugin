<?php

class Movers_Admin_Ajax {

    public function __construct() {
        add_action('wp_ajax_update_address_fields', [$this, 'update_address_fields']);
        add_action('wp_ajax_nopriv_update_address_fields', [$this,'update_address_fields']);

        add_action('wp_ajax_get_address_fields', [$this, 'get_address_fields']);
        // Register AJAX actions for logged in and non-logged in users
        add_action('wp_ajax_get_form_products_one', [$this,'get_form_products_callback_one']);
        add_action('wp_ajax_nopriv_get_form_products_one', [$this,'get_form_products_callback_one']);

        // Register AJAX actions for logged in and non-logged in users
        add_action('wp_ajax_get_form_products', [$this,'get_form_products_callback']);
        add_action('wp_ajax_nopriv_get_form_products', [$this,'get_form_products_callback']);

        add_action('wp_ajax_save_form_progress', [$this, 'moversco_save_form_progress']);
        add_action('wp_ajax_nopriv_save_form_progress', [$this, 'moversco_save_form_progress']);
    }

    // AJAX handler to update address fields
    public function update_address_fields() {
       global $wpdb;

        $table_name = $wpdb->prefix . 'addresses';

        if (!isset($_POST['addressObject'])) {
            wp_send_json_error(['message' => 'No form data provided.']);
        }

        $form_data = $_POST['addressObject'];

        // Sanitize and prepare data
        $order_id = isset($form_data['order_id']) ? intval($form_data['order_id']) : 0;
        $address_type = sanitize_text_field($form_data['address_type']);
        $country = sanitize_text_field($form_data['country']);
        $postal = sanitize_text_field($form_data['postal']);
        $housenumber = sanitize_text_field($form_data['housenumber']);
        $straat = sanitize_text_field($form_data['straat']);
        $plaats = sanitize_text_field($form_data['plaats']);
        $latitude = floatval($form_data['mapLat']);   // now saved as 'latitude'
        $longitude = floatval($form_data['mapLong']); // now saved as 'longitude'
        $full_address = sanitize_text_field($form_data['full_address']);
        $property_type = sanitize_text_field($form_data['property_type']);
        $house_floor_raw = $form_data['house_floor'] ?? '';
        $house_floor = is_array($house_floor_raw)
            ? maybe_serialize(array_map('sanitize_text_field', $house_floor_raw))
            : sanitize_text_field($house_floor_raw);

        $Lift = sanitize_text_field($form_data['Lift']);
        $distance_from_parking = sanitize_text_field($form_data['distance_from_parking']);

        if ($address_type === "") {
            wp_send_json([
            'success' => false,
            'message' => 'Address type is required.'
            ], 200); // 200 is default, but you can add it explicitly
        }

        // Data to insert/update
        $data = [
            'order_id' => $order_id,
            'address_type' => $address_type,
            'country' => $country,
            'postal' => $postal,
            'housenumber' => $housenumber,
            'straat' => $straat,
            'plaats' => $plaats,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'full_address' => $full_address,
            'property_type' => $property_type,
            'house_floor' => $house_floor,
            'Lift' => $Lift,
            'distance_from_parking' => $distance_from_parking
        ];

        // Check if the record exists
        $existing_row = $wpdb->get_row(
            $wpdb->prepare(
            "SELECT address_id FROM $table_name WHERE order_id = %d AND address_type = %s",
            $order_id,
            $address_type
            )
        );

        if ($existing_row) {
            // Update the existing row using address_id
            $wpdb->update(
            $table_name,
            $data,
            ['address_id' => $existing_row->address_id]
            );
            wp_send_json_success(['message' => 'Address updated.']);
        } else {
            // Insert new row
            $wpdb->insert($table_name, $data);
            wp_send_json_success(['message' => 'Address inserted.']);
        }

        wp_die(); // Always end AJAX functions with wp_die()
    }

    // AJAX handler to get address fields
    public function get_address_fields() {
        $address_id = isset($_POST['address_id']) ? intval($_POST['address_id']) : 0;

        // Fetch logic here (e.g., get_post_meta, get_option, etc.)
        // Example:
        // $address_data = get_post_meta($address_id, 'address_fields', true);

        $address_data = [
            'street' => '123 Main St',
            'city' => 'Sample City',
            'state' => 'CA',
            'zip' => '90001'
        ];

        wp_send_json_success(['address_data' => $address_data]);
        wp_die();
    }

    public function get_form_products_callback_one()
    {
        // Get the search term from the AJAX request if set
        $search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

        // Optionally get disassemblyProducts if needed (or remove if not required)
        $disassemblyProducts = isset($_POST['products']) ? $_POST['products'] : "";

        // Arguments for the custom query; add the search parameter if provided
        $args = array(
            'post_type' => 'form_products', // Custom post type name
            'posts_per_page' => -1,              // Retrieve all posts
            'meta_query' => [
            [
                'key' => 'requires_disassembly',
                'value' => '1',
                'compare' => '=',
                'type' => 'CHAR',
            ]
            ],
        );

        if (!empty($search_term)) {
            $args['s'] = $search_term;
        }

        // Add our custom filter to extend the search to tags
        add_filter('posts_search', [$this, 'extend_search_to_tags'], 10, 2);

        // Custom query to get all form_products posts
        $query = new WP_Query($args);

        // Start output buffering so we can return the HTML as a string
        ob_start();

        // Check if any posts were found
        if ($query->have_posts()) {
            // Loop through all posts
            while ($query->have_posts()) {
            $query->the_post();
            $product_quantity = 0;

            // If disassemblyProducts is not empty, loop through it to set product quantity
            if (!empty($disassemblyProducts)) {
                foreach ($disassemblyProducts as $DisProducts) {
                if (get_the_ID() == $DisProducts['productID']) {
                    $product_quantity = $DisProducts['quantity'];
                }
                }
            }

            // Get the custom field value for 'form_product_area' if needed
            $form_product_area = get_post_meta(get_the_ID(), '_form_product_area', true);

            // Get the post thumbnail URL (featured image)
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <div class="form-check form-product-row w-100">
                <div> <img class="form-product-image" src="<?php echo esc_url($thumbnail_url); ?>" alt=""> </div>
                <div class="product-name"> <label class="form-check-label" for=""
                    style="padding:0 !important; width:auto !important; max-width:115px; font-size:15px !important">
                    <?php echo get_the_title(); ?>
                </label> </div>
                <div class="input-group-mvco"><span class="mvco_inline_box minus">–</span><input type="number"
                    class="form-control form-product-input" data-name="<?php echo get_the_title(); ?>"
                    data-id="<?php echo get_the_ID(); ?>" name="selectedProduct" value="<?php echo $product_quantity; ?>" min="0"
                    max="100" placeholder="0"><span class="mvco_inline_box plus">+</span>

                </div>
            </div>
            <?php
            }
            // Reset post data after the query
            wp_reset_postdata();
        } else {
            // If no products are found
            echo '<p>No products found.</p>';
        }

        // Remove our custom search filter so it does not affect other queries
        remove_filter('posts_search', [$this, 'extend_search_to_tags'], 10);

        // Collect the output and return it
        $html = ob_get_clean();
        echo $html;

        // Always end with wp_die() in AJAX callbacks
        wp_die();
    }

    public function get_form_products_callback()
    {
        // Get the search term from the AJAX request if set
        $search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

        // Optionally get disassemblyProducts if needed (or remove if not required)
        $addedProducts = isset($_POST['products']) ? $_POST['products'] : "";

        // Arguments for the custom query; add the search parameter if provided
        $args = array(
            'post_type' => 'form_products', // Custom post type name
            'posts_per_page' => -1,              // Retrieve all posts
        );

        if (!empty($search_term)) {
            $args['s'] = $search_term;
        }

        // Add our custom filter to extend the search to tags
        add_filter('posts_search', [$this, 'extend_search_to_tags'], 10, 2);

        // Custom query to get all form_products posts
        $query = new WP_Query($args);

        // Start output buffering so we can return the HTML as a string
        ob_start();

        // Check if any posts were found
        if ($query->have_posts()) {
            // Loop through all posts
            while ($query->have_posts()) {
            $query->the_post();
            $product_quantity = 0;

            // If disassemblyProducts is not empty, loop through it to set product quantity
            if (!empty($disassemblyProducts)) {
                foreach ($disassemblyProducts as $DisProducts) {
                if (get_the_ID() == $DisProducts['productID']) {
                    $product_quantity = $DisProducts['quantity'];
                }
                }
            }

            if (!empty($addedProducts)) {

                foreach ($addedProducts as $addedProduct) {
                if ((int) get_the_ID() === (int) $addedProduct['ProductID']) {
                    $product_quantity = (int) $addedProduct['ProductQuantity'];
                }
                }
            }


            // Get the custom field value for 'form_product_area' if needed
            $form_product_area = get_post_meta(get_the_ID(), 'form_product_area', true);

            // Get the post thumbnail URL (featured image)
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <div class="form-check form-product-row w-100">
                <div> <img class="form-product-image" src="<?php echo esc_url($thumbnail_url); ?>" alt=""> </div>
                <div class="product-name"> <label class="form-check-label" for=""
                    style="padding:0 !important; width:auto !important; max-width:115px; font-size:15px !important">
                    <?php echo get_the_title(); ?>
                </label>
                </div>
                <div class="input-group-mvco">
                <span class="mvco_inline_box minus">–</span>
                <input type="number" class="form-control form-product-input form-product-input-second"
                    data-product-id="<?php echo get_the_ID(); ?>" data-product-name="<?php echo get_the_title(); ?>"
                    data-area="<?php echo $form_product_area; ?>" id="product-<?php echo get_the_ID(); ?>" name="products"
                    value="<?php echo $product_quantity; ?>" min="0" max="100" placeholder="0">
                <span class="mvco_inline_box plus">+</span>
                </div>
            </div>
            <?php
            }
            // Reset post data after the query
            wp_reset_postdata();
        } else {
            // If no products are found
            echo '<p>No products found.</p>';
        }

        // Remove our custom search filter so it does not affect other queries
        remove_filter('posts_search', 'extend_search_to_tags', 10);

        // Collect the output and return it
        $html = ob_get_clean();
        echo $html;

        // Always end with wp_die() in AJAX callbacks
        wp_die();
    }

    public function extend_search_to_tags($search, $wp_query)
    {
        global $wpdb;

        // Only modify search for our AJAX query on the 'form_products' post type
        $post_type = $wp_query->get('post_type');
        $search_term = $wp_query->get('s');
        if (empty($search_term) || 'form_products' !== $post_type) {
            return $search;
        }

        // Escape the search term for SQL LIKE
        $like = '%' . $wpdb->esc_like($search_term) . '%';

        // Build a custom SQL condition that searches in post_title, post_content,
        // and also in the product-tag taxonomy terms.
        $search = $wpdb->prepare(
            " AND (
                    ({$wpdb->posts}.post_title LIKE %s)
                    OR ({$wpdb->posts}.post_content LIKE %s)
                    OR (
                        EXISTS (
                            SELECT 1 
                            FROM {$wpdb->term_relationships} AS tr
                            INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                            INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
                            WHERE tr.object_id = {$wpdb->posts}.ID 
                            AND tt.taxonomy = 'product-tag'
                            AND t.name LIKE %s
                        )
                    )
                )",
            $like,
            $like,
            $like
        );
        return $search;
    }

    public function moversco_save_form_progress()
    {

        global $wpdb;
        // Define the table name
        $table_name = $wpdb->prefix . 'moving_orders';

        // Add nonce validation
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'moversco_nonce')) {
            wp_send_json_error(['message' => 'Invalid nonce.']);
            wp_die();
        }

        // Generate a random session ID

        // Check if the AJAX request has the required data
        if (!isset($_POST['formData'])) {
        wp_send_json_error(['message' => 'No form data provided.']);
        }

        $form_data = $_POST['formData']; // Use 'formData' instead of 'form_data'

        $formSessionID = isset($form_data['sessionID']) ? sanitize_text_field($form_data['sessionID']) : '';
        $formID = isset($form_data['formID']) ? intval($form_data['formID']) : 0;
        $numberOfAddresses = isset($form_data['numberOfAddresses']) ? sanitize_text_field($form_data['numberOfAddresses']) : '';
        $addressesInform = isset($form_data['addressesInformation']) ? $form_data['addressesInformation'] : [];
        $verhuislift = isset($form_data['verhuislift']) ? json_encode($form_data['verhuislift']) : [];
        $addressesInformation = maybe_serialize($addressesInform);
        $disAssemblyWork = isset($form_data['disassemblyWork']) ? sanitize_text_field($form_data['disassemblyWork']) : '';
        $disassembly = isset($form_data['disassemblyProducts']) ? $form_data['disassemblyProducts'] : [];
        $disassemblyProducts = maybe_serialize($disassembly);
        $packingBoxes = isset($form_data['packingBoxes']) ? sanitize_text_field($form_data['packingBoxes']) : '';
        $totalBoxes = isset($form_data['totalBoxes']) ? sanitize_text_field($form_data['totalBoxes']) : '';
        $MovingLift = isset($form_data['movingLift']) ? sanitize_text_field($form_data['movingLift']) : '';
        $preferredDate = isset($form_data['PreferredDate']) ? $form_data['PreferredDate'] : '';
        $totalProducts = isset($form_data['totalProducts']) ? intval($form_data['totalProducts']) : 0;
        $productz = isset($form_data['products']) ? $form_data['products'] : [];
        $products = maybe_serialize($productz);
        $numberOfItems = isset($form_data['numberOfItems']) ? intval($form_data['numberOfItems']) : 0;
        $totalArea = isset($form_data['totalArea']) ? floatval($form_data['totalArea']) : 0.0;
        $salutation = isset($form_data['salutation']) ? sanitize_text_field($form_data['salutation']) : '';
        $typeklant = isset($form_data['typeklant']) ? sanitize_text_field($form_data['typeklant']) : '';
        $businessname = isset($form_data['businessname']) ? sanitize_text_field($form_data['businessname']) : '';
        $firstName = isset($form_data['firstName']) ? sanitize_text_field($form_data['firstName']) : '';
        $surName = isset($form_data['surName']) ? sanitize_text_field($form_data['surName']) : '';
        $telephone = isset($form_data['telephone']) ? sanitize_text_field($form_data['telephone']) : '';
        $emailAddress = isset($form_data['emailAddress']) ? sanitize_email($form_data['emailAddress']) : '';
        $comments = isset($form_data['Comments']) ? sanitize_textarea_field($form_data['Comments']) : '';
        $verhuisliftInfo = maybe_serialize($verhuislift);
        $Verhuiswagen = isset($form_data['Verhuiswagen']) ? sanitize_text_field($form_data['Verhuiswagen']) : '';
        $Verhuizers = isset($form_data['Verhuizers']) ? sanitize_text_field($form_data['Verhuizers']) : '';
        $form_link = $form_data['form_link'];
        $privacy_toestemming = isset($form_data['privacy_toestemming']) ? sanitize_text_field($form_data['privacy_toestemming']) : 'Nee';
        $voorwaarden_kennisname = isset($form_data['voorwaarden_kennisname']) ? sanitize_text_field($form_data['voorwaarden_kennisname']) : 'Nee';

        // Prepare the SQL query to check for matching id and session_id
        $sql = $wpdb->prepare(
        "SELECT * FROM $table_name WHERE order_id = %d AND session_id = %s",
        $formID,
        $formSessionID
        );
        // Check if the row with the given formID and sessionID exists
        $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE order_id = %d AND session_id = %s", $formID, $formSessionID));

        if ($row) {
        // Update the existing row
        $data = array(
            'number_of_addresses' => $numberOfAddresses,
            'disassembly_work' => $disAssemblyWork,
            'disassembly_products' => $disassemblyProducts,
            'packing_boxes' => $packingBoxes,
            'total_boxes' => $totalBoxes,
            'moving_lift' => $MovingLift,
            'preferred_date' => $preferredDate,
            'total_products' => $totalProducts,
            'products' => $products,
            'number_of_items' => $numberOfItems,
            'total_area' => $totalArea,
            'salutation' => $salutation,
            'first_name' => $firstName,
            'sur_name' => $surName,
            'telephone' => $telephone,
            'email_address' => $emailAddress,
            'comments' => $comments,
            'verhuislift' => $verhuisliftInfo,
            'Verhuizers' => $Verhuizers,
            'Verhuiswagen' => $Verhuiswagen,
            'businessname' => $businessname,
            'typeklant' => $typeklant,
            'form_link' => $form_link,
            'voorwaarden_kennisname' => $voorwaarden_kennisname,
            'privacy_toestemming' => $privacy_toestemming
        );

        // Specify the where clause
        $where = array(
            'order_id' => $formID,
            'session_id' => $formSessionID,
        );

        // Update the data
        $updated = $wpdb->update($table_name, $data, $where);

        if ($updated !== false) {
            wp_send_json_success(['message' => 'Row updated successfully']);
        } else {
            wp_send_json_error(['message' => 'Error updating row']);
        }
        } else {
        wp_send_json_error(['message' => 'Error updating row, Row Not Found']);
        }

        wp_die(); // Properly terminate the script
    }

}

// Initialize the class
new Movers_Admin_Ajax();