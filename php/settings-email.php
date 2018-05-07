<?php
    session_start();
    require_once("config.php");

    $Email = $_GET["Email"];
    $OldEmail = $_GET["OldEmail"];

    //make the database connection
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $query = "UPDATE MedicUsers SET Email='$Email' WHERE Email='$OldEmail'";

    // $_SESSION["Email"]=$Email;
    
    $result = mysqli_query($conn, $query);

    if ($_SESSION["Email"] == $OldEmail){ //regular user
        header("Location: logout.php"); //after changing email, log out 
        die();
    } else{ //admin. hopefully the admin does not change its own email
        header("Location: ../settings.php");
        die();
    }
?>
