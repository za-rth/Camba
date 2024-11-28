<?php
   include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Order Details Page">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #A959E8;
            --secondary-color: #D99DFF;
            --background-color: #E8CAFB;
            --card-background: #fff;
            --text-color: #000;
            --button-color: #f40707;
            --button-hover: #d10808;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f5f5;
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar-custom {
            background-color: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
        }

        .nav-link {
            color: var(--text-color);
            font-weight: 600;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: var(--primary-color);
        }

        .order-details-container {
            max-width: 1100px;
            margin: 3rem auto;
            padding: 1rem;
        }

        .order-title {
            color: var(--primary-color);
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
        }

        .order-card {
            display: flex;
            flex-direction: row;
            background-color: var(--background-color);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        .product-image-container {
            flex: 1;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            height: 400px;
            margin-right: 2rem;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details {
            flex: 2;
            background-color: var(--card-background);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        .detail-label {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--primary-color);
        }

        .detail-value {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .cancel-btn {
            background-color: var(--button-color);
            color: #fff;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            font-weight: 700;
            margin-top: 1.5rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cancel-btn:hover {
            background-color: var(--button-hover);
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            padding: 1rem;
            margin-top: 3rem;
            background: #fff;
            font-weight: 700;
        }

        @media (max-width: 992px) {
            .order-card {
                flex-direction: column;
                align-items: center;
            }

            .product-image-container {
                margin-right: 0;
                margin-bottom: 2rem;
                height: 300px;
                width: 100%;
            }

            .product-details {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="assets/images/logo.png" alt="Company Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/gallery">View Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">View Cart</a>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link btn btn-link text-decoration-none" onclick="logout()">Logout</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="order-details-container">
            <h1 class="order-title">Order Details</h1>
            <div class="order-card">
                <div class="product-image-container">
                    <img id="productImage" src="assets/images/product-image.jpg" alt="Product Image"
                        class="product-image">
                </div>
                <div class="product-details">
                    <div class="detail-group">
                        <label class="detail-label" for="productTitle">Title:</label>
                        <div id="productTitle" class="detail-value">Example Title</div>
                    </div>
                    <div class="detail-group">
                        <label class="detail-label" for="productDescription">Description:</label>
                        <div id="productDescription" class="detail-value">Example Description</div>
                    </div>
                    <div class="detail-group">
                        <label class="detail-label" for="productPrice">Price:</label>
                        <div id="productPrice" class="detail-value">$100.00</div>
                    </div>
                    <div class="detail-group">
                        <label class="detail-label" for="productQuantity">Quantity:</label>
                        <div id="productQuantity" class="detail-value">1</div>
                    </div>
                    <button onclick="cancelOrder()" class="cancel-btn" aria-label="Cancel Order">
                        <i class="fas fa-times-circle me-2"></i>Cancel Order
                    </button>
                </div>
            </div>
        </main>

        <footer class="footer">
            <p>© All rights Reserved. CAMBA</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function cancelOrder() {
            try {
                const orderId = new URLSearchParams(window.location.search).get('id');
                if (!confirm('Are you sure you want to cancel this order?')) return;

                const response = await fetch(`/api/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    credentials: 'same-origin'
                });

                if (!response.ok) throw new Error('Failed to cancel order');

                alert('Order cancelled successfully');
                setTimeout(() => window.location.href = '/orders', 1500);
            } catch (error) {
                console.error('Error cancelling order:', error);
                alert('Failed to cancel order. Please try again.');
            }
        }

        async function logout() {
            try {
                const response = await fetch('/api/logout', {
                    method: 'POST',
                    credentials: 'include'
                });

                if (!response.ok) throw new Error('Logout failed');

                window.location.href = '/login';
            } catch (error) {
                console.error('Logout failed:', error);
                alert('Logout failed. Please try again.');
            }
        }
    </script>
</body>

</html>
