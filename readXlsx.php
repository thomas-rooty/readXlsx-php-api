<?php

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
            $response = 'File uploaded successfully';
        } else {
            $response = 'File upload failed, please try again.';
        }
    } else {
        // Not a xlsx file
        $response = 'Please upload a xlsx file';
    }

    echo $response;

    // Delete the file and exit the script
    unlink($location);
    exit;
}
