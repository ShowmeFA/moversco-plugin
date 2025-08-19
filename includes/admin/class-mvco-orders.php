<?php

if ( ! defined( 'ABSPATH' ) ) exit;


if ( ! class_exists( 'Moversco_Form_Admin' ) ) {
class Moversco_Form_Admin {

    public function __construct() {
        add_action( 'admin_menu',           [ $this, 'register_menu'      ] );
        add_action( 'admin_enqueue_scripts',[ $this, 'enqueue_assets'     ] );
    }

    public function register_menu() {
        add_menu_page(
            'Moving Orders',               // Page title
            'Moving Orders',               // Menu title
            'manage_options',              // Capability
            'moversco_moving_orders',      // Menu slug
            [ $this, 'render_page' ],      // Callback
            'dashicons-list-view',         // Icon
             5                             // Position
        );
    }

    public function enqueue_assets( $hook ) {
        if ( $hook !== 'toplevel_page_moversco_moving_orders' ) {
            return;
        }
        // DataTables CSS & JS from CDN
        wp_enqueue_style( 'datatables-css', 'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'datatables-js',
            'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js',
            [ 'jquery' ],
            null,
            true
        );
    }

public function render_page() {
    ob_start(); // Start output buffering

    global $wpdb;
    $table = $wpdb->prefix . 'moving_orders';
    $action = $_GET['action'] ?? 'list';

    // Handle delete action
    if ( 'delete' === $action && isset( $_GET['id'] ) ) {
        $order_id = intval( $_GET['id'] );
        // Perform deletion of the order from the database
        $wpdb->delete( $table, [ 'order_id' => $order_id ] );

        // After deleting, redirect back to the list
        wp_redirect( admin_url( 'admin.php?page=moversco_moving_orders&action=list' ) );
    }

    if ( in_array( $action, [ 'add', 'edit' ], true ) ) {
        $this->render_form( $table, $action );
    } else {
        $this->render_list( $table );
    }

    ob_end_flush(); // End output buffering and flush
}


private function render_list( $table ) {
    global $wpdb;
    $orders = $wpdb->get_results( "SELECT * FROM `{$table}` ORDER BY `order_id` DESC", ARRAY_A );
    $cols = [
        'order_id'             => 'Order ID',
        'first_name'           => 'First Name',
        'sur_name'             => 'Surname',
        'telephone'            => 'Telephone',
        'email_address'        => 'Email Address',
    ];
    ?>
    <div class="wrap">
      <h1>
        Moving Orders
        <a href="<?php echo admin_url('admin.php?page=moversco_moving_orders&action=add'); ?>"
           class="page-title-action">Add New</a>
      </h1>
      <table id="ordersTable" class="widefat striped">
        <thead><tr>
          <?php foreach ( $cols as $key => $label ): ?>
            <th><?php echo esc_html( $label ); ?></th>
          <?php endforeach; ?>
          <th>Actions</th>
        </tr></thead>
        <tbody>
          <?php foreach ( $orders as $r ): ?>
            <tr>
              <?php foreach ( $cols as $key => $_ ): ?>
                <td><?php echo esc_html( $r[ $key ] ); ?></td>
              <?php endforeach; ?>
              <td>
                <a href="<?php echo admin_url(
                  'admin.php?page=moversco_moving_orders&action=edit&id='
                  . intval( $r['order_id'] )
                ); ?>">Edit</a> |
                <a href="<?php echo admin_url(
                  'admin.php?page=moversco_moving_orders&action=delete&id='
                  . intval( $r['order_id'] )
                ); ?>" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <script>
    jQuery(function($){
      $('#ordersTable').DataTable({
        pageLength: 10,
        order: [[0,'desc']]
      });
    });
    </script>
    <?php
}

