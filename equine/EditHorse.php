<!doctype html>
<html>

<head>
	<title>Equine Project | Edit Horse Clinical Data </title>
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
				<h1>Edit Horse</h1>
<?php
	$hid = $_POST["Hid"];
	$query = "SELECT * FROM Horse WHERE Hid = '$hid'";

	require("assets/php/mysql_connector.php");
	$conn= mysqli_connect($host,$SQLuserName, $Pass, $DB);

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

	$result = $conn->query($query);
	$horseName;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<form method=\"POST\" action=\"functions/php/UpdateHorse.php\">";
        echo "<input type=\"hidden\" name=\"Hid\" value=\"" . $hid . "\" />";
        echo "<h2>Signalment</h2>";
        echo "<div class=\"form-group\">";
        echo "<label for=\"Hname\">Name</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"Hname\" name=\"Hname\" value=\"". $row["Hname"]."\" />";
        echo "</div>";
        echo "<div class=\"form-group\">";
        echo "<label for=\"RREH_Cid\">Rood &amp; Riddle Equine Hospital Case ID</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"RREH_Cid\" name=\"RREH_Cid\" value=\"".$row["RREH_Cid"]."\" readonly />";
        echo "<label for=\"UK_Cid\">UK Pathology Case Id</label>";
        echo "<input type=\"text\" class=\"form-control\" id=\"UK_Cid\" name=\"UK_Cid\" value=\"".$row["UK_Cid"]."\" />";
        echo "</div>";
        echo "<div class=\"form-group\">";
        echo "<label for=\"Hdob\">Date of Birth</label>";
        echo "<input type=\"date\" class=\"form-control\" id=\"Hdob\" name=\"Hdob\" value=\"".$row["Hdob"]."\" />";
        echo "<label for=\"Hdod\">Date of Death or Euthanasia</label>";
        echo "<input type=\"date\" class=\"form-control\" id=\"Hdod\" name=\"Hdod\" value=\"".$row["Hdod"]."\" />";
        echo "<label for=\"Hbreed\">Breed</label>";
        echo "<select name=\"Hbreed\" class=\"form-control\" id=\"Hbreed\" required>";
        echo "<option value=\"thoroughbred\"".(($row["Hbreed"] == "thoroughbred") ? "Selected" : "").">Thoroughbred</option>";
        echo "<option value=\"standardbred\"".(($row["Hbreed"] == "standardbred") ? "Selected" : "").">Standardbred</option>";
        echo "<option value=\"sprintbred\"".(($row["Hbreed"] == "sprintbred") ? "Selected" : "").">Sprint bred (Quarter Horse, Paint, or Appaloosa)</option>";
        echo "<option value=\"arabian\"".(($row["Hbreed"] == "arabian") ? "Selected" : "").">Arabian</option>";
        echo "</select>";
        echo "<label for=\"Hgender\">Gender</label>";
        echo "<select name=\"Hgender\" id=\"Hgender\" class=\"form-control\" required>";
        echo "<option value=\"intact-male\"".(($row["Hgender"] == "intact-male") ? "Selected" : "").">Intact male</option>";
        echo "<option value=\"gelding\"".(($row["Hgender"] == "gelding") ? "Selected" : "").">Gelding</option>";
        echo "<option value=\"female\"".(($row["Hgender"] == "female") ? "Selected" : "").">Female</option>";
        echo "<option value=\"spayed-female\"".(($row["Hgender"] == "spayed-female") ? "Selected" : "").">Spayed female</option>";
        echo "</select>";
        echo "</div>";
        echo "<h2>Race and Training Data</h2>";
        echo "<div class=\"form-group\">";
        echo "<label for=\"RaceTraining\">Was this horse ever in race training (defined as whether or not the horse was ever being exercised for racing competitition, whether or no tth ehorse ever had a published speed work/race)?</label>";
        echo "<select name=\"RaceTraining\" class=\"form-control\" id=\"RaceTraining\">";
        echo "<option value=\"true\" ". (($row["RaceTraining"] == 1) ? "Selected" : "") .">Yes</option>";
        echo "<option value=\"false\" ".(($row["RaceTraining"] != 1) ? "Selected" : "").">No</option>";
        echo "</select>";
        echo "<label for=\"RaceExternal\">Did this horse ever race outside of North America?</label>";
        echo "<select name=\"RaceExternal\" id=\"RaceExternal\" class=\"form-control\">";
        echo "<option value=\"true\" ".(($row["RaceExternal"] == 1) ? "Selected" : "").">Yes</option>";
        echo "<option value=\"false\" ".(($row["RaceExternal"] != 1) ? "Selected" : "").">No</option>";
        echo "</select>";
        echo "<label for=\"RaceStartAge\">Age at first race start (in days). If this Horse has never raced, leave blank</label>";
        echo "<input type=\"text\" name=\"RaceStartAge\" id=\"RaceStartAge\" class=\"form-control\" value=\"".$row["RaceStartAge"]."\" />";
        echo "</div>";
        echo "<div class=\"btn-group\" role=\"group\">";
        echo "<button type=\"submit\" class=\"btn btn-primary mr-2\">Save Changes</button>";
        echo "<a class=\"btn btn-danger mr-2\" href=\"ViewHorse.php?id=".$_POST["Hid"]."\">Cancel</a>";
        echo "<a class=\"btn btn-secondary\" href=\"home.php\">Home</a>";
        echo "</div>";
        echo "</form>";
	}




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
