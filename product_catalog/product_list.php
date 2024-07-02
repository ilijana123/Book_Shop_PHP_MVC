<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Catalog</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Link your custom CSS file -->
    <link rel="stylesheet" href="../main.css">
    <style>
        /* Custom styles for product catalog */
        body {
            background-color: #f8f9fa; /* Light gray background */
            padding-top: 60px; /* Make space for fixed navbar */
            font-family: 'Poppins', sans-serif; /* Set font family */
        }
        .product-card {
            margin-bottom: 20px;
            border: 1px solid #dee2e6; /* Light gray border */
            border-radius: 8px; /* Rounded corners */
            transition: transform 0.3s ease-in-out;
            display: flex; /* Use flexbox for layout */
            overflow: hidden; /* Prevent image overflow */
            background-color: #fff; /* White background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add some shadow */
        }
        .product-card:hover {
            transform: translateY(-5px); /* Lift up on hover */
        }
        .product-card .card-img-top {
            width: 100%; /* Take full width of the parent container */
            height: auto; /* Maintain aspect ratio */
            object-fit: cover; /* Ensure image covers the entire space */
            border-top-left-radius: 8px; /* Rounded corners for top-left */
            border-bottom-left-radius: 8px; /* Rounded corners for bottom-left */
            max-height: 300px; /* Set a maximum height */
        }
        .product-card .card-body {
            padding: 20px;
            flex: 1; /* Allow the content to fill remaining space */
            display: flex; /* Use flexbox for nested layout */
            flex-direction: column; /* Align text vertically */
            justify-content: center; /* Center content vertically */
        }
        .product-card .card-title {
            font-size: 1.8rem; /* Larger font size */
            margin-bottom: 10px; /* Adjust spacing */
            color: #333; /* Dark text color */
        }
        .product-card .card-text {
            font-size: 1.2rem; /* Font size for price */
            margin-bottom: 15px; /* Adjust spacing */
            color: #555; /* Slightly lighter text color */
        }
        .kopce {
            background-color: coral; /* Change button color */
            border: none; /* Remove border */
            color: #fff; /* White text */
            padding: 10px 20px; /* Add padding */
            font-size: 1rem; /* Increase font size */
            border-radius: 30px; /* Rounded corners */
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smooth transitions */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow */
            text-align: center; /* Center text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Allow block styling */
        }
        .kopce:hover {
            background-color: darkorange; /* Darker shade on hover */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); /* Add shadow on hover */
        }
        /* Centering the content */
        .main-content {
            padding: 50px 0; /* Adjust padding as needed */
            margin-top: 20px; /* Adjust margin to separate from navbar */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow effect */
            background-color: rgba(255, 228, 196, 0.8); /* Creamy background with some transparency */
        }
        /* Adjusting the size of elements */
        .list-group {
            max-width: 300px; /* Adjust as per your design */
        }
        .card {
            width: 100%; /* Ensures cards take full width */
        }
    </style>
</head>
<body style="background-image: url('https://p16-flow-sign-va.ciciai.com/ocean-cloud-tos-us/63092a680a28409a911b894a16b97d39.png~tplv-6bxrjdptv7-image.png?rk3s=18ea6f23&x-expires=1747223458&x-signature=pgXzJcmOT5PvluaMW6zNe1lD4Vk%3D');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;">
    <!-- Navbar -->
    <?php include '../view/header.php'; ?>

    <!-- Main content -->
    <div class="main-content container-fluid">
        <div class="container mt-4">
            <div class="row">
                <!-- Sidebar with genres -->
                <div id="sidebar" class="col-lg-3 col-md-4 col-sm-12 mb-4">
                    <h2 class="mb-0">Genres</h2>
                    <a href="../genre_catalog" class="kopce">More about genres</a>
                    <div class="list-group">
                        <?php foreach ($genres as $genre) : ?>
                            <a href="?genre_id=<?php echo $genre['genreID']; ?>" class="list-group-item list-group-item-action">
                                <?php echo $genre['genreName']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="sidebar" class="col-lg-3 col-md-4 col-sm-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="mb-0">Authors</h2>
                        <a href="../author_catalog" class="kopce">More about authors</a>
                    </div>
                    <div class="list-group">
                        <?php foreach ($authors as $author) : ?>
                            <a href="?author_id=<?php echo $author['authorID']; ?>" class="list-group-item list-group-item-action">
                                <?php echo $author['authorName']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Main content area -->
                <div id="content" class="col-lg-9 col-md-8 col-sm-12">
                <a href="?" class="kopce">Show All Products</a>
                    <h1 class="mb-4">
                        <?php echo $filtered_category_name; ?>
                    </h1>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php foreach ($products as $product) : 
                            $image_filename = basename($product['productCode']);
                            $image_path = "../images/" . $image_filename;
                            $default_image_path = "../images/default.jpg";
                            $image_to_display = file_exists($image_path) ? $image_path : $default_image_path;
                        ?>
                            <div class="col">
                                <div class="card h-100 product-card">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <img src="<?php echo $image_to_display; ?>" class="card-img-top" alt="Product Image">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $product['productTitle']; ?></h5>
                                                <p class="card-text">
                                                    Price: $<?php echo number_format($product['listPrice'], 2); ?>
                                                </p>
                                                <form action="../cart/index.php" method="post">
                                                    <input type="hidden" name="action" value="add_to_cart" />
                                                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>" />
                                                    <div class="mb-3">
                                                        <label for="quantity">Quantity:</label>
                                                        <input id="quantity" type="text" name="quantity" value="1" size="2" class="form-control" style="display:inline-block; width: auto;" />
                                                    </div>
                                                    <input type="submit" value="Add to Cart" class="btn" />
                                                </form>
                                                <a href="?action=view_product&product_id=<?php echo $product['productID']; ?>" class="kopce">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-vSrkaIVYfAl9ZaSR2q9sa/TEtNxTojT7FGqIpEAI+RxCzB2mEz2aei8Yk3pVVUEs" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-0iN4DdlsYYV6snxAvDOVcRV6JRloDE5Gm/1yoL7DHS/DgW2cdT8MbDoPOxg+nXk+G" crossorigin="anonymous"></script>                        
</body>
</html>
