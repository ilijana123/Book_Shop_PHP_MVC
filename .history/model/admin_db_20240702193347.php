<?php
function add_admin($email, $password) {
    global $db;
    $password = sha1($email . $password); // Using sha1 for demonstration, consider using more secure hashing methods
    $query = 'INSERT INTO administrators (emailAddress, password) 
              VALUES (:email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_admin_login($username, $email, $password) {
    global $db;
    
    // Hash the password for comparison
    $hashed_password = sha1($email . $password); // Using sha1 for demonstration, consider using more secure hashing methods
    
    // Check if the username, email, and hashed password exist in the administrators table
    $query = 'SELECT adminID FROM administrators 
              WHERE emailAddress = :email 
              AND password = :hashed_password 
              AND EXISTS (
                SELECT 1 FROM account 
                WHERE username = :username 
                AND email = :email
              )';
              
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':hashed_password', $hashed_password);
    $statement->execute();
    
    $valid = ($statement->rowCount() == 1); // Check if a match was found
    
    $statement->closeCursor();
    return $valid;
}
?>