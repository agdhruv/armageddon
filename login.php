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
			<a href="index.php">Rank List</a>
			<a href="problems.php">Problems</a>
			<?php 
				if(isset($_SESSION["user"])){
					echo '<a href="submit-code.php"><span>Submit Code</span></a>';
					echo '<a href="javascript:void(0);"><span>'.$_SESSION["user"].'</span></a>';
					echo '<a href="logout.php"><span>Logout</span></a>';
				}
				else{
					echo '<a href="login.php"><span>Login</span></a>';
					echo '<a href="register.php"><span>Register</span></a>';
				}
			?>
		</div>
	</nav>
	<section class="section1">
		<h1>Login</h1>
		<form method="POST" action="check.php">
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