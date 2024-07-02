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
$email=
switch ($action) {
    case 'delete_from_cart':
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        
        if ($product_id) {
            // Delete the item from the database
            delete_cart_item_by_product_id($_SESSION['accountID'], $product_id);
            
            // Refresh session cart data after deletion
            refresh_session_cart($username);

            // Redirect back to cart view after deletion
            header('Location: index.php?action=cart_view');
            exit;
        }
        break;
    case 'update_cart':
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
        
        if ($product_id && $quantity > 0) {
            // Update cart item quantity in the database
            update_cart_item($_SESSION['accountID'], $product_id, $quantity);
            
            // Refresh session cart data after update
            refresh_session_cart($username);
        }

        // Redirect back to cart view after updating quantity
        header('Location: index.php?action=cart_view');
        exit;
    case 'add_to_cart':
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
        
        if (!$product_id || $quantity <= 0) {
            header('Location: index.php');
            exit;
        }

        // Get product details from the database
        $product = get_product($product_id);

        if ($product) {
            // Save cart information to database
            save_to_cart($username, $product_id, $quantity);

            // Refresh session cart data
            refresh_session_cart($username);
        }

        // Redirect to cart view after adding product
        header('Location: index.php?action=cart_view');
        exit;
    case 'cart_view':
        // Refresh session cart data before displaying cart view
        refresh_session_cart($username);
        include('cart_view.php');
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

            if (mail($to, $subject, $body)) {
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
