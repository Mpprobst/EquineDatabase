<!doctype html>
<html>

<head>
        <title>Equine Project | View a Horse </title>
        <link href="assets/css/style.css" type="text/css" rel="stylesheet" />
        <meta charset="UTF-8" />
</head>

<body>
<?php
if (isset($_COOKIE["equine_database"])) {
?>
<h1>View a Horse</h1>
<?php
	$hid = $_GET["id"];
	$query = "SELECT * FROM Horse WHERE Hid = '$hid'";

	require("assets/php/mysql_connector.php");
	$conn= mysqli_connect($host,$ROuserName, $ROPass, $DB);

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

	$result = $conn->query($query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo "Name: ".$row["Hname"]."<br />";
		echo "Date of Birth: ".$row["Hdob"]."<br />";
		echo "Date of Death or Euthanasia: ".$row["Hdod"]."<br />";
		echo "Breed: ".$row["Hbreed"]."<br />";
		echo "Gender: ".$row["Hgender"]."<br />";
	}
?>
<a class="button" href="home.php">Back</a>
<?php
} else {
		echo "Not Logged In";
		require("assets/php/redirect_helper.php");
		header("Location: http://".$ip."/equine/");
}
?>
</body>
