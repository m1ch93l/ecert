<?php

// set the path to the excel file
$filePath = '../format.xlsx';

// check if the file exists
if (file_exists($filePath)) {
    // get the file name
    $fileName = basename($filePath);
    
    // set appropriate headers for the download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    
    // read the file and output it to the user
    readfile($filePath);
} else {
    // file does not exist
    echo 'File not found.';
}
