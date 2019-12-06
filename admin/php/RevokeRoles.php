<?php
require("../../assets/php/mysql_connector.php");
$conn = mysqli_connect($host, $SQLuserName, $Pass, $DB);

$user = $_GET["id"];

$checkQuery = "SELECT * FROM User WHERE uid = '$user'";
$query = "UPDATE User SET Role = 'read-only' WHERE uid='$user'";

if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
}

$check = $conn->query($checkQuery);
if ($conn->query($query)) {
        require("../../assets/php/redirect_helper.php");
        header("Location: http://".$ip."/equine/SearchUser.php");
}

?>

