=== Waiting for the tide (UK) ===

Contributors: waitingforthetide
Tags: tides, tide times, tide heights, uk tides, waiting for the tide
Requires at least: 5.6
Tested up to: 6.6.2
Stable tag: 1.0.7
Required PHP: 7.4
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Show tide times and heights for over 700 ports and beaches in Cornwall, Devon, Dorset, Hampshire, Sussex, Kent, London, Essex, Suffolk and Norfolk.

== Description ==

Show tide times and heights for over 700 ports and beaches in [Cornwall](https://www.cornwall-tides.com), [Devon](https://www.devon-tides.com), [Dorset](https://www.dorset-tides.com), [Hampshire](https://www.hampshire-tides.com), [Sussex](https://www.sussex-tides.com), [Kent](https://www.kent-tides.com), [London](https://www.london-tides.com), [Essex](https://www.essex-tides.com), [Suffolk](https://www.suffolk-tides.com) and [Norfolk](https://www.norfolk-tides.com).

* Select from over 700 UK ports and beaches
* Add tide times and heights using a sidebar widget or shortcode
* Choose between multiple design themes and viewing options
* Choose to display tide times and heights for 1, 2 or 3 days
* Include a Google Map for your location, plus optional text 
* Customisable JavaScript widget also available [here](https://www.cornwall-tides.com/add-our-tide-times-to-your-website-or-blog)


**How to use the widget**

Go to Wordpress / Appearance / Widgets and drag the widget into your sidebar. You can then configure settings for:

* Region and location
* Description (optional)
* Widget type and theme
* Number of days to show
* Advanced widget options
* Google Map view options


**How to use the shortcode**

You can add tide times and heights using the `tide_plugin` shortcode and the following options:

* **region:** use "cornwall",  "devon",  "dorset",  "hampshire",  "sussex",  "kent",  "london",  "essex",  "suffolk" or "norfolk"
* **location:** use one of the location codes from [here](https://www.cornwall-tides.com/location-codes)
* **type:** use "table" or "card" to set the widget type
* **theme:** use "basic", "space", or "ocean" to set the widget theme
* **days:** use "1", "2", or "3” to set the number of days
* **slider:** use "true" to enable widget controls when showing multiple days
* **icons:** use "false" to disable widget icons 
* **map:** use "true" to include a Google Map 
* **maptype:** use "satellite" or "roadmap" to set the type of map
* **mapzoom:** use "0" to "20" to set the initial map zoom 
* **mapwidth:** default is "100%" but you can set it to any valid CSS dimension
* **mapheight:** default is "auto" but you can set it to any valid CSS dimension

Example shortcode:

`[tide_plugin region="cornwall" location="boobys-bay" type="card" theme="ocean" days="3" slider="true" map="true" maptype="roadmap" mapzoom="12" mapwidth="100%" mapheight="400px"]Lorem ipsum dolor sit amet[/tide_plugin]`

This would show a map plus tide times and heights for the next 3 days for Booby’s Bay, Cornwall.

**Terms and conditions**

By using this plugin, you and your visitors are agreeing to our [terms and conditions of use](https://www.waiting-for-the-tide.com/privacy).

You may not use the data provided by this plugin for any other purpose than displaying tide times and heights using the plugin. You may use your own CSS styles to change the appearance of the plugin but you must not remove or obscure the links to [www.cornwall-tides.com](https://www.cornwall-tides.com), [www.devon-tides.com](https://www.devon-tides.com), [www.dorset-tides.com](https://www.dorset-tides.com), [www.hampshire-tides.com](https://www.hampshire-tides.com), [www.sussex-tides.com](https://www.sussex-tides.com), [www.kent-tides.com](https://www.kent-tides.com), [www.london-tides.com](https://www.london-tides.com), [www.essex-tides.com](https://www.essex-tides.com), [www.suffolk-tides.com](https://www.suffolk-tides.com) and [www.norfolk-tides.com](https://www.norfolk-tides.com).

We reserve the right to block or remove access to the plugin at any time.

**Privacy policy**

This plugin does not use any third-party services. You can learn more about our privacy policy [here](https://www.waiting-for-the-tide.com/privacy).

**License**

License: [GPL2](https://www.gnu.org/licenses/gpl-2.0.html)

== Installation ==

Download the zip file and extract the contents to the wp-content/plugins/ directory of your WordPress installation. Activate the plugin from the WordPress Plugins page.

== Frequently Asked Questions ==

= Is there a JavaScript version of this plugin? =

Yes, we have an awesome JavaScript widget for you [here](https://www.cornwall-tides.com/add-our-tide-times-to-your-website-or-blog)

= How do I find a list of locations to use with the shortcode? =

You can find a list of location codes [here](https://www.cornwall-tides.com/location-codes).

= How are the tide times and heights calculated? =

Great question! We wrote an article for you about [how tide times and heights are calculated](https://www.cornwall-tides.com/faqs).

= Are there similar plugins for other parts of the UK or the world? =

Sorry, no, we don’t have any plans to cover other parts of the world but we plan to cover other parts of the UK in the near future.

= What did the beach say when the tide came in? =

Long time, no sea.

== Screenshots ==

1. Sidebar widget with Google Map (Basic, Ocean and Space themes)
2. Shortcode widget with Google Map and date controls (Basic theme)
3. Shortcode widget with Google Map and date controls (Ocean theme)
4. Shortcode widget with Google Map and date controls (Space theme)
5. Sidebar widget settings

== Changelog ==

= 1.0.7 =
- Stable release