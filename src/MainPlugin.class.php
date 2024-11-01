<?php 
/**
 * Plugin Name: Waiting for the tide (UK)
 * Text Domain: tide-plugin
 */
namespace TidePlugin;

use TidePlugin\Tide;

if (!defined("DS")) define("DS", DIRECTORY_SEPARATOR);


class MainPlugin {

    const SHORT_CODE = "tide_plugin";

    private $base_path  = "";
    
    /** @var TidePlugin\ShortCode */
    private $shortcode = null;

    public function __construct($path) {

        //Initiate:
        $this->base_path = $path;    
        $this->shortcode = new ShortCode(self::SHORT_CODE);

        //Load servers:
        Tide::init($this->path_to("src", "servers.json"));

        //Templates:
        Tide::use_templates($this->path_to("src", "templates"));

        //Register:
        add_action("widgets_init", [$this, "reg_widget"]);
        add_action('plugins_loaded', [$this, 'initiateLocalisation']);

        //add_action("plugins_loaded", [$this, "initiateLocalisation"]);
        add_shortcode(self::SHORT_CODE, [$this->shortcode, 'render']);

        //Register endpoints:
        add_action('wp_ajax_tide_locations', '\TidePlugin\Tide::ajax_get_server_locations');

        //Admin styles & scripts: 
        add_action('admin_enqueue_scripts', [$this, "reg_admin_styles_scripts"] );

        //Client styles & scripts:
        add_action('wp_enqueue_scripts', [$this, "reg_client_styles_scripts"] );
        
    }

    /**
     * Initiates localisation.
     */
    public function initiateLocalisation()
    {
        load_plugin_textdomain("tide-plugin", false, $this->path_to('languages'));
    }

    public function path_to(...$path_parts) {
        return rtrim($this->base_path, DS).DS.implode(DS, $path_parts);
    }

    /** 
     * Registers the widget.
     */
    public function reg_widget() 
    { 
        register_widget('TidePlugin\Widgets\TideTableWidget');
    }
    
    /**
     * Registers the styles.
     */
    public function reg_admin_styles_scripts()
    {
        wp_enqueue_style('tide-style', plugins_url('includes/admin-tide-ui.css', __FILE__));
        wp_enqueue_script('tide-script', plugins_url('includes/admin-tide-scripts.js', __FILE__), [], false, true);
        
    }

    /**
     * Registers the styles.
     */
    public function reg_client_styles_scripts()
    {
        wp_enqueue_style('tide-slider-style', plugins_url('includes/slider/sss.css', __FILE__));
        wp_enqueue_style('tide-style', plugins_url('includes/tide-themes.min.css', __FILE__), ['tide-slider-style']);
        wp_enqueue_script('jquery');
        wp_enqueue_script('tide-slider-script', plugins_url('includes/slider/sss.min.js', __FILE__), [], false, true);
        wp_enqueue_script('tide-script', plugins_url('includes/client-tide-scripts.js', __FILE__), ['tide-slider-script'], false, true);
    }

}