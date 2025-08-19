<?php
class StreetSearch {
    private $api_key;

    public function __construct() {
        $this->api_key = get_option('moversco_postcode_api_key');
    }

    public function search_streets($query) {
        $url = 'https://api.apicheck.nl/search/v1/street?query=' . urlencode($query) . '&api_key=' . $this->api_key;

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return [];
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        return $data['streets'] ?? [];
    }
}