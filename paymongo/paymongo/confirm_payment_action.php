<?php
$secretKey = "sk_test_HtbEbnDMp1tNyFDtu8mh4xdT";
$baseUrl = "https://api.paymongo.com/v1/payment_methods";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentIntentId = $_POST['payment_intent_id'];
    $clientKey = $_POST['client_key'];

    // Card details from the form
    $cardNumber = $_POST['card_number'];
    $expMonth = $_POST['exp_month'];
    $expYear = $_POST['exp_year'];
    $cvc = $_POST['cvc'];

    $ch = curl_init();
    $headers = [
        'Authorization: Basic ' . base64_encode($secretKey . ':'),
        'Content-Type: application/json'
    ];

    $data = [
        "data" => [
            "attributes" => [
                "type" => "card",
                "details" => [
                    "card_number" => $cardNumber,
                    "exp_month" => $expMonth,
                    "exp_year" => $expYear,
                    "cvc" => $cvc
                ],
                "billing" => [
                    "name" => "Test User"
                ]
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

    // Check if the payment method was created successfully
    if (isset($response['data']['id'])) {
        $paymentMethodId = $response['data']['id'];

        // Attach Payment Method to Payment Intent
        attachPaymentMethod($paymentMethodId, $paymentIntentId, $clientKey, $secretKey);
    } else {
        echo "Failed to create payment method: " . json_encode($response);
    }
}

function attachPaymentMethod($paymentMethodId, $paymentIntentId, $clientKey, $secretKey) {
    $baseUrl = "https://api.paymongo.com/v1/payment_intents/$paymentIntentId/attach";
    $ch = curl_init();
    $headers = [
        'Authorization: Basic ' . base64_encode($secretKey . ':'),
        'Content-Type: application/json'
    ];

    $data = [
        "data" => [
            "attributes" => [
                "payment_method" => $paymentMethodId,
                "client_key" => $clientKey
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

    if (isset($response['data']['id'])) {
        echo "Payment successful! Payment ID: " . htmlspecialchars($response['data']['id']);
    } else {
        echo "Failed to confirm payment: " . json_encode($response);
    }
}
?>
