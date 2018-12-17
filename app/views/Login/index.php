<?php
	
	session_start();

?>

<html>
<head>
	<title>Login Page</title>

	<link rel="stylesheet" href="/css/login-layout.css" />
</head>
	<body>

		<header>
			<nav>
				<div class="main-wrapper">
					<div class="nav-login">
						<form action="/login/start_session" method="POST">
							<input type="text" name="uid" placeholder="Username">
							<input type="password" name="pwd" placeholder="Password">
							<button type="submit" name="login">Login</button>
						</form>
					</div>
				</div>
			</nav>
		</header>

		<section class="main-container">
			<div class="main-wrapper">
				<h2>Register</h2>
				<form class="signup-form" action="/login/register" method="POST">
					<input type="text" name="user[user_name]" placeholder="Username">
					<input type="password" name="user[password]" placeholder="Password">
					<input type="text" name="user[first_name]" placeholder="First Name">
					<input type="text" name="user[last_name]" placeholder="Last Name">
					<button type="submit" name="register"> Register </button>
				</form>
			</div>
		</section>



	</body>
</html>
