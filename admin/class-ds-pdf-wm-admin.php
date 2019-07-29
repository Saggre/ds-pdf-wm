<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Saggre
 * @since      1.0.0
 *
 * @package    Ds_Pdf_Wm
 * @subpackage Ds_Pdf_Wm/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ds_Pdf_Wm
 * @subpackage Ds_Pdf_Wm/admin
 * @author     Sakri Koskimies <hello@designsivu.fi>
 */
class Ds_Pdf_Wm_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Deletes old files from stamped folder
     */
    public function delete_old_files()
    {
        $days = 7;
        $path = './logs/';

// Open the directory
        if ($handle = opendir($path)) {
            // Loop through the directory
            while (false !== ($file = readdir($handle))) {
                // Check the file we're doing is actually a file
                if (is_file($path . $file)) {
                    // Check if the file is older than X days old
                    if (filemtime($path . $file) < (time() - ($days * 24 * 60 * 60))) {
                        // Do the deletion
                        unlink($path . $file);
                    }
                }
            }
        }
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ds_Pdf_Wm_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ds_Pdf_Wm_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ds-pdf-wm-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ds_Pdf_Wm_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ds_Pdf_Wm_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ds-pdf-wm-admin.js', array('jquery'), $this->version, false);

    }

}
