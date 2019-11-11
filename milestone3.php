<html>
	<body>
		<Title>Milestone3</Title>
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
		</style>

		<h1>Welcome to the Registration/Login Page!</h1>

		<p style="color:blue;font-size:25px;">If You are a new user please Register an account</p>

		<button onclick= "openRegister()" >Register</button>
		<div class="show" id = "register">
			<h2 class = "alighn">Register</h2>
			<form action="registration.php" class= "alighn" method="post">
				Username: <input type="text" name="rusername"><br><br>
				Password: <input type="text" name="rpassword"><br><br>
				<button type="submit">Submit</button>
				<button type="button" onclick="closeRegister()">Close</button>
			</form>
		</div>

		<p style="color:blue;font-size:25px;">Otherwise select the Login Button to Login</p>

		<button onclick="openLogin()">Login</button>

		<div class="show" id="Login">
			<h1 class = "alighn">Login</h1>
			<form action="registration.php"class = "alighn" method="post">
				Username: <input type="text" name="username"><br><br>
				Password: <input type="text" name="password"><br><br>
				<button type="submit">Submit</button>
				<button type="button" onclick="closeLogin()">Close</button>
			</form>
		</div>

		<script>
			function openRegister() {
				document.getElementById("register").style.display = "block";
			}

			function closeRegister() {
				document.getElementById("register").style.display = "none";
			}
			function openLogin() {
				document.getElementById("Login").style.display = "block";
			}

			function closeLogin() {
				document.getElementById("Login").style.display = "none";
			}
		</script>

	</body>
</html>



