<?php
/**
 * Form Products Class
 */
class MVCO_Form_Products {
    /**
     * Constructor
     */
    public function __construct() {
        // Register post type and taxonomies
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_taxonomies']);
        
        // Meta boxes
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post_form_products', [$this, 'save_meta_box_data']);
        
        // Import/Export
        add_action('restrict_manage_posts', [$this, 'add_import_export_buttons']);
        add_action('admin_footer-edit.php', [$this, 'enable_file_upload']);
        add_action('admin_init', [$this, 'handle_import_export']);
    }

    /**
     * Register the custom post type
     */
    public function register_post_type() {
        $labels = [
            'name'               => _x('Moving Products', 'Post Type General Name', 'moversco-form'),
            'singular_name'      => _x('Moving Product', 'Post Type Singular Name', 'moversco-form'),
            'menu_name'         => __('Moving Products', 'moversco-form'),
            'name_admin_bar'    => __('Moving Product', 'moversco-form'),
            'archives'          => __('Moving Product Archives', 'moversco-form'),
            'attributes'        => __('Moving Product Attributes', 'moversco-form'),
            'add_new_item'      => __('Add New Moving Product', 'moversco-form'),
            'new_item'          => __('New Moving Product', 'moversco-form'),
            'edit_item'         => __('Edit Moving Product', 'moversco-form'),
            'view_item'         => __('View Moving Product', 'moversco-form'),
            'all_items'         => __('All Moving Products', 'moversco-form'),
            'search_items'      => __('Search Moving Products', 'moversco-form'),
            'not_found'         => __('No Moving products found.', 'moversco-form'),
            'not_found_in_trash'=> __('No Moving products found in Trash.', 'moversco-form'),
        ];

        $args = [
            'label'             => __('Moving Products', 'moversco-form'),
            'description'       => __('Custom post type for form products.', 'moversco-form'),
            'labels'            => $labels,
            'supports'          => ['title', 'editor', 'thumbnail'],
            'taxonomies'        => ['product-category', 'product-tag'],
            'public'            => true,
            'show_in_menu'     => true,
            'menu_icon'        => 'dashicons-cart',
            'menu_position'    => 5,
            'has_archive'      => true,
            'rewrite'          => ['slug' => 'form-products'],
            'show_in_rest'     => true,
            'exclude_from_search' => false,
        ];

        register_post_type('form_products', $args);
    }

    /**
     * Register taxonomies
     */
    public function register_taxonomies() {
        // Product Categories
        $category_labels = [
            'name'              => __('Product Categories', 'moversco-form'),
            'singular_name'     => __('Product Category', 'moversco-form'),
            'search_items'      => __('Search Product Categories', 'moversco-form'),
            'all_items'         => __('All Product Categories', 'moversco-form'),
            'parent_item'       => __('Parent Product Category', 'moversco-form'),
            'edit_item'         => __('Edit Product Category', 'moversco-form'),
            'update_item'       => __('Update Product Category', 'moversco-form'),
            'add_new_item'      => __('Add New Product Category', 'moversco-form'),
            'new_item_name'     => __('New Product Category Name', 'moversco-form'),
            'menu_name'         => __('Product Category', 'moversco-form'),
        ];

        register_taxonomy('product-category', 'form_products', [
            'hierarchical'      => true,
            'labels'           => $category_labels,
            'show_ui'          => true,
            'show_admin_column'=> true,
            'show_in_rest'     => true,
            'rewrite'          => [
                'slug'         => 'product-category',
                'with_front'   => false,
                'hierarchical' => true,
            ],
        ]);

        // Product Tags
        $tag_labels = [
            'name'              => __('Product Tags', 'moversco-form'),
            'singular_name'     => __('Product Tag', 'moversco-form'),
            'search_items'      => __('Search Product Tags', 'moversco-form'),
            'popular_items'     => __('Popular Product Tags', 'moversco-form'),
            'all_items'         => __('All Product Tags', 'moversco-form'),
            'edit_item'         => __('Edit Product Tag', 'moversco-form'),
            'update_item'       => __('Update Product Tag', 'moversco-form'),
            'add_new_item'      => __('Add New Product Tag', 'moversco-form'),
            'new_item_name'     => __('New Product Tag Name', 'moversco-form'),
            'menu_name'         => __('Product Tags', 'moversco-form'),
        ];

        register_taxonomy('product-tag', 'form_products', [
            'hierarchical'      => false,
            'labels'           => $tag_labels,
            'show_ui'          => true,
            'show_admin_column'=> true,
            'show_in_rest'     => true,
            'rewrite'          => ['slug' => 'product-tag'],
        ]);
    }

