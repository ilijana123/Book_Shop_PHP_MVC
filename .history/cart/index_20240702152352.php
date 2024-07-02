<?php
session_start();

// Include necessary files
require('../model/database.php');
require('../model/product_db.php');
require('../model/account_db.php');
require('../model/cart_db.php');
require('../util/secure_conn.php');
require('../util/email.php'); // Include the email utility

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../account/index.php?action=show_login');
    exit;
}

$username = $_SESSION['username'];

// Retrieve accountID if not set in session or refresh session if needed
if (!isset($_SESSION['accountID'])) {
    $_SESSION['accountID'] = get_account_id($username);
}

// Action handling
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_products';

switch ($action) {
    case 'delete_from_cart':
        // Delete item from cart logic
        break;
    case 'update_cart':
        // Update cart item logic
        break;
    case 'add_to_cart':
        // Add to cart logic
        break;
    case 'cart_view':
        // Cart view logic
        break;
    case 'place_order':
        // Example of placing an order
        if (isset($_SESSION['cart'][$username]) && !empty($_SESSION['cart'][$username])) {
            // Clear cart after placing order
            unset($_SESSION['cart'][$username]);

            // Send confirmation email to the user
            $account = get_account($username);
            $to = $account['email'];
            $subject = 'Order Confirmation';
            $body = 'Thank you for your order! Your books will be shipped soon.';

            if (send_order_confirmation($to, $subject, $body)) {
                echo "<script>
                        alert('Thanks for buying! An email confirmation has been sent to you.');
                        window.location.href = '../product_catalog';
                      </script>";
            } else {
                echo "<script>
                        alert('Thanks for buying! However, we could not send an email confirmation.');
                        window.location.href = '../product_catalog';
                      </script>";
            }
            exit;
        } else {
            // Handle case where cart is empty
            header('Location: index.php?action=cart_view');
            exit;
        }
    default:
        // Default action, e.g., listing products
        break;
}
?>
