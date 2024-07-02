<?php
require_once 'database.php'; // Ensure database connection is included

function add_admin($username, $email, $password) {
    global $db; // Globalize $db to access the database connection

    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Use secure hashing method
    $query = 'INSERT INTO administrators (username, emailAddress, password) 
              VALUES (:username, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hashed_password);
    $statement->execute();
    $statement->closeCursor();
}
function get_admin_by_username($username) {
    global $db;
    $query = 'SELECT * FROM admin WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();
    return $account;
}

function get_email_by_username($username) {
    $administrator = get_admin_by_username($username); // Using existing function to fetch account details
    if ($account) {
        return $account['email']; // Return email if account found
    } else {
        return null; // Return null if account not found
    }
}
function is_valid_admin_login($username, $email) {
    global $db;
    
    $query = 'SELECT adminID FROM administrators 
              WHERE username = :username
              AND emailAddress = :email';
              
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->execute();
    
    $valid = ($statement->rowCount() == 1);
    
    $statement->closeCursor();
    return $valid;
}
function is_admin($username) {
    global $db;
    $query = "SELECT * FROM administrators WHERE username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $admin = $statement->fetch();
    return ($admin !== false); // Returns true if user is an admin, false otherwise
}
?>
