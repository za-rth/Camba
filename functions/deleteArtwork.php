<?php
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if artwork ID is provided
if (isset($_POST['artwork_id'])) {
    $artwork_id = $_POST['artwork_id'];

    // Begin a transaction to ensure data integrity
    $connection->begin_transaction();

    try {
        // Delete from auction_prices table
        $sql = "DELETE FROM auction_prices WHERE AUCTION_ID IN (SELECT AUCTION_ID FROM auction WHERE ARTWORK_ID = ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $artwork_id);
        $stmt->execute();

        // Delete from auction table
        $sql = "DELETE FROM auction WHERE ARTWORK_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $artwork_id);
        $stmt->execute();

        // Delete from artwork_product_info table
        $sql = "DELETE FROM artwork_product_info WHERE ARTWORK_ID = ? AND USER_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $artwork_id, $user_id);
        $stmt->execute();

        // Commit the transaction
        $connection->commit();

        echo "Artwork deleted successfully.";
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $connection->rollback();
        echo "Failed to delete artwork: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
