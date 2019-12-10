<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../../assets/php/mysql_connector.php");
        require("../../assets/php/redirect_helper.php");
        $mysqli = new mysqli($host, $SQLuserName, $Pass, $DB);

        if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
	}
	// Get the names of all Forelimb bones
	$forelimb = "\"Hindlimb\""; // ignore the fact that Hindlimb is stored in forelimb
	$bone_query = "Select DISTINCT Bone From PathologySite WHERE Limb = " . $forelimb . ";";
	$bone_result = $mysqli->query($bone_query); 
	$bone_array = array();
	while($row = mysqli_fetch_array($bone_result, MYSQLI_ASSOC)) {
		$bone = $row["Bone"];
		array_push($bone_array, $bone);
	}

	$bad_matrix = array();
	$count_matrix = array();
	$breed_matrix = array();
	$bone_count = count($bone_array);
	//echo "bone count = " . $bone_count . "<br>";
	// Use the names of forelimb bones to find number of abnormalities for each bone
	$i = 0;
	while($i < $bone_count) {
		$temp_count_array = array();
		$temp_bad_array = array();
		$temp_breed_array = array();	
		$bone = "\"" . $bone_array[$i] . "\"";
		$bad_query = "SELECT h.Hbreed, COUNT(c.Sid) as " . $bone . " FROM CasePathology c, PathologySite s, Assessment a, Horse h WHERE a.Cid = c.Cid AND c.Sid = s.Sid AND c.Pid > 2 AND a.Chorse = h.Hid AND s.Bone = " . $bone . " GROUP BY h.Hbreed;";
		$temp_query = "SELECT h.Hbreed, COUNT(c.Sid) as " . $bone . " FROM CasePathology c, PathologySite s, Assessment a, Horse h WHERE a.Cid = c.Cid AND c.Sid = s.Sid AND a.Chorse = h.Hid AND s.Bone = " . $bone . " GROUP BY h.Hbreed;";
		
		$temp_result = $mysqli->query($temp_query);
		while($row = mysqli_fetch_array($temp_result, MYSQLI_ASSOC)) {
			$breed = "\"" . $row["Hbreed"] . "\"";
			array_push($temp_breed_array, $breed);	
			array_push($temp_count_array, $row[$bone_array[$i]]);
		}
		$bad_result = $mysqli->query($bad_query);
		while($row = mysqli_fetch_array($bad_result, MYSQLI_ASSOC)) {
			array_push($temp_bad_array, $row[$bone_array[$i]]);	
		}

		array_push($breed_matrix, $temp_breed_array);
		array_push($bad_matrix, $temp_bad_array);
		array_push($count_matrix, $temp_count_array);
		$i++;		
	}

	// Find assessments for each bone, put in different query
	// SELECT h.Hbreed, COUNT(c.Sid) as "Distal Radius" FROM CasePathology c, PathologySite s, Assessment a, Horse h WHERE a.Cid = c.Cid AND c.Sid = s.Sid AND c.Pid > 2 AND a.Chorse = h.Hid AND s.Bone = "Distal Radius" GROUP BY h.Hbreed; 
	//SELECT c.Cid, c.Sid, s.Bone FROM CasePathology c, PathologySite s WHERE c.Pid > 2 AND c.Sid = s.Sid AND s.Limb = " . $forelimb . ";";
	// SELECT h.Hbreed, COUNT(x.Bone) FROM Horse h, Assessment a , (SELECT c.Cid, c.Sid, s.Bone FROM CasePathology c, PathologySite s WHERE c.Pid > 2 AND c.Sid = s.Sid AND s.Bone = "Distal Radius") as x WHERE a.Cid = x.Cid AND x.Cid = h.Hid GROUP BY h.Hbreed
/*
	$bad_query =  "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology,Assessment,Horse WHERE Assessment.Limb = " . $forelimb . " AND CasePathology.Cid= Assessment.Cid AND Assessment.Chorse = Horse.Hid AND CasePathology.Pid > 2 GROUP BY Horse.Hbreed;";
	$count_query = "SELECT COUNT(sid) AS InjuryCount, Horse.Hbreed FROM CasePathology,Assessment,Horse WHERE Assessment.Limb = " . $forelimb . " AND CasePathology.Cid= Assessment.Cid AND Assessment.Chorse = Horse.Hid GROUP BY Horse.Hbreed;";
	//$bone_query = "SELECT Bone, Site, SiteB FROM PathologySite WHERE Limb = " .  $forelimb . ";";
	echo $bone_query;
	$breed_array = array();
	$bad_array = array();
	$count_array = array();
	//$bone_array = array();

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

	/*$bone_result = $mysqli->query($bone_query);
	$bone;
	while($row = mysqli_fetch_array($bone_result, MYSQLI_ASSOC)) {
		if ($row["Bone"] != $bone) { 
			$bone =$row["Bone"];
			//$bone .= " " . $row["Site"]; 
			/*if ($row["SiteB"]) { 
                        	$bone .= " " . $row["SiteB"]; 
			}
		echo "bone = " . $bone . "<br>";
		array_push($bone_array, $bone);
		}

	}*/
	$breed_array = array();
	$count_array = array();
	$bad_array = array();
?>
<head>
<title>Equine Project | Forelimb Abnormalities</title>
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
                        <h2>Hindlimb Abnormalities</h2>
                        <!-- Plotly chart will be drawn inside this DIV -->
                        <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                        <div id="Chart" class="GraphArea"></div>
                                        <div class="btn-group">
                                                <a href="forelimb_breed.php" class="btn btn-primary mr-2">Forelimb Abnormalities</a>
                                                <a href="../reporting.php" class="btn btn-primary mr-2">Reporting Home</a>
                                                <a href="../../home.php" class="btn btn-secondary">Home</a>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<!-- Plotly.js -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        </head>
        <body>
        <!-- Plotly chart will be drawn inside this DIV -->
        <div id="myDiv"></div>
        <!-- <script type="text/javascript"> -->
        <script>

	var breeds = <?php echo json_encode($breed_matrix); ?>;
	var bones = <?php echo json_encode($bone_array); ?>;
	var percents = new Array(bones.length);
        var total_counts = <?php echo json_encode($count_matrix); ?>;
        var bad_counts = <?php echo json_encode($bad_matrix); ?>;
	for (var i = 0; i < total_counts.length; i++) {
		percents[i] = new Array(total_counts[i].length);
		for (var j = 0; j < total_counts[i].length; j++) {
                	percents[i][j] = 100 * bad_counts[i][j] / total_counts[i][j];
		}
	}
	var trace0 = {
                x: breeds[0],
		y: percents[0],
		name: bones[0],
                type: 'bar'
	};
	var trace1 = {
		x: breeds[1],
		y: percents[1],
		name: bones[1],
		type: 'bar'
	};
	var trace2 = {
		x: breeds[2],
		y: percents[2],
		name: bones[2],
		type: 'bar'
	};	
	var trace3 = {
		x: breeds[3],
		y: percents[3],
		name: bones[3],
		type: 'bar'
	};
	var data = [trace0, trace1, trace2, trace3];
	var layout = {
		title: "Percentage of Abnormal Hindlimb Pathology Designations by Breed",
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


