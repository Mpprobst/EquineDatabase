<?php 
//$servername = "localhost";
//$username="root";
//$password="Password1";
//$dbname="equine";
require("./assets/php/mysql_connector.php");
$conn= mysqli_connect($host,$SQLuserName,$Pass,$DB);

//variables and arrays
$side = $_POST["SideAssessed"];
$limbLookUP = array(0 => "Forelimb",1 => "Hindlimb");
$limb = $_POST["LimbType"];
$forelegBoneArray = array($_POST["DistalRadius"],$_POST["Radiocarpal"],$_POST["Metacarpal3"],$_POST["MedialSesamoid"]);
$foreBoneLookUP = array (0=> "DistalRadius",1 => "Radiocarpal",2 => "Metacarpal3",3 =>"MedialSesamoid")
$hindlegBoneArray = array($_POST["DitalTibia"],$_POST["CentralTarsal"],$_POST["Metatarsal3"],$_POST["MedialSesamoid"]);
$lowerlimb;//do array after milestone 4
$DistalR = array($_POST["DistalRadiusDorosomedial"],$_POST["DistalRadiusDorsolateral"],$_POST["DistalRadiusPalmar"]);

$Radio = array($_POST["RadiocarpalBoneProximalMedial"],$_POST["RadiocarpalBoneProximalLateral"],$_POST["RadiocarpalBoneDistalMedial"],$_POST["RadiocarpalBoneDistalLateral"]);

$Metacar = array($_POST["Metacarpal3ProximalDorsal"],$_POST["Metacarpal3ProximalPalmar"],$_POST["Metacarpal3DiaphysisDorsal"],$_POST["Metacarpal3DiaphysisPalmar"],$_POST["Metacarpal3DistalDorsalMedial"], 		     $_POST["Metacarpal3DistalDorsalLateral"],$_POST["Metacarpal3DistalDorsalSagittalRidge"],$_POST["Metacarpal3DistalPalmarMedial"],$_POST["Metacarpal3PalmarLateral"],					 $_POST["Metacarpal3SagittalRidge"]);
$foreMedial = array($_POST["MedialSesmoidApicalArticular"],$_POST["MedialSesmoidApicalNon-Articular"],$_POST["MedialSesmoidMidbodyArticular"],$_POST["MedialSesmoidMidbodyNon-Articular"],         		 		$_POST["MedialSesmoidBaseArticular"],$_POST["MedialSesmoidBaseNon-Articular"],$_POST["MedialSesmoidAxialArticular"],$_POST["MedialSesmoidAxialNon-Articular"]);
$assement = array(1 => "Not Assessed", 2 =>"Within Normal Limits", 3 =>"Lysis", 4 =>"Sclerosis", 5 =>"Fracture", 6 =>"Cyst-Like Lesion");


	
	
if(!$conn){ //checking connection to database
	die("Connection failed: ". mysqli_connect_error());
}



//for loop through each limb to add assement
//$sql = "INSERT INTO Pathology (PName) VALUES($assesment[i])";//query to insert assement into Pathology table
if ($limb = 0){

	//foreach ($ as $LimbLeg){
		for( $i =0; $i<4; $i++){//$foreLegBoneArray as $bone){
			if($foreLegBoneArray[$i]){
				foreach ($DistalR as $d){
					$sql .= "INSERT INTO PathologySite (Limb, Bone, Site) VALUES($limbLookUP[$limb], $foreBoneLookUP[$i], $d)"; //query to insert assesed limb into PathologySite table
				}
			}
			else{
				foreach($DistalR as $d){
				
				}
			}
		}
	
	//$sql .= "INSERT INTO PathologySite (Limb,Bone,Site) VALUES($limbArray[i], $forelegBoneArray[i], $DistalR[i])"; //query to insert assesed limb into PathologySite table
	//$sql .= "INSERT INTO PathologySite (Limb,Bone,Site) VALUES($limb[i], $bone[i], $site[i])";
	}
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
