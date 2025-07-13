<?php 
require(__DIR__ . "/../../config/db.php");

if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($conn, $_POST["user"]);
    $password = $_POST["pass"];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user["password"])) {
            header("Location: ../../pages/dashboard.php");
            exit();
        } else {
            header("Location: ../../pages/login.php?error=wrong");
            exit();
        }
    } else {
        header("Location: ../../pages/login.php?error=not_found");
    }
}   


?>