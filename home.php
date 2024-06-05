<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}


if (isset($_POST['add_to_wishlist'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_wishlist_numbers) > 0) {
        $message[] = 'already added to wishlist';
    } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'product added to wishlist';
    }
}

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart';
    } else {

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <!-- custom css file link  -->
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <?php @include 'header.php'; ?>


    <!-- <section class="heading">
        <h3>Trang chủ</h3>
        <p> <a href="home.php">Trang chủ</p>
    </section> -->

    <section class="products">
        <div class="bg-main">
            <div class="container">
                <div class="box">
                    <h1>Sản phẩm mới nhất</h1>
                    <div class="products">
                        <div class="box-container">
                            <?php
                            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                            if (mysqli_num_rows($select_products) > 0) {
                                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                            ?>
                                    <form action="" method="POST" class="product-card">
                                        <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>">
                                            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                                            <div class="name-box">
                                                <div class="name"><?php echo $fetch_products['name']; ?></div>
                                            </div>
                                            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                            <div class="price"><?php echo $fetch_products['price']; ?>VND</div>
                                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                                        </a>
                                    </form>
                            <?php
                                }
                            } else {
                                echo '<p class="empty">Không có sản phẩm nào</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="more-btn">
        <a href="shop.php" class="btn more">Thêm sản phẩm</a>
    </div>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>