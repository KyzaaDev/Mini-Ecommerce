<?php 
require(__DIR__ . "/../config/db.php");

// Add a new rating
function addRating($product_id, $user_id, $rating, $review = '') {
    global $conn;
    
    // Validate rating
    if ($rating < 1 || $rating > 5) {
        return ['success' => false, 'message' => 'Rating harus antara 1-5'];
    }
    
    // Check if user already rated this product
    $check_query = "SELECT id FROM ratings WHERE product_id = ? AND user_id = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, "ii", $product_id, $user_id);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // Update existing rating
        $update_query = "UPDATE ratings SET rating = ?, review = ?, created_at = CURRENT_TIMESTAMP WHERE product_id = ? AND user_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, "isii", $rating, $review, $product_id, $user_id);
        
        if (mysqli_stmt_execute($update_stmt)) {
            return ['success' => true, 'message' => 'Rating berhasil diperbarui'];
        } else {
            return ['success' => false, 'message' => 'Gagal memperbarui rating'];
        }
    } else {
        // Insert new rating
        $insert_query = "INSERT INTO ratings (product_id, user_id, rating, review) VALUES (?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "iiis", $product_id, $user_id, $rating, $review);
        
        if (mysqli_stmt_execute($insert_stmt)) {
            return ['success' => true, 'message' => 'Rating berhasil ditambahkan'];
        } else {
            return ['success' => false, 'message' => 'Gagal menambahkan rating'];
        }
    }
}

// Get average rating for a product
function getAverageRating($product_id) {
    global $conn;
    
    $query = "SELECT AVG(rating) as avg_rating, COUNT(*) as total_ratings FROM ratings WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $data = mysqli_fetch_assoc($result);
    return [
        'average' => round($data['avg_rating'], 1),
        'total' => $data['total_ratings']
    ];
}

// Get all reviews for a product
function getProductReviews($product_id) {
    global $conn;
    
    $query = "SELECT r.*, u.username FROM ratings r 
              JOIN users u ON r.user_id = u.id 
              WHERE r.product_id = ? 
              ORDER BY r.created_at DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $reviews = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
    
    return $reviews;
}

// Get user's rating for a product
function getUserRating($product_id, $user_id) {
    global $conn;
    
    $query = "SELECT rating, review FROM ratings WHERE product_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $product_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_assoc($result);
}

// Get top rated products
function getTopRatedProducts($limit = 5) {
    global $conn;
    
    $query = "SELECT p.*, AVG(r.rating) as avg_rating, COUNT(r.id) as total_ratings 
              FROM product p 
              LEFT JOIN ratings r ON p.id = r.product_id 
              GROUP BY p.id 
              HAVING avg_rating IS NOT NULL 
              ORDER BY avg_rating DESC, total_ratings DESC 
              LIMIT ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row['avg_rating'] = round($row['avg_rating'], 1);
        $products[] = $row;
    }
    
    return $products;
}

// Get all ratings by a user
function getUserRatings($user_id) {
    global $conn;
    
    $query = "SELECT r.*, p.nama_product, p.pic 
              FROM ratings r 
              JOIN product p ON r.product_id = p.id 
              WHERE r.user_id = ? 
              ORDER BY r.created_at DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $ratings = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ratings[] = $row;
    }
    
    return $ratings;
}

?>