<?php


// Add a shortcode to insert the flipbook in posts
function pageflip_shortcode($atts) {
    $libUrl = plugins_url('/js/page-flip-2.0.7/package/dist/js/page-flip.browser.js', __FILE__);

    $output = '
    <script src="' . $libUrl . '"></script>

<div id="book">
    <div class="my-page" data-density="hard">
        Page Cover
    </div>
    <div class="my-page">
        Page one
    </div>
    <div class="my-page">
        Page two
    </div>
    <div class="my-page">
        Page three
    </div>
    <div class="my-page">
        Page four
    </div>
    <div class="my-page" data-density="hard">
        Last page
    </div>
</div>

<script type="text/javascript">
const pageFlip = new St.PageFlip(document.getElementById("book"),
	    {
	        width: 1024, // required parameter - base page width
	        height: 1024,  // required parameter - base page height
	        showCover: true
	    }
	);	

pageFlip.loadFromImages(["' . plugins_url("/img/cover1.jpg", __FILE__) . '","' . plugins_url("/img/page1.jpg", __FILE__) . '","' . plugins_url("/img/page2.jpg", __FILE__) . '","' . plugins_url("/img/page3.jpg", __FILE__) . '"]);

</script>    
    ';

    return $output;
}
add_shortcode('pageflip', 'pageflip_shortcode');
?>