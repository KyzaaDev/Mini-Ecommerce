<?php
session_start();
require("../controllers/produk.php");
require("../controllers/rating.php");

// Get product ID from URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = getData($product_id);

if (!$product) {
    header("Location: ../index.php");
    exit();
}

// Handle rating submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_rating'])) {
    if (!isset($_SESSION['user_id'])) {
        $message = 'Silakan login terlebih dahulu untuk memberikan rating';
    } else {
        $rating = (int)$_POST['rating'];
        $review = $_POST['review'] ?? '';
        $user_id = $_SESSION['user_id'];
        
        $result = addRating($product_id, $user_id, $rating, $review);
        $message = $result['message'];
    }
}

// Get rating data
$rating_data = getAverageRating($product_id);
$reviews = getProductReviews($product_id);
$user_rating = null;

if (isset($_SESSION['user_id'])) {
    $user_rating = getUserRating($product_id, $_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['nama_product']) ?> - Detail Produk</title>
    <link rel="stylesheet" href="../assets/css/indexstyle.css">
    <style>
        .product-detail {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .product-info {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .product-image {
            flex: 0 0 400px;
        }
        
        .product-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        
        .product-details {
            flex: 1;
        }
        
        .rating-section {
            margin: 20px 0;
        }
        
        .stars {
            display: flex;
            gap: 5px;
            margin: 10px 0;
        }
        
        .star {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
        }
        
        .star.filled {
            color: #ffd700;
        }
        
        .rating-form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .review-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .review-stars {
            color: #ffd700;
        }
        
        .message {
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <?php include("../includes/header.php")?>

    <div class="product-detail">
        <div class="product-info">
            <div class="product-image">
                <img src="../assets/images/<?= $product['pic'] ?>" alt="<?= htmlspecialchars($product['nama_product']) ?>">
            </div>
            
            <div class="product-details">
                <h1><?= htmlspecialchars($product['nama_product']) ?></h1>
                <p><strong>Harga:</strong> Rp <?= number_format($product['harga'], 0, ",", ".") ?></p>
                <p><strong>Stok:</strong> <?= $product['stok'] ?> unit</p>
                
                <div class="rating-section">
                    <h3>Rating Produk</h3>
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star <?= $i <= $rating_data['average'] ? 'filled' : '' ?>">★</span>
                        <?php endfor; ?>
                    </div>
                    <p><?= $rating_data['average'] ?> / 5 (<?= $rating_data['total'] ?> ulasan)</p>
                </div>
                
                <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                    Tambah ke keranjang
                </button>
            </div>
        </div>
        
        <?php if ($message): ?>
            <div class="message <?= strpos($message, 'berhasil') !== false ? 'success' : 'error' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <!-- Rating Form -->
        <div class="rating-form">
            <h3>Berikan Rating & Review</h3>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form method="POST">
                    <div>
                        <label>Rating:</label>
                        <div class="stars" id="rating-stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star" data-rating="<?= $i ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" id="selected-rating" value="<?= $user_rating ? $user_rating['rating'] : '' ?>">
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <label for="review">Review (opsional):</label><br>
                        <textarea name="review" id="review" rows="4" style="width: 100%; padding: 8px;"><?= $user_rating ? $user_rating['review'] : '' ?></textarea>
                    </div>
                    
                    <button type="submit" name="submit_rating" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                        <?= $user_rating ? 'Update Rating' : 'Kirim Rating' ?>
                    </button>
                </form>
            <?php else: ?>
                <p>Silakan <a href="../pages/login.php">login</a> untuk memberikan rating</p>
            <?php endif; ?>
        </div>
        
        <!-- Reviews Section -->
        <div class="reviews-section">
            <h3>Ulasan Pengguna (<?= count($reviews) ?>)</h3>
            <?php if (empty($reviews)): ?>
                <p>Belum ada ulasan untuk produk ini.</p>
            <?php else: ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-item">
                        <div class="review-header">
                            <div>
                                <strong><?= htmlspecialchars($review['username']) ?></strong>
                                <div class="review-stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="star <?= $i <= $review['rating'] ? 'filled' : '' ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <small><?= date('d/m/Y H:i', strtotime($review['created_at'])) ?></small>
                        </div>
                        <?php if ($review['review']): ?>
                            <p><?= htmlspecialchars($review['review']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include("../includes/footer.php")?>

    <script>
        // Star rating functionality
        const ratingStars = document.getElementById('rating-stars');
        const selectedRating = document.getElementById('selected-rating');
        const stars = ratingStars.querySelectorAll('.star');
        
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                const rating = index + 1;
                selectedRating.value = rating;
                
                // Update visual stars
                stars.forEach((s, i) => {
                    if (i < rating) {
                        s.classList.add('filled');
                    } else {
                        s.classList.remove('filled');
                    }
                });
            });
        });
        
        // Initialize stars if user has existing rating
        const currentRating = selectedRating.value;
        if (currentRating) {
            stars.forEach((star, index) => {
                if (index < currentRating) {
                    star.classList.add('filled');
                }
            });
        }
    </script>
</body>
</html>