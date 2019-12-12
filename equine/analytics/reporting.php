<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../assets/php/mysql_connector.php");
	require("../assets/php/redirect_helper.php");
	$mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

	if ($mysqli->connect_error) {
			die("Connection failed: " . $mysqli->connect_error);
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
				
				<div class="col-sm-8">
				<h3>SRC Summary Data (Percentages by Breed and Gender)</h3>
				<?php
					$filter = "";
					$horseTotalQuery = "SELECT COUNT(*) AS HCount FROM Horse;";
					$summaryQuery = "SELECT Hbreed, Hgender, RaceTraining, RaceExternal, COUNT(*) AS Counted FROM Horse GROUP BY Hbreed, Hgender, RaceTraining, RaceExternal;";
					if (isset($_GET["sBreed"])) {
						$filter = "WHERE Hbreed = \"" . $_GET["sBreed"] . "\"";
						$summaryQuery = "SELECT Hbreed, RaceTraining, RaceExternal, COUNT(*) AS Counted FROM Horse ". $filter." GROUP BY Hbreed, RaceTraining, RaceExternal;";
						$horseTotalQuery = "SELECT COUNT(*) AS HCount FROM Horse " . $filter;
					} else if (isset($_GET["sGender"])) {
						$filter = "WHERE Hgender = \"" . $_GET["sGender"] . "\"";
						$summaryQuery = "SELECT Hgender, RaceTraining, RaceExternal, COUNT(*) AS Counted FROM Horse ". $filter ." GROUP BY Hgender, RaceTraining, RaceExternal;";
						$horseTotalQuery = "SELECT COUNT(*) AS HCount FROM Horse " . $filter;
					}
					
					$summary = $mysqli->query($summaryQuery);
					if ($summary->num_rows >0) {
						$totaler = $mysqli->query($horseTotalQuery);
						$total = 1;
						if($totals = mysqli_fetch_array($totaler, MYSQLI_ASSOC)) {
							$total = $totals["HCount"];
						}
						echo "<table class=\"table table-responsive table-hover\">";
						echo "<thead>";
						echo "<tr>";
						if(isset($_GET["sGender"])){
							echo "<th>Breed</th>";
						}
						if(isset($_GET["sBreed"])) {
							echo "<th>Gender</th>";
						}
						echo "<th>Had Race Training</th><th>Raced Outside US</th><th></th></tr>";
						echo "</thead><tbody>";
						while($row = mysqli_fetch_array($summary, MYSQLI_ASSOC)){
							echo "<tr>";
							if(!isset($_GET["sGender"])){
								echo "<td><a href=\"reporting.php?sBreed=".$row["Hbreed"] . "\" >" . $row["Hbreed"]."</a></td>";
							}
							if(!isset($_GET["sBreed"])){
								echo "<td><a href=\"reporting.php?sGender=".$row["Hgender"] . "\" >".$row["Hgender"]."</a></td>";	
							}
							echo "<td>". ($row["RaceTraining"] == 0 ? "No" : "Yes") ."</td>";
							echo "<td>". ($row["RaceExternal"]== 0 ? "No" : "Yes")."</td>";
							echo "<td>". $row["Counted"] . " [" . round( ($row["Counted"] / $total ) * 100 , 2) .  "%]</td>";
							echo "</tr>";
						}
						echo "</tbody></table>";
						if ($filter != "") {
							echo "<a href=\"reporting.php\">Clear Filter...</a>";
						}

					}
					?>
				</div>
				<div class="col-sm-4">
				<h3>Graphs:</h3>
					<div class="btn-group-vertical">
						<a href="graphs/forelimb_breed.php" class="btn btn-primary mb-2">Forelimb Abnormalities</a>
						<a href="graphs/hindlimb_breed.php" class="btn btn-primary mb-2">Hindlimb Abnormalities</a>
						<a href="graphs/irregular_bone_breed.php" class="btn btn-primary mb-2">Abnormalities by Bone and Breed</a>
						<a href="../home.php" class="btn btn-secondary">Home</a>
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>
</body>

