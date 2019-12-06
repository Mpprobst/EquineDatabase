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
	<div class="container">
<?php
if (isset($_COOKIE["equine_database"])) {
?>
		<div class="row">
			<div class="col-sm-12">
				<h1>Search for a Horse</h1>
				<form method="post" action="SearchHorse.php">
					<div class="form-group">
						<label for="search">Enter a horse's name or Rood & Riddle case ID</label>
						<input id="search" class="form-control" name="search" type="text" placeholder="e.g., Secretariat" />		
					</div>
					<div class="btn-group" role="group">
						<button class="btn btn-primary mr-2" type="submit">Search</button>
						<a class="btn btn-secondary" href="home.php">Back</a>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
<?php
	if(isset($_POST["search"])) {
		require("assets/php/mysql_connector.php");
		$mysqli = mysqli_connect($host, $ROuserName, $ROPass,$DB);
		$query = "SELECT * FROM Horse WHERE Horse.Hname LIKE \"". $_POST["search"]. "%\" OR Horse.RREH_Cid LIKE \"" . $_POST["search"] . "%\"";
		$result = $mysqli->query($query);
		if($result->num_rows > 0) {
			echo "<h2>Search Results for <strong>".$_POST["search"]."</strong>:</h2>";
			echo "<ul>";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<li><a href=\"ViewHorse.php?id=".$row["Hid"]."\">".$row["Hname"]."</a></li>";
		}
			echo "</ul>";
		} else {
			echo "<p>No horses match your search term</p>";
		}
	}
?>
			</div>
		</div>

<?php
} else {
	echo "Not Logged In";
	require("assets/php/redirect_helper.php");
	header("Location: http://".$ip."/equine/");
}
?>
</div>
</body>

</html>
