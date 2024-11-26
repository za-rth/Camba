<?php
include dirname(__DIR__) . '/config.php';

/*session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    echo "<script>alert('Are you sure you want to logout.')</script>";
    header('Location: login.php');
    exit();
}
session_abort();
session_destroy();
exit;
*/

session_start();

$USER_ID = $_GET['USER_ID'];
if (!isset($_SESSION['USER_ID'])) {
    // Redirect to the login page if no active session
    echo "<script>alert('Are you sure you want to logout.')</script>";
    header('Location: ../index.php');
    exit();
}

// Optional confirmation alert
echo "<script>alert('You have been logged out.');</script>";

// Clear session variables
$_SESSION = [];

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header('Location: ../index.php');
exit();
