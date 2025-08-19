<?php
class AjaxLocations {
    private $api_key;

    public function __construct() {
        $this->api_key = get_option('moversco_postcode_api_key');
        $this->register_ajax_hooks();
    }

    private function register_ajax_hooks() {
        // Netherlands address lookup
        add_action('wp_ajax_apicheck_lookup', [$this, 'handle_nl_address_lookup']);
        add_action('wp_ajax_nopriv_apicheck_lookup', [$this, 'handle_nl_address_lookup']);

        // Belgium address lookup
        add_action('wp_ajax_address_lookup', [$this, 'handle_be_address_lookup']);
        add_action('wp_ajax_nopriv_address_lookup', [$this, 'handle_be_address_lookup']);

        // German address lookup
        add_action('wp_ajax_germ_address_lookup', [$this, 'handle_de_address_lookup']);
        add_action('wp_ajax_nopriv_germ_address_lookup', [$this, 'handle_de_address_lookup']);

        // Street search
        add_action('wp_ajax_apicheck_street_search', [$this, 'handle_street_search']);
        add_action('wp_ajax_nopriv_apicheck_street_search', [$this, 'handle_street_search']);

        // City search for Belgium
        add_action('wp_ajax_my_search_options', [$this, 'handle_be_city_search']);
        add_action('wp_ajax_nopriv_my_search_options', [$this, 'handle_be_city_search']);

        // City search for Germany
        add_action('wp_ajax_my_german_search_options', [$this, 'handle_de_city_search']);
        add_action('wp_ajax_nopriv_my_german_search_options', [$this, 'handle_de_city_search']);
    }

    private function make_api_request($url) {
        $args = [
            'headers' => [
                'X-API-KEY' => $this->api_key
            ],
            'timeout' => 30
        ];

        $response = wp_remote_get($url, $args);

        if (is_wp_error($response)) {
            wp_send_json_error($response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    public function handle_nl_address_lookup() {
        $postalcode = isset($_POST['postalcode']) ? sanitize_text_field($_POST['postalcode']) : '';
        $houseNumber = isset($_POST['houseNumber']) ? intval($_POST['houseNumber']) : 0;
        $streetNo = isset($_POST['streetNo']) ? sanitize_text_field($_POST['streetNo']) : '';

        $url = "https://api.apicheck.nl/lookup/v1/address/nl?postalcode={$postalcode}&number={$houseNumber}&numberAddition={$streetNo}";
        
        $data = $this->make_api_request($url);
        wp_send_json_success($data);
    }

    public function handle_be_address_lookup() {
        $cityID = isset($_POST['cityID']) ? sanitize_text_field($_POST['cityID']) : '';
        $streetID = isset($_POST['streetID']) ? intval($_POST['streetID']) : 0;

        $url = "https://api.apicheck.nl/search/v1/address/be?city_id={$cityID}&street_id={$streetID}";
        
        $data = $this->make_api_request($url);
        wp_send_json_success($data);
    }

    public function handle_de_address_lookup() {
        $cityID = isset($_POST['cityID']) ? sanitize_text_field($_POST['cityID']) : '';
        $streetID = isset($_POST['streetID']) ? intval($_POST['streetID']) : 0;

        $url = "https://api.apicheck.nl/search/v1/address/de?city_id={$cityID}&street_id={$streetID}";
        
        $data = $this->make_api_request($url);
        wp_send_json_success($data);
    }

    public function handle_street_search() {
        $street_name = isset($_GET['street_name']) ? sanitize_text_field($_GET['street_name']) : '';
        
        $url = "https://api.apicheck.nl/lookup/v1/address/nl?name={$street_name}";
        
        $data = $this->make_api_request($url);
        wp_send_json_success($data);
    }

    public function handle_be_city_search() {
        $search_term = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
        
        $url = add_query_arg('name', $search_term, 'https://api.apicheck.nl/search/v1/street/be');
        
        $data = $this->make_api_request($url);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error('Invalid JSON response');
        }

        $results = $this->format_city_search_results($data);
        wp_send_json($results);
    }

    public function handle_de_city_search() {
        $search_term = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
        
        $url = add_query_arg('name', $search_term, 'https://api.apicheck.nl/search/v1/street/de');
        
        $data = $this->make_api_request($url);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error('Invalid JSON response');
        }

        $results = $this->format_city_search_results($data);
        wp_send_json($results);
    }

    private function format_city_search_results($data) {
        $results = [];
        if (!empty($data['data']['Results'])) {
            foreach ($data['data']['Results'] as $result) {
                $results[] = [
                    'id' => $result['street_id'],
                    'text' => $result['name'] . ', ' . $result['City']['name'],
                    'city_name' => $result['City']['name'],
                    'city_id' => $result['City']['city_id']
                ];
            }
        }
        return $results;
    }
}

// Initialize the class
new AjaxLocations();