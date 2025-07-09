<?php 
require(__DIR__ . "/../config/db.php");

if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($conn, $_POST["user"]);
    $password = mysqli_real_escape_string($conn, $_POST["pass"]);
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    
    if (mysqli_num_rows($result) > 0) {
        echo "login berhasil";
        header("Location: ../pages/dashboard.php");
    
    } else {
        header("Location: " . "../pages/login.php?error=1");
    }
}

?>