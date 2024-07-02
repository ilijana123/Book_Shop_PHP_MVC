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
?>
