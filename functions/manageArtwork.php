<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Ensure the request method is POST and determine the function to execute (edit or delete)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_artwork']) || isset($_POST['delete_artwork'])) {
    if (isset($_POST['edit_artwork'])) {
        // Edit operation
        $artwork_id = $_POST['artwork_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $qty_on_hand = $_POST['qtyonhand'];
        $unit_price = $_POST['unitprice'];

        // Check if a new image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $imageName = $_FILES['image']['name'];
            $imagePath = 'uploads/' . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        } else {
            // If no new image is uploaded, retain the current one
            $imageName = $_POST['existing_image'] ?? ''; // Use a fallback if 'existing_image' is not set
        }

        // Update the artwork details in the database
        $sql = "UPDATE artwork_product_info 
                SET TITLE = ?, DESCRIPTION = ?, QTYONHAND = ?, UNITPRICE = ?, IMG_NAME = ?
                WHERE ARTWORK_ID = ? AND USER_ID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssidsii", $title, $description, $qty_on_hand, $unit_price, $imageName, $artwork_id, $user_id);

        if ($stmt->execute()) {
            echo "<script>alert('Artwork updated successfully')</script>.";
        } else {
            echo "Error updating artwork: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['delete_artwork'])) {
        // Delete operation
        $artwork_id = $_POST['artwork_id'];

        // Start a transaction to delete all related data
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
            echo "<script>alert('Artwork deleted successfully.');</script>";
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $connection->rollback();
            echo "<script>alert('Failed to delete artwork: " . $e->getMessage() . "');</script>";
        }

        $stmt->close();
    }
}