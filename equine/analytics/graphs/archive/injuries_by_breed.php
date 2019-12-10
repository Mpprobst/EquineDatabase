<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../../../assets/php/mysql_connector.php");
	require("../../../assets/php/redirect_helper.php");
	$mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
	$forelimb = "\"Forelimb\"";
	$bad_query =  "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology,Assessment,Horse WHERE Assessment.Limb = " . $forelimb . " AND CasePathology.Cid= Assessment.Cid AND Assessment.Chorse = Horse.Hid AND CasePathology.Pid > 2 GROUP BY Horse.Hbreed;";
	//$bad_query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology, Assessment, Horse WHERE CasePathology.Cid = Assessment.Cid AND Assessment.Chorse = Horse.Hid AND CasePathology.Pid > 2 GROUP BY Horse.Hbreed;";
	$count_query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology,Assessment,Horse WHERE Assessment.Limb = " . $forelimb . " AND CasePathology.Cid= Assessment.Cid AND Assessment.Chorse = Horse.Hid GROUP BY Horse.Hbreed;";
	//$count_query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology, Assessment, Horse WHERE CasePathology.Cid = Assessment.Cid AND Assessment.Chorse = Horse.Hid GROUP BY Horse.Hbreed;";

	$breed_array = array();
	$bad_array = array();
	$count_array = array();

	$count_result = $mysqli->query($count_query);
	
	while($row = mysqli_fetch_array($count_result, MYSQLI_ASSOC)) {
		$breed = "\"" . $row["Hbreed"] . "\"";
		array_push($breed_array, $breed);
		array_push($count_array, $row["InjuryCount"]);
	//	echo "<br>breed=" . $breed . "<br>count=" . $row["InjuryCount"] . "<br>";
	}

	$bad_result = $mysqli->query($bad_query);

	while($row = mysqli_fetch_array($bad_result, MYSQLI_ASSOC)) {
		array_push($bad_array, $row["InjuryCount"]);
	}
?>

<!doctype html>
<html lang="en">
<head>
<title>Equine Project | Percent Abnormal: Forelimb</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../../assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="../../assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	
	<style>
		.GraphArea {
			width: 100%;
			height: 20rem;
		}
	</style>

</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Injury Types By Breed Report</h2>
			<!-- Plotly chart will be drawn inside this DIV -->
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div id="Chart" class="GraphArea"></div>
					<div class="btn-group">
						<a href="tes.php" class="btn btn-primary mr-2">TES Report</a>
						<a href="../reporting.php" class="btn btn-primary mr-2">Reporting Home</a>
						<a href="../../home.php" class="btn btn-secondary">Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script><!-- Plotly.js -->
<script type="text/javascript">

var breeds = <?php echo json_encode($breed_array); ?>;
var percents = [];
var total_counts = <?php echo json_encode($count_array); ?>;
var bad_counts = <?php echo json_encode($bad_array); ?>;
for (var i = 0; i < bad_counts.length; i++) {
	percents[i] = 100 * bad_counts[i] / total_counts[i];
}
var trace = {
	x: breeds,
	y: percents,
	type: 'bar',
	};
var data = [trace];
var layout = {
	title: "Percentage of Assessments that are Injuries By Breed",
	xaxis: {title: "Breed"},
	yaxis: {title: "Percentage (%)"}
};
Plotly.newPlot('Chart', data, layout, {showSendToCloud: true});
</script>
</body>


