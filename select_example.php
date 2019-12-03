<?php
/* Example: Create a list of Selects within a form with dropdowns populated appropriately
*/
?>
<style>
.fixedContainer {
	position: relative;
	left: 5px;
 }
.other{
	position: relative;
        left: 20px;
}
.phantom{
	position: relative;
	left: 30px;
}
.EuthTrue{
	display:none;
	position: relative;
	left:30px;
}

</style>
<body>
<form method="post" action="InsertAssessment.php"> <!-- Note: Sample file name.-->
<!-- Additional Data that needs to be collected for form goes here.  I'll provide one example. -->

	<label for="roodriddle">Rood and Riddle Case Number:</label>
	<input type="text" name="RREH_CID" id="RoodRiddle" />
	<label class = "other" for="leg">Side Assessed</label>
	<select class = "other" name="SideAssessed">
		<option value="1">Left</option>
		<option value="2">Right</option>
	</select>

	<label class = "phantom" for="Phantom">Phantom Density Normalization Included?</label>
	<input class = "phantom" type ="checkbox" name = "Phantom"/><br></br>

	<label>Euthanized?</label>
	<input type="checkbox" onclick="openEuthanasiaDate(this.checked)" name="Euthanized?"/>
	<div class = "EuthTrue" id = "EuthanasiaTrue">
		<label> Date of Euthanasia:</label>
		<input type="date" name="euthanasiaDate"/>
		<label> UK Veterinary Diagnostic Case Number:</label>
		<input type="text" name="UK_CID"/>
	</div>
	<h1>Bone Assessement</h1>
<?php
/*
 * This function contains an initial loop to read in all appropriate PathologySites with another 
 * loop nested inside to populate the Select with appropriate Options.
 */
$host = 'localhost';//enter hostname
$SQLuserName = 'root';//enter user name of DB 
$Pass = 'Rycbar1234!'; //enter password 
$DB = 'equine'; //Enter database name
$mysqli = mysqli_connect($host, $SQLuserName,$Pass,$DB); // Uses read-only user
	if (!$mysqli) {
			 echo "Could not connect to database \n";
			 	 echo "Error: ". $mysqli->connect_error . "\n";
	}
$limb = forelimb;
    // ASSUME: $limb has already been provided, probably by the POST request submitting horse information to this page.
    $siteQuery = "SELECT * FROM PathologySite WHERE Limb ='" . $limb . "'"; //Creates Select Query
    $sites = $mysqli->query($siteQuery); // ($sites is a "MySQLi Result")
    while ($site = mysqli_fetch_array($sites, MYSQLI_ASSOC)) { //$site is an individual associative array (row) from the query results
        $locationName = $site["Bone"]; // Adds the Bone to the Location Name string
        if ($site["Site"] != null) {
            $locationName .= " " . $site["Site"]; // If there is a "site" add it to the name
        }
        if ($site["SiteB"] != null) {
            $locationName .= " " . $site["SiteB"]; // If there is a "siteb" add it to the name
        }
        echo "<label for= S" . $site["Sid"] . ",>" . $locationName . "</label>"; //Display name in label
	//echo "<br></br>";
	//Build the actual select and then populate with possible options
        echo "<select class = fixedcontainer style = 'width:15%; margin-bottom:20px; 'name='". $site["Sid"]."' id='S" . $site["Sid"] . "'>";
            $pathQuery = "SELECT S.Sid, P.Pname, P.Pid FROM Pathology as P INNER JOIN PathologyAtSite as A ON P.Pid = A.Pid INNER JOIN PathologySite as S ON A.Sid = S.Sid where S.Sid='" . $site["Sid"] . "'";
            $pathologies = $mysqli->query($pathQuery);
            while ($pathology = mysqli_fetch_array($pathologies, MYSQLI_ASSOC)){
                echo "<option value='". $pathology["Pid"]. "'>" . $pathology["Pname"] . "</option>";
            }
	    echo "</select><br></br>";
    }

    // After building the form, we need to close the mysqli connection (verify syntax)
   // $mysqli.mysqli_close();
?>
<!-- Finally, we can make the button to submit the form -->
<button type="submit">Submit</button>
</form>

 <script>
 	function openEuthanasiaDate(isChecked){
		if (isChecked)
		{
			document.getElementById("EuthanasiaTrue").style.display="block";
		}
		else
		{	
			document.getElementById("EuthanasiaTrue").style.display="none";
		}
	}
    </script>

</body>


