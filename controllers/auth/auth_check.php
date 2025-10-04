<?php
session_start();
require(__DIR__ . "/../../config/db.php");

// kalau udah ada session login
if (isset($_SESSION["login"])) {
    return; // biarin lanjut
}

// kalau belum ada session, cek cookie
if (isset($_COOKIE["key"]) && isset($_COOKIE["id"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    if ($row = mysqli_fetch_assoc($result)) {
        if ($key === hash('sha256', $row["username"])) {
            // bikin session baru
            $_SESSION["login"] = true;
            $_SESSION["user"] = $row["username"];
            return;
        }
    }
}

$base = "/MiniEcommerce";

// kalau nyampe sini berarti belum login & nggak ada cookie valid
header("Location: $base/pages/login.php");
exit;
?>

