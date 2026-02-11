<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="login.css">
	<link rel="icon" type="image/x-icon" href="https://file.garden/ZxeJbwpMpVUTaKTZ/LogoShort.png">
</head>

<body>
	<div class="container">
		<img src="https://file.garden/ZxeJbwpMpVUTaKTZ/LogoShort.png" style="height: 12rem; width:auto">

		<br>
		<h2>Login</h2>

		<form name="form" action="login.php" method="POST">


			ID: <br> <input type="text" id="user" name="user" required>
			<br> Password: <br> <input type="password" id="pass" name="pass" required>

			<br><br><input type="submit" id="btn" value="Login" name="submit">

		</form>
	</div>
</body>

</html>