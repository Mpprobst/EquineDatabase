<!doctype html>
<html>

<head>
	<title>Equine Project | Find a Horse</title>
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<meta charset="UTF-8" />
</head>

<body>
<?php
if (isset($_COOKIE["equine_database"])) {
?>
<h1>Search for a Horse</h1>
	<form method="post" action="SearchHorse.php">
		<label for="search">Enter a horse's name</label>
		<input name="search" type="text" placeholder="e.g., Secretariat" />
		<button type="submit">Submit</button>
	</form>
<?php
	if(isset($_POST["search"])) {
//    		$cookie_array = explode(",", $_COOKIE["equine_database"]);
		require("assets/php/mysql_connector.php");
		$mysqli = mysqli_connect($host, $ROuserName,$ROPass,$DB);
		$query = "SELECT * FROM Horse WHERE Horse.Hname LIKE '". $_POST['search']. "%'";
		$result = $mysqli->query($query);
		if($result->num_rows > 0) {
			echo "<h2>Search Results:</h2>";
			echo "<ul>";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<li><a href='ViewHorse.php?id=".$row["Hid"]."'>".$row["Hname"]."</a></li>";
		}
			echo "</ul>";
		} else {
			echo "no results";
		}
	}
?>
<a class="button" href="home.php">Back</a>
<?php
} else {
	echo "Not Logged In";
}
?>
</body>

</html>