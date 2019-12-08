<!doctype html>
<html>

<head>
    <title>Equine Project | View an Assessment </title>
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
<?php
	$Cid = $_GET["id"];
	$query = "SELECT * FROM Assessment WHERE Cid = '$Cid'";

	require("assets/php/mysql_connector.php");
	$conn= mysqli_connect($host,$ROuserName, $ROPass, $DB);

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
    
	$assessQuery = "SELECT * FROM Assessment INNER JOIN User ON Assessment.Cuser = User.uid WHERE Assessment.Cid = '$Cid'";
    $assessments = $conn->query($assessQuery);
    if ($row = mysqli_fetch_array($assessments, MYSQLI_ASSOC)) {

    echo "<h1> ". $row["Limb"] ." Pathology Form </h1>";
	echo "<table class=\"table table-responsive table-hover\">";
	echo "<thead><tr><th>Rood &amp; Riddle Case ID</th><th>Clinic</th><th>Assessor</th><th>Limb</th><th>Date</th></tr></thead>";
	echo "<tbody>";
	
    echo "<tr>";
    echo "<td>" . $row["RREH_Cid"] . "</td>";
    echo "<td>" . $row["Clinic"] . "</td>";
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["Limb"] . "</td>";
    echo "<td>" . $row["Cdate"] . "</td>";
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";
    
    echo "<p>TODO: get case pathology and display</p>";
	} else {
        echo "<p>Error: No assessment found</p>";
    }
?>
                <a class="btn btn-secondary" href="home.php">Back</a>
<?php
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
