<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="./assets/css/indexstyle.css">
</head>
<body>
    <?php include("./includes/header.php")?>

    <!-- main -->
    <h2>Our Popular Product</h2>
    <div class="container">
        <div class="produk">

        <?php require("./controllers/produk.php");
        $daftarProduk = produkList(); ?>

        <?php foreach ($daftarProduk as $product) :?>
            <div class="card-katalog">
                <img src="https://placehold.co/200x150" alt="">
                <h3><?= $product["nama_product"]?></h3>
                <p>Stok: <?= $product["stok"];?></p>
                <p>Harga: RP <?= $product["harga"];?></p>
                <button type="submit">Tambah ke keranjang</button>
            </div>
            <br>
        <?php endforeach;?>
        </div>
    </div>

    <?php include("./includes/footer.php")?>
</body>
</html>