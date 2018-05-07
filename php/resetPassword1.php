<?php
    session_start();
    require_once("config.php");

    $Email = $_SESSION["Email"];

    $Password2 = $_POST["Password"];
    $confirmPassword = $_POST["confirmPassword"];


    //check if the password are the same
    if (strcmp($Password2, $confirmPassword) !== 0){ //not same
        $_SESSION["Message"] = "Password does not match!";
        header("Location: ../index.php");
        die();
    }

    //make the database connection
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }
    print "Database Connected! <br>";

    $Password = md5($Password2);

    //make query
    $query = "Update MedicUsers set Password='$Password' where Email='$Email' and (Status=1 or Status=2);";
    $result = mysqli_query($conn, $query);
    if($result){ //Password saved
        $Acode = rand();
        $query2 = "Update MedicUsers set Acode='$Acode' where Email='$Email' and Password='$Password' and (Status=1 or Status=2);"; //END TO END USER PRINCIPLE
        $result2 = mysqli_query($conn, $query2);
        if(!$result2){
            $_SESSION["Message"] = "Update Acode failure".mysqli_error($conn);
            $_SESSION["RegState"] = -3;
            header("Location: ../index.php");
            die();
        }
        $_SESSION["Message"] = "Password saved. Logging in.";
        $_SESSION["RegState"] = 4;
        header("Location: ../index.php");
        die();
    } else{
        $_SESSION["RegState"] = -5;
        $_SESSION["Message"] = "Failed to save password: ".mysqli_error($conn);
        header("Location: ../index.php");
        die();
    }
?>
