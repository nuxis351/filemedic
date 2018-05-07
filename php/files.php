<?php
    session_start();
    require_once('config.php');

    $conn = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    if (!$conn){
        die("Connection Failure".mysqli_connect_error());
    }

    $Status = $_SESSION["Status"];

    if ($Status == 2){ //admin
        echo "<div class=\"row justify-content-center\">
                <div class=\"card\" >
                    <div class=\"card-body\">
                        <div class=\"row\">
                          <div class=\"col\">
                            <h6>UserID:</h6>
                          </div>
                          <div class=\"col-6\">
                            <p style=\"display:inline-block;\">
                              ImageName
                            </p>
                          </div>
                          <div class=\"col\">
                            <label>Date</label>
                          </div>
                          <div class=\"col\">
                            <label>Download</label>
                          </div>
                        </div>";

        $query = "SELECT * from MedicTable ORDER BY UID;";
        $result = mysqli_query($conn, $query);
        $string2 = "";
        if ($result){
            while ($row = mysqli_fetch_assoc($result)){
                $string2 = $string2 . "<div class=\"row\"><div class=\"col\">"
                                    . $row["UID"] . "</div><div class=\"col-6\">" . $row["DiskName"] . "</div><div class=\"col\">"
                                    . $row["Date"] . "</div><div class=\"col\">" . "<a href=\"./uploads/{$row["DiskName"]}\" download>Download</a>" . "</div></div>";
            } 
        } else {
            print "Query failed.";
            die();
        }
        echo $string2;
        echo "
                    </div>
                  </div>
                </div> ";
    } else{ //regular user
        $UID = $_SESSION["UID"];
        $query = "SELECT * from MedicTable where UID='$UID';";
        $result = mysqli_query($conn, $query);
        $string = "";
        if ($result){
            while ($row = mysqli_fetch_assoc($result)){
                $string = $string . "<div class=\"row\"><div class=\"col\">" 
                                  . $UID . "</div><div class=\"col-6\">" . $row["DiskName"] . "</div><div class=\"col\">"
                                  . $row["Date"] . "</div><div class=\"col\">" . "<a href=\"./uploads/{$row["DiskName"]}\" download>Download</a>" . "</div></div>";
            }
        }
        echo "<div class=\"row justify-content-center\">
                <div class=\"card\" >
                    <div class=\"card-body\">
                        <div class=\"row\">
                          <div class=\"col\">
                            <h6>UserID:</h6>
                          </div>
                          <div class=\"col-6\">
                            <p style=\"display:inline-block;\">
                              ImageName
                            </p>
                          </div>
                          <div class=\"col\">
                            <label>Date</label>
                          </div>
                          <div class=\"col\">
                            <label>Download</label>
                          </div>
                        </div>";
        echo $string;
        echo "
                    </div>
                </div>
            </div> ";
    }
?>
