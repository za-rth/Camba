<?php
include 'config.php';

session_start();

// Check if there is an active session
if (!isset($_SESSION['USER_ID'])) {
    // If no active session, redirect to login page
    header('Location: ../');
    exit();
}

// Clear session variables
$_SESSION = [];

// Destroy the session completely
session_unset();
session_destroy();

// Redirect to the login page with a confirmation alert
echo "<script>
        alert('You have been logged out.');
        window.location.href='../';
      </script>";
exit();
