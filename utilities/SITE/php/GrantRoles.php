<?php
require("assets/php/mysql_connector.php");
$conn = mysqli_connect($host, $SQLuserName, $Pass, $DB);

$user = $_GET["id"];

$checkQuery = "SELECT * FROM User WHERE uid = '$user'";
$query = "UPDATE User SET Role = 'read-write' WHERE uid='$user'";

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

$check = $conn->query($checkQuery);
if ($conn->query($query)) {
	header("Location: http://172.31.147.164/equine/SearchUser.php");
}

?>
