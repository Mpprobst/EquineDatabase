<!doctype html>
<html>

<head>
	<title>Equine Project | Add a New Horse</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>

<body>
<?php
require("assets/php/redirect_helper.php");
if(isset($_COOKIE["equine_database"])) {
	$cookie_array = explode(",", $_COOKIE["equine_database"]);
	if($cookie_array[1] == "read-write") {
?>
	<h1>Add a Horse to the Database</h1>
	<form method="post" action="functions/php/InsertHorse.php">
		<h2>Signalment</h2>
		<div class="form-group">
			<label for="Hname">Name</label>
			<input type="text" class="form-control" id="Hname" name="Hname" />
		</div>
		<div class="form-group">
			<label for="RREH_Cid">Rood &amp; Riddle Equine Hospital Case ID</label>
			<input type="text" class="form-control" id="RREH_Cid" name="RREH_Cid" readonly />
			<label for="UK_Cid">UK Pathology Case Id</label>
			<input type="text" class="form-control" id="UK_Cid" name="UK_Cid"  readonly />
		</div>
		<div class="form-group">
			<label for="Hdob">Date of Birth</label>
			<input type="date" class="form-control" id="Hdob" name="Hdob" />
			<label for="Hdod">Date of Death or Euthanasia</label>
			<input type="date" class="form-control" id="Hdod" name="Hdod" />
			<label for="Hbreed">Breed</label>
			<select name="Hbreed" class="form-control" id="Hbreed" required>
				<option value="thoroughbred">Thoroughbred</option>
				<option value="standardbred">Standardbred</option>
				<option value="sprintbred">Sprint bred (Quarter Horse, Paint, or Appaloosa)</option>
				<option value="arabian">Arabian</option>
			</select>
			<label for="Hgender">Gender</label>
			<select name="Hgender" id="Hgender" class="form-control" required>
				<option value="intact-male">Intact male</option>
				<option value="gelding">Gelding</option>
				<option value="female">Female</option>
				<option value="spayed-female">Spayed female</option>
			</select>
		</div>
		<h2>Race and Training Data</h2>
		<div class="form-group">
			<label for="RaceTraining">Was this horse ever in race training (defined as whether or not the horse was ever being exercised for racing competitition, whether or no tth ehorse ever had a published speed work/race)?</label>
			<select name="RaceTraining" class="form-control" id="RaceTraining">
				<option value="true">Yes</option>
				<option value="false">No</option>
			</select>
			<label for="RaceExternal">Did this horse ever race outside of North America?</label>
			<select name="RaceExternal" id="RaceExternal" class="form-control">
				<option value="true">Yes</option>
				<option value="false">No</option>
			</select>
			<label for="RaceStartAge">Age at first race start (in days). If this Horse has never raced, leave blank</label>
			<input type="text" name="RaceStartAge" id="RaceStartAge" class="form-control"/>
		</div>
		<div class="btn-group">
			<button type="submit" class="btn btn-primary mr-2">Submit</button>
			<a class="btn btn-secondary" href="home.php">Cancel &amp; Home</button>
		</div>
	</form>
<?php

	} else {
		echo "Insufficient Privileges";
		header("Location: http://".$ip."/equine/home.php");
	}
} else {
	echo "Not logged in";
	header("Location: http://".$ip."/equine/");
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
