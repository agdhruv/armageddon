<?php
	session_start();

	if(!isset($_SESSION["user"]))
    {
        header("Location: login.php"); 
        exit;
    }
    else if($_SESSION["user"]!='agdhruv'){ //ENTER USERNAMES OF THE ADMINS HERE TO ALLOW ACCESS
    	header("Location: ../login.php"); 
        exit;
    }

    //Establish connection with the DB server
	$dbhost = "localhost";
    $dbuser = "agdhruv";
    $dbpass = "haha";
    $dbname = "onlineJudge";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //Start Handling Entered data
    if(isset($_POST['submit'])){
    	$question_code = isset($_POST["questionCode"])?mysqli_real_escape_string($conn,$_POST["questionCode"]):"";
    	$question_title = isset($_POST["questionTitle"])?mysqli_real_escape_string($conn,$_POST["questionTitle"]):"";
    	$question_body = isset($_POST["questionBody"])?mysqli_real_escape_string($conn,$_POST["questionBody"]):"";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="css/common.css">
</head>
<body>
	<form method="POST" action="submit-code.php">
		Question Code: <textarea name="questionCode" cols="30" rows="10"></textarea><br>
		Question Title: <textarea name="questionTitle" cols="30" rows="10"></textarea><br>
		Question Body: <textarea name="questionBody" cols="30" rows="10"></textarea><br>
		Question Constraints: <textarea name="questionConstraints" cols="30" rows="10"></textarea><br>
		Sample Input 1: <textarea name="sampleInput1" cols="30" rows="10"></textarea><br>
		Sample Output 1: <textarea name="sampleOutput1" cols="30" rows="10"></textarea><br>
		Sample Input 2: <textarea name="sampleInput2" cols="30" rows="10"></textarea><br>
		Sample Output 2: <textarea name="sampleOutput2" cols="30" rows="10"></textarea><br>
		Sample Input 3: <textarea name="sampleInput3" cols="30" rows="10"></textarea><br>
		Sample Output 3: <textarea name="sampleOutput3" cols="30" rows="10"></textarea><br>
		<input type="submit">
	</form>
	<a href="../logout.php">Logout</a>
</body>
<?php
	mysqli_close($conn);
?>
</html>