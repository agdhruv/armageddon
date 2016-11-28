<?php
	session_start();

	if(isset($_SESSION['user']))
	{
    	header("Location: index.php");
    	exit;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thor &middot; Login</title>
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/loginregister.css">
</head>
<body>
	<nav>
		<h1 class="title">
			Thor
		</h1>
		<div class="links">
			<a href="register.php">Register</a>
		</div>
	</nav>
	<section class="section1">
		<h1>Login</h1>
		<form method="POST" action="api/check.php">
			Username<br><input type="text" placeholder="Username" name="userID" autocomplete="off"><br><br>
			Password<br><input type="password" name="password" autocomplete="off" placeholder="Password"><br>
			<input type="submit" name="submitlogin">
		</form>
		<p class="result">
		<?php
			if($_GET["success"]=="false"){
				echo "Wrong User Id or Password.";
			}
			else{
				echo "";
			}
		?>	
		</p>
	</section>
</body>
</html>