<!DOCTYPEHTML>
<html lang="en">
	<head>
		<title>formDemo.html</title>
		<style>
			.alighn{
				position:relative;
				left:4px;
				}
			.show{
				display:none;
				position:relative;
				top:-30px;
				}
			.distalradiuscheckbox{
					position:relative;
					left:100px;
					top:-25px;
				}
			.radiocarpalbonecheckbox{
					position:relative;
					left:215px;
					top:-45px;
					}
			.metacarpal3checkbox{
					position:relative;
					left:360px;
					top:-65px;
					}
			.medialseasamoidcheckbox{
					position:relative;
					left:475px;
					top:-85px;
					}

			.typeofleg{
					position:absolute;
					top:370px;
					left:28px;

				}
			.show1{
				display:none;
				position:absolute;
				//top:10px;
				left:100px;
				}
			.show2{
				display:none;
				position:absolute;
				//top:-250px;
				left:500px;
				}
			.Metacarpal3{
					display:none;
					position:absolute;
					top:230px;
					left:-160px;
					}
			.Metacarpal3selections{
						position:relative;
						left:15px;
						}
			.MedialSesamoid{
					display:none;
					position:absolute;
					top:230px;
					left:200px;
					}

			.EuthBox{
				position:relative;
				top:-94px;
				left:4px;
				}
			.EuthTrue{
				display:none;
				position:relative;
				top:-100px;
				left:100px;
				}

			.RoodRiddle{
				position:relative;
				top:-42px;
				left:250px;
				}
			.Leg{
				position:relative;
				top:-64px;
				left:625px;
				}
			.phantom{
				position:relative;
				top:-84px;
				left:800px;
				}
			.assesmet{
					height: 1040px;
				}
			.submit{
					position: absolute;
					top:1220px;

				}

		</style>
			<meta charset="UTF-8"/>
	</head>
	<body>
<?php