    /**
     * Add meta boxes
     */
    public function add_meta_boxes() {
        add_meta_box(
            'moversco_form_products_meta',
            __('Product Details', 'moversco-form'),
            [$this, 'render_meta_box'],
            'form_products',
            'normal',
            'high'
        );
    }

    /**
     * Render meta box content
     */
    public function render_meta_box($post) {
        wp_nonce_field('moversco_form_products_meta', 'moversco_form_products_meta_nonce');

        $fields = [
            'form_product_area' => __('Volume (m³)', 'moversco-form'),
            'name_en' => __('Name (EN)', 'moversco-form'),
            'requires_disassembly' => __('Requires Disassembly', 'moversco-form'),
            'price' => __('Price', 'moversco-form'),
            'product_position' => __('Item position', 'moversco-form')
        ];

        foreach ($fields as $key => $label) {
            $value = get_post_meta($post->ID, $key, true);
            $this->render_field($key, $label, $value);
        }
    }

    /**
     * Render individual field
     */
    private function render_field($key, $label, $value) {
        if ($key === 'requires_disassembly') {
            printf(
                '<p><label><input type="checkbox" name="%1$s" value="1" %2$s /> %3$s</label></p>',
                esc_attr($key),
                checked($value, 1, false),
                esc_html($label)
            );
        } elseif ($key === 'product_position') {
            printf(
                '<p><label>%1$s<br/><input type="number" name="%2$s" value="%3$s" style="width:100%%;"/></label></p>',
                esc_html($label),
                esc_attr($key),
                esc_attr($value)
            );
        } else {
            printf(
                '<p><label>%1$s<br/><input type="text" name="%2$s" value="%3$s" style="width:100%%;"/></label></p>',
                esc_html($label),
                esc_attr($key),
                esc_attr($value)
            );
        }
    }

    // ... Continue with import/export methods and other functionality
  public function handle_import_export()
  {
    // EXPORT JSON
    if (isset($_GET['action']) && $_GET['action'] === 'export_form_products_json') {
      if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
      }
      header('Content-Type: application/json; charset=utf-8');
      header('Content-Disposition: attachment; filename=form_products.json');

      $out = [];
      $posts = get_posts([
        'post_type' => 'form_products',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
      ]);
      foreach ($posts as $p) {
        $meta = get_post_meta($p->ID);
        $cats = wp_get_post_terms($p->ID, 'product-category', ['fields' => 'names']);
        $tags = wp_get_post_terms($p->ID, 'product-tag', ['fields' => 'names']);
        $out[] = [
          'name_nl' => $p->post_title,
          'image_url' => get_the_post_thumbnail_url($p->ID, 'full'),
          'volume_m3' => floatval($meta['form_product_area'][0] ?? 0),
          'customer_type' => $meta['customer_type'][0] ?? '',
          'rooms' => $meta['rooms'][0] ?? '',
          'item_categories' => implode(', ', $cats),
          'requires_disassembly' => boolval($meta['requires_disassembly'][0] ?? false),
          'tags_nl' => implode(', ', $tags),
          'price' => $meta['price'][0] ?? '',
        ];
      }

      echo wp_json_encode($out, JSON_PRETTY_PRINT);
      exit;
    }

