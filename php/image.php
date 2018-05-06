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
        if ($i == 0){ //for the first one, you need active class for carousel
            echo "<div class=\"carousel-item active\">";
            echo "<img class=\"d-block img-fluid\" src=\"./images/$image\" />";    
            echo "</div>";
        } else{
            echo "<div class=\"carousel-item\">";
            echo "<img class=\"d-block img-fluid\" src=\"./images/$image\" />";    
            echo "</div>";
        }
    }

?>
