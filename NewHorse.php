<!doctype html>
<html>

<head>
	<title>Equine Project | Add a New Horse</title>
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<meta charset="UTF-8" />
</head>

<body>
<?php
if(isset($_COOKIE["equine_database"])) {
	$cookie_array = explode(",", $_COOKIE["equine_database"]);
	if($cookie_array[1] == "read-write") {
?>
	<h1>Add a Horse to the Database</h1>
	<form method="post" action="NewHorse.php">
	<h2>Signalment<h2>
		<label for="Hname">Horse's name:</label>
		<input type="text" name="Hname" required />
<br />		
		<label for="Hbreed">Breed:</label>
		<select name="Hbreed" required>
			<option value="thoroughbred">Thoroughbred</option>
			<option value="standardbred">Standardbred</option>
			<option value="sprintbred">Sprint bred (Quarter Horse, Paint, or Appaloosa)</option>
			<option value="arabian">Arabian</option>
		</select>
<br />
		<label for="Hgender">Gender</label>
		<select name="Hgender" required>
			<option value="intact-male">Intact male</option>
			<option value="gelding">Gelding</option>
			<option value="female">Female</option>
			<option value="spayed-female">Spayed female</option>
		</select>
<br />
		<label for="Hdob">Date of birth:</label>
		<input type="date" name="Hdob" required />
<br />
		<label for="UK_Cid">University of Kentucky Verterinary Diagnostic Laboratory case number (Leave blank if Not Applicable)</label>
		<input type="text" name="UK_Cid" />
<br />
		<label for="RREH_Cid">Rood &amp; Riddle Equine Hospital case number (Leave blank if Not Applicable)</label>
		<input type="text" name="RREH_Cid" />
<br />
		<h2>Racing and Training</h2>
		<label for="RaceTraining">Was this horse ever in race training (defined as whether or not the horse was ever being exercised for racing competitition, whether or no tth ehorse ever had a published speed work/race)?</label>
		<select name="RaceTraining" required>
			<option value="true">Yes</option>
			<option value="false">No</option>
		</select>
<br />
		<label for="RaceExternal">Did this horse ever race outside of North America?</label>
		<select name="RaceExternal" required>
			<option value="true">Yes</option>
			<option value="false">No</option>
		</select>
<br />
		<label for="RaceStartAge">Age at first race start (in days). If this Horse has never raced, leave blank</label>
		<input type="text" name="RaceStartAge" />
<br />

		<button type="submit">Submit</button>
	</form>
<p>IN PROGRESS</p>
<?php

	} else {
		echo "Insufficient Privileges";
		header("Location: http://172.31.147.164/equine/home.php");
	}
} else {
	echo "Not logged in";
	header("Location: http://172.31.147.164/equine/");
}

if(isset($_POST["Hname"])) {
	require("./assets/php/mysql_connector.php");
	$conn= mysqli_connect($host,$SQLuserName,$Pass,$DB);

	$hname = $_POST["Hname"];
	$hdob = $_POST["Hdob"];
	$hdod = empty($_POST["Hdod"]) ? NULL : $_POST["Hdod"];
	$hbreed = $_POST["Hbreed"];
	$hgender = $_POST["Hgender"];
	$checkQuery="SELECT * FROM Horse WHERE (Hname LIKE '$hname') AND (Hdob LIKE '$hdob')";

	if(empty($hdod)) {
		$insertQuery="INSERT INTO Horse (Hname, Hdob, Hbreed, Hgender) VALUES('$hname', '$hdob', '$hbreed', '$hgender')";
	} else {
		$insertQuery="INSERT INTO Horse (Hname, Hdob, Hdod, Hbreed, Hgender) VALUES('$hname', '$hdob', IFNULL($hdod, NULL), '$hbreed', '$hgender')";
	}

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
	$check = $conn->query($checkQuery);
	if ($check->num_rows >0) {
		echo "ERROR: Horse already exists";
	} else {
		if($conn->query($query)){
			echo "Horse Added Successfully!";
		}		
	}
}
?>
<a class="button" href="home.php">Back</a>
</body>
<html>
