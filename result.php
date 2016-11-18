<?php
	session_start();
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
		
		$problemID = mysqli_real_escape_string($conn,trim($_POST["problemID"]));//Generate problem ID
		$in_id = $problemID; //Generate in_id
		$exout_id = $problemID; //Generate exout_out
		$lang_code = $_POST['language'];//Generate Input Language

		$query = "SELECT * FROM problems WHERE PID='{$problemID}'";
		$result = mysqli_query($conn,$query);
		$data = mysqli_fetch_assoc($result);
		$timeout = $data["timeout"]; //Generate timeout

		$submission_file = fopen("flask/submissions/{$sub_id}".".".$lang_code,"w");
		$sub_code = $_POST["submittedCode"];
		fwrite($submission_file,$sub_code);
		fclose($submission_file);

	    //Calling the API
		$ch = curl_init("127.0.0.1:5000/judge/"."{$sub_id}/"."{$in_id}/"."{$exout_id}/"."{$timeout}/"."{$lang_code}");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 	$output = curl_exec($ch);
	 	curl_close($ch);

	 	$query = "INSERT into submissions VALUES ('{$sub_id}','{$problemID}','{$_SESSION["user"]}','{$output}','{$lang_code}')";
	 	echo $output;
    }
    else{
    	echo "Why do you want to access this page? All you will get here is an error. Error 403.";
    }
 	mysqli_query($conn,$query);
?>