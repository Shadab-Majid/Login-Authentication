<?php
session_start();
if (isset($_POST["submit"])) {
    $uname = $_POST['uname'];
    $paswd = $_POST['pswd'];

    // Secure the password using hash function 
    $secure_paswd = password_hash($paswd, PASSWORD_BCRYPT);

    include "config.php";

    $stmnt = $con->prepare("SELECT name, password FROM logindata WHERE name = ?");
    $stmnt->bind_param('s', $uname);
    $stmnt->execute();

    $result = $stmnt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashPaswdOfDB = $row['password'];

        // Checking the password against the hashed password from the database
        if (password_verify($paswd, $hashPaswdOfDB)) {
            $_SESSION['uname'] = $uname;
            header('location: welcome.php');
        } else {
            echo "Invalid username and password <a href='login.php'>try Again</a>.";
        }
    } else {
        echo "Invalid username and password <a href='login.php'>try Again</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <input type="submit" name="submit" value="login" class="btn btn-primary">

                <div class="SignUp">New Member ? <a href="signup.php" class="link">Create Account</a></div>
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
