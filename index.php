<?php
	session_start();
	ini_set('display_errors', 'On');
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
	<title>Thor - Ashoka's Online Judge</title>
	<link rel="stylesheet" href="css/common.css">
</head>
<body>
	<?php 
		if(isset($_SESSION["user"])){
			echo "Logged in as ".$_SESSION["user"];
			echo '<a href="submit-code.php">Submit Code</a>';
			echo '<a href="logout.php">Logout</a>';
		}
		else{
			echo '<a href="login.php">Login</a>';
			echo '<a href="register.php">Register</a>';
		}
	?>
	<table>
		<tr>
			<th>Rank</th>
			<th>Username</th>
			<th>Score</th>
		</tr>
		<?php
			$query = "SELECT * FROM users ORDER BY score DESC";
    		$result = mysqli_query($conn,$query);
    		$rank = 0;
			while($data = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>".$rank."</td>";
				echo "<td>".$data["UID"]."</td>";
				echo "<td>".$data["score"]."</td>";
				echo "</tr>";
				$rank++;
			}
		?>
	</table>
</body>
<?php
	mysqli_close($conn);
?>
</html>