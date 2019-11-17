<?php 
$servername = "localhost";
$username="root";
$password="Password1";
$dbname="equine";
$conn= mysqli_connect($servername,$username,$password,$dbname);

//variables and arrays
$side = $_POST["SideAssessed"]
$limbArray = array($_POST["Forelimb"],$_POST["Hindlimb"]);
$forelegBoneArray = array($_POST["DistalRadius"],$_POST["Radiocarpal"],$_POST["Metacarpal3"],$_POST["MedialSesamoid"]);
$hindlegBoneArray = array($_POST["DitalTibia"],$_POST["CentralTarsal"],$_POST["Metatarsal3"],$_POST["MedialSesamoid"]);
$lowerlimb=;//do array after milestone 4
$DistalR = array($_POST["DistalRadiusDrosomedial"],$_POST["DistalRadiusDorsolateral"],$_POST["DistalRadiusPalmar"]);
$Radio = array($_POST["RadiocarpalBoneProximalMedial"],$_POST["RadiocarpalBoneProximalLateral"],$_POST["RadiocarpalBoneDistalMedial"],$_POST["RadiocarpalBoneDistalLateral"]);
$Metacar = array($_POST["Metacarpal3ProximalDorsal"],$_POST["Metacarpal3ProximalPalmar"],$_POST["Metacarpal3DiaphysisDorsal"],$_POST["Metacarpal3DiaphysisPalmar"],$_POST["Metacarpal3DistalDorsalMedial"], 		     $_POST["Metacarpal3DistalDorsalLateral"],$_POST["Metacarpal3DistalDorsalSagittalRidge"],$_POST["Metacarpal3DistalPalmarMedial"],$_POST["Metacarpal3PalmarLateral"],					 $_POST["Metacarpal3SagittalRidge"]);
$foreMedial = array($_POST["MedialSesmoidApicalArticular"],$_POST["MedialSesmoidApicalNon-Articular"],$_POST["MedialSesmoidMidbodyArticular"],$_POST["MedialSesmoidMidbodyNon-Articular"],         		 		$_POST["MedialSesmoidBaseArticular"],$_POST["MedialSesmoidBaseNon-Articular"],$_POST["MedialSesmoidAxialArticular"],$_POST["MedialSesmoidAxialNon-Articular"]);
$assement = array($_POST["1"],$_POST["2"],$_POST["3"],$_POST["4"],$_POST["5"],$_POST["6"]);
	
	
if(!$conn){ //checking connection to database
	die("Connection failed: ". mysqli_connect_error());
}
//for loop to find correct limb
//for loop to find correct bone
//for loop to find correct site
$sql = "INSERT INTO Pathology (PName) VALUES($assesment[i])";//query to insert assement into Pathology table
for (i= 0; i < 1; i++){
	for( j=0; j<10; j++){
		for(k=0; k<10 k++){
		}
	}
	
	$sql .= "INSERT INTO PathologySite (Limb,Bone,Site) VALUES($limbArray[i], $forelegBoneArray[i], $DistalR[i])"; //query to insert assesed limb into PathologySite table
	//$sql .= "INSERT INTO PathologySite (Limb,Bone,Site) VALUES($limb[i], $bone[i], $site[i])";
}

//entering queries into database
if(mysqli_multi_query($conn,$sql){
	echo"Pathology Assesment created successfully";
}
else{
	echo"Error: ".$sql."<br>". mysqli_error($conn);
}


mysqli_close($conn);
?>


/* Tables related to Pathology to be inserted into
+---+--------+-------------+-----------+ +---+------------------+  +---+---+---------+
|SID|Limb    |Bone         |Site       | |PID|PName	        |  |PID|SID|Available|
+---+--------+-------------+-----------+ +---+------------------+  +---+---+---------+
| # |Forelimb|Distal Radius|Dorsomedial| | # |"Cyst-Like_Lesion"|  | # | # |  True   |
+---+--------+-------------+-----------+ +---+------------------+  +---+---+---------+
*/
