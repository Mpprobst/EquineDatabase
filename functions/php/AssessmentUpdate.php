<?php 
$servername = "localhost";
$username="debian-sys-maint";
$password="ntKxkk9SI6zJjqEF";
$dbname="equine";
$conn= mysqli_connect($servername,$username,$password,$dbname);

//variables and arrays

// Case Vars
$horseName = $_POST["horseName"];
$RREH_CID = $_POST["RREH_CID"];
$phantomDensityState = $_POST["Phantom"];
$isPhantomDensity = false;
if ($phantomDensityState) { $isPhantomDensity = true; }
$isEuthanized = $_POST["Euthanized?"];
$dateEuthanized = $_POST["euthanasiaDate"];
$UK_CID = $_POST["UK_CID"];

// Foreleg Vars
$side = $_POST["SideAssessed"];

$limbLookUP = array(0 => "Forelimb",1 => "Hindlimb");
$limb = $_POST["LimbType"];

$forelegBoneArray = array($_POST["DistalRadius"],$_POST["Radiocarpal"],$_POST["Metacarpal3"],$_POST["MedialSesamoid"]);
$foreBoneLookUP = array (0=> "DistalRadius", 1 => "Radiocarpal", 2 => "Metacarpal3", 3 =>"MedialSesamoid");

$hindlegBoneArray = array($_POST["DitalTibia"],$_POST["CentralTarsal"],$_POST["Metatarsal3"],$_POST["MedialSesamoid"]);
$hindBoneLookUP = array(0 =>"DitalTibia", 1 => "CentralTarsal", 2 => "Metatarsal3", 3 => "MedialSesamoid");

$lowerlimb;//do array after milestone 4

$DistalR = array($_POST["DistalRadiusDorosomedial"],$_POST["DistalRadiusDorsolateral"],$_POST["DistalRadiusPalmar"]);
$DistalRLookUP = array(0 => "DistalRadiusDorosomedial", 1 => "DistalRadiusDorsolateral", 2 => "DistalRadiusPalmar");

$Radio = array($_POST["RadiocarpalBoneProximalMedial"],$_POST["RadiocarpalBoneProximalLateral"],$_POST["RadiocarpalBoneDistalMedial"],$_POST["RadiocarpalBoneDistalLateral"]);
$RadioLookUP = array (0 => "RadiocarpalBoneProximalMedial", 1 => "RadiocarpalBoneProximalLateral", 2 => "RadiocarpalBoneDistalMedial", 3 =>"RadiocarpalBoneDistalLateral");

$Metacar = array($_POST["Metacarpal3ProximalDorsal"],$_POST["Metacarpal3ProximalPalmar"],$_POST["Metacarpal3DiaphysisDorsal"],$_POST["Metacarpal3DiaphysisPalmar"],$_POST["Metacarpal3DistalDorsalMedial"],$_POST["Metacarpal3DistalDorsalLateral"],$_POST["Metacarpal3DistalDorsalSagittalRidge"],$_POST["Metacarpal3DistalPalmarMedial"],$_POST["Metacarpal3PalmarLateral"],$_POST["Metacarpal3SagittalRidge"]);
$MetacarLookUP = array(0 => "Metacarpal3ProximalDorsal", 1 => "Metacarpal3ProximalPalmar", 2 => "Metacarpal3DiaphysisDorsal", 3 => "Metacarpal3DiaphysisPalmar", 4 => "Metacarpal3DistalDorsalMedial", 5 => "Metacarpal3DistalDorsalLateral", 6 => "Metacarpal3DistalDorsalSagittalRidge", 7 => "Metacarpal3DistalPalmarMedial", 8 => "Metacarpal3PalmarLateral", 9 => "Metacarpal3SagittalRidge");

