<?php
function create_reservation_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'bookings';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            booking_date datetime NOT NULL,
            /* Add more columns as needed */
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}

register_activation_hook(__FILE__, 'create_reservation_table');
?>
