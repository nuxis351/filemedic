<?php
    session_start();
    require_once('config.php');

    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $Status = $_SESSION["Status"];

    if ($Status == 2){ //administrator account
        $query = "SELECT * from MedicUsers where (Status=1 or Status=2);";
        $result = mysqli_query($conn, $query);
        if ($result){
            while ($row = mysqli_fetch_assoc($result)){ //traverse the list from query
             echo "<div class=\"row justify-content-center\">
                    <div id=\"userID\" class=\"card\">
                      <div class=\"card-body\">
                        <form class=\"form-inline mb-2\" action=\"php/settings-email.php\" method=\"GET\">
                          <div class=\"form-group mr-2\">
                            <label for=\"changeEmail\" class=\"sr-only\">Email</label>
                            <input type=\"email\" class=\"form-control\" name=\"Email\" placeholder=\"{$row["Email"]}\" />
                          </div>
                          <button name=\"OldEmail\" value=\"{$row["Email"]}\"type=\"submit\" class=\"btn btn-primary\">Change Email</button>
                        </form>
                        <form class=\"form-inline mb-2\" action=\"php/settings-password.php\" method=\"POST\">
                          <div class=\"form-group mr-2\">
                        <label for=\"changePassword\" class=\"sr-only\">Password</label>
                        <input type=\"password\" class=\"form-control\" name=\"Password\" placeholder=\"Password\" />
                          </div>
                          <button name=\"Email\" value=\"{$row["Email"]}\" type=\"submit\" class=\"btn btn-primary\">Change Password</button>
                        </form>
                        <form action=\"php/settings-delete.php\" method=\"get\">
                          <button name=\"Delete\" value=\"{$row["Email"]}\" type=\"submit\" class=\"btn btn-sm btn-block btn-danger\">Delete Account</button>
                        </form>
                      </div>
                    </div>
                </div> ";
             echo "<br>";
            }
        } else{
            print "Query failure";
            die();
        }
    } else{ //regular user
        echo "<div class=\"row justify-content-center\">
                <div id=\"userID\" class=\"card\">
                  <div class=\"card-body\">
                    <form class=\"form-inline mb-2\" action=\"php/settings-email.php\" method=\"GET\">
                      <div class=\"form-group mr-2\">
                        <label for=\"changeEmail\" class=\"sr-only\">Email</label>
                        <input type=\"email\" class=\"form-control\" name=\"Email\" placeholder=\"{$_SESSION["Email"]}\" />
                      </div>
                      <button name=\"OldEmail\" value=\"{$_SESSION["Email"]}\" type=\"submit\" class=\"btn btn-primary\">Change Email</button>
                    </form>
                    <form class=\"form-inline mb-2\" action=\"php/settings-password.php\" method=\"POST\">
                      <div class=\"form-group mr-2\">
                    <label for=\"changePassword\" class=\"sr-only\">Password</label>
                    <input type=\"password\" class=\"form-control\" name=\"Password\" placeholder=\"Password\" />
                      </div>
                      <button name=\"Email\" value=\"{$_SESSION["Email"]}\" type=\"submit\" class=\"btn btn-primary\">Change Password</button>
                    </form>
                    <form action=\"php/settings-delete.php\" method=\"get\">
                      <button name=\"Delete\" value=\"{$_SESSION["Email"]}\" type=\"submit\" class=\"btn btn-sm btn-block btn-danger\">Delete Account</button>
                    </form>
                  </div>
                </div>
            </div> ";
    }
?>
