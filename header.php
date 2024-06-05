<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
                <div class="message">
                    <span>' . $message . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                ';
    }
}
?>


<header class="header">

    <!-- mobile menu -->
    <div class="mobile-menu bg-second">
        <span class="mb-menu-toggle" id="mb-menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </span>
    </div>
    <!-- main header -->
    <div class="header-wrapper" id="header-wrapper">
        <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
            <i class="fa-solid fa-x"></i>
        </span>
        <!-- top header -->
        <div class="bg-main">
            <div class="mid-header container">
                <a href="home.php" class="logo">
                    <img srcset="./assets/image/logo.png 2x" alt="Logo">
                </a>
                <div class="search">
                    <input type="text" placeholder="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <ul class="user-menu">
                    <?php
                    $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                    $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
                    ?>
                    <li><a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a></li>
                    <?php
                    $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    $cart_num_rows = mysqli_num_rows($select_cart_count);
                    ?>
                    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><span>(<?php echo $cart_num_rows; ?>)</span></a></li>

                    <li class="user">
                        <i class="fa-solid fa-user"></i>
                        <div class="account-box">
                        <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                        <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                        <a href="logout.php" class="delete-btn">logout</a>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- bottom header -->
        <div class="bg-second">
            <div class="bottom-header container">
                <ul class="main-menu">
                    <li id="menu__white"><a href="home.php">Trang chủ</a></li>
                    <!-- mega menu -->
                    <li id ="menu__white" class="mega-dropdown">
                        <a href="./shop.php">Sản phẩm<i class="fa-solid fa-angle-down"></i></a>
                        <div class="mega-content">
                            <div class="box">
                                <h3>Máy xét nghiệm</h3>
                                <ul>
                                    <li><a href="#">máy xét nghiệm convergent</a></li>
                                    <li><a href="#">Xét nghiệm RT PCR</a></li>
                                    <li><a href="#">Máy phân tích nước tiểu</a></li>
                                </ul>
                            </div>
                            <div class="box">
                                <h3>Máy siêu âm</h3>
                                <ul>
                                    <li><a href="#">Máy siêu âm 2D</a></li>
                                    <li><a href="#">Máy siêu âm 4D 5D</a></li>
                                    <li><a href="#">Máy siêu âm Sonoscape</a></li>
                                    <li><a href="#">Máy siêu âm chison</a></li>
                                </ul>
                            </div>
                            <div class="box">
                                <h3>Thiết bị y tế</h3>
                                <ul>
                                    <li><a href="#">Hệ thống đo thân nhiệt tự động</a></li>
                                    <li><a href="#">Máy đo oxi</a></li>
                                    <li><a href="#">Máy tạo oxi</a></li>
                                </ul>
                            </div>
                            <div class="box">
                                <h3>Nội soi tai mũi họng</h3>
                                <ul>
                                    <li><a href="#">Máy nội soi tai mũi họng</a></li>
                                    <li><a href="#">Bàn khám tai mũi họng</a></li>
                                    <li><a href="#">Ghế khám tai mũi họng</a></li>
                                    <li><a href="#">Ống khám soi tai mũi họng</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li id="menu__white"><a href="about.php">Giới thiệu</a></li>
                    <li id="menu__white"><a href="contact.php">Liên Hệ</a></li>
                    <li id="menu__white"><a href="orders.php">Lịch sử đặt hàng</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>