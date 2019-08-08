<?php
//start session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="loginStyle.css">
		<title>Form</title>
	</head>
	<body>
	<?php
			$servername = "localhost";
			$username = "root";
			$password = "731997M_h";
			$dbname = "myDB";
			$success = False;

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// Define variables and set to empty values
			$userErr = $emailErr = $passErr = "";
			$user = $email = $pass = "";

			// Info Validation
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["username"])) {
					$userErr = "Username is required";
					$success = FALSE;
				} else {
					$user = test_input($_POST["username"]);
					$success = TRUE;
				}
				if (empty($_POST["email"])) {
					$emailErr = "Email is required";
					$success = FALSE;
				} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					$emailErr = "Not valid email address";
				} else {
					$email = test_input($_POST["email"]);
					$success = TRUE;
				}
				// Given password
				$pass = test_input($_POST["pass"]);

				if (empty($_POST["pass"])) {
					$passErr = "Password is required";
					$success = FALSE;
				}else {
					// Validate password strength
					$uppercase = preg_match('@[A-Z]@', $pass);
					$lowercase = preg_match('@[a-z]@', $pass);
					$number = preg_match('@[0-9]@', $pass);

					if (!$uppercase || !$lowercase || !$number || strlen($pass) < 8) {
						$passErr = 'Password should be at least 8 characters in length and should include at least one uppercase letter and one number.';
						$success = FALSE;
					}else {
						$pass = test_input($_POST["pass"]);
						$success = TRUE;
					}
				}

				if ($success) {
					// Insert a record
					$sql = "INSERT INTO accounts (username, pass, email)
					VALUES ('$user', '$pass', '$email')";

					if ($conn->query($sql) === FALSE) {
						$passErr = "Too long username, email or password!";
					} else {
						$_SESSION["success"] = "You have been registered successfully";
						header('Location: myaction.php');
					}
				}
			}

			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$conn->close();
		?>
		<div class="page">
			<h1>Registeration</h1>
			<div class="form">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<input type="text" name="username" placeholder="username" autofocus>
					<span class="error">* <?php echo $userErr;?></span>
					<input type="text" name="email" placeholder="email">
					<span class="error">* <?php echo $emailErr;?></span>
					<input type="password" name="pass" placeholder="password">
					<span class="error">* <?php echo $passErr;?></span>
					<input type="submit" name="register" value="Register">
					<p class="message">Already registered? <a href="myaction.php">Login</a></p>
				</form>
			</div>
		</div>
	</body>
</html>