<?php 
require "../../controllers/produk.php";

$id = $_GET["id"];

if (produkDelete($id) > 0) {
    echo "<script>
    alert('Produk berhasil di hapus'); 
    document.location.href= 'products.php';
    </script>";
} else {
        echo "<script>
    alert('Produk gagal dihapus'); 
    document.location.href= 'products.php';
    </script>";
}

?>