<?php include '../view/header.php'; ?>
<link rel="stylesheet" type="text/css" href="../view/main.css">

<div id="main" class="container-fluid" style="padding-top: 80px; background-color: #fff8dc;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="border p-4 rounded">
                <h1 class="text-center mb-4" style="color: coral;">Edit Product</h1>
                <form action="index.php" method="post" id="edit_product_form" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update_product" />
                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>" />
                    <input type="hidden" name="genre_id" value="<?php echo $product['genreID']; ?>" />

                    <div class="form-group">
                        <label class="text-dark">Genre:</label>
                        <select name="genre_id" class="form-control">
                            <?php foreach ($genres as $genre) : ?>
                                <option value="<?php echo $genre['genreID']; ?>" <?php if ($genre['genreID'] == $product['genreID']) echo 'selected'; ?>>
                                    <?php echo $genre['genreName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-dark">Author:</label>
                        <select name="author_id" class="form-control">
                            <?php foreach ($authors as $author) : ?>
                                <option value="<?php echo $author['authorID']; ?>" <?php if ($author['authorID'] == $product['authorID']) echo 'selected'; ?>>
                                    <?php echo $author['authorName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-dark">Current Image:</label><br>
                        <?php if (!empty($product['productCode'])): ?>
                            <img src="<?php echo $product['productCode']; ?>" alt="Product Image" style="max-width: 200px;">
                        <?php else: ?>
                            <p>No image uploaded.</p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="text-dark">Change Image:</label>
                        <input type="file" name="image" class="form-control-file" accept="image/*">
                    </div>               

                    <div class="form-group">
                        <label class="text-dark">Title:</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($product['productTitle']); ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="text-dark">Year Published:</label>
                        <input type="text" name="year" value="<?php echo htmlspecialchars($product['yearPublished']); ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="text-dark">Description:</label>
                        <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="text-dark">Number of Pages:</label>
                        <input type="text" name="numpages" value="<?php echo htmlspecialchars($product['numPages']); ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="text-dark">List Price:</label>
                        <input type="text" name="price" value="<?php echo htmlspecialchars($product['listPrice']); ?>" class="form-control" />
                    </div>

                    <div class="text-center">
                        <input type="submit" value="Update Product" class="btn btn-primary" />
                        <a href="?action=list_products" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../view/footer.php'; ?>
