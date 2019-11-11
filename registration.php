<?php

function check_user($Username, $Password){
	
}/*
function register($newName,$newPass,$mysqli){
	echo "in register function ";
	$existingUser = "select Name, Pass From User WHERE $newName = User.Name AND $newPass = User.Pass";
	$qresult = mysqli_num_rows($mysqli,$existingUser);
	//if user and password already exists
	if($qresult >0){
		echo "ERROR: Username and Password already exists";
	}
	else{
		//inserting user into User table
		$insertQuery = "INSERT INTO User (Name, Pass) VALUES('$newName','$newPassword')";
		if(mysqli_query($mysqli,$insertQuery)){
			echo "User Created";
		}
		else{
			echo "ERROR: ". $insertQuery. "<br>" . mysqli_error($mysqli);
		}
	}
}*/
function login($Username,$Password){
	echo "in login function";
	//$show = "SELECT * FROM User,";
	//$result = mysqli_query($conn, $show);
	/*if (mysqli_num_rows($result) > 0
	{
		while($row = mysqli_fetch_assoc($result)) {
			echo "id: " . $row["uid"]. " - Username: " . $row["Name"]. "Password: " . $row["Pass"]. "<br>";
		}
	}
	else{
		echo "no results found";
	}
}
	 */
//Registration of new user
$newName = $_POST["rusername"];
$newPass = $_POST["rpassword"];
$Username = $_POST["username"];
$Password = $_POST["password"];
//echo $newName;
//echo $newPass;
//echo $Username;
//echo $Password;

$host = 'localhost';//enter hostname
$SQLuserName = 'debian-sys-maint';//enter user name of DB
$Pass = 'ntKxkk9SI6zJjqEF'; //enter password
$DB = 'equine'; //Enter database name
$conn = mysqli_connect($host, $SQLuserName,$Pass,$DB);

// Check for connection error
// // If there is an error we will use $mysqli->connect_error
// // to print the cause of the error
if (!$conn) {
	echo "error";
	 exit;
 }
 else {
	 echo "successful connection";
	 if(($newName!=NULL && $newPass!=NULL)){
		 echo "Thank You for registering";
		 register($newName,$newPass,$mysqli);
		 //call function here
	 }
	 else if(($Username!=NULL && $Password!=NULL)){
		 Echo "in login";
		 login($Username,$Password);
		//call function here
	 }
	 else{
		 echo "Enter both Username and Password";
	 }
 }

?>
