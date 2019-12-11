<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../assets/php/mysql_connector.php");
	require("../assets/php/redirect_helper.php");
	$mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
			die("Connection failed: " . $mysqli->connect_error);
	}
	if (isset($_GET["breed"])) {
		$query = "SELECT A.Limb AS Limb, A.Side AS Side, A.Bone AS Bone, A.Pname AS Pathology, COUNT(*) AS Counting FROM (SELECT Limb, Side, Bone, Pname, Cid, Chorse, Pid FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite NATURAL JOIN Pathology) AS A INNER JOIN Horse ON A.Chorse = Horse.Hid WHERE Horse.Hbreed = \"". $_GET["breed"] . "\" AND A.Pid > 2 GROUP BY A.Limb, A.Side, A.Bone, A.Pname;";	
	} else {
		$query = "SELECT A.Limb AS Limb, A.Side AS Side, A.Bone AS Bone, A.Pname AS Pathology, COUNT(*) AS Counting FROM (SELECT Limb, Side, Bone, Pname, Cid, Chorse, Pid FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite NATURAL JOIN Pathology) AS A INNER JOIN Horse ON A.Chorse = Horse.Hid WHERE A.Pid > 2 GROUP BY A.Limb, A.Side, A.Bone, A.Pname;";
	}
	
	$result = $mysqli->query($query);
	
	$path_count_array = array();
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$bone = $row["Side"] . " " . $row["Limb"] . " " . $row["Bone"];
		$pathology = "\"". $row["Pathology"] . "\""; 
		$path_count = array($row["Pathology"], $row["Counting"], $bone);
		array_push($path_count_array, $path_count);
	}

?>
<!doctype html>
<html lang="en">

<head>
	<title>Equine Project | Reporting Home</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="../assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	
	<style>
		.GraphArea {
			width: 100%;
			height: 40rem;
		}
	</style>

</head>

<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Reporting Home</h2>
			<!-- Plotly chart will be drawn inside this DIV -->
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<h3>
					<?php 
					if (isset($_GET["breed"])){
						echo ucwords($_GET["breed"]) . ":";
					}
					?> Pathology by bone</h3>
					<div id="Chart" class="GraphArea"></div>
					<div class="btn-group" role="group">
						<a href="reporting.php?breed=arabian" class="btn btn-primary mr-2">Arabian</a>
						<a href="reporting.php?breed=standardbred" class="btn btn-primary mr-2">Standardbred</a>
						<a href="reporting.php?breed=thoroughbred" class="btn btn-primary mr-2">Thoroughbred</a>
						<a href="reporting.php?breed=sprintbred" class="btn btn-primary mr-2">Sprint Horse</a>
						<a href="reporting.php" class="btn btn-primary">All Breeds</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				<h3>SRC Summary Data (Percentages by Breed and Gender)</h3>
				<?php
					$summaryQuery = "SELECT Hbreed, Hgender, RaceTraining, RaceExternal, COUNT(*) AS Counted FROM Horse GROUP BY Hbreed, Hgender, RaceTraining, RaceExternal;";
					$summary = $mysqli->query($summaryQuery);
					if ($summary->num_rows >0) {
						echo "<table class=\"table table-responsive table-hover\">";
						echo "<thead>";
						echo "<tr><th>Breed</th><th>Gender</th><th>Had Race Training</th><th>Raced Outside US</th><th>Age at Race Start</th><th></th></tr>";
						echo "</thead><tbody>";
						while($row = mysqli_fetch_array($summary, MYSQLI_ASSOC)){
							echo "<tr>";
							echo "<td>".$row["Hbreed"]."</td>";
							echo "<td>".$row["Hgender"]."</td>";
							echo "<td>". ($row["RaceTraining"] == 0 ? "No" : "Yes") ."</td>";
							echo "<td>". ($row["RaceExternal"]== 0 ? "No" : "Yes")."</td>";
							//echo "<td>".$row["RaceStartAge"]."</td>";
							echo "<td>". ($row["Counted"] / $summary->num_rows * 100) ."%</td>";
							echo "</tr>";
						}
						echo "</tbody></table>";

					}
					?>
					<div class="btn-group">
						<a href="graphs/forelimb_breed.php" class="btn btn-primary mr-2">Forelimb Abnormalities</a>
						<a href="graphs/hindlimb_breed.php" class="btn btn-primary mr-2">Hindlimb Abnormalities</a>
						<a href="../home.php" class="btn btn-secondary">Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script><!-- Plotly.js -->
<script type="text/javascript">

		var pathCountArray = <?php echo json_encode($path_count_array); ?>;

		var pathologies = {};
		pathCountArray.forEach(function(path) {
			if(!pathologies.hasOwnProperty(path[0])){
				pathologies[path[0]] = {
					name: path[0],
					bone: [],
					count: []
				};
			}
			pathologies[path[0]].bone.push(path[2]);
			pathologies[path[0]].count.push(path[1]);
		});
		

	var traces = [];
	for (var pathology in pathologies) {
		if (pathologies.hasOwnProperty(pathology)) {

		var trace = {
			x: pathologies[pathology].bone,
			y: pathologies[pathology].count,
			name: pathologies[pathology].name,
			type: 'bar'
		};

		traces.push(trace);
		}
		
	}

	var data = traces;
	var layout = {barmode: 'stack'};
	Plotly.newPlot('Chart', data, layout, {showSendToCloud: true});

</script>

</body>

