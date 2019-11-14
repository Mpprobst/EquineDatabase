<!DOCTYPE HTML>
<html lang = "en">
	<head>
		<title>formDemo.html</title>
		<style>
                        .alighn{
                                position: relative;
                                left: 4px;
                        }
                        .show {
                                display: none;
                                position: relative;
                                top: 20px;
                                border: 3px solid #f1f1f1;
                                border-color: blue;
			}
			.show1 {
				display: none;
                                position: relative;
				top: -60px;
				left: 100px;
			}
                </style>
		<meta charset = "UTF-8" />
	</head>
	<body>
		<h1>Welcome To the Home Page</h1>
		<form action="selection.php" method = "post">
			<fieldset>
				<legend>horse</legend>
				<p>
					<label>Horse</label>
					<select name = "horse">
						<option value = "1">Add</option>
						<option value = "2">Edit/View</option>
					</select>
				</p>
			</fieldset>

		</form>
		<div>
			<fieldset>
				<legend>Assessment</legend>
				<p>
					<label>Foreleg</label>
					<select name = "Action">
						<option value = "1">Add</option>
						<option value = "2">Edit/View</option>
					</select>
					
					<button onclick="openForelimbForm()">Foreleg</button>
					<div class="show" id = "ForelimbForm">
						<h2 class = "alighn">Foreleg</h2>
						<div>
							<button onclick="openDistalRadius()">DistalRadius</button>
							<div class="show1" id = "DistalRadius">
								<h3 class="alighn">Distal Radius</h3>
									Medial: <input type="text" name="distal"><br><br>
							</div>	
						</div>
					</div>
					<button type="submit">Submit</button>
				</p>
			</fieldset>
		</div>
		<form action="selection.php" method = "post">
			<fieldset>
				<legend>Hindleg Assessment</legend>
				<p>
					<label>Hindleg Assessment</label>
					<select name = "Hindleg">
						<option value = "1">Add</option>
						<option value = "2">Edit/View</option>
					</select>
					<button type="submit">Submit</button>
				</p>
			</fieldset>
		</form>	
		<form action="selection.php" method = "post">
			<fieldset>
				<legend>Race Training Clinical</legend>
				<p>
					<label>Race Training Clinical</label>
					<select name = "Race">
						<option value = "1">Add</option>
						<option value = "2">Edit/View</option>
					</select>
					<button type="submit">Submit</button>
				</p>
			</fieldset>
		</form>	
	<script>
		function openForelimbForm() {
			document.getElementById("ForelimbForm").style.display = "block";
		}
		function closeForelimbForm() {
			document.getElementById("ForelimbForm").style.display = "none";
		}
		function openDistalRadius() {
			document.getElementById("DistalRadius").style.display = "block";
		}
		function closeDistalRadius() {
                        document.getElementById("DistalRadius").style.display = "none";
                }
	</script>
	
	</body>
</html>
