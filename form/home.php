<?php
//start the session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="homeStyle.css">
		<title>Home</title>
	</head>
	<body>
		<div class="header">
			<a href="logout.php">Logout</a>
			<h1><?php echo $_SESSION["user"]?>'s Profile</h1>
			<p>My E-mail is <?php echo $_SESSION["email"]?>.</p>
		</div>
		<div class="topnav"></div>
	</body>