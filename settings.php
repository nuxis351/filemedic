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
      </div>
        <div class="row justify-content-center">
          <button id="addUser" type="button" class="btn btn-primary btn-lg">Add User</button>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $status = <?php echo $_SESSION["Status"] ?>;
            if ($status != 2){
                $("#addUser").hide();
            } 
            $("#addUser").click(function(event){
                event.preventDefault();
                $.get("user.html", function(data){
                    $("#settingsContainer").append(data);
                });
            });
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
