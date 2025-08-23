<?php 
require __DIR__ . "../../../controllers/produk.php";
$products = latestProduct();
$users = getUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP MYSQL</title>
    <link rel="stylesheet" href="../../assets/css/dashboardstyle.css">
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
                <h1>Selamat Datang, Admin!</h1>
            </section>

            <section class="stats">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text fs-5"><?= count($products) ?></p>
                    </div>
                </div>
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total User</h5>
                        <p class="card-text fs-5"><?= count($users) ?></p>
                    </div>
                </div>
            </section>

            <section class="data-sec">
                <h3>Data Terbaru!</h3>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Product</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Dibuat pada</th>
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
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </section>  
        </main>
    </div>


</body>
</html>
