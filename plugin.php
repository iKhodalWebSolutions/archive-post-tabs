<?php 
/*
  Plugin Name: Monthly category archive tabs wordpress plugin
  Description: Displays archive posts in monthly category tabs
  Author: iKhodal Web Solution
  Plugin URI: https://www.ikhodal.com/wp-archive-posts-tabs
  Author URI: https://www.ikhodal.com
  Version: 2.1
  Text Domain: archivesposttab
*/ 
  
//////////////////////////////////////////////////////
// Defines the constants for use within the plugin. //
////////////////////////////////////////////////////// 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  
  
        
/**
* Define store url to validate license
*/
define( 'archivesposttab_license_url', 'https://www.ikhodal.com');
                
/**
*  Assets of the plugin
*/
$avptab_plugins_url = plugins_url( "/assets/", __FILE__ );

define( 'avptab_media', $avptab_plugins_url ); 

/**
*  Plugin DIR
*/
$avptab_plugin_DIR = plugin_basename(dirname(__FILE__));

define( 'avptab_plugin_dir', $avptab_plugin_DIR ); 
 
/**
 * Include abstract class for common methods
 */
require_once 'include/abstract.php';


///////////////////////////////////////////////////////
// Include files for widget and shortcode management //
///////////////////////////////////////////////////////

/**
 * Register custom post type for shortcode
 */ 
require_once 'include/shortcode.php';

/**
 * Admin panel widget configuration
 */ 
require_once 'include/admin.php'; 

/**
 * Load Archive Post Tabs on frontent pages
 */
require_once 'include/archivesposttab.php'; 

/**
 * Clean data on activation / deactivation
 */
require_once 'include/activation_deactivation.php';  
 