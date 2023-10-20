<?php

function fab_add_css_files() {
    // Check if the current post belongs to a specific category by category slug
    if (is_single() && in_category('hiddenmind_collection')) {
        echo '<link href="https://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">' . "\n";
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">' . "\n";
        echo '<style>
        .wrapper { margin: 150px auto; }
        .flip-book {
         box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5);
         display: none;
         background-size: cover;
      }
       .page {
         padding: 20px;
         background-color: #fdfaf7;
         color: #785e3a;
         border: solid 1px #c2b5a3;
         overflow: hidden;
      }
       .page .page-content {
         width: 100%;
         height: 100%;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
         align-items: stretch;
      }
       .page .page-content .page-header {
         height: 30px;
         font-size: 100%;
         text-transform: uppercase;
         text-align: center;
      }
       .page .page-content .page-image {
         height: 100%;
         background-size: contain;
         background-position: center center;
         background-repeat: no-repeat;
      }
       .page .page-content .page-text {
         height: 100%;
         flex-grow: 1;
         font-size: 80%;
         text-align: justify;
         margin-top: 10px;
         padding-top: 10px;
         box-sizing: border-box;
         border-top: solid 1px #f4e8d7;
      }
       .page .page-content .page-footer {
         height: 30px;
         border-top: solid 1px #f4e8d7;
         font-size: 80%;
         color: #998466;
      }
       .page.--left {
         border-right: 0;
         box-shadow: inset -7px 0 30px -7px rgba(0, 0, 0, 0.4);
      }
       .page.--right {
         border-left: 0;
         box-shadow: inset 7px 0 30px -7px rgba(0, 0, 0, 0.4);
      }
       .page.--right .page-footer {
         text-align: right;
      }
       .page.hard {
         background-color: #f2e8d9;
         border: solid 1px #998466;
      }
       .page.page-cover {
         background-color: #e3d0b5;
         color: #785e3a;
         border: solid 1px #998466;
      }
       .page.page-cover h2 {
         text-align: center;
         padding-top: 50%;
         font-size: 210%;
      }
       .page.page-cover.page-cover-top {
         box-shadow: inset 0px 0 30px 0px rgba(36, 10, 3, 0.5), -2px 0 5px 2px rgba(0, 0, 0, 0.4);
      }
       .page.page-cover.page-cover-bottom {
         box-shadow: inset 0px 0 30px 0px rgba(36, 10, 3, 0.5), 10px 0 8px 0px rgba(0, 0, 0, 0.4);
      }
      
       </style>' . "\n";
    }
}
add_action('wp_head', 'fab_add_css_files');


?>