<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidding Page</title>
    <link rel="stylesheet" href="resources/bootstrap.css">
    <link rel="stylesheet" href="auction-style.css">
    <script src="/resources/auctionStyling/auction-script.js" defer></script>
</head>

<body>
    <div class="container mt-5">
        <header class="bg-primary text-white text-center py-4 mb-4">
            <h1><?php echo $title; ?> Bidding Portal</h1>
        </header>

        <div class="auction-details text-center">
            <?php


            $auctionId = $_GET['auction_id']; // Get the auction ID from URL
            $sql = "SELECT a.AUCTION_ID, p.TITLE, p.DESCRIPTION, p.UNITPRICE, p.IMG_NAME
                        FROM auction a 
                        JOIN artwork_product_info p ON a.ARTWORK_ID = p.ARTWORK_ID
                        WHERE a.AUCTION_ID = ?";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $auctionId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div oncontextmenu='disableRightClick(event)'>";
                echo "<img src='uploads/" . htmlspecialchars($row['IMG_NAME']) . "' alt='" . htmlspecialchars($row['TITLE']) . "' style='width:200px;height:auto;'>";
                echo "</div>";
                echo "<h2>" . htmlspecialchars($row["TITLE"]) . "</h2>";
                echo "<p>" . htmlspecialchars($row["DESCRIPTION"]) . "</p>";
                echo "<p class='lead'>Current Price: P" . number_format($row["UNITPRICE"], 2) . "</p>";
            } else {
                echo "<p>Auction not found.</p>";
                exit;
            }

            $stmt->close();
            $connection->close();
            ?>
            <input type="text" id="bidInput" class="form-control mb-3" placeholder="Enter your bid"
                oninput="formatInput(this)">
            <button onclick="confirmBid(<?php echo $auctionId; ?>, <?php echo $row['UNITPRICE']; ?>)"
                class="btn btn-success">Confirm Bid</button>
            <button onclick="window.location.href='auction.php'" class="btn btn-danger">Exit</button>
            <!-- Exit Button -->
        </div>
    </div>
</body>

</html>