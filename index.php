<?php
    session_start();
    if ((!isset($_SESSION["RegState"]) || ($_SESSION["RegState"] != 4))){
        header("Location: login.php");
        die();
    }
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
      <a class="navbar-brand" href="#">FileMedic</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavMarkup" aria-controls="navbarNavMarkup"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavMarkup">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userManagmentDropdown"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> User Management
            </a>
            <div class="dropdown-menu" aria-labelledby="userManagmentDropdown">
              <a class="dropdown-item" href="#">Settings</a>
              <a class="dropdown-item" href="#">File Managment</a>
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
        <h1>Upload a Drive Image</h1>
      </div>
      <div class="row justify-content-center">
        <div class="card">
          <div class="card-body">
            <h5>currently supported:</h5>
            <ul>
              <li>
                FAT16
              </li>
            </ul>
          </div>
        </div>
      </div>
      <br />
      <div class="row justify-content-center">
        <div class="col-xs">
          <h2><span class="fa fa-arrow-down" aria-hidden="true"></span></h2>
        </div>
      </div>
      <br />
      <div class="row justify-content-center">
        <form>
          <div class="input-group">
            <div class="row">
                <div class="col-xs offset-sm-3" style="font-size:1.5em">
                  <span class="fa fa-upload"></span>
                </div>
                <div class="col">
                  <input type="file" class="form-control-file" id="uploadFileButton"/>
                </div>
            </div>
          </div>
          <hr />
          <div class="form-group">
            <div class="row">
              <div class="col offset-sm-4">
                <button type="submit" class="btn btn-primary" id="submitFileButton">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <hr />
    <div class="container">
      <br />
      <div class="row justify-content-center">
        <h1>Results</h1>
      </div>
      <br />
      <div class="row justify-content-center">

      </div>
      <br />
      <div class="row justify-content-center">
          <div class="card">
            <ul class="list-group" id="recoveredFileList">
              <li class="list-group-item">
                <h6>thumb-jpg.png</h6>
                <img src="thumb-jpg.png" class="img-thumbnail recoveredImg" />
                <button type="button" class="btn btn-success btn-sm btn-block">Download</button>
              </li>
              <li class="list-group-item">
                <h6>no_thumb.jpg</h6>
                <img src="no_thumb.jpg" class="img-thumbnail recoveredImg" />
                <button type="button" class="btn btn-success btn-sm btn-block">Download</button>
              </li>
              <li class="list-group-item">
                <h6>thumb.svg</h6>
                <img src="thumb.svg" class="img-thumbnail recoveredImg" />
                <button type="button" class="btn btn-success btn-sm btn-block">Download</button>
              </li>
            </div>
            <div class="col-sm-1 offset-sm-2">
              <button type="button" class="btn btn-info">Advanced details</button>
            </div>
          </div>
        </div>
      </div>
    </div>"


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
