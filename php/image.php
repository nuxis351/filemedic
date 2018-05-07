<?php
    session_start();
    require_once('config.php');

    $name = $_GET["Diskname"];
    $UID = $_SESSION["UID"];

    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $query = "INSERT into MedicTable (UID, DiskName) values ('$UID', '$name');";
    $result = mysqli_query($conn, $query);

    $filepath = "../uploads/" . $name;
    exec("rm -f ../images/*"); //remove old images
    exec("../bin/readDisk $filepath", $output);

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
