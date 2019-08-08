<?php 
	// Start the session
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="loginStyle.css">
		<title>Login</title>
	</head>
	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "731997M_h";
			$dbname = "myDB";
			$err = "";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			if (isset($_POST['login'])) {
				$log_email = $_POST["log_email"];
				$log_pass = $_POST["log_pass"];
				$query = "SELECT * FROM accounts WHERE email = '$log_email' AND pass = '$log_pass'";
				$result = mysqli_query($conn,$query);

				// Check username and password
				if (mysqli_num_rows($result)) 
				{
					while($row = mysqli_fetch_assoc($result)) {
						$name = $row["username"];
					}
					$_SESSION["user"] = $name;
					$_SESSION["email"] = $log_email;
					header('Location: home.php');
				} else {
					$err = "Incorrect email or password";
				}
			}

			$conn->close();
		?>
		<div class="page">
			<h4><?php echo $_SESSION["success"];?></h4>
			<h1>LOG IN</h1>
			<div class="form">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<input type="text" name="log_email" placeholder="email" required autofocus>
					<input type="password" name="log_pass" placeholder="password" required>
					<span class="error"><?php echo $err;?></span>
					<input type="submit" name="login" value="Login">
					<p class="message">Not registered? <a href="form.php">Create an account</a></p>
				</form>
			</div>
		</div>
	</body>
</html>