<?php
session_start();
$https=filter_input(INPUT_SERVER,'HTTPS');
if(!$https)
{
    $host=filter_input(INPUT_SERVER,'HTTP_POST');
    $uri=filter_input(INPUT_SERVER,'REQUEST_URI');
    $url='https://' . $host . $uri;
    header("Location: " . $url);
    exit();
}
?>
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
    <link rel="stylesheet" href="main.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="background-image: url('https://p16-flow-sign-va.ciciai.com/ocean-cloud-tos-us/63092a680a28409a911b894a16b97d39.png~tplv-6bxrjdptv7-image.png?rk3s=18ea6f23&x-expires=1747223458&x-signature=pgXzJcmOT5PvluaMW6zNe1lD4Vk%3D');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;">
    <?php include 'view/header.php'; ?>
    <!-- Home section -->
    <section id="home">
        <div class="container text-center">
            <h4>ARE YOU LOOKING FOR BEST BOOKS?</h4>
            <h1><span>Best Prices</span> This Season</h1>
            <p>Explore our latest collection of books, carefully curated for you.</p>
            <a href="product_catalog" class="btn btn-primary">Explore Books</a>
        </div>
    </section>

    <!-- Contact section -->
    <section id="contact" style="background-color: #333; color: #fff; padding: 50px 0;">
        <div class="container text-center">
            <h1>Contact Us</h1>
            <h3>Have questions or need assistance? Feel free to reach out to us.</h3>
            <img src="images/logo.jpg" alt="Logo" width="50">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <p><i class="fas fa-phone-alt"></i> Contact Number: +1234567890</p>
                    <p><i class="fab fa-instagram"></i> Instagram: <a href="https://www.instagram.com/bookshop/" target="_blank">@bookshop</a></p>
                    <p><i class="fab fa-facebook"></i> Facebook: <a href="https://www.facebook.com/bookshop/" target="_blank">BookShop</a></p>
                    <p><i class="fas fa-map-marker-alt"></i> Address: 123 Book Street, Skopje, N.Macedonia</p>
                </div>
            </div>
            <button class="btn btn-outline-light mt-4">Get in Touch</button>
        </div>
    </section>

    <!-- JavaScript and Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-vSrkaIVYfAl9ZaSR2q9sa/TEtNxTojT7FGqIpEAI+RxCzB2mEz2aei8Yk3pVVUEs" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-0iN4DdlsYYV6snxAvDOVcRV6JRloDE5Gm/1yoL7DHS/DgW2cdT8MbDoPOxg+nXk+G" crossorigin="anonymous"></script>
</body>
</html>
