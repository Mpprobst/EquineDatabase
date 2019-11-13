<!DOCTYPE HTML>
<html lang = "en">
	<head>
		<title>formDemo.html</title>
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
					<button type="submit">Submit</button>
				</p>
			</fieldset>
		</form>
		<form action="selection.php" method = "post">
			<fieldset>
				<legend>Foreleg Assessment</legend>
				<p>
					<label>Foreleg Assessment</label>
					<select name = "Foreleg">
						<option value = "1">Add</option>
						<option value = "2">Edit/View</option>
					</select>
					<button type="submit">Submit</button>
				</p>
			</fieldset>
		</form>
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
	</body>
</html>
