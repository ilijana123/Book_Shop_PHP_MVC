<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'model/database.php';
require_once 'model/admin_db.php';

$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

$is_admin_logged_in = false;
if ($username && $email && is_valid_admin_login($username, $email)) {
    $is_admin_logged_in = true;
} else {
    // Debugging information
    error_log("Admin login check failed for username: $username, email: $email");
}

ob_end_flush();
include 'header.php';
?>

<!-- view/index.php -->
<?php
require_once 'index.php';
?>