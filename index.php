<html>
<head>
<?php
require("assets/php/redirect_helper.php");
if(isset($_COOKIE["equine_database"])) {
	header( "Location: http://".$ip."/equine/home.php");
}
?>
	<title>Equine Project | Login</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="assets/bootstrap-4.3.1-dist/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>
	<body>
		<div class="container">
			<div class="row">		
				<div class="col-sm-12">
					<h1 class="text-wildcat-blue">UK Equine Sports Medicine</h1>
					<h2>Welcome to the Login Page!</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-8">
					<h3>Login:</h3>
					<form action="functions/php/registration.php" method="post">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username" id="username"/>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password" id="password">
						</div>
						<button class="btn btn-primary" type="submit">Submit</button>                                
					</form>
					
					<div class="note-group" id="reglink">
						<p>New users, please register an account:
							<a href="Register.php">Register Here!</a>
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<img class="equine-imagery" src="assets/images/gluckcenter_fall2015.jpg" alt="Gluck Equine Center" />
					<div class="footer">
						<p><strong>&copy; 2019</strong>: Darren Powers, Michael Probst, Nicholas Poe, Jake Hayden</p>
						<p>CS 405G - Fall 2019</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>



