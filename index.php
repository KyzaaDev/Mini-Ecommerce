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
    <h2>Our Popular Products</h2>
    <div class="container">
        <div class="produk">

        <?php require("./controllers/produk.php");
        $daftarProduk = produkList(); ?>

        <?php foreach ($daftarProduk as $product) :?>
            <div class="card-katalog">
                <a href="#">
                    <img src='./assets/images/<?= $product["pic"]?>' alt="">
                    <h3><?= htmlspecialchars($product["nama_product"]);?></h3>
                </a>
                    <p>Stok: <?= $product["stok"];?></p>
                    <p>Harga: RP <?= number_format($product["harga"], 0, ",", ".");?></p>
                    <button type="submit">Tambah ke keranjang</button>
                </div>
                <br>
        <?php endforeach;?>
        </div>
    </div>

    <?php include("./includes/footer.php")?>
</body>
</html>