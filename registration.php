<html>
<head>
<title>Equine Project - Login Results</title>
</head>
<body>
<?php

function register($newName,$newPass,$mysqli){
	$existingUser = "SELECT Name from User where (User.Name = '$newName')"; 
	$res = $mysqli->query($existingUser);
	//if user already exists
	if($res->num_rows >0){
		echo "ERROR: User already exists";
	}
	else{
		//inserting user into User table
		$insertQuery = "INSERT INTO User (Name, Pass) VALUES('$newName','$newPass')";
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
	$existingUser = "SELECT Name, Pass from User where (User.Name = '$Username') and (User.Pass ='$Password')";
	$res = $mysqli->query($existingUser);
	// if the user exists print out his information to show that it is actually in the table
	if($res->num_rows >0){
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
//echo $newPass;
//echo $Username;
//echo $Password;

$host = 'localhost';//enter hostname
$SQLuserName = 'horsie';//enter user name of DB
$Pass = 'horses123!'; //enter password
$DB = 'equine'; //Enter database name
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
		 register($newName,$newPass,$mysqli);
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
</body>
</html>
