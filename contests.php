<?php
	session_start();
	//ini_set('display_errors', 'On');
    $dbhost = "localhost";
    $dbuser = "agdhruv";
    $dbpass = "haha";
    $dbname = "onlineJudge";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thor &middot; Ashoka's Online Judge</title>
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/index.css">
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
		<h1>Current Rank List</h1>
		<table class="rankTable">
			<tr>
				<th>Rank</th>
				<th>Name</th>
				<th>Username</th>
				<th>Score</th>
				<th>Accuracy</th>
			</tr>
			<?php
				$query = "SELECT * FROM users ORDER BY score DESC";
	    		$result = mysqli_query($conn,$query);
	    		$rank = 0;
				while($data = mysqli_fetch_assoc($result)){
					if(isset($_SESSION["user"])&&($data["UID"]==$_SESSION["user"])){
						echo '<tr class="loggedIn">';
					}
					else{
						echo '<tr class="notLoggedIn">';
					}
					echo "	<td>".$rank."</td>";
					echo "	<td>".$data["name"]."</td>";
					echo "	<td>".$data["UID"]."</td>";
					echo "	<td>".$data["score"]."</td>";
					echo "	<td>".$data["accuracy"]."</td>";
					echo "</tr>";
					$rank++;
				}
			?>
		</table>
	</section>
</body>
<?php
	mysqli_close($conn);
?>
</html>