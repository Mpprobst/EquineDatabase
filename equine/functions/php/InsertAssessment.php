<?php 
echo "hello<br>";
// This file will insert Assessment queries into the database
if (isset($_COOKIE["equine_database"]))
{	
	$cookie_array = explode(",", $_COOKIE["equine_database"]);
	$user = $cookie_array[0];
	$uid_query = "SELECT uid FROM User WHERE Name = \"" . $user . "\";";
	$uid_result = $mysqli->query($uid_query);
	$uid_row = mysqli_fetch_array($uid_result, MYSQLI_ASSOC);
	$user_id = $uid_row["uid"];
	 
	$horse_id = $_POST["HorseID"];
	echo "Hid = " . $horse_id . "<br>";
	$horse_id = 1;	// delete this when running for real
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

	require("../../assets/php/mysql_connector.php");
        $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
        	die("Connection failed: " . $mysqli->connect_error);
	}

	//$sql_assessment = "INSERT INTO Assessment VALUES (" . "NULL" . ", " . $horse_id . ", " . $user_id . ", " . $date . ", " . $UK_Cid . ", " . $RREH_Cid . ", \"" .  $_POST["Limb"] . "\", " . $phantom . ");";

	echo "Assessment query = " . $sql_assessment . "<br>";
	
	$result_assessment = $mysqli->query($sql_assessment);
	$cid = $mysqli_insert_id($result_assessment);
	//Gets all sites for the selected Limb
	$query = "SELECT Sid FROM PathologySite WHERE Limb = \"" . $_POST["Limb"] . "\";";
	echo "Query: ". $query . "<br>";

	$result_site = $mysqli->query($query);
	while($row = mysqli_fetch_array($result_site, MYSQLI_ASSOC)) {
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
?>
