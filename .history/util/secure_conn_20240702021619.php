<?php
//make sure the page uses a secure connection 
if(!isset($_SERVER['HTTPS'] ) ){
$url = 'https ://' . $_SERVER[ 'HTTPHOST'] . $_SERVER[ 'REQUESTURI'];
header("Location: " . $url); 
exit () ;
}
?>
<?php
// Make sure the page uses a secure connection
if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $url);
    exit();
}
?>