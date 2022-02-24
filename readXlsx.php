<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['file']['name'])) {
    // file name
    $filename = $_FILES['file']['name'];

    // Location
    $location = 'uploads/' . $filename;

    // Check if file is a xlsx file
    $fileType = pathinfo($location, PATHINFO_EXTENSION);
    $response = 0;

    if ($fileType === 'xlsx') {
        // Upload file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            // Get this file
            $spreadsheet = IOFactory::load($location);
            // Create contractPrices array and get cells from cellsToRead array on sheet 2
            $prix = array(
                "ivoire" => $spreadsheet->getSheet(2)->getCell('D238')->getCalculatedValue(),  //[0]
                "silver" => $spreadsheet->getSheet(2)->getCell('D239')->getCalculatedValue(),  //[1]
                "gold" => $spreadsheet->getSheet(2)->getCell('D241')->getCalculatedValue(),    //[2]
                "goldp" => $spreadsheet->getSheet(2)->getCell('D243')->getCalculatedValue(),    //[2]
                "platinium" => $spreadsheet->getSheet(2)->getCell('D245')->getCalculatedValue() //[4]
            );
            // Return response with all the prix
            $response = 'Ivoire : ' . number_format($prix['ivoire'], 1) . ', Silver : ' . number_format($prix['silver'], 1) . ', Gold : ' . number_format($prix['gold'], 1) . ', Gold+ : ' . number_format($prix['goldp'], 1) . ', Platinium : ' . number_format($prix['platinium'], 1);
        } else {
            $response = 'File upload failed, please try again.';
        }
    } else {
        // Not a xlsx file
        $response = 'Please upload a xlsx file';
    }

    echo $response;

    // Delete the file and exit the script
    //unlink($location);
    exit;
}
