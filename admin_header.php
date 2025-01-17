<?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                ';
        }
    }
?>

<header class="header">
        <div class="flex">
            <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
            <nav class="navbar">
                <a href="admin_page.php">Trang chủ</a>
                <a href="admin_product.php">Sản phẩm</a>
                <a href="admin_orders.php">Đơn hàng</a>
                <a href="admin_users.php">Tài khoản</a>
                <a href="admin_contacts.php">Tin nhắn</a>
            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user"></div>
            </div>

            <div class="account-box">
                <p>username: <span><?php echo $_SESSION['admin_name'];?></span> </p>
                <p>email: <?php echo $_SESSION['admin_email'];?> </p>
                <a href="logout.php" class="delete-btn">Đăng xuất</a>
                <div>new <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a>
                </div>            
            </div>

        </div>
</header>