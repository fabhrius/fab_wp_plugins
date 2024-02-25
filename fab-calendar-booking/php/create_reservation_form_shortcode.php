<?php

function reservation_form_shortcode() {

    // Create the reservation table if it doesn't exist
    create_custom_table_if_not_exists();

    ob_start(); // Start output buffering



    ?>

    <!-- Reservation Form -->
    <!-- <form method="post" action=""> -->
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="handle_reservation_form">

        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="date">Date:</label>
        <input type="text" name="date" id="reservation-date" readonly required>

        <label for="time">Time:</label>
        <input type="text" name="time" id="reservation-time" readonly required>

        <input type="submit" name="submit_reservation" value="Submit Reservation">
    </form>

    <?php

    return ob_get_clean(); // End and return output buffering
}


// Register reservation form shortcode
add_shortcode('reservation_form', 'reservation_form_shortcode');

add_action('admin_post_handle_reservation_form', 'handle_reservation_form');
add_action('admin_post_nopriv_handle_reservation_form', 'handle_reservation_form');

function handle_reservation_form() {
    // Your form handling logic goes here

    global $wpdb;


        // Handle form submissions
        if (isset($_POST['submit_reservation'])) {
            // Sanitize and validate form data
            $name = sanitize_text_field($_POST['name']);
            $email = sanitize_email($_POST['email']);
            $date = sanitize_text_field($_POST['date']);
            $time = sanitize_text_field($_POST['time']);
    
            // Debug: Log form data
            error_log('Name: ' . $name);
            error_log('Email: ' . $email);
            error_log('Date: ' . $date);
            error_log('Time: ' . $time);
    
            // Insert data into the database
            $table_name = $wpdb->prefix . 'reservations';
            $data = array(
                'name' => $name,
                'email' => $email,
                'date' => $date,
                'time' => $time
            );
            $format = array('%s', '%s', '%s', '%s');
            $result = $wpdb->insert($table_name, $data, $format);
    
            if ($result === false) {
                // Error handling: Log database error
                error_log('Database error: ' . $wpdb->last_error);
            } else {
                // Display success message
                echo '<p>Reservation submitted successfully!</p>';
            }
        }

}


?>
