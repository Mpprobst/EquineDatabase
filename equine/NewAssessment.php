<!doctype html>
<html lang="en">

<head>
	<title>Equine Project | Create New Assessment</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if(isset($_COOKIE["equine_database"])) {
	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<form method="post" action="./functions/php/InsertAssessment.php">

					<input type="hidden" name="HorseID" value="<?php echo $_POST["Hid"]; ?>" />
					<input type="hidden" name="Date" value="<?php echo date('Y-m-d'); ?>" />
					<input type="hidden" name="Limb" value="<?php echo $_POST["Limb"]; ?>" />
					<input type="hidden" name="RREH_Default" value="<?php echo $_POST["RREH_Cid"]; ?>" />
					

					<div class="form-group">
						<label for="RoodRiddle">Rood and Riddle Case Number:</label>
						<input type="text" class="form-control" name="RREH_CID" id="RoodRiddle" value="<?php echo $_POST["RREH_Cid"]; ?>"/>
					</div>
					<div class="form-group">
						<label for="leg">Side Assessed</label>
						<select class="form-control" id="leg" name="SideAssessed">
							<option value="Left">Left</option>
							<option value="Right">Right</option>
						</select>

						<label for="Phantom">Phantom Density Normalization Included?</label>
						<input class="input-control" type="checkbox" name="Phantom" id="Phantom" />
					</div>

					<div class="form-group">
						<label for="dod"> Date of Euthanasia:</label>
						<input class="form-control" type="date" id="dod" name="Hdod" />
						<small class="form-text text-muted">If horse not euthanized, please leave blank</small>

						<label for="ukcid">UK Veterinary Diagnostic Case Number:</label>
						<input class="form-control" type="text" id="ukcid" name="UK_CID"/>
						
					</div>
					<h1><?php echo $_POST["Limb"]; ?> Assessement</h1>
					<div class="form-group">
				<?php

				function getOptions($sid, $mysqli) {
					echo "<select class=\"form-control\" name=\"". $sid . "\" id=\"S" . $sid . "\">";
					$pathQuery = "SELECT S.Sid, P.Pname, P.Pid FROM Pathology as P INNER JOIN PathologyAtSite as A ON P.Pid = A.Pid INNER JOIN PathologySite as S ON A.Sid = S.Sid where S.Sid=\"" . $sid . "\"";
					$pathologies = $mysqli->query($pathQuery);
					while ($pathology = mysqli_fetch_array($pathologies, MYSQLI_ASSOC)){
						echo "<option value=\"". $pathology["Pid"]. "\">" . $pathology["Pname"] . "</option>";
					}
					echo "</select>";
				}

				require("assets/php/mysql_connector.php");
				$mysqli = mysqli_connect($host, $SQLuserName,$Pass,$DB);
				if (!$mysqli) {
						echo "Error: ". $mysqli->connect_error . "\n";
				}
					
				$siteQuery = "SELECT * FROM PathologySite WHERE Limb=\"" . $_POST["Limb"] . "\";"; //Creates Select Query
				$sites = $mysqli->query($siteQuery); // ($sites is a "MySQLi Result")
				echo "<ol>"; //Ordered List
				// Set up flags for list processing
				$boneOpen = false;
				$siteOpen = false;
				while ($site = mysqli_fetch_array($sites, MYSQLI_ASSOC)) { //$site is an individual associative array (row) from the query results
					$bone = $site["Bone"];
					$loc = $site["Site"];
					$locb = $site["SiteB"];
					$locationName = "";

					if ($locb == "") { 
						// if a site is open, close it
						if($siteOpen){
							echo "</ol></li>";
							$siteOpen = false;
						}
						// if it is not a siteb or a site, it must be a bone
						if ($loc == "") { 
							$locationName = $bone;
							//if a bone is open, close it
							if ($boneOpen){
								echo "</ol></li>";
								$boneOpen = false;
							} 
							// Open a new bone
							echo "<li>";
							echo "<label for=\"S" . $site["Sid"] . "\">" . $locationName . "</label>";
							getOptions($site["Sid"], $mysqli);
							$boneOpen = true;
							echo "<ol type=\"a\">";
						} else {  
							// if it is a site
							$locationName = $bone . " " . $loc;
							// Open a new Site
							echo "<li>";
							echo "<label for=\"S" . $site["Sid"] . "\">" . $locationName . "</label>";
							getOptions($site["Sid"], $mysqli);
							$siteOpen = true;
							echo "<ol type=\"i\">";
						}
					} else {
						$locationName = $bone . " " .$loc. " " . $locb;
						// Open and close a new siteb
						echo "<li>";
						echo "<label for=\"S" . $site["Sid"] . "\">" . $locationName . "</label>";
						getOptions($site["Sid"], $mysqli);
						echo "</li>";
					}
				}
				echo "</ol>";

				
				// // $mysqli.mysqli_close();
				?>
				</div>
				<!-- Finally, we can make the button to submit the form -->
				<button type="submit" class="btn btn-primary" >Submit</button>
				</form>
			</div>
		</div>
	</div>
	<?php
} else {
	echo "not logged in";
	header("Location: http://" . $ip . "/equine/");
}
?>
</body>
</html>