<?php
// Hook into the 'publish_post' action to trigger the function when a new post is published.
add_action('publish_post', 'fab_publish_link_post_to_facebook');

function fab_publish_link_post_to_facebook($post_id) {
    $log = new LoggerManager()->getLogger_log_to_file();
    $function_id = "FUNCTION -> fab_publish_link_post_to_facebook - ";

    // Check if this is not a revision.
    if (!wp_is_post_revision($post_id)) {

        $post_link = get_permalink($post_id);  

        // Initialize the Facebook SDK with your app credentials.
        $fb = new Facebook\Facebook([
            'app_id' => '270407812571567',
            'app_secret' => '877fc74012a6d6d7ec64167c439f44e5',
            'default_graph_version' => 'v18.0', // Use the appropriate version
        ]);

        // Set the access token obtained from your Facebook App.
        $access_token = 'EAAD17zmc4a8BO3ivZBf1kzZCeP4vlQZCNLUR1WPsLZB6EDp99dF3emDDmSTDUHcHx5KhRgrlexFyimOzZAbDZB2FbAiEqkv8bSOZBFixgu5YRaquRoddDmZAZAfJ2fXT1l4kqQ2RLyHYZChu5rW2guQO0wienTDd4O0Y2x1ZCUy7j5Qy7cfiiF7QZBsYkjk0qzAuZA5kTLZAWUjMcZD';

        // Create a Facebook API request to post to a Page.
        try {
            $response = $fb->post('/124969817355822/feed', [
                'link' => $post_link, // Replace with your post URL
            ], $access_token);
            
            // Handle success or error as needed.
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            $errorMessage = $e->getMessage();
            $log_string = function_id . "Caught exception: " . $errorMessage;
            log_it($log_string);

        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK errors.
            $errorMessage = $e->getMessage();
            $log_string = function_id . "Caught exception: " . $errorMessage;
            log_it($log_string);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $log_string = function_id . "Caught exception: " . $errorMessage;
            log_it($log_string);        }
    }
}
function log_it($log_string){
    if ( defined( 'LOGGER_MANAGER_AVAILABLE' ) ) {
        $log->error($log_string);
    }else {
        echo $log_string;
    }
}
?>