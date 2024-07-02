<?php
if ( ! isset($_SERVER[·HTTPS'] ) ) {
    $url = ' h t t p s ://1 . $_SERVER[ 1HTTPHOST1] . $_SERVER[ 1REQUESTURI1]
    header("Location: " . $ u rl); 
    exit () ;
    }
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
require('../model/database.php');
require('../model/product_db.php');
require('../model/genre_db.php');
require('../model/author_db.php');

// Initialize variables
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'list_products');
$admin_username = 'admin';
$admin_password_hash = '$2y$10$I662rv3uo9.O6G3ahZ0ITeiH1..YqsCcCUimTnal.cLqOqoV1Cuza';

function is_admin() {
    global $admin_username;
    return isset($_SESSION['username']) && $_SESSION['username'] === $admin_username;
}

$is_admin_logged_in = is_admin();
switch ($action) {
    case 'list_products':
        $genre_id = isset($_GET['genre_id']) ? $_GET['genre_id'] : 1;
        $genre_name = get_genre_name($genre_id);
        $genres = get_genres();
        $products = get_products_by_genre($genre_id);
        $authors = get_authors();
        include('product_list.php');
        break;

    case 'delete_product':
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $genre_id = isset($_POST['genre_id']) ? $_POST['genre_id'] : 1;

        if (!$product_id) {
            $error = "Product ID is missing.";
            include('../errors/error.php');
            exit;
        }

        delete_product($product_id);
        header("Location: .?genre_id=$genre_id");
        exit;

    case 'show_add_form':
        $genres = get_genres();
        $authors = get_authors();
        include('product_add.php');
        break;

        case 'add_product':
            $genre_id = $_POST['genre_id'];
            $author_id = $_POST['author_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $year = $_POST['year'];
            $description = $_POST['description'];
            $num_pages = $_POST['numpages'];
        
            $image = '';
            if (isset($_FILES['image'])) {
                echo "<pre>";
                print_r($_FILES['image']);
                echo "</pre>";
                
                if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    $upload_dir = '../images/';
                    $image_name = basename($_FILES['image']['name']);
                    $image_path = $upload_dir . $image_name;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        $image = $image_path;
                    } else {
                        echo "Error moving uploaded file.";
                    }
                } else {
                    echo "File upload error code: " . $_FILES['image']['error'];
                }
            } else {
                echo "No image uploaded.";
            }
        
            if (empty($name) || empty($price) || empty($author_id) || empty($year) || empty($description) || empty($num_pages)) {
                $error = "Invalid product data. Check all fields and try again.";
                include('../errors/error.php');
                exit;
            }
        
            add_product($genre_id, $author_id, $image, $name, $price, $year, $num_pages, $description);
            header("Location: .?genre_id=$genre_id");
            exit;
        

    case 'edit_product':
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $genre_id = isset($_POST['genre_id']) ? $_POST['genre_id'] : 1;

        if (!$product_id) {
            $error = "Product ID is missing.";
            include('../errors/error.php');
            exit;
        }

        $product = get_product($product_id);
        $genres = get_genres();
        $authors = get_authors();
        include('product_edit.php');
        break;

        case 'update_product':
            $product_id = $_POST['product_id'];
            $genre_id = $_POST['genre_id'];
            $author_id = $_POST['author_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $year = $_POST['year'];
            $description = $_POST['description'];
            $num_pages = $_POST['numpages'];
        
            $image = $_POST['current_image'];
            if (isset($_FILES['image'])) {
                echo "<pre>";
                print_r($_FILES['image']);
                echo "</pre>";
                
                if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    $upload_dir = '../images/';
                    $image_name = basename($_FILES['image']['name']);
                    $image_path = $upload_dir . $image_name;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        $image = $image_path;
                    } else {
                        echo "Error moving uploaded file.";
                    }
                } else {
                    echo "File upload error code: " . $_FILES['image']['error'];
                }
            } else {
                echo "No image uploaded.";
            }
        
            if (empty($name) || empty($price) || empty($author_id) || empty($year) || empty($description) || empty($num_pages)) {
                $error = "Invalid product data. Check all fields and try again.";
                include('../errors/error.php');
                exit;
            }
        
            edit_product($product_id, $genre_id, $author_id, $image, $name, $price, $year, $num_pages, $description);
            header("Location: .?genre_id=$genre_id");
            exit;
        
    default:
        $error = "Unknown action: $action";
        include('../errors/error.php');
        exit;
}
?>
