<?php
ob_start(); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";
$username=$_SESSION['username'];

function isAdmin($username, $password) {
    global $admin_username, $admin_password;
    return ($username === $admin_username && $password === $admin_password);
}
$is_admin_logged_in = false;
if (isset($_SESSION['username']) && $_SESSION['username'] === $admin_username) {
    $is_admin_logged_in = true;
}
ob_end_flush(); 
?>