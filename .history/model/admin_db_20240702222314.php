<?php
function add_admin($username, $email, $password) {
    global $db;
    $hashed_password = sha1($email . $password); // Using sha1 for demonstration, consider using more secure hashing methods
    $query = 'INSERT INTO administrators (username, emailAddress, password) 
              VALUES (:username, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hashed_password);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_admin_login($username, $email, $password) {
    global $db;
    
    // Hash the password for comparison
    $hashed_password = sha1($email . $password); // Using sha1 for demonstration, consider using more secure hashing methods
    
    // Check if the username, email, and hashed password exist in the administrators table
    $query = 'SELECT adminID FROM administrators 
              WHERE username = :username
              AND emailAddress = :email 
              AND password = :password 
              AND EXISTS (
                SELECT 1 FROM account 
                WHERE username = :username 
                AND email = :email
              )';
              
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hashed_password);
    $statement->execute();
    
    $valid = ($statement->rowCount() == 1); // Check if a match was found
    
    $statement->closeCursor();
    return $valid;
}
?>
