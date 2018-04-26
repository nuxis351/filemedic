<?php
    session_start();
    require_once("config.php");

    //get the variables from index.php
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];
    $md5Password = md5($Password);

    //make the database connection
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    //make the query
    $query = "SELECT * from MedicUsers where Status=1 or Status=2 and Email='$Email' and Password='$md5Password'";
    $result = mysqli_query($conn, $query);

    if ($result){ //query successful
        $rows = mysqli_num_rows($result);
        if ($rows == 1){ //Exact match. Logged in
            $_SESSION["RegState"] = 4;
            $_SESSION["Message"] = "Login Successful";
            $dataset = mysqli_fetch_assoc($result); //get the id of last query
            $_SESSION["UID"] = $dataset["ID"];
            $_SESSION["Status"] = $dataset["Status"];
            header("Location: ../index.php");
            die();
        } else{
            $_SESSION["RegState"] = -6;
            $_SESSION["Message"] = "Login Failed ".mysqli_error($conn);
            print "Row not found! <br>";
            header("Location: ../index.php");
            die();
        }
    } else{
        $_SESSION["RegState"] = -4;
        $_SESSION["Message"] = "Database access failure ".mysqli_error($conn);
        print "query unsuccessful! <br>";
        header("Location: ../index.php");
        die();
    }
?>
