<?php
// PayMongo secret API key
$secretKey = "sk_test_HtbEbnDMp1tNyFDtu8mh4xdT";
$baseUrl = "https://api.paymongo.com/v1/payment_intents";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = (int)$_POST['amount'] * 100; // Convert amount to centavos (PayMongo uses centavos)
    
    $ch = curl_init();
    $headers = [
        'Authorization: Basic ' . base64_encode($secretKey . ':'),
        'Content-Type: application/json'
    ];

    $data = [
        "data" => [
            "attributes" => [
                "amount" => $amount,
                "payment_method_allowed" => ["card"],
                "currency" => "PHP",
                "capture_type" => "automatic"
            ]
        ]
    ];

    curl_setopt($ch, CURLOPT_URL, $baseUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        exit();
    }

    $response = json_decode($result, true);
    curl_close($ch);

    // Check if the payment intent was created successfully
    if (isset($response['data']['id'])) {
        $paymentIntentId = $response['data']['id'];
        $clientKey = $response['data']['attributes']['client_key'];

        // Redirect to payment page or display details for the next steps
        header("Location: confirm_payment.php?payment_intent_id=$paymentIntentId&client_key=$clientKey");
        exit();
    } else {
        echo "Failed to create payment intent: " . json_encode($response);
    }
}
?>
