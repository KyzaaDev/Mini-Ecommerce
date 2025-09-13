<?php 
require "../produk.php"; // Pastikan fungsi ada di sini

// Cek hapus user
if (isset($_GET['id_user'])) {
    $id_user = intval($_GET['id_user']);
    if (userDelete($id_user) > 0) {
        echo "<script>
                alert('User berhasil dihapus');
                window.location.href = '../../pages/admin/dashboard.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus user');
                window.location.href = '../../pages/admin/dashboard.php';
            </script>";
    }
    exit; // supaya gak lanjut ke delete product
}

// Cek hapus product
if (isset($_GET['id_product'])) {
    $id_product = intval($_GET['id_product']);
    if (produkDelete($id_product) > 0) {
        echo "<script>
                alert('Produk berhasil dihapus');
                window.location.href = '../../pages/admin/dashboard.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus produk');
                window.location.href = '../../pages/admin/dashboard.php';
            </script>";
    }
    exit;
}

// Kalau gak ada parameter yang valid
echo "<script>
        alert('ID tidak valid');
        window.location.href = '../../pages/admin/dashboard.php';
    </script>";
?>
