<?php include '../view/header.php'; ?>
<!-- Include main.css -->
<link rel="stylesheet" type="text/css" href="..//main.css">

<div id="main" class="container-fluid" style="background-image: url('https://p16-flow-sign-va.ciciai.com/ocean-cloud-tos-us/63092a680a28409a911b894a16b97d39.png~tplv-6bxrjdptv7-image.png?rk3s=18ea6f23&x-expires=1747223458&x-signature=pgXzJcmOT5PvluaMW6zNe1lD4Vk%3D');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      padding-top: 50px;
      height: 100%;
      margin-top: 56px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Product List</h1>
            <div id="sidebar" class="mb-4">
                <h2 class="text-center" style="color: coral;">Genres</h2>
                <ul class="nav justify-content-center genre-list">
                    <?php foreach ($genres as $genre) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?genre_id=<?php echo $genre['genreID']; ?>">
                                <?php echo $genre['genreName']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div id="content">
                <h2 class="text-center mb-4" style="color: coral;"><?php echo $genre_name; ?></h2>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Year Published</th>
                            <th>Description</th>
                            <th>Number of Pages</th>
                            <th class="text-right">Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <!-- <td><?php echo htmlspecialchars($product['productCode']); ?></td> -->
                                <td>
                                <?php if (!empty($product['productCode'])): ?>
                                    <img src="<?php echo $product['productCode']; ?>" alt="Product Image" style="max-width: 100px;">
                                <?php else: ?>
                                    <p>No image uploaded.</p>
                                <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($product['productTitle']); ?></td>
                                <td><?php echo htmlspecialchars($product['yearPublished']); ?></td>
                                <td><?php echo htmlspecialchars($product['description']); ?></td>
                                <td><?php echo htmlspecialchars($product['numPages']); ?></td>
                                <td class="text-right"><?php echo htmlspecialchars($product['listPrice']); ?></td>
                                <td>
                                    <form action="." method="post" class="d-inline">
                                        <input type="hidden" name="action" value="delete_product" />
                                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>" />
                                        <input type="hidden" name="genre_id" value="<?php echo $product['genreID']; ?>" />
                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                                    </form>
                                    <?php if ($is_admin_logged_in): ?>
                                    <form action="index.php" method="post" class="d-inline">
                                        <input type="hidden" name="action" value="edit_product" />
                                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>" />
                                        <input type="hidden" name="genre_id" value="<?php echo $product['genreID']; ?>" />
                                        <input type="submit" class="btn btn-primary btn-sm" value="Edit" />
                                    </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <a href="?action=show_add_form" class="btn btn-success">Add Product</a>
                    <!-- <a href="../index.php" class="btn btn-secondary">List Categories</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>
