<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

if (isset($_GET['artwork_id'])) {
    $artwork_id = $_GET['artwork_id'];
    $user_id = $_SESSION['user_id'];

    // Prepare the query to fetch the artwork details
    $sql = "SELECT `ARTWORK_ID`, `TITLE`, `DESCRIPTION`, `QTYONHAND`, `UNITPRICE`, `IMG_NAME`
            FROM `artwork_product_info`
            WHERE `ARTWORK_ID` = ? AND `USER_ID` = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ii", $artwork_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $artwork = $result->fetch_assoc();
        echo json_encode($artwork);
    } else {
        echo json_encode(['error' => 'Artwork not found or unauthorized access']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
