<?php

$loggerManager = new LoggerManager();
$log = $loggerManager->getLogger_log_to_file();

$log->info("testing logger log_to_file...");

$shortCodeString = 'short_code_example';
$arrayImagePaths = getArrayImagePath();
$bookTitle = 'Example Book Title';
$endString = 'The End of the Example Book';
$bookHtml_id = 'example_book_html_id';

$flipBookCreator = new FlipBookCreator();
$output = $flipBookCreator->getBookString($arrayImagePaths, $bookTitle, $endString, $bookHtml_id);

$log->info("book String = " . $output);



?>