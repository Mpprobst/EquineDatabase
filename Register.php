<html>
<head>
<?php
require("assets/php/redirect_helper.php");
if(isset($_COOKIE["equine_database"])) {
	header( "Location: http://".$ip."/equine/home.php");
}
?>
	<title>Equine Project | Register</title>
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
					<h2>Welcome to the Registration Page!</h1>
				</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Register</h3>
                    <form action="functions/php/registration.php"  method="post">
                        <div class="form-group">
                            <label for="clinic">Enter your clinic's name</label>
                            <input type="text" class="form-control" id="clinic" name="rclinic" placeholder="Clinic Name" />
                        </div>
                        <div class="form-group">
                            <label for="username">Create a Username</label>
                            <input type="text" class="form-control" id="username" name="rusername" placeholder="New Username" />
                        </div>
                        <div class="form-group">
                            <label for="password">Create a Password</label>
                            <input type="password" class="form-control" id="password" name="rpassword" placeholder="New Password" />
                        </div>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary mr-2" type="submit">Submit</button>
                            <a class="btn btn-secondary" href="index.php">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </body>
</html>