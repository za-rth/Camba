// Function to disable right-click on images
function disableRightClick(event) {
    event.preventDefault();
    alert("Right-clicking is disabled on this image.");
}

// Function to format input with commas
function formatInput(input) {
    let value = input.value.replace(/[^0-9]/g, '');
    input.value = Number(value).toLocaleString('en');
}

// Confirm and validate bid
function confirmBid() {
    const currentBidPrice = 102000; // Example current bid price
    const startingPrice = 94000; // Example starting price
    const bidInputRaw = document.getElementById("bidInput").value.replace(/,/g, ''); // Removing commas
    const userBid = parseFloat(bidInputRaw);

    if (isNaN(userBid) || userBid <= currentBidPrice) {
        alert("Your bid must be higher than the current bid price of P" + currentBidPrice.toLocaleString());
        return;
    } else if (userBid <= startingPrice) {
        alert("Your bid must be higher than the starting price of P" + startingPrice.toLocaleString());
        return;
    }

    // If valid, confirm the bid
    if (confirm("Are you sure you want to place a bid of P" + userBid.toLocaleString() + "?")) {
        // Here you would normally handle the logic to send the bid to the server.
        alert("Your bid of P" + userBid.toLocaleString() + " has been accepted!");

        // Clear the bid input
        document.getElementById("bidInput").value = '';
    }
}


// Exit button functionality
document.getElementById("exit")?.addEventListener("click", function() {
    window.location.href = "auction.html"; // Navigate back to auction page
});
