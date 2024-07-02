<?php
function get_genres() {
    global $db;
    $query = 'SELECT * FROM genres ORDER BY genreID';
    $statement = $db->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function get_genre_name($genre_id) {
    global $db;
    $query = 'SELECT genreName FROM genres WHERE genreID = :genre_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
    $statement->execute();
    $genre = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if ($genre === false) {
        return null; // or handle error as needed, e.g., return a default genre name
    }
    return $genre['genreName'];
}
function get_genre($genre_id) {
    global $db;
    $query = 'SELECT * FROM genres WHERE genreID = :genre_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
    $statement->execute();
    $genre = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if ($genre === false) {
        return null; // or handle error as needed
    }
    return $genre;
}


function add_genre($genre_name) {
    global $db;
    $query = 'INSERT INTO genres (genreName) VALUES (:genre_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_name', $genre_name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_genre($genre_id) {
    global $db;
    $query = 'DELETE FROM genres WHERE genreID = :genre_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->execute();
    $statement->closeCursor();
}
function edit_genre($genre_id, $genre_name) {
    global $db;
    $query = 'UPDATE genres
              SET genreName = :genre_name
              WHERE genreID = :genre_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->bindValue(':genre_name', $genre_name);
    $statement->execute();
    $statement->closeCursor();
}

?>
