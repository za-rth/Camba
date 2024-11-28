<?php
session_start(); // Ensure session is started

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addArtworkForm'])) {
    // Validate required fields
    if (
        empty($_POST['ArtTitle']) ||
        empty($_POST['ArtDescription']) ||
        empty($_POST['quantity']) ||
        empty($_POST['price']) ||
        empty($_FILES['imageName']['name']) // Validate the image filename
    ) {
        echo "<script>alert('Please fill in all required fields.');</script>";
    } else {
        // Sanitize inputs
        $art_title = htmlspecialchars($_POST['ArtTitle']);
        $art_description = htmlspecialchars($_POST['ArtDescription']);
        $qty = (int) $_POST['quantity']; // Ensure integer
        $price = (float) $_POST['price']; // Ensure float

        // Handle file upload
        $target_dir = "uploads/"; // Specify the directory to store images
        $img_name = basename($_FILES['imageName']['name']);
        $target_file = $target_dir . $img_name;

        // Check if user_id is set in session
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['imageName']['tmp_name'], $target_file)) {
                // Prepare SQL query
                $sql = $connection->prepare("INSERT INTO `artwork_product_info` 
                    (`TITLE`, `DESCRIPTION`, `QTYONHAND`, `UNITPRICE`, `IMG_NAME`, `USER_ID`, `LAST_UPDATE`) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())");
                $sql->bind_param("ssidsi", $art_title, $art_description, $qty, $price, $img_name, $user_id);

                // Execute the query
                if ($sql->execute()) {
                    echo "<script>alert('Artwork added successfully!');</script>";
                } else {
                    echo "<script>alert('Error adding artwork: " . $sql->error . "');</script>";
                }

                $sql->close();
            } else {
                echo "<script>alert('Error uploading image file.');</script>";
            }
        } else {
            echo "<script>alert('User not logged in.');</script>";
        }
    }
}