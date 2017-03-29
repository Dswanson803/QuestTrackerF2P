<?php
require_once("common.php");
?>
<!doctype html>
<html>
	<head>
		<link rel="shortcut icon" href="images/favicon" type="image/png">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>Quest Buddy</title>
	</head>
	<body>
		<nav class="header-nav">
			<div class="nav-wrapper">
				<a href="index.php"><img src="images/logo.png" class="logo"></a>
				<ul>
					<?php
					if(isset($_SESSION["username"])) {
						echo '<li><a href="logout.php">Logout</a>';
					} else {
						echo '<li><a href="login.php"><span style="color:rgb(77, 196, 252)">Login</span></a></li>';
					}
					?>
					<li><a href="list.php">Your Plan</a></li>
					<li><a href="quest.php">Quest List</a></li>
				</ul>
			</div>
		</nav>
		<div class="wrapper">