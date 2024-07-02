<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require'model/database.php';
require_once 'model/admin_db.php';
require_once 'model/account_db.php';
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";

// Check session variables
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$email = get_admin_email_by_username($username);
$is_admin_logged_in = false;
$is_user_logged_in = false;

if ($username) {
    // Check if the user is an administrator
    if (is_admin($username)) {
        $is_admin_logged_in = true;
    } else {
        // Check if the user is a regular user
        if (is_user($username)) {
            $is_user_logged_in = true;
        }
    }
}

echo "Username: $username<br>";
echo "Email: $email<br>";
ob_end_flush();
?>
