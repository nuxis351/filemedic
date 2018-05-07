<?php
    session_start();
    $_SESSION["RegState"] = 1; //since registration is successful and email has been sent, regstate = 1
    require_once("config.php");

    //Extract Email
    $Email = $_GET["Email"];

    //Extract Acode
    $Acode = $_GET["Acode"];

    //Connect to Database
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }
    
    //Make the query
    $query = "SELECT * from MedicUsers where Email='$Email' and Acode='$Acode' and Status=0";

    //Check if the query went okay
    $result = mysqli_query($conn, $query);
    if ($result){ //if the query is okay
        $rows = mysqli_num_rows($result); //find number of rows with the result
        if ($rows == 1){ //if it is unique
            $Adatetime = date("Y-m-d h:i:s");
            $Acode2 = rand();
            $query2 = "UPDATE MedicUsers set Status = 1, Acode='$Acode2', Adatetime='$Adatetime' where Email='$Email' and Acode='$Acode';";
            $result2 = mysqli_query($conn, $query2);

            //if query fails
            if (!$result2){
                $_SESSION["Message"] = "Update failure.".mysqli_error($conn);
                $_SESSION["RegState"] = -1; 
                header("Location: ../index.php");
                die();
            }

            //authentication successful
            $_SESSION["RegState"] = 2; //ayyyy 
            $_SESSION["Email"] = $Email;
            $_SESSION["Message"] = "Authentication Successful. Please Log in.";
            header("Location: ../index.php"); //go to index
            die();
        } else{ //if it is NOT unique
            $_SESSION["RegState"] = -3; //noooooo
            $_SESSION["Message"] = "Authentication Failed ".mysqli_error($conn);
            header("Location: ../index.php");
            die();
        }
    } else{ //this is if the query is NOT okay
        $_SESSION["RegState"] = -4;
        $_SESSION["ErrorMsg"] = "Database access failure: ".mysqli_error($conn);
        header("Location: ../index.php");
        die();
    }
    
?>
