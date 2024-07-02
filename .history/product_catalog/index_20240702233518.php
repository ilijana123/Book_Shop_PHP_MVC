<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/database.php';
require_once '../model/product_db.php';
require_once '../model/comment_db.php';
require_once '../model/account_db.php';
require_once '../model/genre_db.php';
require_once '../model/author_db.php';
require_once '../util/secure_conn.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? 'list_products';
include('../view/index.php');
if ($action == 'list_products') {
    $genre_id = filter_input(INPUT_GET, 'genre_id', FILTER_VALIDATE_INT);
    $author_id = filter_input(INPUT_GET, 'author_id', FILTER_VALIDATE_INT);

    $genres = get_genres();
    $authors = get_authors();

    if ($genre_id && !$author_id) {
        $genre_name = get_genre_name($genre_id);
        $products = get_products_by_genre($genre_id);
        $filtered_category_name = $genre_name;
    } elseif ($author_id && !$genre_id) {
        $author_name = get_author_name($author_id);
        $products = get_products_by_author($author_id);
        $filtered_category_name = $author_name;
    } else {
        $products = get_products();
        $filtered_category_name = 'All Products';
    }

    include('product_list.php');
} elseif ($action == 'view_product') {
    $genres = get_genres();
    $product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);

    if (!$product_id) {
        echo "Product ID is missing.";
        exit;
    }

    $product = get_product($product_id);
    if (!$product) {
        echo "Product not found.";
        exit;
    }

    $code = $product['productCode'];
    $name = $product['productTitle'];
    $list_price = $product['listPrice'];
    $year_published = $product['yearPublished'];
    $num_pages = $product['numPages'];
    $description = $product['description'];
    $author_id = $product['authorID'];
    $author_name = get_author_name($author_id);

    $discount_percent = 30;
    $discount_amount = round($list_price * ($discount_percent / 100.0), 2);
    $unit_price = $list_price - $discount_amount;
    $discount_amount = number_format($discount_amount, 2);
    $unit_price = number_format($unit_price, 2);

    $image_filename = '../images/' . $code . '.jpg';
    $image_alt = 'Image: ' . $code . '.jpg';

    $comments = get_comments_for_product($product_id);
    $user_logged_in = isset($_SESSION['username']) && !empty($_SESSION['username']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentText'])) {
        $commentText = trim($_POST['commentText']);
        if (!$user_logged_in) {
            header("Location: login.php");
            exit;
        }
        $username = $_SESSION['username'];
        $success = add_comment($product_id, $username, $commentText);

        if ($success) {
            header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . '?action=view_product&product_id=' . $product_id);
            exit;
        } else {
            echo "<p class='text-danger'>Failed to add comment. Please try again.</p>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment_id']) && isset($_POST['edit_commentText'])) {
        $edit_comment_id = filter_input(INPUT_POST, 'edit_comment_id', FILTER_VALIDATE_INT);
        $edit_commentText = trim($_POST['edit_commentText']);
        $username = $_SESSION['username'];

        $success = edit_comment($edit_comment_id, $username, $edit_commentText);

        if ($success) {
            header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . '?action=view_product&product_id=' . $product_id);
            exit;
        } else {
            echo "<p class='text-danger'>Failed to update comment. Please try again.</p>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment_id'])) {
        $delete_comment_id = filter_input(INPUT_POST, 'delete_comment_id', FILTER_VALIDATE_INT);
        $username = $_SESSION['username'];
        
        $success = delete_comment($delete_comment_id, $username);

        if ($success) {
            // Redirect back to the product view page after deletion
            header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . '?action=view_product&product_id=' . $product_id);
            exit;
        } else {
            echo "<p class='text-danger'>Failed to delete comment. Please try again.</p>";
        }
    }

    include('product_view.php');
}
?>
