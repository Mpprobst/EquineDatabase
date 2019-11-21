<!doctype html>
<html>

<head>
        <title>Equine Project | Find a User</title>
        <link href="assets/css/style.css" type="text/css" rel="stylesheet" />
        <meta charset="UTF-8" />
</head>

<body>
<?php
if (isset($_COOKIE["equine_database"])) {
?>
<h1>Search for a User</h1>
        <form method="post" action="SearchUser.php">
                <label for="search">Enter a username</label>
                <input name="search" type="text"  />
                <button type="submit">Submit</button>
        </form>
<?php
        if(isset($_POST["search"])) {
//              $cookie_array = explode(",", $_COOKIE["equine_database"]);
                require("assets/php/mysql_connector.php");
                $mysqli = mysqli_connect($host, $ROuserName,$ROPass,$DB);
                $query = "SELECT * FROM User  WHERE User.Name LIKE '". $_POST['search']. "%'";
                $result = $mysqli->query($query);
                if($result->num_rows > 0) {
                        echo "<h2>Search Results:</h2>";
                        echo "<table><thead><tr><th>Username</th><th>Role</th><th>Grant Privileges?</th><th>Revoke Privileges?</th></tr></thead><tbody>";
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<tr><td>".$row['Name']."</td>";
			echo "<td>".$row['Role']."</td>";
			echo "<td><a href='GrantRoles.php?id=".$row["uid"]."'>Grant Write Permissions</a></td>";
			echo "<td><a href='RevokeRoles.php?id=".$row["uid"]."'>Revoke Write Permissions</a></td></tr>";
                }
                        echo "</tbody></table>";
                } else {
                        echo "no results\n";
                }
        }
?>
<a class="button" href="home.php">Back</a>
<?php
} else {
        echo "Not Logged In";
}
?>
</body>

