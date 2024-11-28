<?php
include 'config.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch the user's current profile data
$sql = "SELECT UPR.* 
        FROM USER_ACCOUNT UA 
        JOIN USER_PROFILE_REGISTRATION UPR ON UA.FK_REGISTER_ID = UPR.REGISTER_ID 
        WHERE UA.USER_ID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}
// Handle form submission for deleting profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    // Delete the user's profile and account from the database
    $delete_profile_sql = "DELETE FROM user_profile_registration WHERE REGISTER_ID = ?";
    $delete_account_sql = "DELETE FROM user_account WHERE USER_ID = ?";

    $delete_profile_stmt = $connection->prepare($delete_profile_sql);
    $delete_profile_stmt->bind_param("i", $user['REGISTER_ID']);
    $delete_account_stmt = $connection->prepare($delete_account_sql);
    $delete_account_stmt->bind_param("i", $user_id);

    // Execute the deletion queries
    if ($delete_profile_stmt->execute() && $delete_account_stmt->execute()) {
        echo "<script>alert('Account deleted successfully.');</script>";
        // Redirect to the homepage or logout after successful deletion
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error deleting account.');</script>";
    }
}