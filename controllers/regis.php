<?php
require(__DIR__ . "/../config/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_POST['regis'])) {
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = password_hash(mysqli_real_escape_string($conn, $_POST["pass"]), PASSWORD_DEFAULT);
    
        $query = "INSERT INTO users VALUES (NULL, '$nama', '$email', '$username', '$password')";
    
        if (mysqli_query($conn, $query)){
            header("Location: ../pages/login.php?register_success=success");
            exit();
        }  
    }
}

?>