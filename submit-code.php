<?php
	session_start();

	if(!isset($_SESSION["user"]))
    {
        header("Location: login.php"); 
        exit;
    }
    
	$dbhost = "localhost";
    $dbuser = "agdhruv";
    $dbpass = "haha";
    $dbname = "onlineJudge";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(isset($_POST['submit'])){
    	$query = "SELECT count(*) as number FROM submissions";
    	$result = mysqli_query($conn,$query);
    	$data = mysqli_fetch_assoc($result);
    	$sub_id = $_SESSION["user"].$data["number"];//Generate sub_id
    	
    	$problemID = $_POST['problemID']; //Generate problem ID
    	$in_id = $problemID; //Generate in_id
    	$exout_id = $problemID; //Generate exout_out

    	$query = "SELECT * FROM problems WHERE PID='{$problemID}'";
    	$result = mysqli_query($conn,$query);
    	$data = mysqli_fetch_assoc($result);
    	$timeout = $data["timeout"]; //Generate timeout

    	$submission_file = fopen("flask/submissions/{$sub_id}.py","w");
    	$sub_code = $_POST["submittedCode"];
    	fwrite($submission_file,$sub_code);
    	fclose($submission_file);

        //Calling the API
		$ch = curl_init("127.0.0.1:5000/judge/"."{$sub_id}/"."{$in_id}/"."{$exout_id}/"."{$timeout}");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     	$output = curl_exec($ch);
     	curl_close($ch);

     	$query = "INSERT into submissions VALUES ('{$sub_id}','{$problemID}','{$_SESSION["user"]}','{$output}')";
     	mysqli_query($conn,$query);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sumbit</title>
    <link rel="stylesheet" href="css/common.css">
</head>
<body>
	<form method="POST" action="submit-code.php">
		Problem ID: <input type="text" name="problemID" autocomplete="off"><br>
		Your code: <textarea name="submittedCode" cols="30" rows="10" autocomplete="off"></textarea><br>
		<input type="submit" name="submit" required>
	</form>
    <a href="flask/statements/">List of problems</a><br>
	<a href="logout.php">Logout</a><br>
    <?php echo "The code received a verdict of : ".$output; ?>
</body>
<?php
	mysqli_close($conn);
?>
</html>