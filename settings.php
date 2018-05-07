<?php
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/fileMedic.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand" href="index.php">FileMedic</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavMarkup" aria-controls="navbarNavMarkup"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavMarkup">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="userManagmentDropdown"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> User Management
            </a>
            <div class="dropdown-menu" aria-labelledby="userManagmentDropdown">
              <a class="dropdown-item active" href="#">Settings</a>
              <a class="dropdown-item" href="fileManagement.html">File Managment</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <h1>Settings Page</h1>
      </div>
      <div id="settingsContainer">
      <!-- <div class="row justify&#45;content&#45;center"> -->
      <!--   <div id="userID" class="card"> -->
      <!--     <div class="card&#45;body"> -->
      <!--       <form class="form&#45;inline mb&#45;2" action="php/settings&#45;email.php" method="GET"> -->
      <!--         <div class="form&#45;group mr&#45;2"> -->
      <!--           <label for="changeEmail" class="sr&#45;only">Email</label> -->
      <!--           <input type="email" class="form&#45;control" name="Email" id="changeEmail" placeholder="<?php echo $_SESSION["Email"]  ?>" /> -->
      <!--         </div> -->
      <!--         <button type="submit" class="btn btn&#45;primary">Change Email</button> -->
      <!--       </form> -->
      <!--       <form class="form&#45;inline mb&#45;2" action="php/settings&#45;password.php" method="POST"> -->
      <!--         <div class="form&#45;group mr&#45;2"> -->
      <!--           <label for="changePassword" class="sr&#45;only">Password</label> -->
      <!--           <input type="password" class="form&#45;control" name="Password" id="changePassword" placeholder="Password" /> -->
      <!--         </div> -->
      <!--         <button type="submit" class="btn btn&#45;primary">Change Password</button> -->
      <!--       </form> -->
      <!--       <form action="php/settings&#45;delete.php" method="get"> -->
      <!--         <button type="submit" class="btn btn&#45;sm btn&#45;block btn&#45;danger">Delete Account</button> -->
      <!--       </form> -->
      <!--     </div> -->
      <!--   </div> -->
      <!-- </div> -->
    </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url: "php/settings.php",
                async: true,
                dataType: "html",
                type: "GET"
            }).always(function(data){
                $("#settingsContainer").html(data);
            });
        });
    </script>
  </body>
</html>
