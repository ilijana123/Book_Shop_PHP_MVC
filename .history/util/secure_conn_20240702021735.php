
<?php
// Make sure the page uses a secure connection
$https=filter_input(INPUT_SERVER,'HTTPS');
if (!$https) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $url);
    exit();
}
?>