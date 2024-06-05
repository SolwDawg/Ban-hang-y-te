<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

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
};

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
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/reset.css">
</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="products">
        <div class="bg-main">
            <div class="container">
                <div class="box">
                    <div class="breadcumb">
                        <a href="./home.php">home</a>
                        <span><i class="fa-solid fa-angles-right"></i></span>
                        <a href="./shop.php">all products</a>
                    </div>

                    <div class="shoping-products">
                        <div class="left">
                            <div class="categories">
                                <div class="categories-heading">
                                    <i class="fa-solid fa-filter"></i>
                                    <h3>Bộ lọc tìm kiếm</h3>
                                </div>
                                <div class="filter-group">
                                    <span class="filter-heading">Theo danh mục</span>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Máy đo huyết áp</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Máy đo đường huyết</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Máy xông họng</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Xe lăn</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Thiết bị khác</label>
                                        </label>
                                    </div>
                                    <div class="load-more">
                                        <i class="fa-solid fa-angle-down"></i>
                                        <span>Xem thêm</span>
                                    </div>
                                </div>
                                <div class="filter-group">
                                    <span class="filter-heading">Theo nơi bán</span>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">TP.HCM</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Hà Nội</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Đà Nẵng</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Vĩnh Phúc</label>
                                        </label>
                                    </div>
                                    <div class="load-more">
                                        <i class="fa-solid fa-angle-down"></i>
                                        <span>Xem thêm</span>
                                    </div>
                                </div>
                                <div class="filter-group">
                                    <span class="filter-heading">Đơn vị vận chuyển</span>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">TP.HCM</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Hà Nội</label>
                                        </label>
                                    </div>
                                    <div class="shop-filter">
                                        <label for="checkbox" class="checkbox-style">
                                          <input
                                            type="checkbox"
                                            id="checkbox"
                                            class="checkbox-input"
                                          />
                                          <div class="checkbox-box">
                                            <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="h-8 w-8"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                            >
                                              <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                              />
                                            </svg>
                                          </div>
                                          <label for="checkbox" class="checkbox-label">Đà Nẵng</label>
                                        </label>
                                    </div>
                                    <div class="load-more">
                                        <i class="fa-solid fa-angle-down"></i>
                                        <span>Vĩnh Phúc</span>
                                    </div>
                                </div>
                                <div class="filter-group">
                                    <span class="filter-heading">Khoảng giá</span>
                                    <div class="shop-price">
                                        <input type="text" placeholder="₫Từ">
                                        <div></div>
                                        <input type="text" placeholder="₫Đến">
                                    </div>
                                    <a href="" class="btn filter">Khoảng giá</a>
                                </div>
                            </div>
                            <a href="" class="btn">Áp dụng</a>
                        </div>
                        <div class="right">
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

                    <div class="box">
                        <ul class="pagination">
                            <li><a href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><i class="fa-solid fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>