<?php

if (isset($_FILES['file']['name'])) {
    // file name
    $filename = $_FILES['file']['name'];

    // Location
    $location = 'uploads/' . $filename;

    $response = 0;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
        $response = "Uploaded Successfully";
    }

    echo $response;

    // Delete the file and exit the script
    unlink($location);
    exit;
}
