<?php
//make sure the page uses a secure connection 
if(!isset($_SERVER['HTTPS'] ) ){
$url = 'https ://' . $_SERVER[ 1HTTPHOST'] . $_SERVER[ 'REQUESTURI']
header("Location: " . $ u rl); 
ex it () ;
}
?>