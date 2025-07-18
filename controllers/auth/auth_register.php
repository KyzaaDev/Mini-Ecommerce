<?php
require(__DIR__ . "/../../config/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['regis'])) {
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["pass"];
        $passConfirm = $_POST["conf-pass"];
        
        
        // check panjang password users
        if (strlen($_POST["pass"]) < 8) {
            header("Location: ../../pages/register.php?error=terlalu_pendek");
            exit();
        }
        
        // check password confirm
        if ($password !== $passConfirm) {
            header("Location: ../../pages/register.php?error=password_tidak_cocok");
            exit();
        }

        
        // check input user email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../../pages/register.php?error=invalid");
            exit();
        }

        // check apakah email sudah terdaftar
        $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($checkEmail) > 0){
            header("Location: ../../pages/register.php?error=already_used");
            exit();
        }

        //check user
        $checkUser = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($checkUser) > 0){
            header("Location: ../../pages/register.php?error=username_exist");
            exit();
        }
        
        //insert data into database
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users VALUES (NULL, '$nama', '$email', '$username', '$passwordHash')";
        if (mysqli_query($conn, $query)) {
            header("Location: ../../pages/login.php?register_success=success");
            exit();
        }else {
            header("Location: ../../pages/register.php?error=insert_failed");
            exit();
        }
    }
}

?>