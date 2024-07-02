<?php

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
