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
        <h1>Sign Up</h1>
        <form action="" method="POST">
            <div class="form">
                <input type="text" name="name" class="textfiled" placeholder="username" required>
                <input type="email" name="email" class="textfiled" placeholder="email" required>
                <input type="password" name="password" class="textfiled" placeholder="password" req>
                <input type="submit" name="submit" value="Create Account" class="btn btn primary">
                <div class="SignUp">Have an account ? <a href="login.php" class="link">LogIn Here</a></div>
            </div>
        </form>
    </div>
</body>

</html>

<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['name'];
    $uemail = $_POST['email'];
    $upaswd = $_POST['password'];

    //securing the password using the hash password 

    $secure_paswd = password_hash($upaswd, PASSWORD_BCRYPT);


    
    if (empty($uname) || empty($uemail) || empty($secure_paswd)) {
        $errorMessage = "All fields are required";
    } else {
        $stmnt = $con->prepare("INSERT INTO logindata (name, email, password) VALUES (?, ?, ?)");
        $stmnt->bind_param('sss', $uname, $uemail, $secure_paswd);

        if ($stmnt->execute()) {
            $successMessage = "Data Inserted Successfully";
            $stmnt->close();
        } else {
            $errorMessage = "Not Created" . $con->error;
        }
    }
}



if (isset($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
}

if (isset($successMessage)) {
    echo '<p style="color: green;">' . $successMessage . '</p>';
}
?>