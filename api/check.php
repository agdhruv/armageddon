<?php
	session_start();

    $dbhost = "localhost";
    $dbuser = "agdhruv";
    $dbpass = "haha";
    $dbname = "onlineJudge";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    function attempt_login($unm,$pass,$conn){
        $query = "SELECT COUNT(*) as number FROM users WHERE UID='{$unm}' AND password='{$pass}'";
        $result = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($result);
        if($data['number']==1)
            {
            return true;
        }
        return false;
    }

    function usernameExists($unm)
    {
        $query = "SELECT * FROM users WHERE UID='{$unm}'";
        global $conn;
        $result = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($result);
        if(!empty($data)){
            return true;
        }
        return false;
    }

    if(isset($_POST['submitlogin'])){
        $username = isset($_POST['userID'])?trim($_POST['userID']):"";
        $password = isset($_POST['password'])?trim($_POST['password']):"";
        $found_admin = attempt_login($username,$password,$conn);
        if(!$found_admin){
            header("Location: login.php?success=false");
            exit();
        }
        else{
            $_SESSION['user'] = $_POST['userID'];
            header("Location: index.php");
            exit();
        }
    }
    else if(isset($_POST['submitregister'])){
        if(empty(trim($_POST["name"]))){
            header("Location: register.php?success=incomplete");
            exit();
        }
        else if(empty(trim($_POST["userID"]))){
            header("Location: register.php?success=incomplete");
            exit();
        }
        else if(empty(trim($_POST["userPassword"]))){
            header("Location: register.php?success=incomplete");
            exit();
        }
        else if(usernameExists($_POST["userID"])){
            header("Location: register.php?success=exists");
            exit();
        }
        else{
            $UID = isset($_POST["userID"])?trim(mysqli_real_escape_string($conn,$_POST["userID"])):"";
            $password = isset($_POST["userPassword"])?trim(mysqli_real_escape_string($conn,$_POST["userPassword"])):"";
            $name = isset($_POST["name"])?trim(mysqli_real_escape_string($conn,$_POST["name"])):"";
            $query = "INSERT into users VALUES ('{$UID}','{$password}','{$name}','0','0.0')";
            mysqli_query($conn,$query);
            header("Location: register.php?success=true");
            exit();
        }
    }
    else{
        exit("Sorry you cannot access this.");
    }
    mysqli_close($conn);
?>