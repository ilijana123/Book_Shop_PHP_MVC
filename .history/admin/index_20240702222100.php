<?php
session_start(); // Start session

require_once '../model/admin_db.php';
require('../util/secure_conn.php');

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = 'show_login';
    }
}

switch ($action) {
    case 'show_register':
        include('register_view.php');
        break;

    case 'register':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if ($username == NULL || $password == NULL || $email == NULL) {
            $error = "Invalid account data. Check all fields and try again.";
            include('register_view.php');
        } else {
            add_admin($username, $password, $email);
            add_account($username, $password, $email);
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
            exit();
        }
        break;

    case 'show_login':
        include('../account/login_view.php');
        break;
        case 'login':
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
        
            if ($username == NULL || $password == NULL) {
                $error = "Invalid login data. Check all fields and try again.";
                include('login_view.php');
            } else {
                $account = get_account_by_username($username);
                if ($account && password_verify($password, $account['password'])) {
                    $_SESSION['username'] = $username;
                    header("Location: ../index.php");
                    exit();
                } else {
                    $error = "Login failed. Incorrect username or password.";
                    include('login_view.php');
                }
            }
            break;
        
        case 'logout':
            session_unset();
            session_destroy();
            header("Location: ../index.php");
            exit();

    default:
        include('register_view.php');
        break;
}
?>