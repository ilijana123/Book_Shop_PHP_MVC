<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'model/database.php';
require_once 'model/admin_db.php';

$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";

// Check session variables
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$email = get_email_by_username

// Debug output to check session variables
echo "Session username: " . htmlspecialchars($username) . "<br>";
echo "Session email: " . htmlspecialchars($email) . "<br>";

$is_admin_logged_in = false;
if ($username && $email && is_valid_admin_login($username, $email)) {
    $is_admin_logged_in = true;
}

ob_end_flush();
?>
