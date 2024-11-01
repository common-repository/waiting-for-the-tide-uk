<?php 
/**
 * Plugin Name: Waiting for the tide (UK)
 * Text Domain: tide-plugin
 */
namespace TidePlugin;

use \GuzzleHttp\Client;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Tide {

    static ?\Twig\Loader\FilesystemLoader $templates = null;

    static $templates_path = '.';

    static public function  use_templates(string $folder) {

        self::$templates_path = $folder;
        self::$templates = new FilesystemLoader($folder);

    }

    const DEFAULT_WIDGET_OPTIONS  = [
        "id"        => "tide-table-@",
        "class"     => "tide-plugin",
        // "title"     => "Tide Widget",
        "content"   => "",
        "map"       => false,
        "days"      => 3,
        "region"    => "cornwall",
        "location"  => "boscastle",
        "type"      => "table",
        "theme"     => "basic",
        "mapmode"   => "place", // view, place
        "maptype"   => "roadmap", //satellite, roadmap
        "mapzoom"   => 12,
        "mapwidth"  => "100%",
        "mapheight" => "200px",
        "key"       => "AIzaSyDfKlnT0Aq6QOx27AA2u1WHAws9-c_tjgk",
        "slider"    => false,
        "icons"     => true,
        "footer"    => false
    ];

    const DEFAULT_SHORT_OPTIONS  = [
        "id"        => "tide-table-@",
        "class"     => "tide-plugin",
        // "title"     => "Tide Shortcode",
        "content"   => "",
        "map"       => true,
        "days"      => 3,
        "region"    => "cornwall",
        "location"  => "boscastle",
        "type"      => "table",
        "theme"     => "basic",
        "mapmode"   => "place", // view, place
        "maptype"   => "roadmap", //satellite, roadmap
        "mapzoom"   => 12,
        "mapwidth"  => "100%",
        "mapheight" => "200px",
        "key"       => "AIzaSyDfKlnT0Aq6QOx27AA2u1WHAws9-c_tjgk",
        "slider"    => false,
        "icons"     => true,
        "footer"    => false
    ];

    static public $map_types = [];

    static public $types = [];

    static public $themes = [];

    static $servers = [];

    /** @var Client $client */
    static $client;

    public $args = [];

    public $build_as = "widget";

    static private $cache = [];

    public function __construct(
        $args = [],
        $which = "widget"
    ) {
        //Prep arguments:
        $this->build_as = $which;
        $this->args = array_merge($this->build_as === "widget" ? self::DEFAULT_WIDGET_OPTIONS : self::DEFAULT_SHORT_OPTIONS, $args);

        //Add Id index:
        $this->args["id"] = str_replace("@", uniqid(), $this->args["id"]);

    }

    public function render() {
        
        $twig = new Environment(self::$templates, [
            "cache"         => self::$templates_path.DIRECTORY_SEPARATOR."cache",
            "auto_reload"   => true 
        ]);

        $use_template = $this->args["type"]."_view.twig";
        $apply_theme  = "theme-".$this->args["theme"];

        $template = $twig->load($use_template);

        //Get location:
        $data = self::get_location($this->args["region"], $this->args["location"]);

        $location = array_key_exists("location", $data) ? "{$data["region"]}, {$data["location"]}" : $this->args["location"];
        $location_display = array_key_exists("location", $data) ? ucfirst($data["location"]) : $location;
        $coordinates = array_key_exists("lat", $data) ? "{$data["lat"]},{$data["lon"]}" : null;
        $content = trim($this->args["content"]);

        //Pat Tide data points:
        foreach ($data["data"] ?? [] as $key1 => $day) {
            foreach ($day["rows"] ?? [] as $key2 => $row) {
                $padded = str_pad(trim($row[0]), 5, " ", STR_PAD_RIGHT);
                $padded = str_replace(" ", "&nbsp;", $padded);
                $data["data"][$key1]["rows"][$key2][0] = $padded;
            }
        }
        return $template->render([
            "container_id"      => $this->args["id"],
            "container_class"   => $this->args["class"],
            "included_by"       => $this->build_as,
            "theme"             => $apply_theme,
            // "title"             => $this->args["title"],
            "location"          => $location,
            "location_display"  => $location_display,
            "content"           => empty($content) ? false : $content,
            "days"              => $this->args["days"],
            "type_header"       => __("Tide",   "tide-plugin"),
            "time_header"       => __("Time",   "tide-plugin"),
            "height_header"     => __("Height", "tide-plugin"),
            "data"              => $data["data"] ?? [],
            "footer_title"      => $data["footer1 text"] ?? "",
            "footer_link_url"   => $data["footer1 url"] ?? "",
            "footer_link_text"  => $data["footer2 text"] ?? "",
            "data_location"     => $this->args["location"],
            "data_region"       => $this->args["region"],
            "map"               => $this->args["map"],
            "map_key"           => $this->args["key"],
            "map_location"      => sprintf("%s+%s+UK", $this->args["location"], $this->args["region"]),
            "map_coordinates"   => $coordinates,
            "map_zoom"          => $this->args["mapzoom"],
            "map_type"          => $this->args["maptype"],
            "map_mode"          => $this->args["mapmode"],
            "map_height"        => $this->args["mapheight"],
            "map_width"         => $this->args["mapwidth"],
            "slider"            => $this->args["slider"],
            "icons"             => $this->args["icons"],
            "footer"            => $this->args["footer"]
        ]);
    }

    static public function init($servers_path) {
        
        self::$client = new Client();
        self::load_servers($servers_path);

        //Set variation with language support:
        self::$types["table"] = __("Table", "tide-plugin");
        self::$types["card"]  = __("Card", "tide-plugin");

        self::$themes["basic"] = __("Basic", "tide-plugin");
        self::$themes["ocean"] = __("Ocean", "tide-plugin");
        self::$themes["space"]   = __("Space", "tide-plugin");

        self::$map_types["roadmap"] = __("Roadmap", "tide-plugin");
        self::$map_types["satellite"]  = __("Satellite", "tide-plugin");

    }

    static public function load_servers($path) {
        if ($content = file_get_contents($path)) {
            self::$servers = json_decode($content, true) ?? [];
        }
        ksort(self::$servers);
    }

    static public function get_servers_list() {
        $list = [];
        foreach (self::$servers as $id => $values) {
            $list[$id] = $values["name"];
        }
        return $list;
    }

    static public function build_uri($server, $location = "", $all = false) {
        return sprintf(
            "%s/w/%s", 
            rtrim(self::$servers[$server]["domain"], " /\t\n\r\0\\"),
            $all ? trim(self::$servers[$server]["all"], " /\t\n\r\0\\")
                 : trim($location, " /\t\n\r\0\\")
        );
    }

    static public function has_server($region) {
        return array_key_exists($region, self::$servers);
    }

    static public function get_location($region, $location) {
        //Make sure we have the server:
        if (self::has_server($region)) {
            //In cache?
            $cached = self::get_cached($region.$location, false);
            if ($cached !== false) {
                return $cached;
            }
            //Query the server:
            $uri = self::build_uri($region, $location, false);
            $result = self::$client->get($uri, ['allow_redirects' => false]);
            //Parse response:
            if ($result->getStatusCode() == 200) {
                $json = json_decode((string)$result->getBody(), true);
                //Save to cached:
                if ($json) self::set_cached($region.$location, $json);
                return $json ? $json : [];
            }
        }
        return [];
    }

    
    static public function get_server_locations($region) {
        //Make sure we have the server:
        if (self::has_server($region)) {
            //Query the server:
            $uri = self::build_uri($region, "", true);
            $result = self::$client->get($uri, ['allow_redirects' => false]);
            //Parse response:
            if ($result->getStatusCode() == 200) {
                $json = json_decode((string)$result->getBody(), true);
                return array_flip($json ? $json : []);
            }
        }
        return [];
    }

    static public function ajax_get_server_locations($message) {
        
        //Safe get args: only region is allowed:
        $args = wp_parse_args($_POST, [
            "region" => "none"
        ]);
        
        //Sanitize region: only keys (lowercase [^a-z0-9_\-]) names are allowed:
        $args["region"] = sanitize_key($args["region"]);

        //Get locations:
        //NOTE: validation is done in here -> only existing regions are allowed compared to the list of servers
        //NOTE: safe key exists check with array_key_exists....
        $locations = self::get_server_locations($args["region"]);
        $return = [
            "locations" => $locations,
            "args" => $args
        ];
        wp_send_json($return, 200); 
    }

    static public function get_cached($key, $default = null) {
        return array_key_exists($key, self::$cache) ? self::$cache[$key] : $default;
    }

    static public function set_cached($key, $value) {
        self::$cache[$key] = $value;
    }

    static public function _debug($message, ...$variables) {
        $message = $message."\n".json_encode($variables, JSON_PRETTY_PRINT)."\n\n";
        file_put_contents(__DIR__.DIRECTORY_SEPARATOR.'tidelog.log', $message, FILE_APPEND);
    }

}