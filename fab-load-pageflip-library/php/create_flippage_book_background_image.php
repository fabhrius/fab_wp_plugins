<?php
// Add a shortcode to insert the flipbook in posts
    function pageflip_shortcode($atts) {
        $libUrl = plugins_url('/js/page-flip-2.0.7/package/dist/js/page-flip.browser.js', __FILE__);

        $output = '
        <script src="' . $libUrl . '"></script>

        <div id="book">
            <div class="my-page" data-density="hard">
                Page Cover
                <img alt="" src="' . plugins_url('/img/cover1.jpg', __FILE__) . '">
            </div>
            <div class="my-page">
                Page one
                <img alt="" src="' . plugins_url('/img/page1.jpg', __FILE__) . '">
            </div>
            <div class="my-page">
                Page two
                <img alt="" src="' . plugins_url('/img/page2.jpg', __FILE__) . '">
            </div>
            <div class="my-page">
                Page three
                <img alt="" src="' . plugins_url('/img/page3.jpg', __FILE__) . '">
            </div>
            <div class="my-page">
                Page four
                <img alt="" src="' . plugins_url('/img/page4.jpg', __FILE__) . '">
            </div>
            <div class="my-page" data-density="hard">
                Last page
                <img alt="" src="' . plugins_url('/img/cover2.jpg', __FILE__) . '">
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

            pageFlip.loadFromHTML(document.querySelectorAll(".my-page"));

        </script>    
        ';
        return $output;
    }
    add_shortcode('pageflip', 'pageflip_shortcode');
?>