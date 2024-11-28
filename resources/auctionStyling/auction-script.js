// auction-script.js

function placeBid(auctionId) {
    // Function to handle bid placement
    console.log('Bid button clicked for auction ID: ' + auctionId);
    alert('You clicked Place Bid for Auction ID: ' + auctionId);
}

function disableRightClick(event) {
    event.preventDefault();
    alert("Right-clicking is disabled on this image.");
}
