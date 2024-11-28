<?php

include 'functions/deleteUser.php';
include 'config.php';


// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch the user's current profile data
$sql = "SELECT UPR.* FROM USER_ACCOUNT UA 
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
    $zip_code = (int) $_POST['zip_code'];
    $complete_address = htmlspecialchars($_POST['complete_address']);
    $gender = htmlspecialchars($_POST['gender']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $passphrase = $_POST['passphrase'];

    // Check if a new password is provided, if so, hash it
    if (!empty($passphrase)) {
        $new_password = $passphrase;
    } else {
        // If no new password, keep the existing one
        $hashed_password = $user['PASSPHRASE'];
    }

    // Update the user's data in the database
    $sql = "UPDATE user_profile_registration SET FIRSTNAME = ?, LASTNAME = ?, BIRTHDATE = ?, NATIONALITY = ?, COUNTRY = ?, STATE = ?, ZIP_CODE = ?, COMPLETE_ADDRESS = ?, GENDER = ?, EMAIL = ?, PASSPHRASE = ? WHERE REGISTER_ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssissssi", $firstname, $lastname, $birthdate, $nationality, $country, $state, $zip_code, $complete_address, $gender, $email, $new_password, $user['REGISTER_ID']);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!');</script>";
        // Optionally, redirect to a success page or refresh
        header("Location: editProfile.php");
        exit();
    } else {
        echo "<script>alert('Error updating profile: " . $stmt->error . "');</script>";
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    // Start a transaction to ensure all related data is deleted correctly
    $connection->begin_transaction();

    try {
        // Delete the user's profile and account from the database
        $delete_profile_sql = "DELETE FROM user_profile_registration WHERE REGISTER_ID = ?";
        $delete_account_sql = "DELETE FROM user_account WHERE USER_ID = ?";

        $delete_profile_stmt = $connection->prepare($delete_profile_sql);
        $delete_profile_stmt->bind_param("i", $user['REGISTER_ID']);
        $delete_account_stmt = $connection->prepare($delete_account_sql);
        $delete_account_stmt->bind_param("i", $user_id);

        // Execute the deletion queries
        if ($delete_profile_stmt->execute() && $delete_account_stmt->execute()) {
            // Commit the transaction after successful deletion
            $connection->commit();
            echo "<script>alert('Account deleted successfully.');</script>";
            // Redirect to the homepage or logout after successful deletion
            header("Location: index.php");
            exit();
        } else {
            // Rollback the transaction if any delete fails
            $connection->rollback();
            echo "<script>alert('Error deleting account. Please try again.');</script>";
        }

        $delete_profile_stmt->close();
        $delete_account_stmt->close();
    } catch (Exception $e) {
        // Rollback transaction if any exception occurs
        $connection->rollback();
        echo "<script>alert('An error occurred: " . $e->getMessage() . "');</script>";
    }

    $connection->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgba(165, 106, 189, 1);
            --secondary-color: rgba(96, 189, 105, 1);
            --danger-color: rgba(244, 8, 8, 1);
            --input-bg: rgba(217, 217, 217, 0.7);
            --text-color: rgba(0, 0, 0, 1);
            --white: rgba(255, 255, 255, 1);
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--white);
        }

        .header {
            background-color: var(--white);
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            padding: 12px 65px 12px 14px;
        }

        .logo {
            width: 157px;
            height: auto;
        }

        .nav-link {
            color: var(--text-color);
            font-size: 24px;
            margin: 0 35px;
        }

        .main-container {
            max-width: 1301px;
            margin: 64px auto;
            border-radius: 5px;
            border: 2px solid var(--text-color);
        }

        .profile-section {
            background-color: var(--primary-color);
            border-radius: 10px;
            box-shadow: 7px 10px 4px rgba(0, 0, 0, 0.25);
            padding: 38px 71px 63px;
        }

        .profile-header {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
        }

        .profile-image {
            width: 100%;
            max-width: 250px;
            border-radius: 10px;
        }

        .profile-image-section {
            position: relative;
        }

        .change-picture-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 5px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-control {
            background-color: var(--input-bg);
            border-radius: 15px;
            border: 1px solid var(--text-color);
            padding: 12px 15px;
            font-size: 20px;
        }

        .btn-save {
            background-color: var(--secondary-color);
            color: var(--white);
            border-radius: 15px;
            font-size: 32px;
            font-weight: 700;
            padding: 8px 69px;
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: var(--white);
            border-radius: 15px;
            font-size: 32px;
            font-weight: 700;
            padding: 6px 58px;
        }

        .required-field::after {
            content: "*";
            color: var(--danger-color);
            margin-left: 4px;
        }

        .change-password-section {
            border-top: 1px solid var(--text-color);
            margin-top: 83px;
            padding-top: 47px;
        }

        .btn-change-password {
            background-color: rgba(169, 89, 232, 1);
            color: var(--white);
            border-radius: 15px;
            font-size: 32px;
            font-weight: 700;
            width: 100%;
            max-width: 1172px;
            margin: 57px auto 0;
            padding: 7px 70px;
        }

        .footer {
            text-align: center;
            font-weight: 700;
            font-size: 16px;
            margin-top: 57px;
        }

        .modal-save {
            background-color: rgba(232, 202, 251, 1);
            border-radius: 10px;
        }

        .modal-save .modal-content {
            background: transparent;
            border: none;
        }

        .modal-save .btn {
            border-radius: 39px;
            background-color: rgba(135, 54, 189, 1);
            color: var(--white);
            font-size: 32px;
            font-weight: 700;
            padding: 10px 60px;
        }

        @media (max-width: 991px) {
            .header {
                padding-right: 20px;
            }

            .profile-section {
                padding: 38px 20px 63px;
            }

            .profile-header {
                flex-direction: column;
            }

            .btn-save,
            .btn-delete,
            .btn-change-password {
                padding: 8px 20px;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <header class="header d-flex justify-content-between align-items-center">
            <img src="images/CAMBA.png" alt="Company Logo" class="logo">
            <nav class="d-flex align-items-center">
                <a href="buyerPage.php" class="nav-link">Home</a>
                <a href="#" class="nav-link">View Gallery</a>
                <a href="#" class="nav-link">View Cart</a>
                <a href="#" class="nav-link" onclick="handleLogout()">Logout</a>
            </nav>
        </header>

        <main class="main-container">
            <h1 class="mb-5">Edit Profile</h1>
            <form action="" method="POST">
                <div class="mb-4">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstname"
                        value="<?php echo htmlspecialchars($user['FIRSTNAME'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname"
                        value="<?php echo htmlspecialchars($user['LASTNAME'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Birthdate</label>
                    <input type="date" class="form-control" name="birthdate"
                        value="<?php echo htmlspecialchars($user['BIRTHDATE'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Nationality</label>
                    <input type="text" class="form-control" name="nationality"
                        value="<?php echo htmlspecialchars($user['NATIONALITY'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control" name="country"
                        value="<?php echo htmlspecialchars($user['COUNTRY'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control" name="state"
                        value="<?php echo htmlspecialchars($user['STATE'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">ZIP Code</label>
                    <input type="text" class="form-control" name="zip_code"
                        value="<?php echo htmlspecialchars($user['ZIP_CODE'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Complete Address</label>
                    <input type="text" class="form-control" name="complete_address"
                        value="<?php echo htmlspecialchars($user['COMPLETE_ADDRESS'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label">Gender</label>
                    <select class="form-control" name="gender" required>
                        <option value="Male" <?php echo ($user['GENDER'] ?? '') == 'Male' ? 'selected' : ''; ?>>Male
                        </option>
                        <option value="Female" <?php echo ($user['GENDER'] ?? '') == 'Female' ? 'selected' : ''; ?>>
                            Female</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email"
                        value="<?php echo htmlspecialchars($user['EMAIL'] ?? ''); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="passphrase">
                </div>
                <button type="submit" name="update_profile" class="btn btn-save">Save Changes</button>

            </form>
            <form action="" method="POST">
                <button type="submit" name="delete_account" class="btn btn-danger">Delete Account</button>
            </form>


        </main>
        <footer class="footer">
            <p>© All right Reversed. CAMBa</p>
        </footer>

        <div class="modal fade" id="saveConfirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-save">
                    <div class="modal-body text-center p-5">
                        <img src="images/CAMBA.jpg" alt="Confirm" class="mb-4" width="145">
                        <h3 class="mb-5">Are you sure you want to save?</h3>
                        <div class="d-flex gap-4 justify-content-center">
                            <button class="btn" onclick="handleConfirmSave()">Yes</button>
                            <button class="btn" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function handleLogout() {
                alert('Logout clicked!');
                // Add logic for logout here
            }

            function handleSaveChanges() {
                let saveConfirmModal = new bootstrap.Modal(document.getElementById('saveConfirmModal'));
                saveConfirmModal.show();
            }

            function handleDeleteAccount() {
                if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                    alert('Account deleted successfully!');
                    // Add logic for deleting account here
                }
            }

            function handleChangePassword() {
                alert('Password changed successfully!');
                // Add logic for changing password here
            }

            function handleConfirmSave() {
                alert('Profile saved successfully!');
                let saveConfirmModal = bootstrap.Modal.getInstance(document.getElementById('saveConfirmModal'));
                saveConfirmModal.hide();
                // Add logic for saving changes here
            }

            function handleChangePicture() {
                document.getElementById('changePictureInput').click();
            }

            function handlePictureChange(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.querySelector('.profile-image').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>
</body>

</html>