<?php
/**
 * Class AddressLookup
 *
 * This class handles the logic for looking up addresses based on user input and API responses.
 */
class AddressLookup {

    private $api_key;

    public function __construct() {
        $this->api_key = get_option('moversco_postcode_api_key');
    }

    /**
     * Lookup address based on postal code and house number.
     *
     * @param string $postalcode
     * @param int $houseNumber
     * @return array|WP_Error
     */
    public function lookupAddress($postalcode, $houseNumber) {
        $url = 'https://api.apicheck.nl/lookup/v1/address/nl?postalcode=' . urlencode($postalcode) . '&number=' . intval($houseNumber);

        $response = wp_remote_get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_key,
            ],
        ]);

        if (is_wp_error($response)) {
            return $response;
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }
}
?>