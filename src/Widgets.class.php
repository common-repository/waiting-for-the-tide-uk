<?php
/**
 * Plugin Name: Waiting for the tide (UK)
 * Text Domain: tide-plugin
 */
namespace TidePlugin\Widgets;

use TidePlugin\Tide;
use TidePlugin\Inputs\SelectField;
use TidePlugin\Inputs\TextField;
use TidePlugin\Inputs\NumberField;
use TidePlugin\Inputs\ToggleField;
use TidePlugin\Inputs\TextAreaField;

/**
 * Class Widget
 */
class TideTableWidget extends \WP_Widget
{

    const CACHE_KEY = 'tide-locations';   

    /**
     * Widget constructor.
     */
    public function __construct()
    {
        parent::__construct(     
            'tide_table', 
            __('Waiting for the tide (UK)', "tide-plugin"), 
            [
                'classname' => 'tide_table',
                'description' => __('Show tide times and heights for over 700 ports and beaches in the UK. Includes multiple themes and advanced customisation options.', "tide-plugin")
            ]
        );
    }

    /**
     * Shows the widget.
     *
     * @param $attr   
     * @param $instance
     */
    public function widget($attr, $instance)
    {
        $instance = shortcode_atts(Tide::DEFAULT_WIDGET_OPTIONS, $instance);

        $tide = new Tide($instance, "widget");

        echo $tide->render();
    }

    /**
     * Displays the form on the widget admin WP page.
     *
     * @param $instance
     */
    public function form($instance)
    {
        // Set default values
        $instance = wp_parse_args($instance, Tide::DEFAULT_WIDGET_OPTIONS);

        // $title = new TextField(
        //     $this->get_field_id('title'),
        //     $this->get_field_name('title'),
        //     "tide-opt-title",
        //     esc_attr($instance['title']),
        //     __('Widget Title', "tide-plugin"),
        //     __('Enter a title to display', "tide-plugin"),
        //     esc_attr__('Tide times of...', "tide-plugin")
        // );        

        $all_servers = Tide::get_servers_list();
        $servers = new SelectField(
            $this->get_field_id('region'),
            $this->get_field_name('region'),
            "tide-opt-region",
            $instance['region'],
            __('Region', "tide-plugin"),
            null,
            $all_servers
        );

        $all_locations = Tide::get_server_locations($instance['region']);
        $location = new SelectField(
            $this->get_field_id('location'),
            $this->get_field_name('location'),
            "tide-opt-location",
            $instance['location'],
            __('Location', "tide-plugin"),
            null,
            $all_locations
        );
        $type = new SelectField(
            $this->get_field_id('type'),
            $this->get_field_name('type'),
            "tide-opt-type",
            $instance['type'],
            __('Widget type', "tide-plugin"),
            null,
            Tide::$types
        );
        $theme = new SelectField(
            $this->get_field_id('theme'),
            $this->get_field_name('theme'),
            "tide-opt-theme",
            $instance['theme'],
            __('Widget theme', "tide-plugin"),
            null,
            Tide::$themes
        );
        $days = new SelectField(
            $this->get_field_id('days'),
            $this->get_field_name('days'),
            "tide-opt-days",
            $instance['days'],
            __('Number of days', "tide-plugin"),
            null,
            [
                1 => __('1 day', "tide-plugin"),
                2 => __('2 days', "tide-plugin"),
                3 => __('3 days', "tide-plugin")
            ]
        );
        $map = new ToggleField(
            $this->get_field_id('map'),
            $this->get_field_name('map'),
            "tide-opt-map",
            $instance['map'],
            __('Include Google Map', "tide-plugin"),
            null, 
            null
        );
        $content = new TextAreaField(
            $this->get_field_id('content'),
            $this->get_field_name('content'),
            "tide-opt-content",
            [5, 60],
            esc_attr($instance['content']),
            __('Description (optional)', "tide-plugin"),
            null,
            esc_attr__('Add an optional description...', "tide-plugin")
        );
        $static_id = new TextField(
            $this->get_field_id('static-id'),
            $this->get_field_name('static-id'),
            "tide-opt-static-id",
            esc_attr($instance['id']),
            __('Static id (optional)', "tide-plugin"),
            __('Enter an id to use with this instance', "tide-plugin"),
            esc_attr__('Leave blank for default', "tide-plugin")
        );  
        
        $maptype = new SelectField(
            $this->get_field_id('maptype'),
            $this->get_field_name('maptype'),
            "tide-opt-maptype",
            $instance['maptype'],
            __('Google Map theme', "tide-plugin"),
            null,
            Tide::$map_types, 
            !$instance['map']
        );

        $mapzoom = new NumberField(
            $this->get_field_id('mapzoom'),
            $this->get_field_name('mapzoom'),
            "tide-opt-mapzoom",
            [0,20],
            esc_attr($instance['mapzoom']),
            __('Google Map zoom level', "tide-plugin"),
            __('Enter a value between 0 and 20', "tide-plugin"),
            esc_attr__('0-20', "tide-plugin"), 
            !$instance['map']
        );

        // $key = new TextField(
        //     $this->get_field_id('mapkey'),
        //     $this->get_field_name('mapkey'),
        //     "tide-opt-mapkey",
        //     esc_attr($instance['key']),
        //     __('Google map key', "tide-plugin"),
        //     __('Set google map key or blank for default', "tide-plugin"),
        //     esc_attr__('You key or blank for default', "tide-plugin"), 
        //     !$instance['map']
        // );

        $mapheight = new TextField(
            $this->get_field_id('mapheight'),
            $this->get_field_name('mapheight'),
            "tide-opt-mapheight",
            esc_attr($instance['mapheight']),
            __('Google Map height', "tide-plugin"),
            null,
            esc_attr__('Any valid CSS size unit', "tide-plugin"), 
            !$instance['map']
        );

        $mapwidth = new TextField(
            $this->get_field_id('mapwidth'),
            $this->get_field_name('mapwidth'),
            "tide-opt-mapwidth",
            esc_attr($instance['mapwidth']),
            __('Google Map width', "tide-plugin"),
            null,
            esc_attr__('Any valid CSS size unit', "tide-plugin"), 
            !$instance['map']
        );

        $slider = new ToggleField(
            $this->get_field_id('slider'),
            $this->get_field_name('slider'),
            "tide-opt-slider",
            $instance['slider'],
            __('Include widget controls when showing multiple days', "tide-plugin"),
            null, 
            null
        );

        $icons = new ToggleField(
            $this->get_field_id('icons'),
            $this->get_field_name('icons'),
            "tide-opt-icons",
            $instance['icons'],
            __('Include widget icons', "tide-plugin"),
            null,
            null
        );

        $servers->render();
        $location->render();
        // $title->render();
        $content->render();
        $type->render();
        $theme->render();
        $days->render();
        $slider->render();
        $icons->render();
        $map->render();
        $maptype->render();
        $mapzoom->render();
        $mapwidth->render();
        $mapheight->render();
        // $key->render();
        $static_id->render();
    }

