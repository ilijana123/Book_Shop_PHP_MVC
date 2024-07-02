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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add_author') {
        $author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_STRING);
        $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_STRING);
        $birth_date = filter_input(INPUT_POST, 'birth_date');
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

        if (!$author_name || !$nationality || !$birth_date || !$gender) {
            $error = "All fields are required.";
            include('../errors/error.php');
        } else {
            add_author($author_name, $nationality, $birth_date, $gender);
            header("Location: index.php?action=list_authors");
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'delete_author') {
        if (!is_admin()) {
            $error = "Unauthorized access.";
            include('../errors/error.php');
            exit();
        }
        
        $author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
        if ($author_id == NULL || $author_id == FALSE) {
            $error = "Missing or incorrect author ID.";
            include('../errors/error.php');
        } else {
            delete_author($author_id);
            header("Location: .");
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'edit_author') {
        if (!is_admin()) {
            $error = "Unauthorized access.";
            include('../errors/error.php');
            exit();
        }

        $author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
        $author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_STRING);
        $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_STRING);
        $birth_date = filter_input(INPUT_POST, 'birth_date');
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

        if (!$author_id || !$author_name || !$nationality || !$birth_date || !$gender) {
            $error = "All fields are required.";
            include('../errors/error.php');
        } else {
            edit_author($author_id, $author_name, $nationality, $birth_date, $gender);
            header("Location: index.php?action=list_authors");
        }
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_authors';
}

switch ($action) {
    case 'list_authors':
        $authors = get_authors();
        include('author_list.php');
        break;

    case 'view_author':
        if (isset($_GET['author_id'])) {
            $author_id = $_GET['author_id'];
            $author = get_author($author_id);
            if ($author) {
                $name = $author['authorName'];
                $nationality = $author['nationality'];
                $birth_date = $author['birthDate'];
                $gender = $author['gender'];
                $author_books = get_author_books($author_id);
                include('author_view.php');
            } else {
                echo "Author not found.";
            }
        } else {
            echo "Author ID is missing.";
        }
        break;

    case 'show_add_form':
        if (!is_admin()) {
            $error = "Unauthorized access.";
            include('../errors/error.php');
            exit();
        }
        
        include('author_add.php');
        break;

    case 'show_edit_form':
        if (!is_admin()) {
            $error = "Unauthorized access.";
            include('../errors/error.php');
            exit();
        }

        if (isset($_GET['author_id'])) {
            $author_id = $_GET['author_id'];
            $author = get_author($author_id);
            if ($author) {
                include('author_edit.php');
            } else {
                echo "Author not found.";
            }
        } else {
            echo "Author ID is missing.";
        }
        break;

    default:
        $error = "Unknown action: " . $action;
        include('../errors/error.php');
        break;
}
?>
