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
        body {
            background-color: #f8f9fa; 
            padding-top: 60px; 
            font-family: 'Poppins', sans-serif; 
        }
        .product-card {
            margin-bottom: 20px;
            border: 1px solid #dee2e6; 
            border-radius: 8px; 
            transition: transform 0.3s ease-in-out;
            display: flex; 
            overflow: hidden; 
            background-color: #fff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-card:hover {
            transform: translateY(-5px); /* Lift up on hover */
        }
        .product-card .card-img-top {
            width: 100%; 
            height: auto;
            object-fit: cover; 
            border-top-left-radius: 8px; 
            border-bottom-left-radius: 8px; 
            max-height: 300px; 
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
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
        }
        .kopce:hover {
            background-color: darkorange; 
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); 
        }
        .main-content {
            padding: 50px 0;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            background-color: rgba(255, 228, 196, 0.8);
        }
        .list-group {
            max-width: 300px; 
        }
        .card {
            width: 100%; 
        }
        .brisi {
            background-color: red; 
            border: none; 
            color: #fff; 
            padding: 10px 20px; 
            font-size: 1rem; 
            border-radius: 30px; 
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
        }
        .brisi:hover {
            background-color: darkorange; 
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); 
        }
    </style>
</head>
<?php include '../view/header.php'; ?>
<body style="background-image: url('https://p16-flow-sign-va.ciciai.com/ocean-cloud-tos-us/63092a680a28409a911b894a16b97d39.png~tplv-6bxrjdptv7-image.png?rk3s=18ea6f23&x-expires=1747223458&x-signature=pgXzJcmOT5PvluaMW6zNe1lD4Vk%3D');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;">

    <!-- Main content -->
    <div class="main-content container-fluid">
        <div class="container mt-4">     
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Author List</h2>
                <?php if ($is_admin_logged_in): ?>
                    <a href="?action=show_add_form" class="kopce">Add New Author</a>
                <?php endif; ?>
            </div>
            <!-- Main content area -->
            <div id="content" class="col-lg-9 col-md-8 col-sm-12">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($authors as $author) : ?>
                        <div class="col">
                            <div class="card h-100 product-card">
                                <div class="row g-0">
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($author['authorName']); ?></h5>
                                            <a href="?action=view_author&author_id=<?php echo $author['authorID']; ?>" class="kopce">View Details</a>
                                            <?php if ($is_admin_logged_in): ?>
                                                <a href="?action=show_edit_form&author_id=<?php echo $author['authorID']; ?>" class="kopce">Edit</a>
                                            <?php endif; ?> 
                                            <tr></tr>
                                            <?php if ($is_admin_logged_in): ?>
                                                <form action="index.php" method="post" class="d-inline">
                                                    <input type="hidden" name="action" value="delete_author" />
                                                    <input type="hidden" name="author_id" value="<?php echo $author['authorID']; ?>" />
                                                    <input type="submit" class="brisi" value="Delete" />
                                                </form>
                                            <?php endif; ?>
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
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>