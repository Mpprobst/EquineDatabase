<?php 

$b = $_POST["1"];
echo "\n1: ". $b . "<br>";
$cid = 1;

// if is set cookie ***look at inserthorse.php
// This file will insert Assessment queries into the database
function new_assessment() {
	require("../../assets/php/mysql_connector.php");
        $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
        	die("Connection failed: " . $mysqli->connect_error);
	}
	// create the insert into asessment with the post data from the static portions of the form (POST) before the case pathology nonsense
	// HorseID, RREH_Cid, etc.
	// get the auto_incremented number from that assessmet and set $cid to that ***lookk at InsertHorse.php***
	// returns result set that contains the numerical value of the last auto increment number
	// make sure that cid is in scope when running the foreleg portion of the assessment
	$HorseName = $_POST["HorseName"];

	$horse_query = "SELECT Hid FROM Horse WHERE Hname = " . $HorseName . ";";
	echo "horse query = " . $horse_query . "<br>"; 
	$HorseId = $mysqli->query($horse_query);
	echo "query result = " . $HorseId . "<br>";

	$RREH_Cid = $_POST["RREH_CID"];
	$side = $_POST["SideAssessed"];
	$phantom = $_POST["Phantom"];
	$euthanized = $_POST["Euthanized?"];
	$euthanization_date = $_POST["euthanasiaDate"];
	$UK_Cid = $_POST["UK_CID"];
	
	$sql = "INSERT INTO CasePathology VALUES ";
	// Gets all sites for the selected Limb
	$query = "SELECT Sid FROM PathologySite WHERE Limb = \"" . $_POST["Limb"] . "\";";
	echo "Query: ". $query . "<br>";

	$result = $mysqli->query($query);
	$cid = 1;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$sid = $row["Sid"];
		echo "sid: " . $sid;
		$pid = $_POST[(string) $sid];
		$sql .= "(" . $cid . "," . $sid . "," . $pid . "),";
	}
	// Remove last character from the query, which is an extraneous ','
	$sql = substr($sql, 0, -1);
	$sql .= ";";
	echo $sql;
}

new_assessment($mysqli);
?>
