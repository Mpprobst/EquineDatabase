<?php 

// This file will insert Assessment queries into the database
if (isset($_COOKIE["equine_database"]))
{	
	require("../../assets/php/mysql_connector.php");
	require("../../assets/php/redirect_helper.php");
	$mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
        	die("Connection failed: " . $mysqli->connect_error);
	}
	$cookie_array = explode(",", $_COOKIE["equine_database"]);
	$user = $cookie_array[0];
	$uid_query = "SELECT uid FROM User WHERE Name = \"" . $user . "\";";
	$user_id;
	$uid_result = $mysqli->query($uid_query);
	while ($uid_row = mysqli_fetch_array($uid_result, MYSQLI_ASSOC)) {
		$user_id = $uid_row["uid"];
	}
	$horse_id = $_POST["HorseID"];
	
	$side = $_POST["SideAssessed"];
	$phantom = ($_POST["Phantom"] == "") ? 0 : 1;

	$euthanized = $_POST["Hdod"];
	
	$UK_Cid = $_POST["UK_CID"];
	$RREH_Cid = ($_POST["RREH_CID"] == "") ? $_POST["RREH_Default"] : $_POST["RREH_CID"];
	
	$date = $_POST["Date"];

	$sql_assessment = "INSERT INTO Assessment VALUES (NULL, ";
	$sql_assessment .= $horse_id . ", ";
	$sql_assessment .= $user_id . ", ";
	$sql_assessment .= "\"" . $date . "\", ";
	$sql_assessment .= "\"" . $UK_Cid . "\", ";
	$sql_assessment .= "\"" . $RREH_Cid . "\", ";
	$sql_assessment .= "\"" .  $_POST["Limb"] . "\", ";
	$sql_assessment .= $phantom . ", ";
	$sql_assessment .= "\"". $side . "\", ";
	$sql_assessment .= $cookie_array[2] . ");";

	$assessmentId;
	if ($mysqli->query($sql_assessment) === TRUE) {
		echo "Assessment Inserted Successfully<br>";
		$idquery = "SELECT LAST_INSERT_ID();";
		echo $idquery;
		$res = $mysqli->query($idquery);
		
		while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
			$assessmentId = $row["LAST_INSERT_ID()"];
			echo $assessmentId;
		}
	} else {
		echo "Error: " . $sql_assessment . "<br>" . $mysqli->error;
	}
	//Gets all sites for the selected Limb
	$query_site = "SELECT Sid FROM PathologySite WHERE Limb = \"" . $_POST["Limb"] . "\";";
	echo "Query: ". $query_site . "<br>";

	$result_site = $mysqli->query($query_site);
	$pathology_site = "INSERT INTO CasePathology VALUES";
	$isFirst = true;
	while($row = mysqli_fetch_array($result_site, MYSQLI_ASSOC)) {
		$sid = $row["Sid"];
		// echo "sid: " . $sid;
		$pid = $_POST[$sid];
		// echo "pid: " . $pid . "<br />";
		if ($isFirst == false) {
			$pathology_site .= ", ";
		} else {
			$isFirst = false;
		}
		$pathology_site .= " (" . $assessmentId . "," . $sid . "," . $pid . ")";	
	}
	$pathology_site .= ";";

	// echo $pathology_site;
	if ($mysqli->query($pathology_site)) {
		echo "success!";
		header("Location: http://" . $ip . "/equine/ViewHorse.php?id=" . $horse_id);
	} else {
		echo "Error: " . $pathology_site . "<br>" . $mysqli->error;
	}
}
else
{
	echo "no cookie<br>";
}
?>
