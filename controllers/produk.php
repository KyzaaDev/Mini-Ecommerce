<?php 
require(__DIR__ . "/../config/db.php");


function produkList() {
    $query = "SELECT * FROM product";
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


?>