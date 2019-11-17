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
				top:20px;
				border:3pxsolid#f1f1f1;
				border-color:blue;
				}
			.show1{
				display:none;
				position:relative;
				top:-60px;
				left:100px;
				}
			.show2{
				display:none;
				position:relative;
				top:-250px;
				left:500px;
				}
			.Metacarpal3{
					display:none;
					position:relative;
					top:-250px;
					left:140px;
					}
			.Metacarpal3selections{
						position:relative;
						left:20px;
						}
			.MedialSesamoid{
					display:none;
					position:relative;
					top:-800px;
					left:700px;
					}
		</style>
			<meta charset="UTF-8"/>
	</head>
	<body>
		<h1>Welcome To the Home Page</h1>
		<form action="selection.php"method="post">
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
		<form action="selection.php" method="post">
			<fieldset>
				<legend>Assessment</legend>
				<p>
					<label>Foreleg</label>
					<select name="Action">
						<option value="1">Add</option>
						<option value="2">Edit/View</option>
					</select>

					<button type="button" onclick="openForelimbForm()">Foreleg</button>
					<div class="show" id="ForelimbForm">
						<h2 class="alighn">Foreleg</h2>
						<div>
							<button type="button" onclick="openDistalRadius()">Distal Radius</button><br></br>
							<div class="show1"id="DistalRadius">
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
						<div>
							<button type="button" onclick="openRadiocarpalBone()">Radiocarpal Bone</button>
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
						<div>
							<button type="button" onclick="openMetacarpal3()">Metacarpal 3</button>
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
						<div>
							<button type="button" onclick="openMedialSesamoid()">Medial Sesamoid</button>
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
			<button type="submit">Submit</button>
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
			function openForelimbForm(){
				document.getElementById("ForelimbForm").style.display="block";
				}
			function closeForelimbForm(){
				document.getElementById("ForelimbForm").style.display="none";
			}
			function openDistalRadius(){
				document.getElementById("DistalRadius").style.display="block";
			}
			function closeDistalRadius(){
				document.getElementById("DistalRadius").style.display="none";
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
	
</body>
</html>
