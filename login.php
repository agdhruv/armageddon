<?php
	session_start();
	$dbhost = "localhost";
	$dbuser = "agdhruv";
	$dbpass = "haha";
	$dbname = "onlineJudge";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(isset($_SESSION['user']))
	{
    	header("Location: index.php");
    	exit;
	}

	function attempt_login($unm,$pass,$conn){
        $query = "SELECT COUNT(*) as number FROM users WHERE UID='{$unm}' AND password='{$pass}'";
        $result = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($result);
        if($data['number']==1)
            {
            return true;
        }
        return false;
    };

	if(isset($_POST['submit'])){
		$username = isset($_POST['userID'])?$_POST['userID']:"";
        $password = isset($_POST['password'])?$_POST['password']:"";
        $found_admin = attempt_login($username,$password,$conn);
        if(!$found_admin){
            $loginSuccess = "Wrong user ID or password";
        }
        else{
        	$_SESSION['user'] = $_POST['userID'];
        	header("Location: submit-code.php");
    		exit;
        }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/common.css">
</head>
<body>
	<form method="POST" action="login.php">
		User ID: <input type="text" placeholder="Unique User ID" name="userID" autocomplete="off"><br>
		Password: <input type="password" name="password" autocomplete="off" placeholder="*****"><br>
		<input type="submit" name="submit">
	</form>
	<p><?php echo htmlentities($loginSuccess); ?></p>
	<a href="register.php">Click to register.</a>
</body>
<?php
	mysqli_close($conn);    
?>
</html>