
<?php
// Make sure the page uses a secure connection
$https=filter_input(INPUT_SERVER,'HTTPS');
if (!$https) {
    $host=filter_input(INPUT_SERVER,'HTTP_POST');
    $uri=filter_input(INPUT_SERVER,'REQUEST_URI');
    $url = 'https://' . $host . $uri;
    header("Location: " . $url);
    exit();
}
?>