<?php
session_start();
header('Content-Type: application/json');

require("../controllers/rating.php");

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
    exit();
}

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    $input = $_POST;
}

$product_id = isset($input['product_id']) ? (int)$input['product_id'] : 0;
$rating = isset($input['rating']) ? (int)$input['rating'] : 0;
$review = isset($input['review']) ? trim($input['review']) : '';

// Validate input
if (!$product_id || $rating < 1 || $rating > 5) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Data tidak valid']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Add rating
$result = addRating($product_id, $user_id, $rating, $review);

if ($result['success']) {
    // Get updated rating data
    $rating_data = getAverageRating($product_id);
    $result['rating_data'] = $rating_data;
}

echo json_encode($result);
?>