<?php
    session_start();
    session_unset();
    session_destroy();

    // Remove Cookie
    // setcookie("3238-lab3-HyunseungD", "", time() - 1500, "/");
    header("Location: ../index.php");
    exit();
?>
