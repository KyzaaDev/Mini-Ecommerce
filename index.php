<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="./assets/css/indexstyle.css">
    <style>
        .rating-display {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 5px 0;
        }
        
        .rating-stars {
            color: #ffd700;
            font-size: 14px;
        }
        
        .rating-text {
            font-size: 12px;
            color: #666;
        }
        
        .top-rated-section {
            margin: 40px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <?php include("./includes/header.php")?>

    <!-- Top Rated Products Section -->
    <?php 
    require("./controllers/rating.php");
    $top_rated = getTopRatedProducts(4);
    if (!empty($top_rated)):
    ?>
    <div class="top-rated-section">
        <h2 class="section-title">⭐ Produk Terpopuler</h2>
        <div class="container">
            <div class="produk">
                <?php foreach ($top_rated as $product): ?>
                    <div class="card-katalog">
                        <a href="./pages/detail.php?id=<?= $product["id"]?>">
                            <img src='./assets/images/<?= $product["pic"]?>' alt="">
                            <h3><?= htmlspecialchars($product["nama_product"]);?></h3>
                        </a>
                        <p>Stok: <?= $product["stok"];?></p>
                        <p>Harga: RP <?= number_format($product["harga"], 0, ",", ".");?></p>
                        <div class="rating-display">
                            <div class="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?= $i <= $product['avg_rating'] ? 'filled' : '' ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-text"><?= $product['avg_rating'] ?> (<?= $product['total_ratings'] ?> ulasan)</span>
                        </div>
                        <button type="submit">Tambah ke keranjang</button>
                    </div>
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- main -->
    <h2>Our Popular Products</h2>
    <div class="container">
        <div class="produk">

        <?php require("./controllers/produk.php");
        $daftarProduk = produkList(); ?>

        <?php foreach ($daftarProduk as $product) :?>
            <?php 
            $rating_data = getAverageRating($product['id']);
            ?>
            <div class="card-katalog">
                <a href="./pages/detail.php?id=<?= $product["id"]?>">
                    <img src='./assets/images/<?= $product["pic"]?>' alt="">
                    <h3><?= htmlspecialchars($product["nama_product"]);?></h3>
                </a>
                    <p>Stok: <?= $product["stok"];?></p>
                    <p>Harga: RP <?= number_format($product["harga"], 0, ",", ".");?></p>
                    <div class="rating-display">
                        <div class="rating-stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star <?= $i <= $rating_data['average'] ? 'filled' : '' ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        <span class="rating-text"><?= $rating_data['average'] ?> (<?= $rating_data['total'] ?> ulasan)</span>
                    </div>
                    <button type="submit">Tambah ke keranjang</button>
                </div>
                <br>
        <?php endforeach;?>
        </div>
    </div>

    <?php include("./includes/footer.php")?>
</body>
</html>