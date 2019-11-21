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
		<label for="Hname">Horse's name:</label>
		<input type="text" name="Hname" required />
<br />		
		<label for="Hdob">Birthdate:</label>
		<input type="date" name="Hdob" required />
<br />
		<label for="Hdod">Date of Death or Euthanasia:</label>
		<input type="date" name="Hdod" />
<br />
		<label for="Hbreed">Breed:</label>
		<input type="text" name="Hbreed" required />
<br />
		<label for="Hgender">Gender</label>
		<select name="Hgender" required>
			<option value="filly">Filly</option>
			<option value="mare">Mare</option>
			<option value="gelding">Gelding</option>
			<option value="stallion">Stallion</option>
		</select>
<br />
		<button type="submit">Submit</button>
	</form>
<p>IN PROGRESS</p>
<?php

	} else {
		echo "Insufficient Privileges";
	}
} else {
	echo "Not logged in";
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
