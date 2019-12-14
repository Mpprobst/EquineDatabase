<?php
require("../../assets/php/redirect_helper.php");

if (isset($_COOKIE["equine_database"]))
{
    // Build Update Query from the POST data
    $query =  "UPDATE Assessment SET ";

    $numArgs = 0;

    if (isset($_POST["RREH_CID"])){
        if ($numArgs > 0 ) {
            $query .= ", ";
        }
        $query .= "RREH_Cid = \"" . $_POST["RREH_CID"] . "\"";
        $numArgs++;
    }

    if (isset($_POST["UKCID"])){
        if ($numArgs > 0 ) {
            $query .= ", ";
        }
        $query .= "UK_Cid = \"" . $_POST["UKCID"] . "\"";
        $numArgs++;
    }
    
    if (isset($_POST["SideAssessed"])){
        if ($numArgs > 0 ) {
            $query .= ", ";
        }
        $query .= "Side = \"" . $_POST["SideAssessed"] . "\"";
        $numArgs++;
    }

    if (isset($_POST["Phantom"])){
        if ($numArgs > 0 ) {
            $query .= ", ";
        }
        $query .= "PhantomDensityIncluded = \"" . $_POST["Phantom"] . "\"";
        $numArgs++;
    }
    $query .= " WHERE Cid=\"".$_POST["Cid"]."\";";

    require("../../assets/php/mysql_connector.php");
    $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    if ($mysqli->query($query) === TRUE) {
        echo "Assessment updated Successfully<br>";

        $fieldsToUpdate= "SELECT * FROM CasePathology WHERE Cid=" . $_POST["Cid"];
        $fields = $mysqli->query($fieldsToUpdate);
        while ($field = mysqli_fetch_array($fields, MYSQLI_ASSOC)){
            if ($_POST[$field["Sid"]] != $field["Pid"]){
                $updater = "UPDATE CasePathology SET Pid=" . $_POST[$field["Sid"]] . " WHERE Sid=" . $field["Sid"] . " AND Cid = " . $_POST["Cid"];
                echo $updater . ": ";
                if ($mysqli->query($updater) === TRUE) {
                    echo "Success<br>";
                } else {
                    echo "Failure";
                }

                
            }
            
        }


        

        header("Location: http://" . $ip . "/equine/ViewAssessment.php?id=" . $_POST["Cid"]);
    }else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
} else {
    echo "not logged in";
    header("Location: http://" . $ip . "/equine/index.php");
}

?>