<?php
require('../model/database.php');
require('../model/author_db.php');
require('../model/product_db.php'); 
require('../model/genre_db.php');   

// Check if the form was submitted via POST
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
        $author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
        if ($author_id == NULL || $author_id == FALSE) {
            $error = "Missing or incorrect author id.";
            include('../errors/error.php');
        } else {
            delete_author($author_id);
            header("Location: .");
        }
    }
}

// Handle GET requests and other actions
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
        include('author_add.php');
        break;    

    default:
        $error = "Unknown action: " . $action;
        include('../errors/error.php');
        break;
}
?>
