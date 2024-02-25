<?php
/**
 * Plugin Name: Fab Message Service
 * Description: A REST Service that handles messages from a mobile app.
 * Version: 1.0
 * Author: Fab
 */

// Include the main class file
include_once(plugin_dir_path(__FILE__) . 'db/create_msgtable.php');

include_once(plugin_dir_path(__FILE__) . 'class/mobile_message_manager.php');

// Instantiate the main class
$my_plugin = new Mobile_Message_Manager();

// Register activation and deactivation hooks
register_activation_hook(__FILE__, array($my_plugin, 'activate'));
register_deactivation_hook(__FILE__, array($my_plugin, 'deactivate'));



?>