function render_form( $table, $action ) {
    global $wpdb;
    $addresses_table = $wpdb->prefix . 'addresses';
    $id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

    // Field definitions
    $map = [
        'first_name'           => 'Naam',
        'sur_name'             => 'Achternaam',
        'telephone'            => 'Telefoon',
        'email_address'        => 'E-mailadres',
        'salutation'           => 'Aanhef',
        'typeklant'            => 'type klant',
        'businessname'         => 'Bedrijfsnaam',
        'preferred_date'       => 'Voorkeursdatum',
        'comments'             => 'Vragen of opmerkingen',
        'verhuislift'          => 'Verhuislift nodig?',
        'Verhuizers'           => 'Verhuizers nodig?',
        'Verhuiswagen'         => 'Verhuiswagen nodig?',
        'packing_boxes'        => 'Inpakken in dozen',
        'total_boxes'          => 'Aantal dozen',
        'disassembly_work'     => '(De)montagewerk',
        'products'             => 'Inventaris',
        'disassembly_products' => '(De)montagewerk Items',
        'number_of_addresses'  => 'Aantal Adressen',
        'submission_date'      => 'Submission Date',
        'total_products'       => 'Total Products',
        'number_of_items'      => 'Aantal artikelen',
        'total_area'           => 'Kubieke meters (m³)',
        'voorwaarden_kennisname' => 'Voorwaarden Kennisname',
        'privacy_toestemming'    => 'Privacy Toestemming',
        'form_link'            => 'Form Link'
    ];

    // Address‐field definitions
    $address_map = [
        'address_id'            => 'Address ID',
        'full_address'          => 'Volledige adres',
        'property_type'         => 'Type woning',
        'house_floor'           => 'Verdieping(en)',
        'lift'                  => 'Interne lift',
        'distance_from_parking' => 'Afstand parkeerplek-voordeur',
        'latitude'              => 'Latitude',
        'longitude'             => 'Longitude',
        'country'               => 'Land',
        'postal'                => 'Postcode',
        'housenumber'           => 'Huisnummer',
        'plaats'                => 'Plaats',
        'straat'                => 'Straat',
    ];
    
    // Fixed address types
    $addr_types = [ 'startadres', 'tussenadres-1', 'tussenadres-2', 'eindadres' ];
    
    // Lift options (if you still need them)
    $lift_opts = [ 'Startadres','Tussenadres-1','Tussenadres-2','Eindadres' ];
    
    // Fetch products
    $all_products = get_posts([
        'post_type'   => 'form_products',
        'numberposts' => -1,
        'orderby'     => 'title',
        'order'       => 'ASC',
    ]);
    
    // Load existing order
    $record = [];
    if ( $action === 'edit' && $id ) {
        $record = (array) $wpdb->get_row(
            $wpdb->prepare( "SELECT * FROM `{$table}` WHERE order_id = %d", $id ),
            ARRAY_A
        ) ?: [];
    }
    
    // Load existing addresses keyed by type
    $addresses = [];
    if ( $action === 'edit' && $id ) {
        $rows = $wpdb->get_results(
            $wpdb->prepare( "SELECT * FROM `{$addresses_table}` WHERE order_id = %d", $id ),
            ARRAY_A
        );
        foreach ( $rows as $r ) {
            $addresses[ $r['address_type'] ] = $r;
        }
    }

    // Handle submission
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer( 'moversco_save_order' ) ) {
        // 1) Save order fields
        $data = [];
        foreach ( $map as $key => $_label ) {
            if ( in_array( $key, ['products','disassembly_products'], true ) ) {
                continue;
            }
            if ( $key === 'verhuislift' ) {
                $sel   = (array) ( $_POST['verhuislift'] ?? [] );
                $valid = array_intersect( $lift_opts, $sel );
                $data['verhuislift'] = wp_json_encode( array_values( $valid ) );
            } else {
                $data[ $key ] = sanitize_text_field( wp_unslash( $_POST[ $key ] ?? '' ) );
            }
            
        }
        
        // products (serialize)
        $prods = [];
        foreach ( (array) ( $_POST['products_row'] ?? [] ) as $i => $pid ) {
            $pid = intval( $pid );
            $qty = intval( $_POST['products_qty'][ $i ] ?? 0 );
            if ( $pid && $qty > 0 ) {
                $p    = get_post( $pid );
                $area = get_post_meta( $pid, 'form_product_area', true );
                $prods[] = [
                    'ProductID'       => (string) $pid,
                    'ProductName'     => $p->post_title,
                    'ProductQuantity' => (string) $qty,
                    'ProductArea'     => (string) $area,
                ];
            }
        }
        $data['products'] = maybe_serialize( $prods );
        // disassembly_products (serialize)
        $diss = [];
        foreach ( (array) ( $_POST['disassembly_row'] ?? [] ) as $i => $pid ) {
            $pid = intval( $pid );
            $qty = intval( $_POST['disassembly_qty'][ $i ] ?? 0 );
            if ( $pid && $qty > 0 ) {
                $p    = get_post( $pid );
                $diss[] = [
                    'productID'   => (string) $pid,
                    'productName' => $p->post_title,
                    'quantity'    => (string) $qty,
                ];
            }
        }
        $data['disassembly_products'] = maybe_serialize( $diss );

        // Insert/update order
        if ( $action === 'edit' && $id ) {
            $wpdb->update( $table, $data, [ 'order_id' => $id ] );
        } else {
            $wpdb->insert( $table, $data );
            $id = $wpdb->insert_id;
        }

        // 2) Save exactly four addresses
        foreach ( $addr_types as $type ) {
            $aid   = intval( $_POST['addr_id'][ $type ] ?? 0 );
            $full  = sanitize_text_field( wp_unslash( $_POST['addr_full'][ $type ] ?? '' ) );
            $prop  = sanitize_text_field( wp_unslash( $_POST['addr_prop'][ $type ] ?? '' ) );
            $floor = maybe_serialize( array_map( 'trim', explode( ',', sanitize_text_field( wp_unslash( $_POST['addr_floor'][ $type ] ?? '' ) ) ) ) );
            $liftA = sanitize_text_field( wp_unslash( $_POST['addr_lift'][ $type ] ?? '' ) );
            $dist  = sanitize_text_field( wp_unslash( $_POST['addr_dist'][ $type ] ?? '' ) );
            $lat   = sanitize_text_field( wp_unslash( $_POST['addr_lat'][ $type ] ?? '' ) );
            $lng   = sanitize_text_field( wp_unslash( $_POST['addr_lng'][ $type ] ?? '' ) );
            $country= sanitize_text_field( wp_unslash( $_POST['addr_country'][ $type ] ?? '' ) );
            $postal = sanitize_text_field( wp_unslash( $_POST['addr_postal'][ $type ] ?? '' ) );
            $house  = sanitize_text_field( wp_unslash( $_POST['addr_house'][ $type ] ?? '' ) );
            $place  = sanitize_text_field( wp_unslash( $_POST['addr_place'][ $type ] ?? '' ) );
            $straat = sanitize_text_field( wp_unslash( $_POST['addr_straat'][ $type ] ?? '' ) );
            

            $row = [
                'order_id'                  => $id,
                'address_type'              => $type,
                'full_address'              => $full,
                'property_type'             => $prop,
                'house_floor'               => $floor,
                'lift'                      => $liftA,
                'distance_from_parking'     => $dist,
                'latitude'                  => $lat,
                'longitude'                 => $lng,
                'country'                   => $country,
                'postal'                    => $postal,
                'housenumber'               => $house,
                'plaats'                    => $place,
                'straat'                    => $straat,
            ];

            if ( $aid ) {
                $wpdb->update( $addresses_table, $row, [ 'address_id' => $aid ] );
            } elseif ( $full !== '' ) {
                $wpdb->insert( $addresses_table, $row );
            }
        }

        echo '<div class="notice notice-success"><p>Order and addresses saved.</p></div>';

        // rebuild edit‐page URL properly
        $edit_url = add_query_arg(
            [
              'page'   => 'moversco_moving_orders',
              'action' => 'edit',
              'id'     => $id,
            ],
            admin_url('admin.php')
        );
        
        //echo '<script>setTimeout(function(){ location.href="'. esc_js( $edit_url ) .'"; },800);</script>';
    
    }

    // Prepare for edit rendering
    $pre_lifts   = [];
    if ( ! empty( $record['verhuislift'] ) ) {
        $tmp = json_decode( $record['verhuislift'], true );
        if ( is_array( $tmp ) ) $pre_lifts = $tmp;
    }
    $exist_prods = is_string( $record['products'] ?? '' ) ? maybe_unserialize( $record['products'] ) : [];
    $exist_diss  = is_string( $record['disassembly_products'] ?? '' ) ? maybe_unserialize( $record['disassembly_products'] ) : [];
    
    
    // Render form
    ?>
    <div class="wrap">
      <h1><?php echo $action==='edit'?'Edit':'Add New'; ?> Order</h1>
      <form method="post">
        <?php wp_nonce_field('moversco_save_order'); ?>
        <table class="form-table">
          <?php foreach ( $map as $key => $label ) :
            if ( in_array( $key, ['products','disassembly_products','order_id'], true ) ) continue;
            $val = $record[ $key ] ?? '';
          ?>
            <tr>
              <th><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label></th>
              <td>
                <?php if ( $key === 'comments' ) : ?>
                  <textarea name="<?php echo esc_attr( $key ); ?>" rows="4" cols="50"><?php echo esc_textarea($val); ?></textarea>
                <?php elseif ( $key === 'verhuislift' ) : ?>
                  <select name="verhuislift[]" multiple style="width:300px;">
                    <?php foreach ( $lift_opts as $opt ) : ?>
                      <option value="<?php echo esc_attr($opt); ?>" <?php selected(in_array($opt,$pre_lifts),true); ?>>
                        <?php echo esc_html($opt); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  
                 
                <?php elseif ( $key === 'number_of_addresses' ) : ?>
                    <select name="number_of_addresses" id="number_of_addresses" class="regular-text">
                      <?php for ( $i = 1; $i <= 4; $i++ ) :
                        $opt = "{$i}-adressen";
                      ?>
                        <option value="<?php echo esc_attr( $opt ); ?>" <?php selected( $val, $opt ); ?>>
                          <?php echo esc_html( $opt ); ?>
                        </option>
                      <?php endfor; ?>
                    </select>
                <?php elseif ( strpos($key,'preferred_date') !== false ) : ?>
                  <input type="text" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($val); ?>" class="regular-text"/>
                
                <?php elseif ( strpos($key,'submission_date') !== false ) : ?>
                    <?php
                      $timestamp = strtotime(esc_attr($val));
                      $value = date('d-m-Y H:i', $timestamp);
                    ?>
                    <input type="text" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>" class="regular-text"/>
                
                <?php else : ?>
                  <input type="text" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($val); ?>" class="regular-text"/>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>

          <!-- Addresses fixed rows -->
          <tr>
            <th>Addresses</th>
            <td>
              <table style="width:100%;border-collapse:collapse;">
                <thead>
                  <tr>
                    <th>Type</th><th>Volledige adres</th><th>Type woning</th><th>Verdieping(en)</th>
                    <th>Interne lift</th><th>Afstand parkeerplek-voordeur</th><th>Lat</th><th>Lng</th>
                    <th>Land</th><th>Postcode</th><th>Huisnummer</th><th>Plaats</th><th>Straat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ( $addr_types as $type ) :
                    $a = $addresses[ $type ] ?? [];
                    $aid = $a['address_id'] ?? 0;
                    $floor_arr = maybe_unserialize( $a['house_floor'] ?? '' );
                    $floor_str = is_array($floor_arr) ? implode(', ',$floor_arr) : '';
                  ?>
                  <tr>
                    <td>
                      <input type="hidden" name="addr_id[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($aid);?>"/>
                      <input type="text" value="<?php echo esc_html($type);?>" disabled/>
                    </td>
                    <td><input type="text" name="addr_full[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr(stripslashes($a['full_address']) ?? '');?>" /></td>
                    <td><input type="text" name="addr_prop[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['property_type'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_floor[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($floor_str);?>" placeholder="comma-separated"/></td>
                    <td><input type="text" name="addr_lift[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['lift'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_dist[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['distance_from_parking'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_lat[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['latitude'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_lng[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['longitude'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_country[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['country'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_postal[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['postal'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_house[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['housenumber'] ?? '');?>" /></td>
                    <td><input type="text" name="addr_place[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr(stripslashes($a['plaats']) ?? '');?>" /></td>
                    <td><input type="text" name="addr_straat[<?php echo esc_attr($type);?>]" value="<?php echo esc_attr($a['straat'] ?? '');?>" /></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </td>
          </tr>

          <!-- Products & Disassembly sections unchanged -->

        </table>
        <!--Update Button here-->
      </form>
    </div>
    <?php
}

    public function enqueue_scripts(){
        
    }
    
    public function enqueue_styles(){
        
    }
    
}
  
}

new Moversco_Form_Admin();