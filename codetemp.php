<?php
	session_start();

	if(!isset($_SESSION["user"]))
    {
        header("Location: login.php"); 
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sumbit</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/submitCode.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="ace/src-min/ace.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css" media="screen">

    .codeContainer{
        position: relative;
        width: 80vw;
        margin: 0px auto;
        min-height: 100px;
        border: 2px solid black;
    }

    #editor { 
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
</head>
<body>
    <nav>
        <h1 class="title">
            Thor
        </h1>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="flask/statements/" target="_blank">Problems</a>
            <?php
                if(isset($_SESSION["user"])){
                    echo '<a href="javascript:void(0);"><span>'.$_SESSION["user"].'</span></a>';
                    echo '<a href="logout.php"><span>Logout</span></a>';
                }
            ?>
        </div>
    </nav>
    <section class="section1">
        <h1>Submit Code</h1>
    	<form action="#">
            <label>Problem ID - </label><input type="text" name="problemID" autocomplete="off">
            <label>Language - </label>
            <select name="language">
                <option value="cpp">C++</option>
                <option value="py">Python</option>
                <option value="c">C</option>
                <option value="java">Java</option>
            </select>
    		<br>
    		<label>Your code</label><br>
            <div class="codeContainer">
                <div id="editor">
                    function name (){
                        kuchbhi
                    }
                </div>
            </div>
            <textarea id="code" name="submittedCode"></textarea><br>
    		<input type="submit" name="submit" required>
    	</form>
    </section>
    <?php //echo "The code received a verdict of : ".$output; ?>
    <script>

        $("#code").css("display","none");
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/xcode");
        editor.getSession().setMode("ace/mode/javascript");

        $("form").on("submit",function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.post("result.php",data,function(response){
                if(response){
                    console.log(response);
                }
            });
        });
    </script>
</body>
<?php
	mysqli_close($conn);
?>
</html>