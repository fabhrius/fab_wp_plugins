<?php
/*
Plugin Name: Fab Datetime Booking
Description: Plugin for booking with datetimepicker.
Version: 1.0
Author: Your Name
*/

// Include files
require_once plugin_dir_path(__FILE__) . 'php/create_reservation_table.php';
require_once plugin_dir_path(__FILE__) . 'php/create_datetime_form_shortcode.php';
require_once plugin_dir_path(__FILE__) . 'php/enqueue_scripts.php';

register_activation_hook(__FILE__, 'create_reservation_table');

?>

