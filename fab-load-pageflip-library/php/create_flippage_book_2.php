<?php


// Add a shortcode to insert the flipbook in posts
function pageflip_shortcode($atts) {
    $img1 = plugins_url('/img/page1.jpg', __FILE__);
    $img2 = plugins_url('/img/page2.jpg', __FILE__);
    $img3 = plugins_url('/img/page3.jpg', __FILE__);
    $img4 = plugins_url('/img/page4.jpg', __FILE__);

    $output = '
  <div class="wrapper">

  <div class="container">
    <h1>Title and Chapter Here ---------------------------------------------------</h1>
    <div>
        <button type="button" class="btn-prev btn btn-primary">Previous page</button>
        <span class="page-current">1</span> of <span class="page-total">-</span>
        <button type="button" class="btn-next btn btn-primary">Next page</button>
    </div>

    <div class="alert alert-danger mt-3 mb-3">
        State: <i class="page-state">read</i>, orientation: <i class="page-orientation">landscape</i>
    </div>
</div>

<div class="container">
    <div class="flip-book" id="demoBookExample">
        <div class="page page-cover page-cover-top" data-density="hard">
            <div class="page-content">
                <h2>BOOK TITLE</h2>
            </div>
        </div>        
    <div class="page page-cover">
        <div class="page-content">
            <h2 class="page-header"></h2>
            <div class="page-image" style="background-image: url()"></div>
            <div class="page-text"></div>
            <div class="page-footer"></div>
        </div>
    </div>        
    <div class="page">
        <div class="page-content">
            <h2 class="page-header">Page header 1</h2>
            <div class="page-image" style="background-image: url(' . $img1 . ')"></div>
            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna. Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.</div>
            <div class="page-footer">2</div>
        </div>
    </div>
        <div class="page">
            <div class="page-content">
                <h2 class="page-header">Page header 1</h2>
                <div class="page-image" style="background-image: url(' . $img2 . ')"></div>
                <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna. Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.</div>
                <div class="page-footer">2</div>
            </div>
        </div>
        <!-- PAGES .... -->
        <div class="page">
            <div class="page-content">
                <h2 class="page-header">Page header - 15</h2>
                <div class="page-image" style="background-image: url(' . $img3 . ')"></div>
                <div class="page-footer">16</div>
            </div>
        </div>
        <div class="page">
            <div class="page-content">
                <h2 class="page-header">Page header - 16</h2>
                <div class="page-image" style="background-image: url(' . $img4 . ')"></div>
                <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna. Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.</div>
                <div class="page-footer">17</div>
            </div>
        </div>
        <div class="page page-cover page-cover-bottom" data-density="hard">
            <div class="page-content">
                <h2>THE END</h2>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/page-flip@0.4.3/dist/js/page-flip.browser.min.js"></script>
<script>
  document.addEventListener(\'DOMContentLoaded\', function() {

    const pageFlip = new St.PageFlip(
        document.getElementById("demoBookExample"),
        {
            width: 550, // base page width
            height: 733, // base page height

            size: "stretch",
            // set threshold values:
            minWidth: 315,
            maxWidth: 1000,
            minHeight: 420,
            maxHeight: 1350,

            maxShadowOpacity: 0.5, // Half shadow intensity
            showCover: true,
            mobileScrollSupport: false // disable content scrolling on mobile devices
        }
    );

    // load pages
    pageFlip.loadFromHTML(document.querySelectorAll(".page"));

    document.querySelector(".page-total").innerText = pageFlip.getPageCount();
    document.querySelector(
        ".page-orientation"
    ).innerText = pageFlip.getOrientation();

    document.querySelector(".btn-prev").addEventListener("click", () => {
        pageFlip.flipPrev(); // Turn to the previous page (with animation)
    });

    document.querySelector(".btn-next").addEventListener("click", () => {
        pageFlip.flipNext(); // Turn to the next page (with animation)
    });

    // triggered by page turning
    pageFlip.on("flip", (e) => {
        document.querySelector(".page-current").innerText = e.data + 1;
    });

    // triggered when the state of the book changes
    pageFlip.on("changeState", (e) => {
        document.querySelector(".page-state").innerText = e.data;
    });

    // triggered when page orientation changes
    pageFlip.on("changeOrientation", (e) => {
        document.querySelector(".page-orientation").innerText = e.data;
    });
});
</script>    
    ';

    return $output;
}
add_shortcode('pageflip', 'pageflip_shortcode');
?>