
<?php
// Make sure the page uses a secure connection
$https=f
if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $url);
    exit();
}
?>