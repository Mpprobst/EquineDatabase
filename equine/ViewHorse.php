<!doctype html>
<html>

<head>
	<title>Equine Project | View a Horse </title>
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
if (isset($_COOKIE["equine_database"])) {
?>
				<h1>Horse Clinical &amp; Race Data</h1>
<?php
	$hid = $_GET["id"];
	$query = "SELECT * FROM Horse WHERE Hid = '$hid'";

	require("assets/php/mysql_connector.php");
	$conn= mysqli_connect($host,$ROuserName, $ROPass, $DB);

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

	$result = $conn->query($query);
	$horseName;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$death = ($row["Hdod"] == "") ? "Not Applicable" : $row["Hdod"];
		echo "<h2>Signalment</h2>";
		echo "<p><strong>Name:</strong> ".$row["Hname"]."</p>";
		$horseName = $row["Hname"];
		echo "<p><strong>Rood &amp; Riddle Equine Hospital ID:</strong> ". $row["RREH_Cid"] . "</p>";
		echo "<p><strong>UK Pathology Case ID:</strong> ". $row["UK_Cid"] ."</p>";
		echo "<p><strong>Date of Birth:</strong> ".$row["Hdob"]."</p>";
		echo "<p><strong>Date of Death or Euthanasia:</strong> ".$death."</p>";
		echo "<p><strong>Breed:</strong> ".$row["Hbreed"]."</p>";
		echo "<p><strong>Gender:</strong> ".$row["Hgender"]."</p>";

		echo "<h2>Race and Training Data</h2>";
		$raceTraining = ($row["RaceTraining"] == 1) ? "Yes" : "No";
		$raceExternal = ($row["RaceExternal"] == 1) ? "Yes" : "No";
		$raceStartAge = ($row["RaceStartAge"] == "") ? "Not Applicable" : $row["RaceStartAge"] . " days old";
		echo "<p><strong>Horse in Race Training?:</strong> ".$raceTraining."</p>";
		echo "<p><strong>Horse raced outside North America:</strong> ".$raceExternal."</p>";
		echo "<p><strong>Age of horse at first race start:</strong> ".$raceStartAge."</p>";
	}
?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2>Assessments</h2>
<?php
	
	$assessQuery = "SELECT * FROM Assessment INNER JOIN User ON Assessment.Cuser = User.uid WHERE Assessment.Chorse = '$hid'";
	$assessments = $conn->query($assessQuery);
	if ($assessments->num_rows > 0){
		echo "<h3>Pathology Assessments for " . $horseName . "</h3>";
		echo "<table class=\"table table-responsive table-hover\">";
		echo "<thead><tr><th>Rood &amp; Riddle Case ID</th><th>Clinic</th><th>Assessor</th><th>Limb</th><th>Date</th></tr></thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_array($assessments, MYSQLI_ASSOC)) {
			echo "<tr>";
			echo "<td><a href=\"ViewAssessment.php?id=". $row["Cid"] . "\">" . $row["RREH_Cid"] . "</a></td>";
			echo "<td>" . $row["Clinic"] . "</td>";
			echo "<td>" . $row["Name"] . "</td>";
			echo "<td>" . $row["Limb"] . "</td>";
			echo "<td>" . $row["Cdate"] . "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	} else {
		echo "<p><strong>No assessments found for this horse.</strong></p>";
	}
	

	$cookie_array = explode(",", $_COOKIE["equine_database"]);

	echo "<div class=\"btn-group\" role=\"group\">";
	if ($cookie_array[1] == "read-write"){
		// Add additional layer of if statement for checking clinic?

		// Edit this Horse Button
		echo "<form method=\"post\" action=\"EditHorse.php\">";
		echo "<input type=\"hidden\" name=\"Hid\" value=\"" . $hid . "\" />";
		// other data needed for edit horse clinical data?
		echo "<button type=\"submit\" class=\"btn btn-light mr-2\">Edit Clinical Data</button>";
		echo "</form>";

		// New Forelimb Assessment Button
		echo "<form method=\"post\" action=\"NewAssessment.php\">";
		echo "<input type=\"hidden\" name=\"Hid\" value=\"" . $hid . "\" />";
		echo "<input type=\"hidden\" name=\"Limb\" value=\"Forelimb\" />";
		echo "<button type=\"submit\" class=\"btn btn-primary mr-2\">New Forelimb Assessment</button>";
		echo "</form>";
	
		// New Hindlimb Assessment Button
		echo "<form method=\"post\" action=\"NewAssessment.php\">";
		echo "<input type=\"hidden\" name=\"Hid\" value=\"" . $hid . "\" />";
		echo "<input type=\"hidden\" name=\"Limb\" value=\"Hindlimb\" />";
		echo "<button type=\"submit\" class=\"btn btn-primary mr-2\">New Hindlimb Assessment</button>";
		echo "</form>";
	}
	
	echo "<a class=\"btn btn-secondary\" href=\"home.php\">Back</a>";
	echo "</div>";

} else {
		echo "Not Logged In";
		require("assets/php/redirect_helper.php");
		header("Location: http://".$ip."/equine/");
}
?>
			</div>
		</div>
	</div>
</body>
