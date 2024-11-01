<?php
/**
 * Plugin Name: Waiting for the tide (UK)
 * Text Domain: tide-plugin
 */
namespace TidePlugin;

use TidePlugin\Tide;

class ShortCode
{

    public $tag = "shortcode";

    /**
     * Shortcode constructor.
     */
    public function __construct($tag)
    {
        $this->tag = trim(strtolower($tag));
    }

    /**
     * @param array $attr
     * @param string|null $content
     * @return string
     */
    public function render($attr = [], $content = null)
    {
        // normalize attribute keys, lowercase
        $attr = array_change_key_case( (array) $attr, CASE_LOWER );
        $attr = shortcode_atts(Tide::DEFAULT_SHORT_OPTIONS, $attr);
        //$attr["content"] = do_shortcode($content);
        $attr["content"] = $content;
        //Validate region:
        $attr['region'] = Tide::has_server(strtolower($attr['region'])) ? strtolower($attr['region']) : Tide::DEFAULT_SHORT_OPTIONS["region"];
        //Validate type:
        $attr['type'] = array_key_exists(strtolower($attr['type']), Tide::$types) ? strtolower($attr['type']) : Tide::DEFAULT_SHORT_OPTIONS["type"];  
        //Validate theme:
        $attr['theme'] = array_key_exists(strtolower($attr['theme']), Tide::$themes) ? strtolower($attr['theme']) : Tide::DEFAULT_SHORT_OPTIONS["theme"]; 
        //Validate days:
        $attr['days'] = is_numeric($attr['days']) && intval($attr['days']) >= 1  ? intval($attr['days']) : Tide::DEFAULT_SHORT_OPTIONS["days"]; 
        //Validate map:
        $attr['map'] = in_array($attr["map"], [1, "1", true, "true"], true) ? true : false; 
        //Validate mapzoom:
        $attr['mapzoom'] = is_numeric($attr["mapzoom"]) && intval($attr['mapzoom']) >= 0 && intval($attr['mapzoom']) <= 20 ? intval($attr['mapzoom']) : Tide::DEFAULT_SHORT_OPTIONS["mapzoom"]; 
        //Validate maptype:
        $attr['maptype'] = array_key_exists(strtolower($attr['maptype']), Tide::$map_types) ? strtolower($attr['maptype']) : Tide::DEFAULT_SHORT_OPTIONS["maptype"]; 
        //Validate slider:
        $attr['slider'] = in_array($attr["slider"], [1, "1", true, "true"], true) ? true : false; 
        //Validate icons:
        $attr['icons'] = in_array($attr["icons"], [1, "1", true, "true"], true) ? true : false; 
        //Build & render:
        $tide = new Tide($attr, "shortcode");
        return $tide->render();
    }
}
