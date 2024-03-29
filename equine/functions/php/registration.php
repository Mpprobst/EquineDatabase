<?php

function register($newName,$newPass,$mysqli, $clinic){
	$existingUser = "SELECT Name from User where (User.Name = '$newName')"; 
	$res = $mysqli->query($existingUser);
	//if user already exists
	if($res->num_rows >0){
		echo "ERROR: User already exists";
	}
	else{
		//inserting user into User table
		$insertQuery = "INSERT INTO User (Name, Pass, Clinic, Role) VALUES('$newName','$newPass', '$clinic', 'read-only')";
		$res = $mysqli->query($insertQuery);
		if($res){
			echo "<h2>".$newName.": Created succesfully</h2>";
			login($newName, $newPass, $mysqli);
		}
		else{
			echo "ERROR: ". $existingUser. "<br>" . mysqli_error($mysqli);
		}
	}
}
function login($Username,$Password,$mysqli){
	$existingUser = "SELECT User.uid AS uid, User.Name As Name, User.Role As Role, Clinic.Lid As Clinic FROM User INNER JOIN Clinic ON User.Clinic = Clinic.Lid WHERE (User.Name = '$Username') and (User.Pass ='$Password')";
	$res = $mysqli->query($existingUser);
	// if the user exists print out his information to show that it is actually in the table
	if($res->num_rows >0){
		$row= mysqli_fetch_array($res, MYSQLI_ASSOC);
		$value= $row["Name"].",".$row["Role"].",".$row["Clinic"].",".$row["uid"];
		setcookie("equine_database", $value, time()+24*60*60, '/');
		echo "<h3>".$Username.", You are now logged in</h3>";
		echo "<table border='1'>";
		while($row = $res->fetch_assoc())
		{
			echo "<tr>";
			foreach ($row as $field => $value)
		       	{
			  echo "<td>" . $value . "</td>"; 
			}
			echo "</tr>";
		}
		echo "</table>";
		require("../../assets/php/redirect_helper.php");
		header( "Location: http://". $ip . "/equine/home.php" );
		exit ;
	}
	else
	{
		echo "<h3>User does not exist</h3>";
	}
}
//Registration of new user
$newName = $_POST["rusername"];
$newPass = $_POST["rpassword"];
$Username = $_POST["username"];
$Password = $_POST["password"];
$Clinic = $_POST["rclinic"];

require("../../assets/php/mysql_connector.php");
$mysqli = mysqli_connect($host, $SQLuserName,$Pass,$DB);

// Check for connection error
// // If there is an error we will use $mysqli->connect_error
// // to print the cause of the error
 if (!$mysqli) {
	 echo "Could not connect to database \n";
	 echo "Error: ". $mysqli->connect_error . "\n";
 }
 else {
	 if(($newName!=NULL && $newPass!=NULL)){		 
		 register($newName,$newPass,$mysqli, $Clinic);
		 //call function here
	 }
	 else if(($Username!=NULL && $Password!=NULL)){
		 login($Username,$Password,$mysqli);
		//call function here
	 }
	 else{
		 echo "Please enter both Username and Password";
	 }
 }

?>