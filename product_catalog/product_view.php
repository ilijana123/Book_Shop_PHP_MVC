<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 60px;
            font-family: 'Poppins', sans-serif;
            background-image: url('https://p16-flow-sign-va.ciciai.com/ocean-cloud-tos-us/63092a680a28409a911b894a16b97d39.png~tplv-6bxrjdptv7-image.png?rk3s=18ea6f23&x-expires=1747223458&x-signature=pgXzJcmOT5PvluaMW6zNe1lD4Vk%3D');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
        .main-content {
            padding: 50px 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 228, 196, 0.9);
            text-align: center; /* Center align text */
        }
        .product-details {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-details img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 20px;
            border-radius: 8px;
        }
        .product-details h1 {
            font-size: 2.5rem; /* Larger font size */
            margin-bottom: 20px;
            color: coral;
        }
        .product-details p {
            font-size: 1.3rem; /* Larger font size */
            margin-bottom: 10px;
            color: #555;
        }
        .btn {
            background-color: coral;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #ff6b3b;
        }
        .comments {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .comment {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            font-size: 1.2rem;
        }
        .comment:last-child {
            border-bottom: none; 
        }
        .comment .user {
            font-weight: bold;
            color: coral;
        }
        .comment .timestamp {
            color: #999;
            font-size: 0.9rem;
        }
        .comment .content {
            margin-top: 5px;
            color: #333;
        }
        .comment-form {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
        }
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical; 
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include '../view/header.php'; ?>

    <!-- Main content -->
    <div class="main-content container">
        <div class="product-details">
            <?php
            // Ensure $image_filename is correctly set without extra extension
            $image_filename = basename($product['productCode']);
            $image_path = "../images/" . $image_filename;
            $default_image_path = "../images/default.jpg";
            $image_to_display = file_exists($image_path) ? $image_path : $default_image_path;
            ?>
            <img src="<?php echo $image_to_display; ?>" alt="Product Image" />
            <h1><?php echo $product['productTitle']; ?></h1>
            <p><b>Year Published:</b> <?php echo $product['yearPublished']; ?></p>
            <p><b>Number of Pages:</b> <?php echo $product['numPages']; ?></p>
            <p><b>Description:</b> <?php echo $product['description']; ?></p>
            <p><b>Author:</b> <a href="../author_catalog/?action=view_author&author_id=<?php echo $product['authorID']; ?>"><?php echo $author_name; ?></a></p>
            <p><b>List Price:</b> $<?php echo $product['listPrice']; ?></p>
            <!-- Add your price calculations here -->
            <form action="../cart/index.php" method="post">
                <input type="hidden" name="action" value="add_to_cart" />
                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>" />
                <div class="mb-3">
                    <label for="quantity">Quantity:</label>
                    <input id="quantity" type="text" name="quantity" value="1" size="2" class="form-control" style="display:inline-block; width: auto;" />
                </div>
                <input type="submit" value="Add to Cart" class="btn" />
            </form>
            <!-- Comment Form -->
            <?php if ($user_logged_in): ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?action=view_product&product_id=' . $product['productID']; ?>" method="post" class="comment-form">
                    <div class="form-group">
                        <label for="commentText">Your Comment</label>
                        <textarea class="form-control" id="commentText" name="commentText" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            <?php else: ?>
                <p>You must be <a href="../account/?action=login">logged in</a> to leave a comment.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="comments">
    <h2>Comments</h2>
    <?php foreach ($comments as $comment): ?>
        <div class="comment row" id="comment_<?php echo htmlspecialchars($comment['commentID']); ?>">
            <div class="col">
                <span class="user"><?php echo htmlspecialchars($comment['username']); ?></span>
                <p class="content"><?php echo htmlspecialchars($comment['comment']); ?></p>
            </div>
            <?php if ($user_logged_in && $_SESSION['username'] === $comment['username']): ?>
                <div class="col-auto">
                    <!-- Edit Form -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?action=view_product&product_id=' . $product['productID']; ?>" method="post" class="edit-comment-form">
                        <input type="hidden" name="edit_comment_id" value="<?php echo htmlspecialchars($comment['commentID']); ?>">
                        <textarea name="edit_commentText" rows="3" class="form-control mb-2" required><?php echo htmlspecialchars($comment['comment']); ?></textarea>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </form>
                    <!-- Delete Button -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?action=view_product&product_id=' . $product['productID']; ?>" method="post">
                        <input type="hidden" name="delete_comment_id" value="<?php echo htmlspecialchars($comment['commentID']); ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>
