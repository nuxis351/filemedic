<?php
    session_start();
    require_once("config.php");

    $Email = $_SESSION["Email"];

    //make the database connection
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $query = "DELETE FROM MedicUsers WHERE Email='$Email'";

    $result = mysqli_query($conn, $query);
    header("Location: logout.php");
    die();
?>