if(isset($_COOKIE["equine_database"])){

?>

		<h1>Welcome To the Home Page</h1>
		<form action="AssessmentUpdate.php"method="post">
			<fieldset>
				<legend>horse</legend>
				<p>
					<label>Horse</label>
				<select name="horse">
					<option value="1">Add</option>
					<option value="2">Edit/View</option>
				</select>
			</p>
			<button type="submit">Submit</button>
			</fieldset>
		</form>
		<form action="AssessmentUpdate.php" method="post">
			<fieldset class = "assesmet">
				<legend>Assessment</legend>
				<p>

					<label>Action</label>	
					<select name="Action">
						<option value="1">Add New</option>
						<option value="2">Edit Existing</option>
					</select>
					

					<div class="alighn" id="HorseName">
					HorseName: <input type="text" name="horseName"><br><br>	
					</div>
											
					<div class="RoodRiddle" id=RoodRiddle">
					Rood and Riddle Case Number: <input type="text" name="RREH_CID">
					</div>
					
					<div class="Leg" id="Leg">
					<label>Side Assessed</label>
					<select name="SideAssessed">
						<option value="1">Left</option>					
						<option value="1">Right</option>					
					</select>
					</div>

					<div class="phantom" id="Phantom">
					Phantom Density Normalization Included? <input type="checkbox" name="Phantom"><br><br>
					</div>

					<div class="EuthBox" id="isEuthanized">
					Euthanized?: <input type="checkbox" onclick="openEuthanasiaDate(this.checked)" name="Euthanized?"><br><br>
					</div>
					
					<div class="EuthTrue" id="EuthanasiaTrue">
					Date of Euthanasia: <input type="date" name="euthanasiaDate">
					UK Veterinary Diagnostic Case Number: <input type="text" name="UK_CID">
					</div>

					<div class = "typeofleg">
						<label>Leg</label>
						<select id = "typeofleg" name="LimbType">
							<option value="1">Foreleg</option>
							<option value="2">Hindleg</option>
						</select>
						<button type="button" onclick="getOption()">Type of leg</button>
						<button type="button" onclick="closeForelimbForm()">Close</button>

					</div>




					<div class="show" id="ForelimbForm">
						<h2 class="alighn">Foreleg</h2>
						<div class = "distalradiuscheckbox">
							Distal Radius: <input type="checkbox" onclick="checkDistalRadius(this.checked)" name = "DistalRadius">
							<div class="show1"id="Distal Radius">
								<h3 class="alighn">Distal Radius</h3>
								<p>
									<label>Distal Radius Dorsomedial</label>
									<select name="DistalRadiusDorsomedial">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Distal Radius Dorsolateral</label>
									<select name="DistalRadiusDorsolateral">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Distal Radius Palmar</label>
									<select name="DistalRadiusPalmar">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
							</div>
						</div>
						<div class = "radiocarpalbonecheckbox">
							Radiocarpal Bone: <input type="checkbox" onclick="checkRadiocarpalBone(this.checked)" name = "RadiocarpalBone">
							<div class="show2"id="Radiocarpal Bone">
								<h3 class="alighn">Radiocarpal Bone</h3>
								<p>
									<label>Radiocarpal Bone Proximal Medial</label>
									<select name="RadiocarpalBoneProximalMedial">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Radiocarpal Bone Proximal Lateral</label>
									<select name="RadiocarpalBoneProximalLateral">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Radiocarpal Bone Distal Medial</label>
									<select name="RadiocarpalBoneDistalMedial">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Radiocarpal Bone Distal Lateral</label>
									<select name="RadiocarpalBoneDistalLateral">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>

							</div>
						</div>
						<div class = "metacarpal3checkbox">
							Metacarpal 3: <input type="checkbox" onclick="checkMetacarpal3(this.checked)" name = "Metacarpal3">
							<div class="Metacarpal3"id="Metacarpal 3">
								<h3 class="alighn">Metacarpal 3</h3>
								<label>Metacarpal 3 Proximal</label>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Proximal Dorsal</label>
									<select class=Metacarpal3selections name="Metacarpal3ProximalDorsal">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Proximal Palmar</label>
									<select class=Metacarpal3selections name="Metacarpal3ProximalPalmar">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
									<label>Metacarpal 3 Diaphysis</label>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Diaphysis Dorsal</label>
									<select class=Metacarpal3selections name="Metacarpal3DiaphysisDorsal">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Diaphysis Palmar</label>
									<select class=Metacarpal3selections name="Metacarpal3DiaphysisPalmar">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<label>Metacarpal 3 Distal</label>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Distal Dorsal Medial</label>
									<select class=Metacarpal3selections name="Metacarpal3DistalDorsalMedial">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Distal Dorsal Lateral</label>
									<select class=Metacarpal3selections name="Metacarpal3DistalDorsalLateral">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Distal Dorsal Sagittal Ridge</label>
									<select class=Metacarpal3selections name="Metacarpal3DistalDorsalSagittalRidge">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Distal Palmar Medial</label>
									<select class=Metacarpal3selections name="Metacarpal3DistalPalmarMedial">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label class=Metacarpal3selections>Metacarpal 3 Distal Palmar Lateral</label>
									<select class=Metacarpal3selections name="Metacarpal3DistalPalmarLateral">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
								<label class=Metacarpal3selections>Metacarpal 3 Distal Palmar Sagittal Ridge</label>
									<select class=Metacarpal3selections name="Metacarpal3DistalPalmarSagittalRidge">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
							</div>
						</div>
						<div class = "medialseasamoidcheckbox">
							Medial Sesamoid: <input type="checkbox" onclick="checkMedialSesamoid(this.checked)" name = "MedialSesamoid">
							<div class="MedialSesamoid"id="MedialSesamoid">
								<h3 class="alighn">Medial Sesamoid</h3>
								<p>
									<label>Medial Sesamoid Apical Articular</label>
									<select name="MedialSesamoidApicalArticular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Medial Sesamoid Apical Non-Articular</label>
									<select name="MedialSesamoidApicalNon-Articular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Medial Sesamoid Midbody Articular</label>
									<select name="MedialSesamoidMidbodyArticular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Medial Sesamoid Midbody Non-Articular</label>
									<select name="MedialSesamoidMidbodyNon-Articular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Medial Sesamoid Base Articular</label>
									<select name="MedialSesamoidBaseArticular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Medial Sesamoid Base Non-Articular</label>
									<select name="MedialSesamoidBaseNon-Articular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Medial Sesamoid Axial Articular</label>
									<select name="MedialSesamoidAxialArticular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
								<p>
									<label>Medial Sesamoid Axial Non-Articular</label>
									<select name="MedialSesamoidAxialNon-Articular">
										<option value="1">Not Assesed</option>
										<option value="2">Within Normal Limits</option>
										<option value="3">Lysis</option>
										<option value="4">Sclerosis</option>
										<option value="5">Fracture</option>
										<option value="6">Cyst-Like Lesion</option>
									</select>
								</p>
							</div>
						</div>
					</div>
				</p>
			<button class = "submit" type="submit">Submit</button>
			</fieldset>
		</form>
		<form action="selection.php"method="post">
			<fieldset>
				<legend>Hindleg Assessment</legend>
				<p>
					<label>Hindleg Assessment</label>
					<select name="Hindleg">
						<option value="1">Add</option>
						<option value="2">Edit/View</option>
					</select>
					<button type="submit">Submit</button>
				</p>
			</fieldset>
		</form>
		<form action="selection.php"method="post">
			<fieldset>
				<legend>Race Training Clinical</legend>
				<p>
					<label>Race Training Clinical</label>
					<select name="Race">
						<option value="1">Add</option>
						<option value="2">Edit/View</option>
					</select>
					<button type="submit">Submit</button>
				</p>
			</fieldset>
		</form>
		<script>
			function openEuthanasiaDate(isChecked){
				if (isChecked)
					document.getElementById("EuthanasiaTrue").style.display="block";
				else 
					document.getElementById("EuthanasiaTrue").style.display="none";
			}
			function checkDistalRadius(isChecked){
							if (isChecked)
								openDistalRadius();
							else 
								closeDistalRadius();
						}
			function checkRadiocarpalBone(isChecked){
							if (isChecked)
								openRadiocarpalBone();
							else 
								closeRadiocarpalBone();
						}
			function checkMetacarpal3(isChecked){
							if (isChecked)
								openMetacarpal3();
							else 
								closeMetacarpal3();
						}

			function checkMedialSesamoid(isChecked){
							if (isChecked)
								openMedialSesamoid();
							else 
								closeMedialSesamoid();
						}

			function getOption() { 
            					selectElement = document.querySelector('#typeofleg');
						if(selectElement){
							openForelimbForm();
						}
			}
			function openForelimbForm(){
				document.getElementById("ForelimbForm").style.display="block";
				}
			function closeForelimbForm(){
				document.getElementById("ForelimbForm").style.display="none";
			}
			function openDistalRadius(){
				document.getElementById("Distal Radius").style.display="block";
			}
			function closeDistalRadius(){
				document.getElementById("Distal Radius").style.display="none";
			}
			function openRadiocarpalBone(){
				document.getElementById("Radiocarpal Bone").style.display="Block";
			}
			function closeRadiocarpalBone(){
				document.getElementById("Radiocarpal Bone").style.display="none";
			}
			function openMetacarpal3(){
				document.getElementById("Metacarpal 3").style.display="Block";
			}
			function closeMetacarpal3(){
				document.getElementById("Metacarpal 3").style.display="none";
			}
			function openMedialSesamoid(){
				document.getElementById("MedialSesamoid").style.display="block";
			}
			function closeMedialSesamoid(){
				document.getElementById("MedialSesamoid").style.display="none";
			}

		</script>
<?php
} else {
	echo "You are not logged in. <a href=\"index.php\">Return to login<a> ";
}
?>
</body>
</html>
