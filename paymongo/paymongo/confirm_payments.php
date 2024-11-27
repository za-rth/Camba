<?php
// PayMongo secret API key
$secretKey = "sk_test_HtbEbnDMp1tNyFDtu8mh4xdT";
$baseUrl = "https://api.paymongo.com/v1/payment_methods";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['payment_intent_id']) && isset($_GET['client_key'])) {
    $paymentIntentId = $_GET['payment_intent_id'];
    $clientKey = $_GET['client_key'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
</head>
<body>
    <h1>Confirm Payment</h1>
    <form action="confirm_payment_action.php" method="POST">
        <input type="hidden" name="payment_intent_id" value="<?php echo htmlspecialchars($paymentIntentId); ?>">
        <input type="hidden" name="client_key" value="<?php echo htmlspecialchars($clientKey); ?>">

        <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" id="card_number" required><br>

        <label for="exp_month">Expiry Month:</label>
        <input type="text" name="exp_month" id="exp_month" required><br>

        <label for="exp_year">Expiry Year:</label>
        <input type="text" name="exp_year" id="exp_year" required><br>

        <label for="cvc">CVC:</label>
        <input type="text" name="cvc" id="cvc" required><br>

        <button type="submit">Submit Payment</button>
    </form>
</body>
</html>
