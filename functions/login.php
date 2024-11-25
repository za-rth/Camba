<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.')</script>";
    } else {
        // Prepare and execute the SQL query
        $sql = $connection->prepare("SELECT EMAIL,PASSWORD,USER_TYPE FROM  `user_account` WHERE `EMAIL` = ? AND `PASSWORD` = ?");
        $sql->bind_param("ss", $email, $password);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            // Fetch the user's details
            $row = $result->fetch_assoc();
            $userType = $row['USER_TYPE'];

            // Welcome message
            echo "<script>alert('Welcome')</script>";

            // Redirect based on USER_TYPE
            if ($userType === 'Buyer') {
                header("Location: buyerPage.php");
            } elseif ($userType === 'Artist') {
                header("Location: sellerPage.php");
            } else {
                echo "<script>alert('Invalid user type!')</script>";
            }
            exit; // Stop further script execution after redirect
        } else {
            echo "<script>alert('Invalid email or password')</script>";
        }

        $sql->close();
    }
}
