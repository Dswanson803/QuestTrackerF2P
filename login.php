<?php
require("header.php");
?>
<div class="index-img column-12"></div>
<div class="column-10 article">
	<h2>Login to begin your adventure!</h2>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		echo '<form method="POST" action="login.php">';
		echo 'Username: <input type="text" name="username"><br><br>';
		echo 'Password: <input type="password" name= "password"><br><br>';
		echo '<button type="submit">Submit</button>';
		echo '</form>';
	} else if($_SERVER["REQUEST_METHOD"] == "POST") {
		//sanity checks
		if($_POST["username"] == "admin" && $_POST["password"] == "pass") {
			$_SESSION["username"] = "admin";
			header("location:index.php");
		} else if($_POST["username"] == "user" && $_POST["password"] == "pass") {
			$_SESSION["username"] = "user";
			header("location:index.php");
		} else {
			session_destroy();
			$_SESSION = array();
			session_write_close();
			header("location: login.php");
			exit();
		}	
	}
?>
</div>
<?php
require("footer.php");