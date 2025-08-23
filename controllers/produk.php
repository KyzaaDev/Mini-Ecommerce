<?php 
require(__DIR__ . "/../config/db.php");


function produkList() {
    $query = "SELECT * FROM product ";
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function getData($id) {
    global $conn;
    $query = "SELECT * FROM product WHERE id = $id";
    
    $result = mysqli_query($conn, $query);
    
    $detail = mysqli_fetch_assoc($result);
    return $detail;
}

function getUser() {
    global $conn;
    $query = "SELECT * FROM users";

    $res = mysqli_query($conn, $query);
    $users = [];

    while($user = mysqli_fetch_assoc($res)) {
        $users[] = $user;
    }

    return $users;
}
?>