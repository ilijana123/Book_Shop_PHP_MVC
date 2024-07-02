<?php
//make sure the page uses a secure connection 
if(!isset($_SERVER[·HTTPS'] ) ) {
$url = ' h t t p s ://1 . $_SERVER[ 1HTTPHOST1] . $_SERVER[ 1REQUESTURI1]
header("Location: " . $ u rl); 
ex it () ;
}
?>