$foreMedial = array($_POST["MedialSesmoidApicalArticular"],$_POST["MedialSesmoidApicalNon-Articular"],$_POST["MedialSesmoidMidbodyArticular"],$_POST["MedialSesmoidMidbodyNon-Articular"], $_POST["MedialSesmoidBaseArticular"],$_POST["MedialSesmoidBaseNon-Articular"],$_POST["MedialSesmoidAxialArticular"],$_POST["MedialSesmoidAxialNon-Articular"]);
$foreMedialLookUP = array(0 => "MedialSesmoidApicalArticular", 1 => "MedialSesmoidApicalNon-Articular", 2 => "MedialSesmoidMidbodyArticular", 3 => "MedialSesmoidMidbodyNon-Articular", 4 => "MedialSesmoidBaseArticular", 5 => "MedialSesmoidBaseNon-Articular", 6 =>"MedialSesmoidAxialArticular", 7 =>"MedialSesmoidAxialNon-Articular");

$assement = array(1 => "Not Assessed", 2 =>"Within Normal Limits", 3 =>"Lysis", 4 =>"Sclerosis", 5 =>"Fracture", 6 =>"Cyst-Like Lesion");
	
if(!$conn){ //checking connection to database
	die("Connection failed: ". mysqli_connect_error());
}
if ($isEuthanized) {
	$sql .= "INSERT INTO PathologyCase (Chorse, Cuser, Cdate, UK_Cid, RREH_Cid, Limb, PhantomDensityIncluded) VALUES ((SELECT Hid FROM Horse WHERE Horse.Hname = '$horseName'), 1, '2019-11-18', $UK_CID, $RREH_CID, $limb, $isPhantomDensity)";
}
else {
	$sql .= "INSERT INTO PathologyCase (Chorse, Cuser, Cdate, RREH_Cid, Limb, PhantomDensityIncluded) VALUES ((SELECT Hid FROM Horse WHERE Horse.Hname = '$horseName'), 1, '2019-11-18', $RREH_CID, $limb, $isPhantomDensity)";
}
/*
//for loop through each limb to add assement
//$sql = "INSERT INTO Pathology (PName) VALUES($assesment[i])";//query to insert assement into Pathology table
if ($limb = 0){

	//foreach ($ as $LimbLeg){
		for( $i =0; $i<4; $i++){//$foreLegBoneArray as $bone){
			foreach ($DistalR as $d){
				$j = 0;
				//query to insert assesed limb into PathologySite table
				$sql .= "INSERT INTO PathologySite (Limb, Bone, Site) VALUES($limbLookUP[$limb], $foreBoneLookUP[$i], $DistalRLookUP[$j])";
					$j++;

				if ($forelegBoneArray[$i]){
					$sql .= "INSERT INTO Pathology (Pname) VALUES ($assessment[$d])";
				}
				else {
					$sql .= "INSERT INTO Pathology (PName) VALUES ($assessment[0])";
				}
				//$sql .= "INSERT INTO CasePathology (Cid, Sid, Pid) VALUES ( (SELECT c.Cid FROM PathologyCase c, WHERE c.Chorse = (SELECT Hid FROM Horse WHERE Horse.Hname = $horseName), (SELECT s.Sid FROM PathologySite s, WHERE s. = (SELECT Hid FROM Horse WHERE Horse.Hname = $horseName) ";
			}
		}	
}
 */


//entering queries into database
if(mysqli_multi_query($conn,$sql)){
	echo"Pathology Assesment created successfully";
}
else{
	echo"Error: ".$sql."<br>". mysqli_error($conn);
}


mysqli_close($conn);



/* Tables related to Pathology to be inserted into
+---+--------+-------------+-----------+ +---+------------------+  +---+---+---------+
|SID|Limb    |Bone         |Site       | |PID|PName	        |  |PID|SID|Available|
+---+--------+-------------+-----------+ +---+------------------+  +---+---+---------+
| # |Forelimb|Distal Radius|Dorsomedial| | # |"Cyst-Like_Lesion"|  | # | # |  True   |
+---+--------+-------------+-----------+ +---+------------------+  +---+---+---------+
 */
?>