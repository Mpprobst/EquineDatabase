<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../../assets/php/mysql_connector.php");
        require("../../assets/php/redirect_helper.php");
        $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

        if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
	}
	$forelimb = "\"Forelimb\"";
	$bad_query =  "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology,Assessment,Horse WHERE Assessment.Limb = " . $forelimb . " AND CasePathology.Cid= Assessment.Cid AND Assessment.Chorse = Horse.Hid AND CasePathology.Pid > 2 GROUP BY Horse.Hbreed;";
	$count_query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology,Assessment,Horse WHERE Assessment.Limb = " . $forelimb . " AND CasePathology.Cid= Assessment.Cid AND Assessment.Chorse = Horse.Hid GROUP BY Horse.Hbreed;";
	$bone_query = "SELECT Bone, Site, SiteB FROM PathologySite WHERE Limb = " .  $forelimb . ";";
	echo $bone_query;
	$breed_array = array();
	$bad_array = array();
	$count_array = array();
	$bone_array = array();

	$count_result = $mysqli->query($count_query);
	while($row = mysqli_fetch_array($count_result, MYSQLI_ASSOC)) {
		$breed = "\"" . $row["Hbreed"] . "\"";
		array_push($breed_array, $breed);
		array_push($count_array, $row["InjuryCount"]);
		//echo "<br>breed=" . $breed . "<br>count=" . $row["InjuryCount"] . "<br>";
	}

	$bad_result = $mysqli->query($bad_query);
	while($row = mysqli_fetch_array($bad_result, MYSQLI_ASSOC)) {
		array_push($bad_array, $row["InjuryCount"]);
	}

	$bone_result = $mysqli->query($bone_query);
	while($row = mysqli_fetch_array($bad_result, MYSQLI_ASSOC)) {
		$bone = $row["Bone"];
		if ($row["Site"] != "NULL") { 
			$bone .= " " . $row["Site"]; 
			if ($row["SiteB"] != "NULL") { 
                        	$bone .= " " . $row["SiteB"]; 
                	}
		}
		echo "bone = " . $bone . "<br>";
		array_push($bone_array, $bone);
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
	var bones = <?php echo json_encode($bone_array); ?>;
        var percents = [];
        var total_counts = <?php echo json_encode($count_array); ?>;
        var bad_counts = <?php echo json_encode($bad_array); ?>;
        for (var i = 0; i < bad_counts.length; i++) {
                percents[i] = 100 * bad_counts[i] / total_counts[i];
        }
	var trace1 = {
                x: breeds,
		y: percents,
		name: bones[0],
                type: 'bar'
	};
	var trace2 = {
		x: breeds,
		y: bad_counts,
		name: bones[1],
		type: 'bar'
	}
	var data = [trace1, trace2];
	var layout = {
		title: "Percentage of Abnormal Forelimb Pathology Designations by Breed",
		xaxis: {title: "Breed"},
		yaxis: {title: "Percentage (%)"},
		legend: {
		    x: 0,
		    y: 1.0,
		    bgcolor: 'rgba(255, 255, 255, 0)',
		    bordercolor: 'rgba(255, 255, 255, 0)'
		  },
		  barmode: 'group',
		  bargap: 0.15,
		  bargroupgap: 0.1
	};
        Plotly.newPlot('myDiv', data, layout, {showSendToCloud: true});
        </script>
        </body>


