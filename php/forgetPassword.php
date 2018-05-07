<?php
    session_start();
    require_once("config.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';

    //extract email
    $Email = $_POST["Email"];

    //Connect to MySQL
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        $_SESSION["RegState"] = -1;
        $_SESSION["Message"] = "Connection Failed: ".mysqli_connect_error();
        print "database connect failure";
        header("Location: ../index.php");
        die();
    }

    //make the query
    $query = "SELECT * from MedicUsers where Email = '$Email'";
    $result = mysqli_query($conn, $query); //result of query
    if ($result){ //if query is successful
        //find number of rows with this email
        $rows = mysqli_num_rows($result);

        //email found
        if ($rows == 1){
            //update Acode
            $Acode = rand();        
            $query = "UPDATE MedicUsers set Acode = '$Acode' where Email = '$Email';";
            $result = mysqli_query($conn, $query);
            if (!$result){ //if query fails
                $_SESSION["RegState"] = -2;
                $_SESSION["Message"] = "Cannot update the Acode for the Email".mysqli_error($conn);
                header("Location: ../index.php");
                die();
            }
            $msg = "Please click on the link to reset password for your account:".
                "http://cis-linux2.temple.edu/~tug01495/filemedic/php/resetPassword.php?Email=$Email&Acode=$Acode";
            $mail = new PHPMailer(true);
            try{
                $mail->SMTPDebug = 0;// Wants to see all errors
                $mail->IsSMTP();
                $mail->Host="smtp.gmail.com";
                $mail->SMTPAuth=true;
                $mail->Username="cis105223053238@gmail.com";
                $mail->Password = 'g+N3NmtkZWe]m8"M';
                $mail->SMTPSecure = "ssl";
                $mail->Port=465;
                $mail->SMTPKeepAlive = true;
                $mail->Mailer = "smtp";
                $mail->setFrom("cis105223053238@gmail.com", "Hyunseung Do");
                $mail->addReplyTo("cis105223053238@gmail.com","Hyunseung Do");
                $mail->addAddress($Email, $FirstName . $LastName);
                $mail->Subject = "Reset Password for FileMedic";
                $mail->Body = $msg;
                $mail->send();
                print "Email sent ... <br>";
                // $_SESSION["RegState"] = 3;
                $_SESSION["Message"] = "Email sent.";
                header("location:../index.php");
                exit();
            } catch(phpmailerException $e){
                $_SESSION["Message"] = "Mailer error:".$e->errorMessage();
                $_SESSION["RegState"] = -4;
                print "Mail send failed:".$e->errorMessage;
            }

            //update session variables
            $_SESSION["RegState"] = 1;
            $_SESSION["Message"] = "Email Sent successfully. Please check your email.";
            print "success";
            header("Location: ../index.php");
            die();

        //email not found
        } else{ 
            $_SESSION["RegState"] = -7;
            $_SESSION["Message"] = "Email not found ".mysqli_error($conn);
            print "not successful";
            header("Location: ../index.php");
            die();
        }
    } else { //query failure
        $_SESSION["RegState"] = -1;
        $_SESSION["Message"] = "Database Access failure".mysqli_error($conn);
        print "query failure";
        header("Location: ../index.php");
        die();
    }
?>
