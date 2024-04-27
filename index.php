<?php
// Database connection and product fetch
include('dbConn.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
    <link rel="stylesheet" href="slider.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <h1>Camera Management System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="addProduct.html">Add Product</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Featured Products</h2>
            <div id="product-slider">
                <div class="slider-container">
                    <!-- Slider images and card-like format -->
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            <div class="product-details">
                                <h3><?php echo $product['name']; ?></h3>
                                <p>Production Date: <?php echo $product['productionDate']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-controls">
                    <button class="prev-btn">&laquo; Prev</button>
                    <button class="next-btn">Next &raquo;</button>
                </div>
            </div>
        </section>
    </main>

    <script>
        var currentIndex = 0;

        function initializeSlider() {
            var sliderContainer = $('.slider-container');

            // Show the first image
            sliderContainer.find('.product-card').hide().eq(currentIndex).show();

            // Slider controls
            $('.prev-btn').click(function() {
                showPrevImage();
            });

            $('.next-btn').click(function() {
                showNextImage();
            });
        }

        function showPrevImage() {
            var sliderContainer = $('.slider-container');
            var images = sliderContainer.find('.product-card');

            images.eq(currentIndex).hide();
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            images.eq(currentIndex).show();
        }

        function showNextImage() {
            var sliderContainer = $('.slider-container');
            var images = sliderContainer.find('.product-card');

            images.eq(currentIndex).hide();
            currentIndex = (currentIndex + 1) % images.length;
            images.eq(currentIndex).show();
        }

        $(document).ready(function() {
            initializeSlider();
        });
    </script>
</body>
</html>
