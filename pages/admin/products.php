<?php 
require __DIR__ . "../../../controllers/produk.php";
$products = produkList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP MYSQL</title>
    <link rel="stylesheet" href="../../assets/css/dashboardstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- HEADER ADMIN -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <span class="navbar-brand mb-0 h1">
            <img src="https://img.icons8.com/color/48/000000/php.png" width="30" height="30" class="d-inline-block align-top" alt="">
            ADMIN CRUD DASHBOARD
        </span>
    </nav>

    <div class="wrapper">
        <!-- SIDEBAR -->
        <?php include("includes/sidebar.php") ?>
    
        <!-- MAIN CONTENT -->
        <main class="content">

            <section class="judul">
                <h1>CRUD Products Dashboard</h1>
            </section>

            <section class="data-sec">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Product</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Dibuat pada</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $product["id"] ?></th>
                            <td><?= $product["nama_product"] ?></td>
                            <td><?= $product["stok"] ?></td>
                            <td>RP <?= number_format($product["harga"], 0, ",", "."); ?></td>
                            <td><?= $product["created_at"] ?></td>
                            <td>
                                <a type="button" class="btn btn-danger" href="hapus.php?id=<?= $product['id']?>" onclick="return confirm('Yakin ingin menghapus produk?')" >Delete <i class="bi bi-trash-fill"></i></a>
                                <a type="button" class="btn btn-warning">Edit <i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </section>  
        </main>
    </div>


</body>
</html>
