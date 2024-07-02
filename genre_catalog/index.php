<?php
require('../model/database.php');
require('../model/author_db.php');
require('../model/product_db.php');
require('../model/genre_db.php');
require('../util/secure_conn.php');
include('../view/index.php');
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_genres';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add_genre') {
        $genre_name = filter_input(INPUT_POST, 'genre_name', FILTER_SANITIZE_STRING);

        if (!$genre_name) {
            $error = "Genre name is required.";
            include('../errors/error.php');
        } else {
            add_genre($genre_name);
            header("Location: index.php?action=list_genres");
        }
    }
}

switch ($action) {
    case 'list_genres':
        $genres = get_genres();
        include('genre_list.php');
        break;

    case 'delete_genre':
        $genre_id = filter_input(INPUT_POST, 'genre_id', FILTER_VALIDATE_INT);
        if ($genre_id == NULL || $genre_id == FALSE) {
            $error = "Missing or incorrect genre ID.";
            include('../errors/error.php');
        } else {
            delete_genre($genre_id);
            header("Location: .");
        }
        break;

    case 'show_add_form':
        include('genre_add.php');
        break;

    default:
        $error = "Unknown action: " . $action;
        include('../errors/error.php');
        break;
}
?>
