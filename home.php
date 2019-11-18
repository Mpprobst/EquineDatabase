<!doctype html>
<html>

<head>
	<title>Equine Project | Home (Milestone 4)</title>
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<meta charset="UTF-8" />
</head>

<body>
<?php
if(isset($_COOKIE["equine_database"])) {
	$cookie_array = explode(",", $_COOKIE["equine_database"]);
	echo "<h1>Welcome ".$cookie_array[0].",</h1>";
	echo "<p>Your Clinic: ".$cookie_array[2]."</p>";

	echo "<p>Please choose an option:</p>";

	echo "<ul class=\"button-list\">";

	echo "<li><a class=\"button\">View Horse</a></li>";
	echo "<li><a class=\"button\">View Assessment</a></li>";
	if($cookie_array[1] == "read-write") {
		echo "<li><a class=\"button\">Manage/Add/Edit Horse</a></li>";
		echo "<li><a class=\"button\">Submit an Assessment</a></li>";	
		echo "<li><a class=\"button\">Manage a user</a></li>";
	}
	echo "<li><a href=\"./logout.php\" class=\"button background-medium-gray\">Logout</a></li>";
	echo "</ul>";
	if($cookie_array[1] == "read-only") {
		echo "<p>If you require more than read-only access, please contact any user with write permissions</p>";
	}
} else {
	echo "Not Logged In";
}
?>
</body>

</html>
