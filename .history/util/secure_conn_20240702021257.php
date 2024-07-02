<?php
//make sure the page uses a secure connection 
if(!isset($_SERVER['HTTPS'] ) ){
$url = 'https ://' . $_SERVER[ 1HTTPHOST1] . $_SERVER[ 'REQUESTURI1]
header("Location: " . $ u rl); 
ex it () ;
}
?>