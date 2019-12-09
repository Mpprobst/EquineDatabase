<?php
require("../../assets/php/redirect_helper.php");
if (isset($_COOKIE["equine_database"]))
{
    
    // Make SQL connection
    require("../../assets/php/mysql_connector.php");
    $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check to see if horse already exists
    $checker = "SELECT * FROM Horse WHERE Hname =\"" . $_POST["Hname"] . "\" ";
    $checker .= "AND RREH_Cid =\"" . $_POST["RREH_Cid"] . "\";";
    $check = $mysqli->query($checker);
    if($check->num_rows <= 0) {

        $cookie_array = explode(",", $_COOKIE["equine_database"]);
        $currentUser = $cookie_array[3];
        // Generate Insert Query from Post Data
        $query = "INSERT INTO Horse VALUES (NULL,\"" . $_POST["Hname"] . "\",\"";
        $query .= $_POST["Hdob"] . "\",";
        $query .= "NULL, \"";
        $query .= $_POST["Hbreed"] . "\",\"";
        $query .= $_POST["Hgender"] . "\",";
        $query .= ($_POST["UK_Cid"] != "" ? "\"" . $_POST["UK_Cid"] . "\"" : "NULL") . ",\"";
        $query .= $_POST["RREH_Cid"] . "\",";
        $query .= $_POST["RaceTraining"] . ",";
        $query .= $_POST["RaceExternal"] . ",";
        $query .= ($_POST["RaceStartAge"] != "" ?  $_POST["RaceStartAge"] : "NULL") . ",";
        $query .= $currentUser;
        $query .= ");";

        // Insert Horse
        if ($mysqli->query($query) === TRUE) {
            echo "Horse Created Successfully<br>";
            $idquery = "SELECT LAST_INSERT_ID();";
            echo $idquery;
            $res = $mysqli->query($idquery);
            
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                
                header("Location: http://" . $ip . "/equine/ViewHorse.php?id=" . $row["LAST_INSERT_ID()"]);
            }
        } else {
            echo "Error: " . $query . "<br>" . $mysqli->error;
        }
    } else {
        echo "<p class=\"text-danger\">Error: Horse already exists.</p>";
        echo "<a href=\"../../NewHorse\" class=\"btn btn-secondary\">Back</a>";
    }

}
else
{
    // Redirect to Login, not logged in
    echo "Not logged in";
    header("Location: http://" . $ip . "/equine/index.php");
}
?>