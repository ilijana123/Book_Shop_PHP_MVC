<?php

require('../model/database.php');
require('../model/author_db.php');
require('../model/product_db.php');
require('../model/genre_db.php');
require('../util/secure_conn.php');
session_start();

$admin_username = 'admin';
$admin_password_hash = '$2y$10$I662rv3uo9.O6G3ahZ0ITeiH1..YqsCcCUimTnal.cLqOqoV1Cuza';

function is_adminn() {
    global $admin_username;
    return isset($_SESSION['username']) && $_SESSION['username'] === $admin_username;
}

$is_admin_logged_in = is_adminn();

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
    } elseif (isset($_POST['action']) && $_POST['action'] == 'edit_genre') {
        $genre_id = filter_input(INPUT_POST, 'genre_id', FILTER_VALIDATE_INT);
        $genre_name = filter_input(INPUT_POST, 'genre_name', FILTER_SANITIZE_STRING);

        if (!$genre_id || !$genre_name) {
            $error = "Invalid genre data.";
            include('../errors/error.php');
        } else {
            edit_genre($genre_id, $genre_name);
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
        if (!is_adminn()) {
            $error = "Unauthorized access.";
            include('../errors/error.php');
            exit();
        }

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
        if (!is_admin()) {
            $error = "Unauthorized access.";
            include('../errors/error.php');
            exit();
        }

        include('genre_add.php');
        break;

    case 'show_edit_form':
        if (!is_admin()) {
            $error = "Unauthorized access.";
            include('../errors/error.php');
            exit();
        }

        $genre_id = filter_input(INPUT_GET, 'genre_id', FILTER_VALIDATE_INT);
        if ($genre_id == NULL || $genre_id == FALSE) {
            $error = "Missing or incorrect genre ID.";
            include('../errors/error.php');
        } else {
            $genre = get_genre($genre_id);
            include('genre_edit.php');
        }
        break;

    default:
        $error = "Unknown action: " . $action;
        include('../errors/error.php');
        break;
}

?>
