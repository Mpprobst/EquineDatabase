<?php
if (isset($_COOKIE["equine_database"]))
{
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
    $query .= ($_POST["RaceStartAge"] != "" ?  $_POST["RaceStartAge"] : "NULL");
    $query .= ");";

    require("../../assets/php/mysql_connector.php");
    $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    if ($mysqli->query($query) === TRUE) {
        echo "Horse Created Successfully<br>";
        $idquery = "SELECT LAST_INSERT_ID();";
        echo $idquery;
        $res = $mysqli->query($idquery);
        
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            require("../../assets/php/redirect_helper.php");
            header("Location: http://" . $ip . "/equine/ViewHorse.php?id=" . $row["LAST_INSERT_ID()"]);
        }
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
    

}
else
{
    // Redirect to Login, not logged in
    echo "Not logged in";
}
?>