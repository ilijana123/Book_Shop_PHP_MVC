<?php
ob_start(); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";
$admin_username = 'admin';
$admin_password = '$2y$10$I662rv3uo9.O6G3ahZ0ITeiH1..YqsCcCUimTnal.cLqOqoV1Cuza';
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