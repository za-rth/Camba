<?php

include 'resources/bootstrap&googleFonts.php';
session_start();
$_SESSION["username"] = "TEST";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-purple: #e8cafb;
      --dark-purple: #a56abd;
      --shadow-purple: rgba(0,0,0, 0.25);
    }

    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #fff;
    }

    .dashboard {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .top-header {
        background: #fff;
        box-shadow: 0 4px 4px var(--shadow-color);
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        width: 157px;
        height: auto;
    }

    .search-container {
        margin: 3rem auto;
        width: 100%;
        max-width: 1305px;
        padding: 0 1rem;
    }
    .search-input {
        width: 100%;
        padding: 1rem 2rem;
        border-radius: 20px;
        border: none;
        background-color: #d9d9d9;
        font-size: 1.25rem;
        font-weight: 300;
    }
    .main-content {
        display: flex;
        gap: 1.25rem;
        padding: 1rem;
        max-width: 1408px;
        margin: 0 auto;
        width: 100%;
    }
    .sidebar {
        background: var(--primary-purple);
        box-shadow: 7px 10px 4px var(--shadow-color);
        padding: 1rem;
        border-radius: 0.5rem;
        width: 300px;
        flex-shrink: 0;
    }
    .profile-section {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .profile-image {
            width: 156px;
            height: 156px;
            border-radius: 25px;
            object-fit: cover;
            box-shadow: 0 4px 4px var(--shadow-color);
    }
    .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            margin: 0.5rem 0;
            transition: background-color 0.3s;
            border-radius: 0.5rem;
    }
    .nav-item:hover {
            background-color: var(--dark-purple);
            color: white;
    }
    .nav-icon {
            width: 42px;
            height: 42px;
    }
    .content-area {
            flex-grow: 1;
            background: var(--primary-purple);
            box-shadow: 7px 10px 4px var(--shadow-color);
            padding: 2rem;
            border-radius: 0.5rem;
    }
    .post-card {
            background: var(--dark-purple);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 7px 10px 4px var(--shadow-color);
    }
    .post-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
    }
    .post-title {
            font-size: 1rem;
            line-height: 1.5;
    }

        .post-author {
            display: flex;
            align-items: center;
            gap: 1rem;
    }
    .author-avatar {
            width: 63px;
            height: 63px;
            border-radius: 50%;
    }

        .post-image {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
    }
    .right-sidebar {
            background: var(--primary-purple);
            box-shadow: 7px 10px 4px var(--shadow-color);
            padding: 1.5rem;
            border-radius: 0.5rem;
            width: 250px;
            flex-shrink: 0;
    }
    @media (max-width: 992px) {
            .main-content {
                flex-direction: column;
            }

            .sidebar,
            .right-sidebar {
                width: 100%;
            }

            .profile-section {
                flex-direction: column;
                align-items: center;
            }
    }
    .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <header class="top-header">
      <img src="images/CAMBA.png" alt="Website Logo" class="logo">
        <nav aria-label="Main navigation">
                
                <button class="btn btn-link text-dark text-decoration-none fs-4"> <a href="buyerPage.php"></a>Home</button>
                <form action="functions/logOut.php"><button class="btn btn-link text-dark text-decoration-none fs-4" type="submit"> Log Out</button></form>
            </nav>
    </header>

    <div class="search-container">
            <form role="search">
                <label for="search" class="visually-hidden">Search</label>
                <input type="search" id="search" class="search-input form-control" placeholder="Search here...">
            </form>
    </div>

    <main class="main-content">
            <aside class="sidebar">
                <div class="profile-section">
                    <img src="images/Onin.jpg" alt="User Profile" class="profile-image">
                    <div>
                      <?php echo $_SESSION["username"]
                      
                      ?>
                        <h2 class="h5 fw-bold mb-1">Onin</h2>
                        <p class="mb-0"> Cay Aguanta</p>
                    </div>
                </div>

                <nav aria-label="Side navigation">
                    <div class="nav-item">
                        <img src="images/L1.jpg" alt="" class="nav-icon">
                        <span>Profile</span>
                    </div>
                    <div class="nav-item">
                        <img src="images/L2.jpg" alt="" class="nav-icon">
                        <span>Notification</span>
                    </div>
                    <div class="nav-item">
                        <img src="images/L4.jpg" alt="" class="nav-icon">
                        <span>Auction</span>
                    </div>
                    <div class="nav-item">
                        <img src="images/L3.jpg" alt="" class="nav-icon">
                        <span>Cart</span>
                    </div>
                    <div class="nav-item">
                        <img src="images/L5.jpg" alt="" class="nav-icon">
                        <span>Orders</span>
                    </div><div class="nav-item">
                        <img src="images/L6.jpg" alt="" class="nav-icon">
                        <span>Settings</span>
                    </div>
                </nav>
            </aside>

            <section class="content-area">
                <article class="post-card">
                    <div class="post-header">
                        <h3 class="post-title">
                            <strong>"Resting in Peace"</strong><br>
                            Mixed Media: Recycled Plastic Bags & Oil Paint<br>
                            Size: 25" x 30"<br>
                            Year: 2023
                        </h3>
                        <div class="post-author">
                            <span class="fw-bold">Xanne</span>
                            <img src="images/a.jpg" alt="Xanne's avatar" class="author-avatar">
                        </div>
                    </div>
                    <img src="images/a2.jpg" alt="Resting in Peace artwork" class="post-image">
                </article>

                <article class="post-card">
                    <div class="post-header">
                        <h3 class="post-title">
                            <strong>"Makabagong Filipina"</strong><br>
                            Mixed Media: Recycled Plastic Bags & Oil Paint<br>
                            Size: 40" x 30"<br>
                            Year: 2023
                        </h3>
                        <div class="post-author">
                        <span class="fw-bold">Xanne</span>
                        <img src="images/a.jpg" alt="Xanne's avatar" class="author-avatar">
                        </div>
                    </div>
                    <img src="images/a2.jpg" alt="Makabagong Filipina artwork" class="post-image">
                </article>
                <article class="post-card">
                    <div class="post-header">
                        <h3 class="post-title">
                            <strong>"Resting in Peace"</strong><br>
                            Mixed Media: Recycled Plastic Bags & Oil Paint<br>
                            Size: 25" x 30"<br>
                            Year: 2023
                        </h3>
                        <div class="post-author">
                            <span class="fw-bold">Xanne</span>
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fe7779d596b47110f79d69209108d3ba84b797c7a9b90a88e0ef967dce2e7218?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6" alt="Xanne's avatar" class="author-avatar">
                        </div>
                    </div>
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e259886a1325589643ceda877dc40c72b674cfcfcdcd2788f62a54f12063e8b8?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6" alt="Resting in Peace artwork" class="post-image">
                </article>
              </section>
              <aside class="right-sidebar">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d8d72e437a81be21bf193e285c5a35679778860d472733ac1a69c442b7faa2a5?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6" alt="Additional content" class="img-fluid">
            </aside>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>