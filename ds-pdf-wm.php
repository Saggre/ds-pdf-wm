<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/Saggre
 * @since             1.0.0
 * @package           Ds_Pdf_Wm
 *
 * @wordpress-plugin
 * Plugin Name:       Designsivu.fi PDF Watermark & Metadata Plugin
 * Plugin URI:        https://designsivu.fi
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Sakri Koskimies
 * Author URI:        https://github.com/Saggre
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ds-pdf-wm
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('DS_PDF_WM_VERSION', '1.0.0');
define('ROOT_PATH', plugin_dir_path(__FILE__));
define('ROOT_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ds-pdf-wm-activator.php
 */
function activate_ds_pdf_wm()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-ds-pdf-wm-activator.php';
    Ds_Pdf_Wm_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ds-pdf-wm-deactivator.php
 */
function deactivate_ds_pdf_wm()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-ds-pdf-wm-deactivator.php';
    Ds_Pdf_Wm_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_ds_pdf_wm');
register_deactivation_hook(__FILE__, 'deactivate_ds_pdf_wm');

require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

require plugin_dir_path(__FILE__) . 'includes/PdfMake.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-ds-pdf-wm.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ds_pdf_wm()
{

    $plugin = new Ds_Pdf_Wm();
    $plugin->run();

}

run_ds_pdf_wm();
