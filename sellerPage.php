<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Inter:wght@400;500;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-purple: rgba(169, 89, 232, 1);
            --light-purple: rgba(232, 202, 251, 1);
            --dark-purple: rgba(135, 54, 189, 1);
            --white: rgba(255, 255, 255, 1);
            --black: rgba(0, 0, 0, 1);
            --gray: rgba(99, 99, 99, 1);
            --red: rgba(255, 87, 87, 1);
            --green: rgba(96, 189, 105, 1);
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--white);
        }

        .header {
            background-color: var(--white);
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            padding: 1rem;
        }
        .search-bar {
            border-radius: 20px;
            border: 4px solid var(--dark-purple);
            background-color: var(--white);
            padding: 1rem;
            color: var(--primary-purple);
            font-weight: 700;
        }

        .manage-gallery-btn {
            background-color: var(--light-purple);
            border-radius: 10px;
            box-shadow: 7px 10px 4px rgba(0, 0, 0, 0.25);
            color: var(--primary-purple);
            padding: 1.5rem;
            font-weight: 700;
        }
        
        .artwork-card {
            background-color: var(--light-purple);
            border-radius: 10px;
            box-shadow: 7px 10px 4px rgba(0, 0, 0, 0.25);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .profile-img {
            border-radius: 25px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            width: 156px;
            height: auto;
        }

        .avatar {
            border-radius: 100px;
            width: 61px;
            height: auto;
        }

        .btn-add-artwork {
            border-radius: 10px;
            border: 1px solid var(--gray);
            color: var(--gray);
            padding: 1rem 2rem;
            font-size: 2rem;
            font-family: 'Inter', sans-serif;
        }

        .btn-delete {
            background-color: var(--red);
            border-radius: 15px;
            color: var(--white);
            padding: 1rem 4rem;
            font-size: 2.25rem;
            font-weight: 700;
        }

        .btn-confirm {
            background-color: var(--green);
            border-radius: 15px;
            color: var(--white);
            padding: 1rem 4rem;
            font-size: 2.25rem;
            font-weight: 700;
        }

        .modal-delete {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 4rem;
        }

        @media (max-width: 991px) {
            .artwork-card {
                margin: 1rem 0;
            } 
            .btn-add-artwork,
            .btn-delete,
            .btn-confirm {
                padding: 0.75rem 2rem;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar header">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="images/CAMBA.png" alt="Logo" width="209" height="auto">
                </a>
                <span class="fs-4">Home</span>
            </div>
        </nav>

        <main class="container my-4">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="search-bar">
                        Search artwork...
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="manage-gallery-btn">
                        Manage Gallery
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-3">
                    <div class="artwork-card">
                        <div class="text-center">
                            <img src="images/Onin.jpg" alt="Profile" class="profile-img mb-3">
                            <h2 class="fs-4 fw-bold">Onin</h2>
                        </div>
                        <div class="mt-4">
                            <p class="mb-2">Cebu City, Philippines</p>
                            <p>@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="artwork-card">
                        <h1 class="fs-2 mb-4">Manage Your Artworks</h1>
                        <button class="btn btn-add-artwork w-100 mb-4">Add New Artwork +</button>
                        <h2 class="fs-3 text-center mb-4">Your Existing Artworks</h2>
                        <div class="artwork-list">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="artwork-card">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h3 class="fs-5 fw-bold">"Resting in Peace"</h3>
                                                <p>Mixed Media: Recycled Plastic Bags & Oil Paint</p>
                                                <p>Size: 25" x 30"</p>
                                                <p>Year: 2023</p>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="d-flex align-items-center">
                                                    <span class="me-3 fw-bold">Xanne</span>
                                                    <img src="" alt="Artist" class="avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="modal-delete position-fixed top-0 start-0 w-100 h-100 d-none">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="bg-white p-5 text-center">
                            <img src="" alt="Delete" width="145" height="auto" class="mb-4">
                            <h2 class="fs-1 mb-5">Are you sure you want to delete this artwork?</h2>
                            <div class="d-flex justify-content-center gap-4">
                                <button class="btn btn-delete">Cancel</button>
                                <button class="btn btn-confirm">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>