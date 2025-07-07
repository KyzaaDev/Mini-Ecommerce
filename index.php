<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header + Navbar-->
    <header>
        <h1>Selamat datang!</h1>

        <nav>
            <a href="#">Hardware</a>
            <a href="#">IoT</a>
            <a href="#">Tentang Perusahaan kami</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

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
    <footer><p>&copy; 2025 KyzaaDev's team. All rights reserved.</p></footer>
</body>
</html>