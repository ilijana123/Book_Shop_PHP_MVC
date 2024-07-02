<?php
ob_start(); 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$password = isset($_SESSION['password']) ? $_SESSION['password'] : null;

$is_admin_logged_in = false;
if ($username && $email && $password && is_valid_admin_login($username, $email, $password)) {
    $is_admin_logged_in = true;
}

ob_end_flush(); 
?>
