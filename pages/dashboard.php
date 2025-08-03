<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require("../controllers/rating.php");

// Get user's ratings
$user_ratings = getUserRatings($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rating Saya</title>
    <link rel="stylesheet" href="../assets/css/indexstyle.css">
    <style>
        .dashboard-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .rating-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        
        .rating-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .stars {
            color: #ffd700;
            font-size: 16px;
        }
        
        .rating-date {
            color: #666;
            font-size: 12px;
        }
        
        .review-text {
            margin-top: 10px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 4px;
        }
        
        .no-ratings {
            text-align: center;
            padding: 40px;
            color: #666;
        }
    </style>
</head>
<body>
    <?php include("../includes/header.php")?>

    <div class="dashboard-container">
        <h1>Dashboard - Rating Saya</h1>
        
        <?php if (empty($user_ratings)): ?>
            <div class="no-ratings">
                <h3>Belum ada rating</h3>
                <p>Anda belum memberikan rating untuk produk apapun.</p>
                <a href="../index.php" style="color: #007bff;">Lihat produk</a>
            </div>
        <?php else: ?>
            <h2>Rating Anda (<?= count($user_ratings) ?>)</h2>
            
            <?php foreach ($user_ratings as $rating): ?>
                <div class="rating-item">
                    <div class="rating-header">
                        <div class="product-info">
                            <img src="../assets/images/<?= $rating['pic'] ?>" alt="<?= htmlspecialchars($rating['nama_product']) ?>" class="product-image">
                            <div>
                                <h4><?= htmlspecialchars($rating['nama_product']) ?></h4>
                                <div class="stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="star <?= $i <= $rating['rating'] ? 'filled' : '' ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <div class="rating-date">
                            <?= date('d/m/Y H:i', strtotime($rating['created_at'])) ?>
                        </div>
                    </div>
                    
                    <?php if ($rating['review']): ?>
                        <div class="review-text">
                            <strong>Review:</strong><br>
                            <?= htmlspecialchars($rating['review']) ?>
                        </div>
                    <?php endif; ?>
                    
                    <div style="margin-top: 10px;">
                        <a href="../pages/detail.php?id=<?= $rating['product_id'] ?>" style="color: #007bff; text-decoration: none;">
                            Lihat produk
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include("../includes/footer.php")?>
</body>
</html>