    // IMPORT JSON
    if (isset($_POST['moversco_do_import_json'])) {
      global $wpdb;
      // quick admin notice to confirm handler hit
      add_action('admin_notices', function () {
        echo '<div class="notice notice-success is-dismissible"><p>Import handler triggered.</p></div>';
      });

      if (
        !current_user_can('manage_options')
        || !wp_verify_nonce($_POST['moversco_import_nonce'] ?? '', 'moversco_import_form_products_json')
        || empty($_FILES['moversco_import_file']['tmp_name'])
      ) {
        return;
      }

      require_once ABSPATH . 'wp-admin/includes/file.php';
      require_once ABSPATH . 'wp-admin/includes/media.php';
      require_once ABSPATH . 'wp-admin/includes/image.php';

      $json = file_get_contents($_FILES['moversco_import_file']['tmp_name']);
      $items = json_decode($json, true);

      if (json_last_error() !== JSON_ERROR_NONE) {
        $err = json_last_error_msg();
        error_log('JSON parse error: ' . $err);
        add_action('admin_notices', function () use ($err) {
          echo '<div class="notice notice-error"><p>JSON parse error: ' . esc_html($err) . '</p></div>';
        });
        return;
      }
      if (!is_array($items)) {
        add_action('admin_notices', function () {
          echo '<div class="notice notice-error"><p>Invalid JSON structure.</p></div>';
        });
        return;
      }

      foreach ($items as $item) {
        $title = sanitize_text_field($item['name_nl'] ?? '');
        if (!$title) {
          continue;
        }

        $post_id = $wpdb->get_var($wpdb->prepare(
          "SELECT ID FROM {$wpdb->posts} WHERE post_title = %s AND post_type = %s LIMIT 1",
          $title,
          'form_products'
        ));
        if ($post_id) {
          $pid = $existing->ID;
          wp_update_post(['ID' => $pid, 'post_title' => $title]);
        } else {
          $pid = wp_insert_post([
            'post_type' => 'form_products',
            'post_title' => $title,
            'post_status' => 'publish',
          ]);
        }
        if (is_wp_error($pid) || !$pid) {
          continue;
        }

        // Update meta
        update_post_meta($pid, 'form_product_area', sanitize_text_field((string) ($item['volume_m3'] ?? '')));
        update_post_meta($pid, 'customer_type', sanitize_text_field($item['customer_type'] ?? ''));
        update_post_meta($pid, 'rooms', sanitize_text_field($item['rooms'] ?? ''));
        update_post_meta($pid, 'requires_disassembly', !empty($item['requires_disassembly']) ? 1 : 0);
        update_post_meta($pid, 'price', sanitize_text_field($item['price'] ?? ''));

        // Set NL categories
        if (!empty($item['item_categories'])) {
          $cats = array_map('trim', explode(',', $item['item_categories']));
          wp_set_object_terms($pid, $cats, 'product-category', false);
        }
        // Set NL tags
        if (!empty($item['tags_nl'])) {
          $tags = array_map('trim', explode(',', $item['tags_nl']));
          wp_set_object_terms($pid, $tags, 'product-tag', false);
        }

        // Sideload thumbnail
        if (!empty($item['image_url'])) {
          $tmp = download_url($item['image_url']);
          if (!is_wp_error($tmp)) {
            $file = ['name' => wp_basename($item['image_url']), 'tmp_name' => $tmp];
            $att = media_handle_sideload($file, $pid);
            if (!is_wp_error($att)) {
              set_post_thumbnail($pid, $att);
            } else {
              @unlink($tmp);
            }
          }
        }
      }

      // Redirect back with a query var so you can show a success notice
      wp_safe_redirect(add_query_arg('imported', '1', admin_url('edit.php?post_type=form_products')));
      exit;
    }
  }

  function add_import_export_buttons()
  {
    $screen = get_current_screen();
    if ($screen->post_type !== 'form_products') {
      return;
    }

    // Export JSON link
    $export_url = add_query_arg(
      ['action' => 'export_form_products_json'],
      admin_url('edit.php?post_type=form_products')
    );
    echo '<a href="' . esc_url($export_url) . '" class="page-title-action">Export JSON</a>';

    // Import JSON file input + submit button (no nested form)
    echo wp_nonce_field('moversco_import_form_products_json', 'moversco_import_nonce', true, false);
    echo ' <input type="file" name="moversco_import_file" accept=".json" style="vertical-align:middle;margin-left:10px;" />';
    echo ' <input type="submit" name="moversco_do_import_json" class="page-title-action" value="Import JSON" />';
  }

  public function enable_file_upload()
  {
    $screen = get_current_screen();
    if ($screen->post_type !== 'form_products') {
      return;
    }
    ?>
    <script>
      jQuery(function ($) {
        const $form = $('#posts-filter');
        const $importBtn = $('input[name="moversco_do_import_json"]');
        const $fileInput = $('input[name="moversco_import_file"]');

        // Track import intent
        let importTriggered = false;

        // Detect import submit button click
        $importBtn.on('click', function (e) {
          importTriggered = true;
        });

        // Before form submits, conditionally change method
        $form.on('submit', function () {
          if (importTriggered && $fileInput.val()) {
            $form.attr('method', 'post');
          }
        });

        // Always set enctype (safe for both GET and POST)
        $form.attr('enctype', 'multipart/form-data');
      });
    </script>

    <?php
  }

  public function save_meta_box_data($post_id)
  {
    if (
      !isset($_POST['moversco_form_products_meta_nonce']) ||
      !wp_verify_nonce($_POST['moversco_form_products_meta_nonce'], 'moversco_form_products_meta')
    )
      return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
      return;
    if (!current_user_can('edit_post', $post_id))
      return;
    $fields = ['form_product_area', 'name_en', 'requires_disassembly', 'price', 'product_position'];
    foreach ($fields as $key) {
      if ($key === 'requires_disassembly') {
        $val = isset($_POST[$key]) ? 1 : 0;
      } else {
        $val = sanitize_text_field($_POST[$key] ?? '');
      }
      update_post_meta($post_id, $key, $val);
    }
  }



}

// Initialize the class
new MVCO_Form_Products();