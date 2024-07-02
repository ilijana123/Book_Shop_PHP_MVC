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
            
            text-align: center;
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
            font-size: 1.3rem; /* Larger font size */
            border-radius: 30px;
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: darkorange;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            color: #333;
            font-size: 1.2rem; /* Larger font size */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include '../view/header.php'; ?>
    <!-- Main content -->
    <div class="main-content container">
        <div class="product-details">
            <!-- <img src="<?php echo $image_filename; ?>" alt="<?php echo $image_alt; ?>" /> -->
            <h1><?php echo $name; ?></h1>
            <p><b>Nationality:</b> <?php echo $nationality; ?></p>
            <p><b>Birth Date:</b> <?php echo $birth_date; ?></p>
            <p><b>Gender:</b> <?php echo $gender; ?></p>
            <div class="author-books">
            <p><b></b><h2>Author's Books</h2>
            <ul>
                <?php foreach ($author_books as $book) : ?>
                    <li style="list-style-type: none;"><a href="../product_catalog/?action=view_product&product_id=<?php echo $book['productID']; ?>"><?php echo htmlspecialchars($book['productTitle']); ?></a> (Published: <?php echo htmlspecialchars($book['yearPublished']); ?>)</li>
                <?php endforeach; ?>
            </ul>
            </div></p>
            
        </div>
    </div>

    <!-- Footer -->
    <?php include '../view/footer.php'; ?>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
