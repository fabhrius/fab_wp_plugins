<?php

$properties = getProperties_example();
$shortCodeString = $properties['short_code_string'];


// Add a shortcode to insert the flipbook in posts
    function shortcode_example($atts) {

        $arrayImagePaths = getArrayImagePath_example();
        $properties = getProperties_example();


        $bookTitle = $properties['book_title'];
        $endString = $properties['end_string'];
        $bookHtml_id = $properties['book_html_id'];

        $flipBookCreator = new FlipBookCreator();
        $output = $flipBookCreator->getBookString($arrayImagePaths, $bookTitle, $endString, $bookHtml_id);

        return $output;
    }
    add_shortcode($shortCodeString, 'shortcode_example');



    function getArrayImagePath_example(){

        $config_file_path = 'img_path.ini'; 
        $config = parse_ini_file($config_file_path);

        if ($config === false) {
            die('Error: Unable to read the configuration file.');
        }

        foreach ($config as $key => $value) {
            $arrayImagePaths[$key] = plugins_url($value, __FILE__);
        }
        return $arrayImagePaths;
    }

    function getProperties_example(){
        $config_file_path = 'config.ini'; 
        $config = parse_ini_file($config_file_path);

        if ($config === false) {
            die('Error: Unable to read the configuration file.');
        }
        return $config;
    }

?>