<?php

session_start();
if(isset($_POST["submit"])){
    $uname = $_POST['uname'];
    $paswd = $_POST['pswd'];
    // if(empty($uname) && empty($paswd)){
    //     echo " "
    // }
    include "config.php";
    
    $stmnt = $con->prepare("SELECT name, password FROM logindata WHERE name =? && password = ?");
    $stmnt->bind_param('ss', $uname, $paswd);
    $stmnt->execute();

    $result = $stmnt->get_result();

    if($result->num_rows == 1){
        $_SESSION['uname'] = $uname;
        $_SESSION['paswd'] = $paswd;

        header('location: welcome.php');
    }else{
        echo "Invalid username and password <a href = 'login.php'>try Again</a>.";
    }

}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login-style.css">
</head>

<body>
    <div class="center">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class="form">
                <input type="text" name="uname" class="textfiled" placeholder="username" required>
                <input type="password" name="pswd" class="textfiled" placeholder="password" required>

                <div class="forget-pass">
                    <a href="#" class="link" onclick="alert()">Forget Password ?</a>
                </div>
                <input type="submit" name="submit" value="login" class="btn btn primary">

                <div class="SignUp">New Member ? <a href="signup.php" class="link">Creat Account</a></div>
            </div>
        </form>
    </div>
    <script>
        function alert() {
            alert("try again");
        }
    </script>
</body>

</html>