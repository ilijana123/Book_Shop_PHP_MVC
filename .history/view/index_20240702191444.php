<?php
ob_start(); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/shop/";
$username=$_SESSION['username'];
$email=$_SESSION['email'];

ob_end_flush(); 
?>