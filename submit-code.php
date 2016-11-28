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
	<title>Thor &middot; Submit Code</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/submitCode.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="ace/src-min/ace.js" type="text/javascript" charset="utf-8"></script>
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
        <h1>Submit Code</h1>

        <form action="#" class="inputs-container">
            <div class="problemID">
                <label>Problem ID - </label><input type="text" name="problemID" autocomplete="off">
            </div>
            <div class="language">
                <label>Language - </label>
                <select name="language">
                    <option value="cpp">C++</option>
                    <option value="py">Python</option>
                    <option value="c">C</option>
                    <option value="java">Java</option>
                </select>
            </div>
            <div class="ace-code">
                <label>Your code</label><br>
                <div id="editor">#include</div>
                <textarea id="code" name="submittedCode"></textarea><br>
            </div>
            <div class="submitButton">
                <input type="submit" name="submit" required>
            </div>
        </form>
        <p class="result"></p>
    </section>
    <script>

        //Configure the Code Editor
        $("#code").css("display","none");//hide textarea
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/xcode");
        editor.getSession().setMode("ace/mode/c_cpp");

        //Handle default code in code editor
        var content = "#include <iostream>\nusing namespace std;\n\nint main() {\n    //your code goes here\n   return 0;\n}";
        editor.setValue(content,1);

        //Handle language change in code editor
        $('form select').on('change', function(){
            var lang = $(this).val();
            if(lang==="cpp"){
                editor.getSession().setMode("ace/mode/c_cpp");
                content = "#include <iostream>\nusing namespace std;\n\nint main() {\n    //your code goes here\n   return 0;\n}";
                editor.setValue(content,1);
            }
            else if(lang==="c"){
                editor.getSession().setMode("ace/mode/c_cpp");
                content = "#include <stdio.h>\n\nint main(void) {\n    //your code goes here\n   return 0;\n}";
                editor.setValue(content,1);
            }
            else if(lang==="py"){
                editor.getSession().setMode("ace/mode/python");
                content = "# your code goes here";
                editor.setValue(content,1);
            }
            else if(lang==="java"){
                editor.getSession().setMode("ace/mode/java");
                content = "/* package whatever; //don't place package name! */\n\nimport java.util.*;\nimport java.lang.*;\nimport java.io.*;\n\n/* Name of the class has to be \"Main\" only. */\n\nclass Main\n{   public static void main (String[] args) throws java.lang.Exception\n    {\n     // your code goes here\n    }\n}";
                editor.setValue(content,1);
            }
        });

        //Handle AJAX Call
        $("form").on("submit",function(e){
            e.preventDefault();
            $("#code").val(editor.getSession().getValue());//enter code editor code to text area to POST to API
            var data = $(this).serialize();
            data += "&submit=yes";
            console.log(data);
            $.post("api/result.php",data,function(response){
                console.log(response);
                if(response){
                    $("p.result").html("Verdict: "+response);
                }
                else{
                    $("p.result").html("Verdict: Something");
                }
            });
        });
    </script>
</body>
<?php
	mysqli_close($conn);
?>
</html>
