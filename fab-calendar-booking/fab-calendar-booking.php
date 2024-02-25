<?php
/*
Plugin Name: fab-calendar-booking
Description: Allows users to make reservations and appointments.
Version: 1.0
Author: Fab
*/

error_log('starting plugin fab-booking.');


require_once(plugin_dir_path(__FILE__) . 'php/create_reservation_table.php');
require_once(plugin_dir_path(__FILE__) . 'php/enqueue_scripts.php');
require_once(plugin_dir_path(__FILE__) . 'php/create_reservation_form_shortcode.php');

