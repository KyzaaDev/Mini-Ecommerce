<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP MYSQL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">
            <img src="https://img.icons8.com/color/48/000000/php.png" width="30" height="30" class="d-inline-block align-top" alt="">
            CRUD PHP MYSQL
        </span>
    </nav>

    <!-- Container -->
    <div class="container mt-4">
        <h4>DATA</h4>
        <button class="btn btn-primary mb-3">+ Add New</button>


        <table class="table table-bordered table-striped">

            <!-- AMBIL DATA PRODUK -->
            <?php include("../../controllers/produk.php");
            $products = produkList();?>

            <thead class="thead-dark">
                <tr>
                    <th>ID Product</th>
                    <th>Nama Product</th>
                    <th>Harga Product</th>
                    <th>Stok Produk</th>
                    <th>Gambar Produk</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) : ?>
                <tr>
                    <td><?= $product["id"]; ?></td>
                    <td><?= $product["nama_product"]; ?></td>
                    <td><?= $product["stok"]; ?></td>
                    <td>RP <?= number_format($product["harga"], 0, ",","."); ?></td>
                    <td>
                        <img src='../../assets/images/<?= $product["pic"]?>' alt="gambar ngga ada nihh" style="width: 100px; height: 100px; object-fit: cover;">
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
