<?php
// Function to create custom table if not exists
function create_custom_table_if_not_exists() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'reservations';

    // Check if the table exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        // Table does not exist, create it
        $charset_collate = $wpdb->get_charset_collate();

        // SQL statement to create the table
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            date date NOT NULL,
            time time NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        // Include the upgrade file for creating tables
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        // Create the table
        dbDelta($sql);
    }
}

// Hook into the plugin activation and create table if not exists
register_activation_hook(__FILE__, 'create_custom_table_if_not_exists');
?>
