<?php
class ApiCheckHandler {
    private $api_key;

    public function __construct() {
        $this->api_key = get_option('moversco_postcode_api_key');
    }

    public function lookup_address($postalcode, $houseNumber, $streetNo) {
        $url = 'https://api.apicheck.nl/lookup/v1/address/nl?postalcode=' . urlencode($postalcode) . '&number=' . intval($houseNumber) . '&numberAddition=' . urlencode($streetNo);
        
        $response = wp_remote_get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_key,
            ],
        ]);

        if (is_wp_error($response)) {
            return [
                'success' => false,
                'message' => $response->get_error_message(),
            ];
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        return [
            'success' => true,
            'data' => $data,
        ];
    }
}