<?php
require_once 'database.php'; // Assuming this file correctly establishes $db connection

function get_accounts() {
    global $db;
    $query = 'SELECT * FROM account ORDER BY id';
    $statement = $db->query($query);
    return $statement->fetchAll();
}

function get_account_by_username($username) {
    global $db;
    $query = 'SELECT * FROM account WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();
    return $account;
}

function get_account_by_email($email) {
    global $db;
    $query = 'SELECT * FROM account WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();
    return $account;
}

function get_account($username) {
    global $db;
    $query = 'SELECT * FROM account WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();
    return $account;
}
function delete_account($account_id) {
    global $db;
    $query = 'DELETE FROM account WHERE id = :account_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':account_id', $account_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_account($username, $password, $email) {
    global $db;
    $query = 'INSERT INTO account (username, password, email)
              VALUES (:username, :password, :email)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    $statement->bindValue(':email', $email);
    $statement->execute();
    $statement->closeCursor();
}

function edit_account($account_id, $username, $password, $email) {
    global $db;
    $query = 'UPDATE account 
              SET username = :username,
                  password = :password,
                  email = :email
              WHERE id = :account_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':account_id', $account_id);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    $statement->bindValue(':email', $email);
    $statement->execute();
    $statement->closeCursor();
}

function get_account_id($username) {
    global $db;
    $query = 'SELECT id FROM account WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();
    return $account ? $account['id'] : null;
}

function get_user_by_id($user_id) {
    global $db;
    $query = 'SELECT * FROM account WHERE id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}
function get_email_by_username($username) {
    $account = get_account_by_username($username); // Using existing function to fetch account details
    if ($account) {
        return $account['email']; // Return email if account found
    } else {
        return null; // Return null if account not found
    }
}
?>
