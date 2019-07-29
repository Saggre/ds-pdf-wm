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
 * shortcodes
 *
 * @package    Ds_Pdf_Wm
 * @subpackage Ds_Pdf_Wm/public
 * @author     Sakri Koskimies <hello@designsivu.fi>
 */
class Ds_Pdf_Wm_Shortcodes
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
     * [ds-pdf-wm href="url"]
     * @param $atts
     * @return string
     */
    function create_pdf_download_link($atts, $content = "")
    {
        $a = shortcode_atts(array(
            'href' => '',
        ), $atts);

        $href = get_site_url() . '?pdfdl=' . urlencode($a["href"]);

        return "<a href='$href'>$content</a>";
    }

}
