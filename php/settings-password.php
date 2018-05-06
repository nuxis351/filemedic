<?php
    session_start();
    require_once("config.php");

    $Password = md5($_POST["Password"]]);
    $Email = $_SESSION["Email"];

    //make the database connection
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $query = "UPDATE MedicUsers SET Password='$Password' WHERE Email='$Email'";
    $result = mysqli_query($conn, $query);
    header("Location: ../settings.php");
    die();
?>
