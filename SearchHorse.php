<!doctype html>
<html>

<head>
	<title>Equine Project | Find a Horse</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
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
		require("asssets/php/mysql_connector.php");
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
	require("assets/php/redirect_helper.php");
	header("Location: http://".$ip."/equine/");
}
?>
</body>

</html>
