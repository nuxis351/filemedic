<?php
    session_start();
    require_once("config.php");

    $Email = $_GET["Delete"];

    //make the database connection
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $query = "UPDATE MedicUsers SET Status=-1 WHERE Email='$Email'";
    $result = mysqli_query($conn, $query);

    if ($Email == $_SESSION["Email"]){
        header("Location: logout.php");
        die();
    } else{
        header("Location: ../settings.php");
        die();
    }

    // $query = "DELETE FROM MedicUsers WHERE Email='$Email'";

    // header("Location: logout.php");
    // die();
?>
