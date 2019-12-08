<?php 
echo "hello<br>";
// This file will insert Assessment queries into the database
if (isset($_COOKIE["equine_database"]))
{	
	require("../../assets/php/mysql_connector.php");
        $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
        	die("Connection failed: " . $mysqli->connect_error);
	}
	$cookie_array = explode(",", $_COOKIE["equine_database"]);
	$user = $cookie_array[0];
	$uid_query = "SELECT uid FROM User WHERE Name = \"" . $user . "\";";
	
	$uid_result = $mysqli->query($uid_query);
	$uid_row = mysqli_fetch_array($uid_result, MYSQLI_ASSOC);
	$user_id = $uid_row["uid"];
	$horse_id = $_POST["HorseID"];
	echo "Hid = " . $horse_id . "<br>";
	$side = $_POST["SideAssessed"];
	$phantom = $_POST["Phantom"];
	if ($phantom) {$phantom = 1;}
	else {$phantom = 0;}
	$euthanized = $_POST["Euthanized?"];
	$euthanization_date = "NULL";
	$UK_Cid = "NULL";
	$RREH_Cid = $_POST["RREH_CID"];
	if ($euthanized)
	{
		$ehuthanization_date = $_POST["euthanasiaDate"];
		$UK_Cid = $_POST["UK_CID"];	
	}
	$date = "'" .  $_POST["Date"] . "'";

	$sql_assessment = "INSERT INTO Assessment VALUES (" . "NULL" . ", " . $horse_id . ", " . $user_id . ", " . $date . ", " . $UK_Cid . ", " . $RREH_Cid . ", \"" .  $_POST["Limb"] . "\", " . $phantom . ");";

	echo "Assessment query = " . $sql_assessment . "<br>";
	
	$result_assessment = $mysqli->query($sql_assessment);
	$cid = $mysqli_insert_id($result_assessment);
	//Gets all sites for the selected Limb
	$query_site = "SELECT Sid FROM PathologySite WHERE Limb = \"" . $_POST["Limb"] . "\";";
	echo "Query: ". $query_site . "<br>";

	$result_site = $mysqli->query($query_site);
	while($row = mysqli_fetch_array($result_site, MYSQLI_ASSOC)) {
		$sid = $row["Sid"];
		echo "sid: " . $sid;
		$pid = $_POST[(string) $sid];
		$pathology_site = "INSERT INTO CasePathology VALUES(" . $cid . "," . $sid . "," . $pid . ")";
		$mysqli->query($pathology_site);
	}
	// Remove last character from the query, which is an extraneous ','
}
else
{
	echo "no cookie<br>";
}
?>
