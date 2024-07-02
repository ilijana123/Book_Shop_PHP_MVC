<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'model/database.php';
require_once 'model/admin_db.php';
require_once 'model/account_db.php';
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";

// Check session variables
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$email = get_email_by_username($username);
$is_admin_logged_in = false;
if ($username && $email && is_valid_admin_login($username, $email)) {
    $is_admin_logged_in = true;
}
echo "Username: $username<br>";
echo "Email: $email<br>";
echo "Is admin logged in? " . ($is_admin_logged_in ? "Yes" : "No") . "<br>";
ob_end_flush();
?>
