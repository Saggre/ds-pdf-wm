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

    /**Converts an url into a filesystem path
     * @param $url
     * @return string
     */
    private function url2path($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        return $_SERVER['DOCUMENT_ROOT'] . $path;
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

        print_r($current_user);
        exit;

        $fileUrl = urldecode($_GET['pdfdl']);
        $filePath = $this->url2path($fileUrl);

        $outputPath = ROOT_PATH . 'stamped/' . $fileName;

        $pdfMake = new PdfMake();
        $pdfMake->AddFooterWatermark($filePath, $outputPath);

        $pdfUrl = ROOT_URL . 'stamped/' . $fileName;

        // Redirect user
        header('Content-type: application/pdf');
        header("Location: " . $pdfUrl);
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
