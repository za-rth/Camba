<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
                <a href="#" class="nav-link">Home</a>
                <a href="#" class="nav-link">View Gallery</a>
                <a href="#" class="nav-link">View Cart</a>
                <a href="#" class="nav-link" onclick="handleLogout()">Logout</a>
            </nav>
        </header>
        
        <main class="main-container">
        <div class="profile-section">
            <div class="profile-header">
                <div class="profile-image-section">
                    <img src="images/Onin.jpg" alt="Profile" class="profile-image">
                    <button class="change-picture-btn" onclick="handleChangePicture()">Change Picture</button>
                    <input type="file" id="changePictureInput" accept="image/*" style="display: none;" onchange="handlePictureChange(event)">
                </div><br><br><br>
                <div class="profile-info">
                    <h1 class="mb-5">Edit Profile</h1>
                    <div class="mb-4">
                        <label class="form-label">User ID</label>
                        <div class="d-flex gap-4">
                            <input type="text" class="form-control" value="1003" readonly>
                            <button class="btn btn-save" onclick="handleSaveChanges()">Save Changes</button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label required-field">Name</label>
                        <div class="d-flex gap-4">
                            <input type="text" class="form-control" value="">
                            <button class="btn btn-delete" onclick="handleDeleteAccount()">Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label required-field">Phone Number</label>
                    <input type="tel" class="form-control" value="">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Home Phone Number</label>
                    <input type="tel" class="form-control">
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <label class="form-label required-field">Address</label>
                    <input type="text" class="form-control" value="">

                    <div class="row g-4 mt-3">
                        <div class="col-md-6">
                            <label class="form-label required-field">State</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required-field">Postcode</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label required-field">City</label>
                    <input type="text" class="form-control" value="">
                    
                    <label class="form-label required-field mt-3">Country</label>
                    <input type="text" class="form-control" value="">
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label required-field">Birthday</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Account Creation Date</label>
                    <input type="text" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Account Type</label>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>

            <p class="text-danger mt-4">Required Fields*</p>

            <div class="change-password-section">
                <div class="row g-4">
                <div class="col-md-4">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <button class="btn btn-change-password" onclick="handleChangePassword()">Change Password</button>
            </div>
        </div>
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
                reader.onload = function(e) {
                    document.querySelector('.profile-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>

