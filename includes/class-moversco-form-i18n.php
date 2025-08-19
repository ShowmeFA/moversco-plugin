<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://fadigitals.com
 * @since      1.0.0
 *
 * @package    Moversco_Form
 * @subpackage Moversco_Form/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Moversco_Form
 * @subpackage Moversco_Form/includes
 * @author     Faizan Ali <showmefa@outlook.com>
 */
class Moversco_Form_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		 load_plugin_textdomain(
            'moversco',
            false,
            MOVERSCO_FORM_DIR . 'languages'
        );

	}



}
