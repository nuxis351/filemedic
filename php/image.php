<?php
    session_start();
    require_once('config.php');

    $name = $_GET["Diskname"];
    $filepath = "../uploads/" . $name;
    exec("rm -f ../images/*"); //remove old images
    exec("../bin/readDisk $filepath", $output);
    // echo "<pre>";
    // print $name;
    // var_dump($output);
    // print $output[0];
    // print count($output);
    // echo "</pre>";

    for ($i = 0; $i < count($output); $i++){
        $image = $output[$i];
        echo "<div>";
        echo "<img src=\"./images/$image\" >";    
        echo "</div>";
    }

?>
