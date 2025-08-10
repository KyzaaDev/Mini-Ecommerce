<?php
require(__DIR__ . "/../../config/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['regis'])) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["password"];
        $passConfirm = $_POST["password-confirm"];
        

        if (empty($email) || empty($username) || empty($password) || empty($passConfirm)) {
            header("Location: ../../register.php?error=empty_fields");
            exit;
        }else {
            // check panjang password users
            if (strlen($_POST["password"]) < 8) {
                header("Location: ../../pages/register.php?error=password_too_short");  
                exit();
            }
    
            // check password confirm
            if ($password !== $passConfirm) {
                header("Location: ../../pages/register.php?error=password_not_match");
                exit();
            }   
            
            // check input user email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../../pages/register.php?error=invalid_email");
                exit();
            }
    
            // check apakah email sudah terdaftar
            $checkEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if(mysqli_num_rows($checkEmail) > 0){
                header("Location: ../../pages/register.php?error=email_exist");
                exit();
            }
    
            //check user
            $checkUser = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
            if(mysqli_num_rows($checkUser) > 0){
                header("Location: ../../pages/register.php?error=username_exist");
                exit();
            }
            
            //insert data into database
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users VALUES (NULL, '$email', '$username', '$passwordHash')";
            if (mysqli_query($conn, $query)) {
                header("Location: ../../pages/login.php?register_success=success");
                exit();
            }else {
                header("Location: ../../pages/register.php?error=insert_failed");
                exit();
            }

        }
    }
}

?>