<?php 
$users = ["username" => "atmin", "passwd" => "atmin123"];

$username = $_POST["user"];
$password = $_POST["pass"];

if ( $username == $users["username"] && $password == $users["passwd"]) {
    echo "<script>alert('Berhasil login')</script>";
    header("Location: " . "../pages/dashboard.php");
}else {
    header("Location: " . "login.php?error=1");
}



?>