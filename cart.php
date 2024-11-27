<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .cart-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .header {
            background-color: #fff;
            box-shadow: 0 4px 4px rgba(0,0,0,0.25);
            padding: 12px 20px;
        }

        .logo {
            width: 157px;
            height: auto;
        }

        .nav-link {
            color: #000;
            font-size: 24px;
            font-family: 'Open Sans', sans-serif;
            margin: 0 35px;
        }

        .cart-item {
            background-color: #d9d9d9;
            margin: 20px 0;
            padding: 20px;
            border-radius: 5px;
        }

        .cart-image {
            width: 407px;
            height: 353px;
            object-fit: cover;
        }

        .cart-details {
            font-family: 'Inter', sans-serif;
            font-size: 24px;
            line-height: 1.5;
        }

        .checkout-btn {
            background-color: #60bd69;
            color: #fff;
            font-size: 36px;
            font-weight: 700;
            padding: 9px 70px;
            border-radius: 15px;
            border: none;
            margin: 40px 0;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            font-size: 18px;
        }

        .footer {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            padding: 20px 0;
        }

        @media (max-width: 991px) {
            .cart-image {
                width: 100%;
                height: auto;
            }
            
            .checkout-btn {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <header class="header d-flex justify-content-between align-items-center">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/79d01adef1c40803c0a9a9ec4008e71d633bbc8e6c8047182c3cc49d9b1493bc?placeholderIfAbsent=true&apiKey=1826919cd84f4b08ba6fcace3d6b37c6" alt="Logo" class="logo">
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="gallery.html" class="nav-link">View Gallery</a></li>
                    <li class="nav-item"><a href="cart.html" class="nav-link">View Cart</a></li>
                    <li class="nav-item"><a href="#" class="nav-link" onclick="logout()">Logout</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1 class="mt-5 mb-4">My Cart</h1>
            <div id="cartItems">
                <div class="cart-item">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="https://source.unsplash.com/random/407x353" alt="Product" class="cart-image">
                        </div>
                        <div class="col-lg-7">
                            <div class="cart-details">
                                <h2>Title</h2>
                                <p>Description</p>
                                <p>Price: P 9000.00</p>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-3">Quantity: 1</p>
                                    <button class="delete-btn" onclick="deleteItem(this)">Delete</button>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="checkout-btn d-block mx-auto" onclick="checkout()">CHECKOUT</button>
        </main>

        <footer class="footer">
            <p>© All rights Reserved. CAMBA</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteItem(button) {
            button.closest('.cart-item').remove();
        }

        function checkout() {
            window.location.href = 'checkout.html';
        }

        function logout() {
            if(confirm('Are you sure you want to logout?')) {
                window.location.href = 'login.html';
            }
        }
    </script>
</body>
</html>