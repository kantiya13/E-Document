<?php

    // Get filename.
    $temp = explode(".", $_FILES["file"]["name"]);

    // Get extension.
    $extension = end($temp);

    // An image check is being done in the editor but it is best to
    // check that again on the server side.
    // Do not use $_FILES["file"]["type"] as it can be easily forged.
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

    // Generate new random name.
    $name = "file_".uniqid()."." . $extension;

    // Save file in the uploads folder.
    move_uploaded_file($_FILES["file"]["tmp_name"], "uploadfile/" . $name);

    // Generate response.
    $response = new StdClass;
    $response->link = "uploadfile/" . $name;
    echo stripslashes(json_encode($response));
?>
