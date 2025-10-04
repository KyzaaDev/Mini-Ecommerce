<?php 
session_start();
session_unset();
session_destroy();
setcookie('key', '', time() - 3600, "/");
setcookie('id', '', time() - 3600, "/");

header("Location: ../../pages/login.php");
?>