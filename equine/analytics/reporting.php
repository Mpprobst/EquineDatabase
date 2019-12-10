<?php
/* This script uses an open source poltting library, Plotly, to create a D3.js based bar charts. */
?>
<!doctype html>
<html lang="en">

<head>
	<title>Equine Project | Reporting Home</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="../assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	
	<style>
		.GraphArea {
			width: 100%;
			height: 20rem;
		}
	</style>

</head>

<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Reporting Home</h2>
			<!-- Plotly chart will be drawn inside this DIV -->
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div id="Chart" class="GraphArea"></div>
					<div class="btn-group">
						<a href="graphs/forelimb_breed.php" class="btn btn-primary mr-2">Forelimb Abnormalities</a>
						<a href="graphs/hindlimb_breed.php" class="btn btn-primary mr-2">Hindlimb Abnormalities</a>
						<a href="../home.php" class="btn btn-secondary">Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

