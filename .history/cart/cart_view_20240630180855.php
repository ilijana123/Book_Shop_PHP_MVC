<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../main.css">
    <style>
        body {
            background-image: url('https://static.vecteezy.com/system/resources/previews/004/299/830/original/shopping-online-on-phone-with-podium-paper-art-modern-pink-background-gifts-box-illustration-free-vector.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
        .info-box {
            border: 2px solid coral; 
            padding: 20px; 
            margin-bottom: 20px; 
            border-radius: 10px; 
            text-align: center; 
            font-size: 18px; 
            font-weight: bold;
            text-transform: uppercase; 
        }
        .total {
            font-size: 30px; 
            margin-top: 20px; 
        }
        .buy-button {
            background-color: coral;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        .buy-button:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include '../view/header.php'; ?>

    <!-- Main content -->
    <div id="main" class="container">
        <h1 class="top">Shopping Cart</h1>
        <?php if (empty($_SESSION['cart'][$username])) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['cart'][$username] as $item) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['productTitle']); ?></td>
                    <td>$<?php echo number_format($item['listPrice'], 2); ?></td>
                    <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="update_cart" />
                        <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>" />
                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control" style="width: 80px; display: inline-block;" />
                        <input type="submit" value="Update" class="btn btn-primary" />
                    </form>
                    </td>
                    <td>$<?php echo number_format($item['listPrice'] * $item['quantity'], 2); ?></td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="action" value="delete_from_cart" />
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>" />
                            <input type="submit" value="Remove" class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total"><b>Total: $<?php echo number_format(calculate_cart_total($_SESSION['cart'][$username]), 2); ?></b></p>
            <form id="placeOrderForm" action="index.php" method="post">
                <input type="hidden" name="action" value="place_order" />
                <button type="button" class="buy-button" onclick="placeOrder()">Place Order</button>
            </form>
        <?php endif; ?>
    </div>
    <div class="info-box">
        <p>Welcome to our book community! Here, you can enjoy our selection of books with the option to exchange them, but no refunds. We'll always notify you whenever a new book arrives on our Instagram page, so don't miss out on discovering something new and exciting.</p>
        <p>Thank you for being part of our literary adventure!</p>
        <p>Best regards,</p>
        <p>Book Shop</p>
    </div>

    <!-- Footer -->
    <?php include '../view/footer.php'; ?>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function placeOrder() {
            alert('Thanks for buying!');
            // Optionally, you can clear the cart via AJAX here if needed
            // handleBuy();
        }
        
        function handleBuy() {
            fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'action': 'clear_cart'
                })
            }).then(response => {
                if (response.ok) {
                    // Optionally, handle success if needed
                    window.location.reload(); // Reload the page to update the cart view
                } else {
                    alert("There was a problem processing your request.");
                }
            }).catch(error => {
                console.error('Error:', error);
                alert("There was a problem processing your request.");
            });
        }
    </script>
</body>
</html>