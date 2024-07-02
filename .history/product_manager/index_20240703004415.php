// Ensure HTTPS
if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $url);
    exit();
}

// Start the session
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Include necessary files
require('../model/database.php');
require('../model/product_db.php');
require('../model/genre_db.php');
require('../model/author_db.php');
require('../model/admin_db.php');

// Initialize variables
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'list_products');

// Include the index view
include('../view/index.php');

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
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image_path = handle_image_upload($_FILES['image']);
                $image = $image_path;
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
        
        $image_path = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_path = handle_image_upload($_FILES['image']);
        } else {
            $product = get_product($product_id);
            $image_path = $product['productCode'];
        }

        if (empty($name) || empty($price) || empty($author_id) || empty($year) || empty($description) || empty($num_pages)) {
            $error = "Invalid product data. Check all fields and try again.";
            include('../errors/error.php');
            exit;
        }

        edit_product($product_id, $genre_id, $author_id, $image_path, $name, $price, $year, $num_pages, $description);
        header("Location: .?genre_id=$genre_id");
        exit;

    default:
        $error = "Unknown action: $action";
        include('../errors/error.php');
        exit;
}
