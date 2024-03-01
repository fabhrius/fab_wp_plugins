<?php
function booking_form_shortcode() {
    create_reservation_table();

    ob_start();
    ?>
    <form id="booking-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="handle_booking_form">

        <label for="booking-date">Select Date and Time:</label>
        <input type="text" id="booking-date" name="booking-date" class="datetimepicker" />
        <!-- Add additional form fields as needed -->
        <input type="submit" name="submit_booking" value="Book Now" />

    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('booking_form', 'booking_form_shortcode');


add_action('admin_post_handle_booking_form', 'handle_booking_form_submission');
add_action('admin_post_nopriv_handle_booking_form', 'handle_booking_form_submission');


function handle_booking_form_submission() {
    if (isset($_POST['submit_booking'])) {
        $booking_date = isset($_POST['booking-date']) ? sanitize_text_field($_POST['booking-date']) : '';

        if (!empty($booking_date)) {
            insert_booking($booking_date);
        }
    }
}

function insert_booking($booking_date) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'bookings';

    $wpdb->insert(
        $table_name,
        array(
            'booking_date' => $booking_date,
            /* Add more columns and values as needed */
        ),
        array(
            '%s' // Format for booking_date column (datetime)
            /* Add more format specifiers as needed */
        )
    );
}

?>
