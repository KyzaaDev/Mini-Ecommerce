<?php
session_start();
require(__DIR__ . "/../../config/db.php");

if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($conn, $_POST["user"]);
    $password = $_POST["pass"];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE BINARY username = '$username'");
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $role = $user["role"];
        if (password_verify($password, $user["password"])) {
            if ($role == "user") {
                header("Location: ../../pages/user/dashboard.php");
                exit();
            } elseif ($role === "admin") {
                $_SESSION["login"] = true;
                $_SESSION["user"] = $user["username"];
                header("Location: ../../pages/admin/dashboard.php");
                exit();
            }
        } else {
            header("Location: ../../pages/login.php?error=wrong");
            exit();
        }
    } else {
        header("Location: ../../pages/login.php?error=not_found");
        exit();
    }
}   


?>