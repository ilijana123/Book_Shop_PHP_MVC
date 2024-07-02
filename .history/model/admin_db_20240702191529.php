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

function is_valid_admin_login($username,) {
    global $db;
    
    // Check if the username exists in the administrators table
    $query = 'SELECT adminID FROM administrators WHERE emailAddress = (
              SELECT email FROM account WHERE username = :username)';
              
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    
    $valid = ($statement->rowCount() == 1); // Check if a match was found
    
    $statement->closeCursor();
    return $valid;
}
?>