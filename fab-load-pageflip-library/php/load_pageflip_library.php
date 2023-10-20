<?php

// Enqueue PageFlip.js script and styles
function enqueue_pageflip_script() {
    wp_enqueue_script('pageflip', plugins_url('/js/page-flip-2.0.7/package/dist/js/page-flip.browser.js', __FILE__), array(), null, true);
    //wp_enqueue_style('pageflip-style', plugins_url('/css/pageflip.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'enqueue_pageflip_script');

// Add a shortcode to insert the flipbook in posts
function pageflip_shortcode($atts) {
    // Specify PageFlip.js settings
    $settings = "const pageFlip = new St.PageFlip(document.getElementById('my-flipbook'),
	    {
	        width: 1024, // required parameter - base page width
	        height: 1024,  // required parameter - base page height
	    }
	);
    pageFlip.loadFromHTML(document.querySelectorAll('.page'));
    ";

    // Define the flipbook's HTML structure with images
    $content = '
    <div id="my-flipbook" class="pageflip">
        <div class="page" style="background-image: url(' . plugins_url('/images/page1.jpg', __FILE__) . ');"></div>
        <div class="page" style="background-image: url(' . plugins_url('/images/page2.jpg', __FILE__) . ');"></div>
        <div class="page" style="background-image: url(' . plugins_url('/images/page3.jpg', __FILE__) . ');"></div>
    </div>';

    // Combine settings and content
    $output = "{$content}<script type='text/javascript'>{$settings}</script>";

    return $output;
}
add_shortcode('pageflip', 'pageflip_shortcode');


?>