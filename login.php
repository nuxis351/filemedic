<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <link href="css/fileMedic.css" rel="stylesheet" />
  <meta charset="UTF-8">
  <title>FileMedic Login</title>
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="#">FileMedic</a>
  </nav>
</head>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
    <div class="card-header">Login</div>
      <div class="card-body">
        <form action="php/login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" name="Email" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="Password" id="exampleInputPassword1" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input name="rmBtn" class="form-check-input" type="checkbox" value="rememberMe"> Remember Password</label>
            </div>
          </div>
          <!-- <a class="btn btn&#45;primary btn&#45;block" href="index.php">Login</a> -->
          <input type="submit" class="btn btn-primary btn-block" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
