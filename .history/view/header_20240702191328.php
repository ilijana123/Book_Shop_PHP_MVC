
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Book Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/main.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="padding-bottom:20px;">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">
                <img src="<?php echo $base_url; ?>images/logo.jpg" alt="Logo" width="50">
                BookShop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/product_catalog/') === false && strpos($_SERVER['REQUEST_URI'], '/cart/') === false && strpos($_SERVER['REQUEST_URI'], '/author_catalog/') === false && strpos($_SERVER['REQUEST_URI'], '/product_manager/') === false ? 'active' : ''; ?>" aria-current="page" href="<?php echo $base_url; ?>index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/product_catalog/') !== false ? 'active' : ''; ?>" href="<?php echo $base_url; ?>product_catalog">Shop</a>
                    </li>
                    <?php if ($is_admin_logged_in): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/product_manager/') !== false ? 'active' : ''; ?>" href="<?php echo $base_url; ?>product_manager">Edit Products</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($is_admin_logged_in): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/genre_manager/') !== false ? 'active' : ''; ?>" href="<?php echo $base_url; ?>genre_manager">Edit Genres</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($is_admin_logged_in): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/author_manager/') !== false ? 'active' : ''; ?>" href="<?php echo $base_url; ?>author_manager">Edit Authors</a>
                        </li>
                    <?php endif; ?>
                    <?php if (strpos($_SERVER['REQUEST_URI'], '/index.php') !== false): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_url; ?>cart/index.php?action=cart_view">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['username']) && $_SESSION['username']): ?>
                            <a class="nav-link" href="<?php echo $base_url; ?>account/index.php?action=logout">
                                <i class="fas fa-user"></i> Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)
                            </a>
                        <?php else: ?>
                            <a class="nav-link" href="<?php echo $base_url; ?>account/index.php?action=show_login">
                                <i class="fas fa-user"></i> Login
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- JavaScript and Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<?php
<?php

?>
