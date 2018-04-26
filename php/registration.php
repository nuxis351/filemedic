<?php
    session_start(); //need in order to use session variables
    $_SESSION["RegState"] = 0;
    require_once("config.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';

    // Fetch web data
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $Email = $_POST["Email"]; // Consider a sql injection filter
    $Password = $_POST["Password"];
    $md5Password = md5($Password);

    //Connect to MySQL
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    //Create a query
    $Acode = rand();
    $Rdatetime = date("Y-m-d h:i:s");
    $query = "INSERT into MedicUsers (Email,Status,Acode,Rdatetime,Password,FirstName,LastName) values ('$Email', 0, '$Acode', '$Rdatetime', '$md5Password', '$FirstName', '$LastName');";
    $result = mysqli_query($conn, $query);

    //query failure
    if (!$result){
        $_SESSION["Message"] = "Insert failed!".mysqli_connect_error();
        header("location: ../index.php");
        exit();
    } else{ //query success
        // Build the PHPMailer object:
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
            $msg = "Please click on the link to authenticate your account: http://cis-linux2.temple.edu/~tug01495/filemedic/php/authenticate.php?Email=$Email&Acode=$Acode";
            $mail->addAddress($Email, $FirstName . $LastName);
            $mail->Subject = "Registration for FileMedic";
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
        header("Location: ../index.php");
        exit();
    }
?>
