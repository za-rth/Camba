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

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    // Sanitize and validate the input data
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $birthdate = $_POST['birthdate'];
    $nationality = htmlspecialchars($_POST['nationality']);
    $country = htmlspecialchars($_POST['country']);
    $state = htmlspecialchars($_POST['state']);
    $zip_code = (int)$_POST['zip_code'];
    $complete_address = htmlspecialchars($_POST['complete_address']);
    $gender = htmlspecialchars($_POST['gender']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $passphrase = $_POST['passphrase'];

    // Check if a new password is provided, if so, hash it
    if (!empty($passphrase)) {
        $new_password = $passphrase;
    } else {
        // If no new password, keep the existing one
        $new_password = $user['PASSPHRASE'];
    }

    // Update the user's data in the database
    $sql = "UPDATE user_profile_registration SET FIRSTNAME = ?, LASTNAME = ?, BIRTHDATE = ?, NATIONALITY = ?, COUNTRY = ?, STATE = ?, ZIP_CODE = ?, COMPLETE_ADDRESS = ?, GENDER = ?, EMAIL = ?, PASSPHRASE = ? WHERE REGISTER_ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssissssi", $firstname, $lastname, $birthdate, $nationality, $country, $state, $zip_code, $complete_address, $gender, $email, $new_password, $user['REGISTER_ID']);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!');</script>";
        header("Location: editProfile.php");
        exit();
    } else {
        echo "<script>alert('Error updating profile: " . $stmt->error . "');</script>";
    }
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
        header("Location: logout.php");
        exit();
    } else {
        echo "<script>alert('Error deleting account.');</script>";
    }
}