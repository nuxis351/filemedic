<?php
    session_start();
    require_once('config.php');

    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $Email = $_POST["Email"];
    $pwd = $_POST["Password"];
    $Password = md5($pwd);
    $query = "INSERT into MedicUsers (Email,Password,Status) values ('$Email', '$Password', 1);";
    $result = mysqli_query($conn, $query);
    header("Location: ../settings.php");
    die();
?>
