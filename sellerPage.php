<?php
include 'config.php';
include 'resources/bootstrap&googleFonts.php';
session_start();
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Artist Dashboard - Manage and showcase your artwork">
    <title><?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-purple: rgba(169, 89, 232, 1);
            --light-purple: rgba(232, 202, 251, 1);
            --dark-purple: rgba(153, 40, 218, 1);
            --border-purple: rgba(135, 54, 189, 1);
            --white: #ffffff;
            --black: #000000;
            --shadow: rgba(0, 0, 0, 0.25);
        }

        .artist-dashboard {
            background-color: var(--white);
            min-height: 100vh;
        }

        .header {
            background-color: var(--white);
            box-shadow: 0 4px 4px var(--shadow);
            padding: 1rem 1.375rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            width: 209px;
            height: auto;
        }

        .search-section {
            margin-top: 2rem;
            padding: 0 1rem;
        }

        .search-wrapper {
            position: relative;
        }

        .search-box {
            border: 4px solid var(--border-purple);
            border-radius: 20px;
            padding: 1.125rem 4.375rem;
            color: var(--primary-purple);
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            background-color: rgb(255, 251, 251);
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .search-box:focus {
            outline: none;
            border-color: var(--dark-purple);
            box-shadow: 0 0 0 0.25rem rgba(153, 40, 218, 0.25);
        }

        .search-icon {
            position: absolute;
            right: 1.25rem;
            top: -2.5rem;
            width: 98px;
            height: auto;
        }

        .manage-gallery-btn {
            background-color: var(--light-purple);
            color: var(--primary-purple);
            border-radius: 10px;
            box-shadow: 7px 10px 4px var(--shadow);
            padding: 1.6875rem 4.375rem;
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            border: none;
            width: 100%;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .manage-gallery-btn:hover {
            transform: translateY(-2px);
            box-shadow: 7px 12px 6px var(--shadow);
        }

        .manage-gallery-btn:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(169, 89, 232, 0.25);
        }

        .profile-card {
            background-color: var(--light-purple);
            border-radius: 10px;
            box-shadow: 7px 10px 4px var(--shadow);
            padding: 2.4375rem 0;
            margin-top: 3.875rem;
        }

        .profile-image {
            width: 156px;
            height: 156px;
            border-radius: 25px;
            box-shadow: 0 4px 4px var(--shadow);
            margin: 0 auto;
            display: block;
            object-fit: cover;
        }

        .username {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            text-align: center;
            margin-top: 0.5rem;
            color: var(--black);
        }

        .stats {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0.75rem;
            font-size: 0.9375rem;
            color: var(--black);
        }

        .follow-btn {
            background-color: var(--dark-purple);
            color: var(--white);
            font-size: 0.5rem;
            font-weight: 700;
            padding: 0.3125rem 0.9375rem;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .follow-btn:hover {
            background-color: rgba(133, 20, 198, 1);
        }

        .artwork-card {
            background-color: rgba(165, 106, 189, 1);
            border-radius: 10px;
            box-shadow: 7px 10px 4px var(--shadow);
            padding: 0.9375rem;
            margin-bottom: 1.25rem;
            transition: transform 0.3s ease;
        }

        .artwork-card:hover {
            transform: translateY(-5px);
        }

        .artwork-title {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            font-size: 0.9375rem;
            color: var(--black);
        }

        .artwork-details {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9375rem;
            font-weight: 400;
            color: var(--black);
            line-height: 1.5;
        }

        .artist-tag {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--black);
        }

        .artist-avatar {
            width: 61px;
            height: 61px;
            border-radius: 50%;
            object-fit: cover;
        }

        .artwork-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 1rem;
        }

        @media (max-width: 991px) {
            .header {
                padding: 0.75rem 1.25rem;
            }

            .search-box,
            .manage-gallery-btn {
                padding: 1.125rem 1.25rem;
            }

            .artwork-card {
                margin: 0.9375rem 0;
            }

            .profile-card {
                margin-top: 2rem;
            }
        }

        @media (max-width: 576px) {
            .logo {
                width: 150px;
            }

            .search-icon {
                width: 70px;
                top: -2rem;
            }

            .profile-image {
                width: 120px;
                height: 120px;
            }

            .artist-avatar {
                width: 45px;
                height: 45px;
            }
        }

        .skip-link {
            position: absolute;
            left: -9999px;
            z-index: 999;
            padding: 1em;
            background-color: var(--white);
            color: var(--black);
            text-decoration: none;
        }

        .skip-link:focus {
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/CAMBA.png" width="125" alt="CAMBa Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item mr-3">
                        <button type="button" class="btn p-3 " 
                            style="border-color:#A021EF; background:#A021EF; color: #FFFFFF;">
                            Home</button>
                    </li>
                    
                    <li class="nav-item ml-3">
                        <button type="button" class="btn p-3 " 
                            style="border-color:#A021EF; color: #A021EF;" >
                            <a  href="functions/logOut.php" style="color: #A021EF;"></a>Logout</button>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="artist-dashboard">


        <main id="main-content">
            <div class="container search-section">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="search-wrapper">
                            <label for="artwork-search" class="visually-hidden">Search artwork</label>
                            <input type="search" id="artwork-search" class="search-box" placeholder="Search artwork..."
                                aria-label="Search artwork">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1502b3ba5cd9382ee1533e77a5f7043abfa6a2ead3d68dae50a330a9db2ca821?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6"
                                alt="" class="search-icon" aria-hidden="true">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <button class="manage-gallery-btn" aria-label="Manage Gallery"><a href="addartwork.php">Manage
                                Gallery</a></button>

                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <aside class="col-lg-3">
                        <div class="profile-card">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/09712380ac6c57b440e20ebd7c30d5ba5ec17b2bbf6272cc73685c8af38b472c?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6"
                                alt="Roxanne Normandia's profile" class="profile-image">
                            <div class="username">Xanne</div>
                            <div class="stats">
                                <span>Roxanne Normandia</span>
                                <span aria-label="12.4 thousand followers">12.4K</span>
                            </div>
                            <div class="d-flex justify-content-end px-3">
                                <button class="follow-btn" aria-label="Follow Xanne">Follow +</button>
                            </div>
                            <address class="text-center mt-3">
                                <div>Cebu City, Philippines</div>
                                <a href="mailto:roxanne.normandia@gmail.com"
                                    class="text-decoration-none text-dark mt-2 d-block">
                                    <?php echo htmlspecialchars($_SESSION["email"]); ?>
                                </a>
                            </address>
                        </div>
                    </aside>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6">
                                <article class="artwork-card">
                                    <h2 class="artwork-title">"Resting in Peace"</h2>
                                    <div class="artwork-details">
                                        <p>Mixed Media: Recycled Plastic Bags & Oil Paint<br>
                                            Size: 25" x 30"<br>
                                            Year: 2023</p>
                                    </div>
                                    <div class="artist-tag mt-3">
                                        <span>Xanne</span>
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fefb9d068771931f746ee34fbf53df7a5cf178726f6ce68900b95dc461485c81?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6"
                                            alt="" class="artist-avatar" aria-hidden="true">
                                    </div>
                                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/a67addcbdbd3014a5346263d225823f764ddfbdb21d526511141a9a1cffdef54?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6"
                                        alt="Resting in Peace artwork" class="artwork-image">
                                </article>
                            </div>

                            <div class="col-lg-6">
                                <article class="artwork-card">
                                    <h2 class="artwork-title">"Makabagong Filipina"</h2>
                                    <div class="artwork-details">
                                        <p>Mixed Media: Recycled Plastic Bags & Oil Paint<br>
                                            Size: 40" x 30"<br>
                                            Year: 2023</p>
                                    </div>
                                    <div class="artist-tag mt-3">
                                        <span>Xanne</span>
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/98e8b29755f5225abee9a3c08d49789ce2f0284e21802cb2006d77271592e1fc?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6"
                                            alt="" class="artist-avatar" aria-hidden="true">
                                    </div>
                                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/c380ae4db3eca73384ab931942ca8dc136136f8c32220fdf59ad8c34c98b27d7?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6"
                                        alt="Makabagong Filipina artwork" class="artwork-image">
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>