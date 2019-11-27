<?php 

// This file will insert Assessment queries into the database
function new_assessment($mysqli) {
	$sql = "INSERT INTO CasePathology VALUES ";
	// Gets all sites for the selected Limb
	$query = "SELECT Sid FROM PathologySite WHERE Limb = $_POST["Limb"]";
	$result = $mysqli->query($query);
	
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
		$sid = $row["Sid"];
		$pid = $_POST[(string) $sid];
		$sql .= "($cid, $sid, $pid),";
	}
	// Remove last character from the query, which is an extraneous ','
	$sql = substr($sql, 0, -1);
	echo $sql;
}
?>
