<?php
function get_products() {
    global $db;
    $query = 'SELECT * FROM product ORDER BY productID';
    $statement = $db->query($query);
    return $statement->fetchAll();
}

function get_products_by_genre($genre_id) {
    global $db;
    $query = 'SELECT * FROM product WHERE genreID = :genre_id ORDER BY productID';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function get_products_by_author($author_id) {
    global $db;
    $query = 'SELECT * FROM product WHERE authorID = :author_id ORDER BY productID';
    $statement = $db->prepare($query);
    $statement->bindValue(':author_id', $author_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function get_product($product_id) {
    global $db;
    $query = 'SELECT * FROM product WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

function delete_product($product_id) {
    global $db;
    $query = 'DELETE FROM product WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_product($genre_id, $author_id, $image, $name, $price, $year, $num_pages, $description) {
    global $db;
    $query = 'INSERT INTO product (genreID, authorID, productCode, productTitle, listPrice, yearPublished, numPages, description)
              VALUES (:genre_id, :author_id, :image, :name, :price, :year, :num_pages, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->bindValue(':author_id', $author_id);
    $statement->bindValue(':image', $image);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':num_pages', $num_pages);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}
function edit_product($product_id, $genre_id, $author_id, $image_path, $name, $price, $year, $num_pages, $description) {
    global $db;

    $query = 'UPDATE product 
              SET genreID = :genre_id,
                  authorID = :author_id,
                  productCode = :image_path,
                  productTitle = :name,
                  listPrice = :price,
                  yearPublished = :year,
                  numPages = :num_pages,
                  description = :description
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':genre_id', $genre_id);
    $statement->bindValue(':author_id', $author_id);
    $statement->bindValue(':image_path', $image_path);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':num_pages', $num_pages);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}
function handle_image_upload($image) {
    $upload_dir = '../images/';
    $image_name = basename($image['name']);
    $image_path = $upload_dir . $image_name;

    if (move_uploaded_file($image['tmp_name'], $image_path)) {
        return $image_path;
    } else {
        echo "Error moving uploaded file.";
        exit;
    }
}
?>
