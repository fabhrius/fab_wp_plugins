<?php

// Register a custom endpoint for handling the JSON request
add_action('rest_api_init', 'create_msgtable');

function create_msgtable() {
    global $wpdb;

    // Create a table name with the WordPress table prefix
    $table_name = $wpdb->prefix . 'mobile_messages';

    // SQL query to create the messages table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    recipient_id INT,
    content TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $wpdb->get_charset_collate();";

    // Execute the SQL query
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

}

?>

