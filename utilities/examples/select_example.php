<?php
/* Example: Create a list of Selects within a form with dropdowns populated appropriately
*/
?>
<form method="post" action="InsertAssessment.php"> <!-- Note: Sample file name.-->
<!-- Additional Data that needs to be collected for form goes here.  I'll provide one example. -->
    <label for="example">This is just an example</label>
    <input type="text" name="sample" id="example" />
<?php
/*
 * This function contains an initial loop to read in all appropriate PathologySites with another 
 * loop nested inside to populate the Select with appropriate Options.
 */
    require("functions/php/mysql_connector.php");
    $mysqli = mysqli_connect($host, $ROuserName,$ROPass,$DB); // Uses read-only user
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
        echo "<label for='S" . $site["Sid"] . ",>" . $locationName . "</label>"; //Display name in label

        //Build the actual select and then populate with possible options
        echo "<select name='". $site["Sid"]."' id='S" . $site["Sid"] . "'>";
            $pathQuery = "SELECT S.Sid, P.Pname, P.Pid FROM Pathology as P INNER JOIN PathologyAtSite as A ON P.Pid = A.Pid INNER JOIN PathologySite as S ON A.Sid = S.Sid where S.Sid='" . $site["Sid"] . "'";
            $pathologies = $mysqli->query($pathQuery);
            while ($pathology = mysqli_fetch_array($pathologies, MYSQLI_ASSOC)){
                echo "<option value='". $pathology["Pid"]. "'>" . $pathology["Pname"] . "</option>";
            }
        echo "</select>";
    }

    // After building the form, we need to close the mysqli connection (verify syntax)
    $mysqli.mysqli_close();
?>
<!-- Finally, we can make the button to submit the form -->
<button type="submit">Submit</button>
</form>
