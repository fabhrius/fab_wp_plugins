<?php

// Enqueue jQuery UI Datepicker
function enqueue_datepicker() {
    wp_enqueue_script('jquery-ui-datepicker');
}
add_action('wp_enqueue_scripts', 'enqueue_datepicker');




function fab_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('datetimepicker-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js', array('jquery'), '2.5.20', true);
    wp_enqueue_style('datetimepicker-css', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css', array(), '2.5.20');

        // Enqueue custom script for handling date and time picker
        // wp_enqueue_script('reservation-scripts', plugin_dir_url(__FILE__) . '../script/reservation-scripts.js', array('jquery', 'datetimepicker-js'), null, true);

        // Pass ajax_url to script.js
        //wp_localize_script('reservation-scripts', 'reservation_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'fab_enqueue_scripts');


// Enqueue script with localized data
function enqueue_timepicker_with_ajax() {
    wp_enqueue_script('reservation-scripts', plugin_dir_url(__FILE__) . '../script/reservation-scripts.js', array('jquery', 'datetimepicker-js'), null, true);
    wp_localize_script('reservation-scripts', 'reservation_ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_timepicker_with_ajax');

// AJAX handler to fetch available times for selected date
add_action('wp_ajax_get_available_times', 'get_available_times_callback');
add_action('wp_ajax_nopriv_get_available_times', 'get_available_times_callback'); // Allow non-logged-in users to access the AJAX endpoint

function get_available_times_callback() {
    // Retrieve selected date from AJAX request
    $selected_date = $_POST['selectedDate'];

    $available_times = generate_available_times_by_day($selected_date);

    // Return available times as JSON response
    wp_send_json_success(array('availableTimes' => $available_times));
    wp_die();
}


/************************************************* */


// Function to retrieve booked times from the database for a given date

function get_booked_times($selected_date) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'bookings'; // Assuming 'bookings' is the table name

    // Query to retrieve booked times with hour and minute parts
    $booked_times = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT CONCAT(LPAD(HOUR(booking_date), 2, '0'), ':', LPAD(MINUTE(booking_date), 2, '0')) AS booking_time FROM $table_name WHERE DATE(booking_date) = %s",            
            $selected_date
        )
    );

    return $booked_times;
}


// Function to generate available times for a given date
function generate_available_times_by_day($selected_date) {
    // Define array to store available times
    $available_times = array();

    // Define all possible times of the day (assuming hourly intervals)
    $start_time = strtotime('09:00');
    $end_time = strtotime('17:00');
    $interval = 60 * 60; // 1 hour interval
    for ($time = $start_time; $time <= $end_time; $time += $interval) {
        $available_times[] = date('H:i', $time);
    }

    // Retrieve booked times for the selected date
    $booked_times = get_booked_times($selected_date);
    error_log('booked times : ' . json_encode($booked_times));

    // Remove booked times from available times
    error_log('available_times befor : ' . json_encode($available_times));

    $available_times = array_diff($available_times, $booked_times);
    // error_log('available_times after : ' . json_encode($available_times));

    $new_available_times = array();

    // foreach ($booked_times as $booking) {
    //     $key = array_search($booking, $available_times);
    //     if ($key !== false) {
    //         unset($available_times[$key]);
    //         error_log('available_times in the loop : ' . json_encode($available_times));
    //     } 
    // }
    foreach($available_times as $times){
        $new_available_times[] = $times;
        error_log('new_available_times in the loop : ' . json_encode($new_available_times));
    }



    return $new_available_times;
}

?>
