<html>
<head>
<title>Equine Project - Selection results </title>
</head>
<body>
<?php

//Registration of new user
$horse = $_POST["horse"];
$foreleg = $_POST["Foreleg"];
$hindleg = $_POST["Hindleg"];
$race = $_POST["Race"];


$host = 'localhost';//enter hostname
$SQLuserName = 'root';//enter user name of DB
$Pass = 'Rycbar1234!'; //enter password
$DB = 'equine'; //Enter database name
$mysqli = mysqli_connect($host, $SQLuserName,$Pass,$DB);

// Check for connection error
// // If there is an error we will use $mysqli->connect_error
// // to print the cause of the error
 if (!$mysqli) {
	 echo "Could not connect to database \n";
	 echo "Error: ". $mysqli->connect_error . "\n";
 }
 else{
	if($horse == 1){	
		echo "adding horse";
	}
	else if($horse == 2){
		 echo "editing horse";

	}
	if($foreleg== 1){	
	 	echo "adding foreleg";

	}
	else if($foreleg== 2){
		 echo "edditing foreleg";

	}
	if($hindleg== 1){	
	 	echo "adding hindleg";

	}
	else if($hindleg== 2){
		 echo "edditing hindleg";

	}
	if($race== 1){	
	 	echo "adding race";

	}
	else if($race== 2){
		 echo "edditing race";

	}



}


?>
</body>
</html>
