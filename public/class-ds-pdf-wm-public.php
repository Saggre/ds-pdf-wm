<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/Saggre
 * @since      1.0.0
 *
 * @package    Ds_Pdf_Wm
 * @subpackage Ds_Pdf_Wm/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ds_Pdf_Wm
 * @subpackage Ds_Pdf_Wm/public
 * @author     Sakri Koskimies <hello@designsivu.fi>
 */
class Ds_Pdf_Wm_Public
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
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Converts an url into a filesystem path
     * @param $url
     * @return string
     */
    private function url2path($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        return str_replace("//", "/", $_SERVER['DOCUMENT_ROOT'] . $path);
    }

    function create_watermark_text($current_user)
    {
        $user_id = $current_user->ID;
        $user_first_name = $current_user->user_firstname;
        $user_last_name = $current_user->user_lastname;
        $user_email = $current_user->user_email;
        $organisation = get_user_meta($user_id, 'organisation', true);

        $watermark = '';

        if (!empty($organisation)) {
            $watermark .= $organisation;
        }

        if (!empty($user_first_name) && !empty($user_last_name)) {
            if (strlen($watermark) > 0) {
                $watermark .= ', ';
            }
            $watermark .= $user_first_name . ' ' . $user_last_name;
        }

        return $watermark;
    }

    /**
     * Finds and stamps a PDF-file if $_GET['pdfdl'] is not empty
     */
    public function parse_request()
    {
        $fileName = 'file.pdf';

        if (empty($_GET['pdfdl'])) {
            // Not downloading pdf
            return;
        }

        $current_user = wp_get_current_user();
        if ($current_user->ID == 0) {
            // Not logged in
            return;
        }

        $watermark_text = $this->create_watermark_text($current_user);

        // File url
        $file_url = urldecode($_GET['pdfdl']);

        // File path in local filesystem
        $file_path = $this->url2path($file_url);

        $output_path = ROOT_PATH . 'stamped/' . $fileName;

        try {
            $pdf_make = new PdfMake();
            $pdf_make->AddFooterWatermark($watermark_text, $file_path, $output_path);

            $pdf_url = ROOT_URL . 'stamped/' . $fileName;
        } catch (Exception $e) {
            // Fallback and return original file

            $pdf_url = $file_url;
        }

        // Redirect user
        header('Content-type: application/pdf');
        header("Location: " . $pdf_url);
        exit;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ds-pdf-wm-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ds-pdf-wm-public.js', array('jquery'), $this->version, false);

    }

}
