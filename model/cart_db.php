<?php
// Function to get a cart item from database
function get_cart_item($accountID, $product_id) {
    global $db;
    
    $query = 'SELECT * FROM cart WHERE accountID = :accountID AND product_id = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':accountID', $accountID);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $cart_item = $statement->fetch();
    $statement->closeCursor();
    return $cart_item;
}

// Function to update a cart item in database
function update_cart_item($accountID, $product_id, $quantity) {
    global $db;
    
    $query = 'UPDATE cart SET quantity = :quantity WHERE accountID = :accountID AND product_id = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':accountID', $accountID);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

// Function to add a new cart item to database
function add_cart_item($accountID, $product_id, $quantity) {
    global $db;
    
    $query = 'INSERT INTO cart (accountID, product_id, quantity) VALUES (:accountID, :product_id, :quantity)';
    $statement = $db->prepare($query);
    $statement->bindValue(':accountID', $accountID);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
}

// Function to get all cart items for an account from database
function get_cart_items($accountID) {
    global $db;
    
    $query = 'SELECT c.*, p.productTitle, p.listPrice FROM cart c 
              INNER JOIN product p ON c.product_id = p.productID 
              WHERE c.accountID = :accountID';
    $statement = $db->prepare($query);
    $statement->bindValue(':accountID', $accountID);
    $statement->execute();
    $cart_items = $statement->fetchAll();
    $statement->closeCursor();
    return $cart_items;
}

// Function to calculate total cart value
function calculate_cart_total($cart_items) {
    $total = 0;

    foreach ($cart_items as $item) {
        $total += $item['listPrice'] * $item['quantity'];
    }

    return $total;
}
function get_cart_items_by_username($username) {
    global $db;
    
    $query = 'SELECT c.*, p.productTitle, p.listPrice 
              FROM cart c 
              INNER JOIN product p ON c.product_id = p.productID 
              INNER JOIN account a ON c.accountID = a.id 
              WHERE a.username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $cart_items = $statement->fetchAll();
    $statement->closeCursor();
    return $cart_items;
}
function refresh_session_cart($username) {
    // Clear existing session cart data
    $_SESSION['cart'][$username] = array();

    // Retrieve updated cart information from database
    $cart_items = get_cart_items_by_username($username);

    // Populate session cart data with retrieved items
    foreach ($cart_items as $item) {
        $_SESSION['cart'][$username][$item['product_id']] = array(
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'productTitle' => $item['productTitle'],
            'listPrice' => $item['listPrice']
        );
    }
}
function delete_cart_item_by_product_id($accountID, $product_id) {
    global $db;
    $query = 'DELETE FROM cart WHERE accountID = :accountID AND product_id = :product_id';  // Use product_id instead of productID
    $statement = $db->prepare($query);
    $statement->bindValue(':accountID', $accountID);
    $statement->bindValue(':product_id', $product_id);  // Correct parameter name here
    $statement->execute();
    $statement->closeCursor();
}
function save_to_cart($username, $product_id, $quantity) {
    // Retrieve accountID using username
    $accountID = get_account_id($username);

    // Check if product is already in cart
    $existing_cart_item = get_cart_item($accountID, $product_id);

    if ($existing_cart_item) {
        // Update quantity if product already exists in cart
        update_cart_item($accountID, $product_id, $existing_cart_item['quantity'] + $quantity);
    } else {
        // Add new product to cart
        add_cart_item($accountID, $product_id, $quantity);
    }

    // Refresh session cart data after saving/updating
    refresh_session_cart($username);
}
?>

