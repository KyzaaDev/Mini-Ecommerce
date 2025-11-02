<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require(__DIR__ . "/../../config/db.php");

if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($conn, $_POST["user"]);
    $password = $_POST["pass"];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE BINARY username = '$username'");
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $role = $user["role"];
        $id = $user["id"];
        if (password_verify($password, $user["password"])) {
            if ($role == "user") {
                header("Location: ../../pages/user/dashboard.php");
                exit();
            } elseif ($role === "admin") {


            //cek remember me
            
            
                $_SESSION["login"] = true;
                $_SESSION["user"] = $user["username"];

                if (isset($_POST['remember'])) {
                    $token = bin2hex(random_bytes(32));
                    $tokenHash = hash('sha256', $token);

                    $expiry = time() + 259200;

                    setcookie("whoami", $token, time() + 259200, "/");
                    mysqli_query($conn ,"UPDATE users SET cookies = '$tokenHash', cookie_expiry = FROM_UNIXTIME($expiry) WHERE username = '$username'");

            }

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