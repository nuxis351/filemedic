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
    <script src="js/plupload.full.min.js"></script>
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
              <a class="dropdown-item" href="settings.php">Settings</a>
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
      <div class="row justify-content-center" id="uploader">
        <ul id="filelist"></ul>
        <br />
        <div id="uploadContainer">
            <a id="browse" class="btn btn-primary" href="javascript:;">
              <span class="fa fa-folder-open"></span>Browse</a>
            <a id="start-upload" class="btn btn-success" href="javascript:;">
              <span class="fa fa-upload"></span>Start Upload</a>
        </div>
        <br />
        <pre id="console"></pre>
        <!-- <form action="php/upload.php" method="post" enctype="multipart/form&#45;data"> -->
        <!--   <div class="input&#45;group"> -->
        <!--     <div class="row"> -->
        <!--         <div class="col&#45;xs offset&#45;sm&#45;3" style="font&#45;size:1.5em"> -->
        <!--           <span class="fa fa&#45;upload"></span> -->
        <!--         </div> -->
        <!--         <div class="col"> -->
        <!--           <input name="fileUpload" type="file" class="form&#45;control&#45;file" id="fileUpload"/> -->
        <!--         </div> -->
        <!--     </div> -->
        <!--   </div> -->
        <!--   <hr /> -->
        <!--   <div class="form&#45;group"> -->
        <!--     <div class="row"> -->
        <!--       <div class="col offset&#45;sm&#45;4"> -->
        <!--         <button name="submit" type="submit" class="btn btn&#45;primary" id="submitFileButton">Submit</button> -->
        <!--       </div> -->
        <!--     </div> -->
        <!--   </div> -->
        <!-- </form> -->
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
        <div id="carouselControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="thumb-jpg.png" />
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="no_thumb.jpg" />
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="thumb.svg" />
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <br />
      <div class="row justify-content-center">
        <button type="button" class="btn btn-info">Advanced details</button>
      </div>
    </div>
  </div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var uploader = new plupload.Uploader({
            browse_button : 'browse',
            url : 'upload.php',
            chunk_size : '2mb',
            unique_names : false,

            init : {
                PostInit: function(){
                    document.getElementById('filelist').innerHTML = '';

                    document.getElementById('start-upload').onclick = function(){
                        uploader.start();
                        return false;
                    };
                },

                FilesAdded: function(up, files){
                    plupload.each(files, function(file){
                        document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                    });
                },

                UploadProgress: function(up, file){
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                },

                FileUploaded: function(up, file, result){

                },
            }
        });
        uploader.init();
    </script>
  </body>
</html>
