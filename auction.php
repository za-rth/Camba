<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMBa AUCTION</title>
    <link rel="stylesheet" href="resources/bootstrap.css">
    
    <link rel="stylesheet" href="auction-style.css">
    

    <script src="/resources/auctionStyling/auction-script.js" defer></script>
</head>

<body>
    <div class="container mt-5">
        <header class="text-white text-center py-4 mb-4" style="background-color: #A021EF;">
            <h1><?php
            echo $title; ?> Auction Portal</h1>
        </header>
        <div id="auctionItems" class="row">
            <?php

            $sql = "SELECT a.AUCTION_ID, p.TITLE, p.DESCRIPTION, p.UNITPRICE, p.IMG_NAME
            FROM auction a
            JOIN artwork_product_info p ON a.ARTWORK_ID = p.ARTWORK_ID";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='auction-item col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<div oncontextmenu='disableRightClick(event)'>";
                    echo "<img src='uploads/" . htmlspecialchars($row['IMG_NAME']) . "' alt='" . htmlspecialchars($row['TITLE']) . "' style='width:200px;height:auto;'>";
                    echo "</div>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($row["TITLE"]) . "</h5>";
                    echo "<p class='card-text'>" . htmlspecialchars($row["DESCRIPTION"]) . "</p>";
                    echo "<p class='card-text'>Starting Price: P" . number_format($row["UNITPRICE"], 2) . "</p>";
                    echo "<a href='bidding.php?auction_id=" . $row["AUCTION_ID"] . "' class='btn btn-success'>View
                            Bidding</a>"; // Updated link
                    echo "</div>
                </div>
            </div>";
                }
            } else {
                echo "<div class='col-12'>
                <p>No auctions available.</p>
            </div>";
            }

            $connection->close();
            ?>
        </div>
    </div>
</body>

</html>