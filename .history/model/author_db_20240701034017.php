<?php
// function get_authors() {
//     global $db;
//     $query = 'SELECT * FROM authors ORDER BY authorID';
//     $statement = $db->query($query);
//     return $statement->fetchAll(PDO::FETCH_ASSOC);
// }

function get_authors() {
    global $db;
    $query = 'SELECT * FROM authors ORDER BY authorName';
    $statement = $db->prepare($query);
    $statement->execute();
    $authors = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $authors;
}
function get_author_name($author_id) {
    global $db;
    $query = 'SELECT authorName FROM authors WHERE authorID = :author_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':author_id', $author_id, PDO::PARAM_INT);
    $statement->execute();
    $author = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if ($author === false) {
        return null; 
    }
    return $author['authorName'];
}
function get_author($author_id) {
    global $db;
    $query = 'SELECT * FROM authors WHERE authorID = :author_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':author_id', $author_id);
    $statement->execute();
    $author = $statement->fetch();
    $statement->closeCursor();
    return $author;
}

function delete_author($author_id) {
    global $db;
    $query = 'DELETE FROM authors WHERE authorID = :author_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':author_id', $author_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_author($author_name, $nationality, $birth_date, $gender) {
    global $db;
    $query = 'INSERT INTO authors (authorName, nationality, birthDate, gender)
              VALUES (:author_name, :nationality, :birth_date, :gender)';
    $statement = $db->prepare($query);
    $statement->bindValue(':author_name', $author_name);
    $statement->bindValue(':nationality', $nationality);
    $statement->bindValue(':birth_date', $birth_date);
    $statement->bindValue(':gender', $gender);
    $statement->execute();
    $statement->closeCursor();
}


function edit_author($author_id, $name, $nationality, $birth_date, $gender) {
    global $db;
    $query = 'UPDATE authors
              SET authorName = :name,
                  nationality = :nationality,
                  birthDate = :birth_date,
                  gender = :gender
              WHERE authorID = :author_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':author_id', $author_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':nationality', $nationality);
    $statement->bindValue(':birth_date', $birth_date);
    $statement->bindValue(':gender', $gender);
    $statement->execute();
    $statement->closeCursor();
}
function get_author_books($author_id) {
    global $db;
    $query = 'SELECT * FROM product WHERE authorID = :author_id ORDER BY productTitle';
    $statement = $db->prepare($query);
    $statement->bindValue(':author_id', $author_id, PDO::PARAM_INT);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $books;
}
?>
