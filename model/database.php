<?php
$dsn = 'mysql:host=localhost;dbname=book_shop';
$username = 'mgs_user';
$password = 'pa55word';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/database_error.php');
    exit(); // Stop execution of the script
}
?>
