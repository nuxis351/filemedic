<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])){
        move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
        chmod($target_file, 0666);
        echo "The file " . basename($_FILES["fileUpload"]["name"]) . " has been uploaded.";
    }
?>
