<?php
session_start();
require(__DIR__ . "/../../config/db.php");

// kalau udah ada session login
if (isset($_SESSION["login"])) {
    return; // biarin lanjut
}

// kalau belum ada session, cek cookie
if (isset($_COOKIE["whoami"])) {
    $token = $_COOKIE["whoami"];
    $tokenHash = hash("sha256", $token);

    $result = mysqli_query($conn, "SELECT username, cookies, cookie_expiry FROM users WHERE cookies = '$tokenHash'");

    if (strtotime($result["cookie_expiry"] > time())) {
            // bikin session baru
            $_SESSION["login"] = true;
            $_SESSION["user"] = $row["username"];
            return;
    } else {
            // token udah expired -> hapus cookie dan reset di DB
            setcookie('whoami', '', time() - 3600, '/');
            mysqli_query($conn, "UPDATE users SET cookies=NULL, cookie_expiry=NULL WHERE username='{$result['username']}'");
    }
}

$base = "/MiniEcommerce";

// kalau nyampe sini berarti belum login & nggak ada cookie valid
header("Location: $base/pages/login.php");
exit;
?>

