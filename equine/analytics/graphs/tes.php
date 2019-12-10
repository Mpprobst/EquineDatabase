<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../assets/php/mysql_connector.php");
	require("../assets/php/redirect_helper.php");
	$mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
			die("Connection failed: " . $mysqli->connect_error);
	}
	$query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology, Assessment, Horse WHERE CasePathology.Cid = Assessment.Cid AND Assessment.Chorse = Horse.Hid AND CasePathology.Pid > 2 GROUP BY Horse.Hbreed;";
	$result = $mysqli->query($query);
	$breed_array = array();
	$count_array = array();
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$breed = "\"" . $row["Hbreed"] . "\"";
		array_push($breed_array, $breed);
		array_push($count_array,$row["InjuryCount"]);
		//echo "<br>breed=" . $result_array[0] . "<br>count=" . $row["InjuryCount"] . "<br>";
	}
?>
<!doctype html>
<html lang="en">
<head>
<title>Equine Project | TES Report</title>
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
			<h2>TES Report</h2>
			<!-- Plotly chart will be drawn inside this DIV -->
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div id="Chart" class="GraphArea"></div>
					<div class="btn-group">
						<a href="injuries_by_breed.php" class="btn btn-primary mr-2">Injuries by Breed</a>
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
	var counts = <?php echo json_encode($count_array); ?>;

	var trace = {
		x: breeds,
		y: counts,
		type: 'bar',
	  };
	var data = [trace];
	Plotly.newPlot('Chart', data, {}, {showSendToCloud: true});
</script>
</body>

</html>