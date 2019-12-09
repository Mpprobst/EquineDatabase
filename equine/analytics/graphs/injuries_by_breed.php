<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../../assets/php/mysql_connector.php");
        require("../../assets/php/redirect_helper.php");
        $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

        if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
	}
	$bad_query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology, Assessment, Horse WHERE CasePathology.Cid = Assessment.Cid AND Assessment.Chorse = Horse.Hid AND CasePathology.Pid > 2 GROUP BY Horse.Hbreed;";
	$count_query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology, Assessment, Horse WHERE CasePathology.Cid = Assessment.Cid AND Assessment.Chorse = Horse.Hid GROUP BY Horse.Hbreed;";

	$breed_array = array();
	$bad_array = array();
	$count_array = array();
	
	$count_result = $mysqli->query($count_query);
	
	while($row = mysqli_fetch_array($count_result, MYSQLI_ASSOC)) {
		$breed = "\"" . $row["Hbreed"] . "\"";
		array_push($breed_array, $breed);
		array_push($count_array, $row["InjuryCount"]);
		//echo "<br>breed=" . $result_array[0] . "<br>count=" . $row["InjuryCount"] . "<br>";
	}

	$bad_result = $mysqli->query($bad_query);

	while($row = mysqli_fetch_array($bad_result, MYSQLI_ASSOC)) {
		array_push($bad_array, $row["InjuryCount"]);
	}
?>
<!-- Plotly.js -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        </head>
        <body>
        <!-- Plotly chart will be drawn inside this DIV -->
        <div id="myDiv"></div>
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
        Plotly.newPlot('myDiv', data, layout, {showSendToCloud: true});
        </script>
        </body>


