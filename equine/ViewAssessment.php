<!doctype html>
<html>

<head>
    <title>Equine Project | View an Assessment </title>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
<?php
if (isset($_COOKIE["equine_database"])) {
?>
<?php
    $Cid = $_GET["id"];
    $hid;

	require("assets/php/mysql_connector.php");
	$conn= mysqli_connect($host,$ROuserName, $ROPass, $DB);

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
    
	$assessQuery = "SELECT Assessment.PhantomDensityIncluded AS Phantom, Assessment.Cid AS Cid, Assessment.RREH_Cid AS RREH_Cid, Assessment.UK_Cid AS UK_Cid, Clinic.Name AS Clinic, User.Name AS Name, Assessment.Limb AS Limb, Assessment.Side AS Side, Assessment.Cdate AS Cdate, Assessment.Chorse AS Hid, Horse.Hname AS Hname FROM Assessment INNER JOIN User ON Assessment.Cuser = User.uid INNER JOIN Clinic ON User.Clinic = Clinic.Lid INNER JOIN Horse ON Horse.Hid = Assessment.Chorse WHERE Assessment.Cid='$Cid'";
	$assessments = $conn->query($assessQuery);
	if ($assessments->num_rows > 0){
		while ($row = mysqli_fetch_array($assessments, MYSQLI_ASSOC)) {
            echo "<h3>" . $row["Side"] . " " . $row["Limb"] . " Assessment for " . $row["Hname"] . "</h3>";
            $hid = $row["Hid"];
			echo "<ul class=\"list-group\">";
            echo "<li class=\"list-group-item\">Rood &amp; Riddle Case Number: <strong>" . $row["RREH_Cid"] . "</strong></li>";
            echo "<li class=\"list-group-item\">UK Veterinary Diagnostic Case Number: <strong>" . $row["UK_Cid"] . "</strong></li>";
			echo "<li class=\"list-group-item\">Original Assessing Clinic: <strong>" . $row["Clinic"] . "</strong></li>";
			echo "<li class=\"list-group-item\">Original Assessor: <strong>" . $row["Name"] . "</strong></li>";
			echo "<li class=\"list-group-item\">Limb Assessed: <strong>" . $row["Limb"] . "</strong></li>";
			echo "<li class=\"list-group-item\">Side Assessed: <strong>" . $row["Side"] . "</strong></li>";
            echo "<li class=\"list-group-item\">Date Assessment Entered: <strong>" . $row["Cdate"] . "</strong></li>";
            $phantom = ($row["Phantom"] == TRUE) ? "Yes" : "No";
            echo "<li class=\"list-group-item\">Phantom Density Normalization Included?: <strong>" . $phantom . "</strong></li>";
			echo "</ul>";
		}
        
        $pathologiesQuery = "SELECT S.Limb, S.Bone AS Bone, S.Site AS Site, S.SiteB AS SiteB, P.Pname AS Name FROM CasePathology AS C INNER JOIN PathologySite AS S ON S.Sid = C.Sid INNER JOIN Pathology AS P ON P.Pid = C.Pid WHERE CID=" . $Cid;
        $pathologies = $conn->query($pathologiesQuery);

        if ($pathologies->num_rows > 0) {
            echo "<ol>"; //Ordered List
            // Set up flags for list processing
            $boneOpen = false;
            $siteOpen = false;
            while ($site = mysqli_fetch_array($pathologies, MYSQLI_ASSOC)) { //$site is an individual associative array (row) from the query results
                $bone = $site["Bone"];
                $loc = $site["Site"];
                $locb = $site["SiteB"];
                $name = $site["Name"];
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
                        echo  $locationName . ": ";
                        echo "<strong>" . $name . "</strong>";
                        $boneOpen = true;
                        echo "<ol type=\"a\">";
                    } else {  
                        // if it is a site
                        $locationName = $bone . " " . $loc;
                        // Open a new Site
                        echo "<li>";
                        echo  $locationName . ": ";
                        echo "<strong>" . $name . "</strong>";
                        $siteOpen = true;
                        echo "<ol type=\"i\">";
                    }
                } else {
                    $locationName = $bone . " " .$loc. " " . $locb;
                    // Open and close a new siteb
                    echo "<li>";
                    echo  $locationName . ": ";
                    echo "<strong>" . $name . "</strong>";
                    echo "</li>";
                }
            }
            echo "</ol>";
        } else {
            echo "<p><strong>No Pathologies found for this Assessment</strong></p>";
        }
        

	} else {
		echo "<p><strong>No assessments found for this horse.</strong></p>";
	}
?>
        <div class="btn-group" role="group">
            <a class="btn btn-success mr-2" href="EditAssessment.php?id=<?php echo $Cid; ?>">Edit</a>
            <a class="btn btn-secondary mr-2" href="ViewHorse.php?id=<?php echo $hid; ?>">Back</a>
            <a class="btn btn-secondary" href="home.php">Home</a>
        </div>          
<?php
} else {
		echo "Not Logged In";
		require("assets/php/redirect_helper.php");
		header("Location: http://".$ip."/equine/");
}
?>
            </div>
        </div>
    </div>
</body>
