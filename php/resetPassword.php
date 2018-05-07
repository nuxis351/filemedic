<?php
    session_start();
    require_once("config.php");

    //extract email and acode
    $Email = $_GET["Email"];
    $Acode = $_GET["Acode"];

    //Connect to MySQL
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }
    print "Database Connected! <br>";

    //make the query
    $query = "SELECT * from MedicUsers where Email = '$Email' and Acode = '$Acode' and (Status=1 or Status=2);";
    $result = mysqli_query($conn, $query);

    if ($result){ //Email with the Acode found
        $rows = mysqli_num_rows($result); //find number of rows with the result
        if ($rows == 1){ //if it is unique
            $_SESSION["RegState"] = 5;
            $_SESSION["Email"] = $Email;
            $_SESSION["Message"] = "Authentication Successful";
            header("Location: ../resetPassword.php"); //go to index
            die();
        } else{ //if it is NOT unique
            $_SESSION["RegState"] = -3; //noooooo
            $_SESSION["Message"] = "Authentication Failed ".mysqli_error($conn);
            header("Location: ../index.php");
            die();
        }
    } else{ //Email with the Acode not found

    }
?>