    /**
     * @param $newInstance
     * @param $oldInstance
     * @return mixed
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        // $instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
        $instance['region']   = isset( $new_instance['region'] ) && !empty($new_instance['region'])
                                    ? wp_strip_all_tags( $new_instance['region'] ) 
                                    : Tide::DEFAULT_WIDGET_OPTIONS["region"];
        $instance['location'] = isset( $new_instance['location'] )  && !empty($new_instance['location'])
                                    ? wp_strip_all_tags( $new_instance['location'] ) 
                                    : Tide::DEFAULT_WIDGET_OPTIONS["location"];
        $instance['type']     = isset( $new_instance['type'] ) &&  array_key_exists($new_instance['type'], Tide::$types)
                                    ? $new_instance['type']
                                    : Tide::DEFAULT_WIDGET_OPTIONS["type"];
        $instance['theme']    = isset( $new_instance['theme'] ) && array_key_exists($new_instance['theme'], Tide::$themes) 
                                    ? $new_instance['theme']
                                    : Tide::DEFAULT_WIDGET_OPTIONS["theme"];
        $instance['days']     = isset( $new_instance['days'] ) && is_numeric($new_instance['days']) && intval($new_instance['days']) >= 1
                                    ? intval( $new_instance['days'] ) 
                                    : Tide::DEFAULT_WIDGET_OPTIONS["days"];

        $instance['map']      = array_key_exists("map", $new_instance) && in_array($new_instance["map"], [1, "1", true, "true"], true) 
                                    ? true
                                    : false;
        $instance['mapzoom']  = array_key_exists("mapzoom", $new_instance) && is_numeric($new_instance["mapzoom"]) && intval($new_instance['mapzoom']) >= 0 && intval($new_instance['mapzoom']) <= 20
                                    ? intval( $new_instance['mapzoom'] ) 
                                    : Tide::DEFAULT_WIDGET_OPTIONS["mapzoom"];
        // $instance['key']    = isset( $new_instance['key'] ) && !empty( $new_instance['key'])
        //                             ?  $new_instance['key']
        //                             : Tide::DEFAULT_WIDGET_OPTIONS["key"];
        $instance['maptype']= isset( $new_instance['maptype'] ) && array_key_exists($new_instance['maptype'], Tide::$map_types) 
                                    ?  $new_instance['maptype']
                                    : Tide::DEFAULT_WIDGET_OPTIONS["maptype"];
        $instance['mapwidth']    = isset( $new_instance['mapwidth'] ) && !empty( $new_instance['mapwidth'])
                                    ?  $new_instance['mapwidth']
                                    : Tide::DEFAULT_WIDGET_OPTIONS["mapwidth"];
        $instance['mapheight']    = isset( $new_instance['mapheight'] ) && !empty( $new_instance['mapheight'])
                                    ?  $new_instance['mapheight']
                                    : Tide::DEFAULT_WIDGET_OPTIONS["mapheight"];
        $instance['content']  = isset( $new_instance['content'] ) ? wp_kses_post( $new_instance['content'] ) : '';
        $instance['id']       = isset( $new_instance['static-id'] ) && !empty($new_instance['static-id'])
                                    ? wp_strip_all_tags( $new_instance['static-id'] ) 
                                    : '';
        $instance['slider'] = isset( $new_instance['slider'] ) && in_array($new_instance["slider"], [1, "1", true, "true"], true) ? true : false; 
        $instance['icons'] = isset( $new_instance['icons'] ) && in_array($new_instance["icons"], [1, "1", true, "true"], true) ? true : false; 

        // Tide::_debug("Tide", Tide::$types, Tide::$themes);
        // Tide::_debug("Save widget options", $old_instance, $new_instance, $instance);

        return $instance;

    }
}
