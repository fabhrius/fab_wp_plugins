<?php
class Mobile_Message_Manager {

    public function __construct() {
        // Register REST API endpoints
        add_action('rest_api_init', array($this, 'init_endpoints'));
    }

    // Activation hook
    public function activate() {
        // Additional activation logic, if needed
    }

    // Deactivation hook
    public function deactivate() {
        // Additional deactivation logic, if needed
    }

    // Initialize REST API endpoints
    public function init_endpoints() {
        register_rest_route('service', '/getMessages', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_messages'),
        ));

        register_rest_route('service', '/sendMessage', array(
            'methods' => 'POST',
            'callback' => array($this, 'send_message'),
        ));
    }

 
    // Callback function for getMessages endpoint
    public function get_messages($data) {
        global $wpdb;

        // Sanitize and retrieve data from the request
        $user_id = isset($data['user_id']) ? intval($data['user_id']) : 0;
        $recipient_id = isset($data['recipient_id']) ? intval($data['recipient_id']) : 0;

        // Validate input parameters (you may add more validation as needed)
        if ($user_id <= 0 || $recipient_id <= 0) {
            return rest_ensure_response(array('error' => 'Invalid user_id or recipient_id.'));
        }

        // Retrieve messages from the database
        $table_name = $wpdb->prefix . 'mobile_messages';
        $sql = $wpdb->prepare(
            "SELECT id, sender_id, content, timestamp FROM $table_name WHERE (sender_id = %d AND recipient_id = %d) OR (sender_id = %d AND recipient_id = %d) ORDER BY timestamp ASC",
            $user_id, $recipient_id, $recipient_id, $user_id
        );

        $messages = $wpdb->get_results($sql, ARRAY_A);

        // Prepare the response
        $response = array('status' => 'success', 'messages' => $messages);

        return rest_ensure_response($response);
    }

    // Callback function for sendMessage endpoint
    public function send_message($data) {
        global $wpdb;

        // Sanitize and retrieve data from the request
        $sender_id = isset($data['sender_id']) ? intval($data['sender_id']) : 0;
        $recipient_id = isset($data['recipient_id']) ? intval($data['recipient_id']) : 0;
        $message_content = isset($data['message_content']) ? sanitize_text_field($data['message_content']) : '';

        // Validate input parameters (you may add more validation as needed)
        if ($sender_id <= 0 || $recipient_id <= 0 || empty($message_content)) {
            return rest_ensure_response(array('error' => 'Invalid sender_id, recipient_id, or message_content.'));
        }

        // Insert the message into the database
        $table_name = $wpdb->prefix . 'mobile_messages';
        $sql = $wpdb->prepare(
            "INSERT INTO $table_name (sender_id, recipient_id, content) VALUES (%d, %d, %s)",
            $sender_id, $recipient_id, $message_content
        );

        if ($wpdb->query($sql)) {
            $response = array('status' => 'success', 'message_id' => $wpdb->insert_id);
        } else {
            $response = array('status' => 'error', 'message' => 'Error inserting message into the database.');
        }

        return rest_ensure_response($response);
    }

        
}



?>

