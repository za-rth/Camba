<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Validate required fields
    if (
        empty($_POST['ArtTitle']) ||
        empty($_POST['ArtDescription']) ||
        empty($_POST['quantity']) ||
        empty($_POST['price']) ||
        empty($_POST['imageName']) // Validate the image filename
    ) {
        echo "<script>alert('Please fill in all required fields.');</script>";
    } else {
        $art_title = $_POST['ArtTitle'];
        $art_description = $_POST['ArtDescription'];
        $qty = (int) $_POST['quantity']; // Ensure integer
        $price = (float) $_POST['price']; // Ensure float
        $img_name = $_POST['imageName']; // Only get the filename

        // Prepare SQL query
        $sql = $connection->prepare("INSERT INTO `artwork_product_info` 
            (`TITLE`, `DESCRIPTION`, `QTYONHAND`, `UNITPRICE`, `IMG_NAME`, `USER_ID`, `LAST_UPDATE`) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        $sql->bind_param("ssidsi", $art_title, $art_description, $qty, $price, $img_name, $_SESSION['user_id']);

        // Execute the query
        if ($sql->execute()) {
            echo "<script>alert('Artwork added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding artwork: " . $sql->error . "');</script>";
        }

        $sql->close();
    }
}