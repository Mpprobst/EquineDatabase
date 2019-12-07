<?php
require("../../assets/php/redirect_helper.php");
if (isset($_COOKIE["equine_database"]))
{
    // Build Update Query from the POST data
    $query =  "UPDATE Horse SET ";
    $query .= "Hname = \"" . $_POST["Hname"] . "\", ";
    $query .= "Hdob = \"" . $_POST["Hdob"] . "\", ";
    if ($_POST["Hdod"] != ""){
        $query .= "Hdod = \"" . $_POST["Hdod"] . "\", ";
    }
    $query .= "Hbreed = \"" . $_POST["Hbreed"] . "\", ";
    $query .= "Hgender = \"" . $_POST["Hgender"] . "\", ";
    $query .= "UK_Cid = \"" . $_POST["UK_Cid"] . "\", ";
    $query .= "RREH_Cid = \"" . $_POST["RREH_Cid"] . "\", ";
    $query .= "RaceTraining = \"" . $_POST["RaceTraining"] . "\", ";
    $query .= "RaceExternal = \"" . $_POST["RaceExternal"] . "\", ";
    $query .= "RaceStartAge = \"" . $_POST["RaceStartAge"] . "\" ";
    $query .= "WHERE Hid=\"".$_POST["Hid"]."\";";

    require("../../assets/php/mysql_connector.php");
    $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    if ($mysqli->query($query) === TRUE) {
        echo "Horse Clinical Data updated Successfully<br>";
        header("Location: http://" . $ip . "/equine/ViewHorse.php?id=" . $_POST["Hid"]);
    }else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
} else {
    echo "not logged in";
    header("Location: http://" . $ip . "/equine/index.php");
}

?>