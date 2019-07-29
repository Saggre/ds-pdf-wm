<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/Saggre
 * @since      1.0.0
 *
 * @package    Ds_Pdf_Wm
 * @subpackage Ds_Pdf_Wm/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ds_Pdf_Wm
 * @subpackage Ds_Pdf_Wm/includes
 * @author     Sakri Koskimies <hello@designsivu.fi>
 */
class Ds_Pdf_Wm_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ds-pdf-wm',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
