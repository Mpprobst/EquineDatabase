<!doctype html>
<html>

<head>
        <title>Equine Project | Find a User</title>
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
				<h1>Search for a User</h1>
				<form method="post" action="SearchUser.php">
					<div class="form-group">
						<label for="search">Enter a username</label>
						<input id="search" name="search" class="form-control" type="text"  />
						<small class="form-text text-muted">Please note: You will only be able to see users who are in the same clinic as you.</small>
					</div>
					<div class="btn-group" role="group">
						<button class="btn btn-primary mr-2" type="submit">Submit</button>
						<a class="btn btn-secondary" href="home.php">Back</a>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
<?php
        if(isset($_POST["search"])) {
	            $cookie_array = explode(",", $_COOKIE["equine_database"]);
                require("assets/php/mysql_connector.php");
                $mysqli = mysqli_connect($host, $ROuserName,$ROPass,$DB);
                $query = "SELECT * FROM User  WHERE User.Name LIKE '". $_POST['search']. "%' AND User.Clinic = \"". $cookie_array[2] . "\";";
                $result = $mysqli->query($query);
                if($result->num_rows > 0) {
                        echo "<h2>Users matching your search in \"".$cookie_array[2]."\":</h2>";
						echo "<table class=\"table table-responsive table-hover\">";
						echo "<thead><tr><th>Username</th><th>Role</th><th>Grant Privileges?</th><th>Revoke Privileges?</th></tr></thead><tbody>";
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						echo "<tr><td>".$row['Name']."</td>";
						echo "<td>".$row['Role']."</td>";
						echo "<td><a href='admin/php/GrantRoles.php?id=".$row["uid"]."'>Grant Write Permissions</a></td>";
						echo "<td><a href='admin/php/RevokeRoles.php?id=".$row["uid"]."'>Revoke Write Permissions</a></td></tr>";
                }
                        echo "</tbody></table>";
                } else {
                        echo "<p>No Users match your search term within your clinic</p>";
                }
        }
?>
				
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