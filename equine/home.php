<!doctype html>
<html lang="en">

<head>
	<title>Equine Project | Home</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
<?php
if(isset($_COOKIE["equine_database"])) {
	$cookie_array = explode(",", $_COOKIE["equine_database"]);
	echo "<h1>Welcome ".$cookie_array[0].",</h1>";
	
	// Get Clinic Name for Display
	require("assets/php/mysql_connector.php");
	$mysqli = new mysqli($host,$ROuserName, $ROPass, $DB);
	if(!$mysqli) {
		die("Connection failed: ".mysqli_connect_error());
	}
	$getClinic = "SELECT Name FROM Clinic WHERE Lid=\"" . $cookie_array[2] . "\";";
	$clinicRes = $mysqli->query($getClinic);
	while ($clinic = mysqli_fetch_array($clinicRes, MYSQLI_ASSOC)) {
		echo "<p>Your Clinic: ".$clinic["Name"]."</p>";
	}

	echo "<p>Please choose an option:</p>";

	echo "<div class=\"btn-group-vertical\" role=\"group\">";

	echo "<a class=\"btn btn-primary mb-2\" href=\"SearchHorse.php\">Select Horse</a>";
	
	if($cookie_array[1] == "read-write") {
		echo "<a class=\"btn btn-primary mb-2\" href=\"NewHorse.php\">Add New Horse</a>";
		echo "<a class=\"btn btn-primary mb-2\" href=\"SearchUser.php\">Manage a User</a>";
	}
	// TODO : remove enclosing "<li>" tags to remove the indicator dot
	echo "<a class=\"btn btn-success mb-2\" href=\"analytics/reporting.php\">Reports &amp; Statistics</a>";
	echo "<a href=\"functions/php/logout.php\" class=\"btn btn-secondary\">Logout</a>";
	echo "</div>";
	if($cookie_array[1] == "read-only") {
		echo "<p>If you require more than read-only access, please contact any user with write permissions</p>";
	}
} else {
	echo "Not Logged In";
	require("assets/php/request_helper.php");
	header("Location: http://" . $ip . "/equine/");
}
?>
			</div>
		</div>
	</div>
</body>

</html>
