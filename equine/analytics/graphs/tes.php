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
<head>
<!-- Plotly.js -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        </head>
        <body>
        <!-- Plotly chart will be drawn inside this DIV -->
        <div id="myDiv"></div>
	<script type="text/javascript">

	var breeds = <?php echo json_encode($breed_array); ?>;
	var counts = <?php echo json_encode($count_array); ?>;

	var trace = {
		x: breeds,
		y: counts,
		type: 'bar',
	  };
	var data = [trace];
	Plotly.newPlot('myDiv', data, {}, {showSendToCloud: true});
	</script>
        </body>

