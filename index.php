<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php include("./includes/header.php")?>

    <!-- main -->
    <h2>Our Popular Product</h2>
    <div class="container">
        <div class="produk">
        <?php for ($i = 0; $i < 7; $i++) :?>
            <div class="card-katalog">
                <img src="https://placehold.co/200x150" alt="">
                <h3>RTX 3050</h3>
                <p>Stok: 50</p>
                <p>Harga: RP 5.500.000</p>
                <button type="submit">Tambah ke keranjang</button>
            </div>
            <br>
        <?php endfor;?>
        </div>
    </div>

    <?php include("./includes/footer.php")?>
</body>
</html>