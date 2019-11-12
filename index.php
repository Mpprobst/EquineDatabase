<html>
<head>
	<title>Equine Project | Login (Milestone 3)</title>
	<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
</head>
	<body>

		<h1 class="text-wildcat-blue">UK Equine Sports Medicine</h1>
		<h2>Welcome to the Registration/Login Page!</h1>

<div class="container">
		<div class="input-form" id="Login">
                        <h3>Login:</h3>
                        <form class="input-form-bordered" action="registration.php" method="post">
                                Username: <input type="text" name="username"><br><br>
                                Password: <input type="text" name="password"><br><br>
                                <button type="submit">Submit</button>                                
                        </form>
                </div>

		<div class="input-form input-form-bordered input-form-collapsed" id="register">
			<h3>Register</h3>
			<form action="registration.php"  method="post">
				Username: <input type="text" name="rusername"><br><br>
				Password: <input type="text" name="rpassword"><br><br>
				<button type="submit">Submit</button>
				<button type="button" onclick="toggleRegisterLogin()">Close</button>
			</form>
		</div>
		<div class="note-group" id="reglink">
			<p>New users, please register an account:
				<button onclick="toggleRegisterLogin();" >Register here!</button>
			</p>
		</div>
</div>
		<img class="equine-imagery" src="assets/images/gluckcenter_fall2015.jpg" alt="Gluck Equine Center" />
		<div class="footer">
			<p><strong>&copy; 2019</strong>: Darren Powers, Michael Probst, Nicholas Poe, Jake Hayden</p>
			<p>CS 405G - Fall 2019</p>
		</div>
		<script>
			function toggleRegisterLogin() {
				if(document.getElementById("register").style.display != "block")
				{ 
					document.getElementById("register").style.display = "block";
					document.getElementById("Login").style.display = "none";
					document.getElementById("reglink").style.display = "none";
				} else {
					document.getElementById("register").style.display = "none";
					document.getElementById("Login").style.display = "block";
					document.getElementById("reglink").style.display = "block";
				}
			}
		</script>
	</body>
</html>



