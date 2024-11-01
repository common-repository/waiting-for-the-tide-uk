<?php
defined('ABSPATH') or die('Not Allowed');
/**
* Plugin Name: Waiting for the tide (UK)
* Plugin URI: https://www.waiting-for-the-tide.com/
* Description: Show tide times and heights for over 700 ports and beaches in the UK. Includes multiple themes and advanced customisation options. Ideal for local blogs, hotels or business sites.
* Version: 1.0.7
* Requires at least: 5.6
* Tested up to: 6.0.2
* Requires PHP: 7.4
* Author: Waiting for the tide
* Text Domain: tide-plugin
* Domain Path: /languages
**/

require_once __DIR__.DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."autoload.php";

use \TidePlugin\MainPlugin;

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


$TidePlugin = new MainPlugin(__DIR__);