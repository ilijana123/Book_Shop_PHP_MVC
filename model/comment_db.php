<?php
require_once('account_db.php');

function add_comment($product_id, $username, $commentText) {
    global $db;

    // Prepare the SQL query to insert comment
    $query = 'INSERT INTO comments (productID, username, comment) '
           . 'VALUES (:product_id, :username, :commentText)';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':commentText', $commentText);
    
    // Execute the statement
    $success = $statement->execute();
    
    // Close the cursor
    $statement->closeCursor();
    
    return $success;
}

function get_comments_for_product($product_id) {
    global $db;
    
    // Prepare the SQL query to retrieve comments
    $query = 'SELECT * FROM comments WHERE productID = :product_id ORDER BY commentID';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    
    // Fetch all comments
    $comments = $statement->fetchAll();
    
    // Close the cursor
    $statement->closeCursor();
    
    return $comments;
}
function edit_comment($comment_id, $username, $comment_text) {
    global $db;

    // Example implementation; adjust as per your database structure
    $query = "UPDATE comments SET comment = :comment_text WHERE commentID = :comment_id AND username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':comment_text', $comment_text);

    try {
        $success = $statement->execute();
        return $success;
    } catch (PDOException $e) {
        // Log or display the error
        error_log('Database error: ' . $e->getMessage());
        return false;
    }
}
function get_comment_by_id($comment_id) {
    global $db;

    // Prepare the SQL query to retrieve a comment by its ID
    $query = 'SELECT * FROM comments WHERE commentID = :comment_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->execute();
    
    // Fetch the comment
    $comment = $statement->fetch();
    
    // Close the cursor
    $statement->closeCursor();
    
    return $comment;
}
function delete_comment($comment_id, $username) {
    global $db;
    $query = 'DELETE FROM comments WHERE commentID = :comment_id AND username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $statement->closeCursor();
    return $statement->rowCount() > 0;
}
?>
