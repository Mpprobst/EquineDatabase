<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based histogram.   
 */

	require("../../assets/php/mysql_connector.php");
	require("../../assets/php/redirect_helper.php");
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
	<link href="../../assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="../../assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	
	<style>
		.GraphArea {
			width: 100%;
			height: 40rem;
		}
	</style>

</head>

<body>
<?php
if(isset($_COOKIE["equine_database"])) {
?>
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
					?> Irregular Pathologies, by Bone</h3>
					<div id="Chart" class="GraphArea"></div>
				</div>
                <div class="col-sm-1"></div>
			</div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                <div class="btn-group" role="group">
                    <?php
                        $getBreedsQuery = "SELECT DISTINCT Hbreed FROM Horse;";
                        $breeds = $mysqli->query($getBreedsQuery);
                        while ($row = mysqli_fetch_array($breeds, MYSQLI_ASSOC)) {
                            echo "<a href=\"irregular_bone_breed.php?breed=".$row["Hbreed"] . "\" class=\"btn btn-primary mr-2\">". ucwords($row["Hbreed"]) . "</a>";
                        }                        
                    ?>
                        <a href="irregular_bone_breed.php" class="btn btn-primary">All Breeds</a>
					</div>
                </div>
            </div>
			<div class="row">
				<div class="col-sm-8">
				<h3>Pathology Summary Data (Percentages by Breed and Gender, by Bone)</h3>
				<?php

                    $filter = "";
                    $horseTotalQuery = "SELECT COUNT(*) AS HCount FROM Horse;";
                    $summaryQuery = "SELECT Horse.Hbreed AS Hbreed, Horse.Hgender AS Hgender, A.Limb AS Limb, A.Side AS Side, A.Bone AS Bone, A.PhantomDensityIncluded AS Phantom, COUNT(*) AS Counted FROM ( SELECT Limb, Side, Bone, Cid, Chorse, PhantomDensityIncluded FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite ) AS A INNER JOIN Horse ON A.Chorse = Horse.Hid GROUP BY Horse.Hbreed, Horse.Hgender, A.Limb, A.Side, A.Bone, A.PhantomDensityIncluded;";
                    $numSummary = 1;
                    if (isset($_GET["sBreed"])) {
                        if ($numSummary > 0) {
                            $filter .= " AND ";
                        } else {
                            $filter .= "WHERE ";
                        }
                        $filter .= "Hbreed = \"" . $_GET["sBreed"] . "\"";
                        $numSummary++;
                    }
                    
                    if (isset($_GET["sGender"])) {
                        if ($numSummary > 0) {
                            $filter .= " AND ";
                        } else {
                            $filter .= "WHERE ";
                        }
                        $filter .= " Hgender = \"" . $_GET["sGender"] . "\"";
                        $numSummary++;
                    }

                    if (isset($_GET["sBone"])) {
                        if ($numSummary >0) {
                            $filter .= " AND ";
                        } else {
                            $filter .= "WHERE ";
                        }
                        $filter .= " Bone = \"" . $_GET["sBone"] . "\"";
                        $numSummary++;
                    }

                    $summaryQuery = "SELECT Horse.Hbreed AS Hbreed, Horse.Hgender AS Hgender, A.Limb AS Limb, A.Side AS Side, A.Bone AS Bone, A.PhantomDensityIncluded AS Phantom, A.Pname AS Pathology, COUNT(*) AS Counted FROM ( SELECT Limb, Side, Bone, Cid, Chorse, PhantomDensityIncluded, Pname, Pid FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite NATURAL JOIN Pathology) AS A INNER JOIN Horse ON A.Chorse = Horse.Hid WHERE A.Pid > 2 ". $filter ." GROUP BY Horse.Hbreed, Horse.Hgender, A.Limb, A.Side, A.Bone, A.PhantomDensityIncluded, A.Pname;";
                    $horseTotalQuery = "SELECT COUNT(*) AS HCount FROM Horse INNER JOIN Assessment ON Horse.Hid = Assessment.Chorse NATURAL JOIN CasePathology NATURAL JOIN PathologySite NATURAL JOIN Pathology WHERE Pid > 2" . $filter;
					$summary = $mysqli->query($summaryQuery);
					if ($summary->num_rows >0) {
                        $horseTotal = 1;
                        $TotalResult = $mysqli->query($horseTotalQuery);
                        while ($row = mysqli_fetch_array($TotalResult, MYSQLI_ASSOC)){
                            $horseTotal = $row["HCount"];
                        }
						echo "<table class=\"table table-responsive table-hover\">";
						echo "<thead>";
						echo "<tr><th>Breed</th><th>Gender</th><th>Limb</th><th>Side</th><th>Bone</th><th>Phantom Density</th><th>Irregular Pathology</th><th></th></tr>";
						echo "</thead><tbody>";
						while($row = mysqli_fetch_array($summary, MYSQLI_ASSOC)){
                            $params = "?";
                            $numParams = 0;
                            if ($_GET["sBreed"]){
                                $params .= "sBreed=" . $row["Hbreed"];
                                $numParams++;
                            }
                            if ($_GET["sGender"]){
                                if ($numParams > 0) {
                                    $params .= "&";
                                }
                                $params .= "sGender=" . $row["Hgender"];
                                $numParams++;
                            }
                            if ($_GET["sBone"]) {
                                if ($numParams > 0) {
                                    $params .= "&";
                                }
                                $params .= "sBone=" . $row["Bone"];
                                $numParams++;
                            }
                            if ($numParams > 0) {
                                $params .= "&";
                            }
                            

							echo "<tr>";
							echo "<td><a href=\"irregular_bone_breed.php". $params."sBreed=".$row["Hbreed"] . "\" >" . $row["Hbreed"]."</a></td>";
							echo "<td><a href=\"irregular_bone_breed.php".$params."sGender=".$row["Hgender"] . "\" >".$row["Hgender"]."</a></td>";
							echo "<td>". $row["Limb"] ."</td>";
                            echo "<td>".$row["Side"]."</td>";
							echo "<td><a href=\"irregular_bone_breed.php".$params."sBone=".$row["Bone"] . "\" >".$row["Bone"]."</td>";
                            echo "<td>". ($row["Phantom"]== 0 ? "No" : "Yes")."</td>";
                            echo "<td>". $row["Pathology"] . "</td>";
							echo "<td>". $row["Counted"] . " [" . round(($row["Counted"] / $horseTotal * 100), 2) ."%]</td>";
							echo "</tr>";
						}
						echo "</tbody></table>";
                        if($filter != ""){
                            echo "<a href=\"irregular_bone_breed.php\">Clear Filter...</a>"; 
                        }
					}
					?>
					<div class="btn-group">
						<a href="forelimb_breed.php" class="btn btn-primary mr-2">Forelimb Abnormalities</a>
						<a href="hindlimb_breed.php" class="btn btn-primary mr-2">Hindlimb Abnormalities</a>
						<a href="../../home.php" class="btn btn-secondary">Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script><!-- Plotly.js -->
<script type="text/javascript">

		var pathCountArray = <?php echo json_encode($path_count_array); ?>;

        if (pathCountArray.length > 0) {
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
        var layout = {barmode: 'stack', xaxis:{automargin: true}};
        Plotly.newPlot('Chart', data, layout, {showSendToCloud: true});
    } else {
        document.getElementById('Chart').innerHTML += "<div class='alert alert-info'>No data available for selection</div>";
    }


</script>
<?php
} else {
	echo "Not Logged In";
	require("assets/php/request_helper.php");
	header("Location: http://" . $ip . "/equine/");
}

?>
</body>

