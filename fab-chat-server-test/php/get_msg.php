<?php
/**
 * Plugin Name: JSON Hello World
 * Description: A simple WordPress plugin that responds to a GET request with a JSON "hello world" message.
 * Version: 1.0
 * Author: Your Name
 */

// Register a custom endpoint for handling the JSON request
add_action('rest_api_init', function () {
    register_rest_route('service', '/chat', array(
        'methods' => 'GET',
        'callback' => 'json_hello_world_callback',
    ));
});

// Callback function for the custom endpoint
function json_hello_world_callback($data) {
    // Create a simple associative array with the "hello world" message
    $response = array('message' => 'Hello, World!');

    // Return the response as a JSON object
    return rest_ensure_response($response);
}


?>

