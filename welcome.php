<!-- 

// session_start();
// if(isset($_SESSION['uname']) || isset($_SESSION['paswd'])){
//     echo "WELCOME TO LOGIN PAGE ".$_SESSION['uname'];
     
// }else{
//     echo "invalid data ";
//     echo "<a href ='signup.page'>Signup</a>";
// }-->

<?php
session_start();

if (!isset($_SESSION["uname"]) && !isset($_SESSION["paswd"])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION["uname"] ;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?></h2>
    <a href="logout.php">Logout</a>
</body>
</html>
