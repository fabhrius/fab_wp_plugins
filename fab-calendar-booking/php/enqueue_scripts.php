<?php

function enqueue_reservation_scripts() {
    // Enqueue jQuery UI for datepicker
    wp_enqueue_script('jquery-ui-core');

    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-datepicker-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

    // Enqueue jQuery timepicker addon
    wp_enqueue_script('jquery-timepicker', 'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js', array('jquery'), null, true);
    wp_enqueue_style('jquery-timepicker-style', 'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css');

    // Enqueue custom script for handling date and time picker
    wp_enqueue_script('reservation-scripts', plugin_dir_url(__FILE__) . '../script/reservation-scripts.js', array('jquery', 'jquery-ui-datepicker', 'jquery-timepicker'), null, true);

    // Pass ajax_url to script.js
    wp_localize_script('reservation-scripts', 'reservation_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_reservation_scripts');
