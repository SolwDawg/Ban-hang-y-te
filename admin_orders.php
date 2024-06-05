<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['payment_status'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');
    $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="./assets/css/admin_style.css">
    <link rel="stylesheet" href="./assets/css/reset.css">
</head>

<body>

    <?php
    @include 'admin_header.php';
    ?>

    <section class="placed-orders">

        <h1 class="title">Đơn hàng</h1>

        <div class="box-container">

            <?php

            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                    <div class="box">
                        <p> id người dùng : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                        <p> Ngày đặt hàng : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                        <p> Tên : <span><?php echo $fetch_orders['name']; ?></span> </p>
                        <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
                        <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                        <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
                        <p> Sản phẩm : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                        <p> tổng tiền : <span><?php echo $fetch_orders['total_prices']; ?>VNĐ</span> </p>
                        <p> phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
                        <form action="" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                            <select name="update_payment">
                                <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                                <option value="đang chờ xác nhận">đang chờ xác nhận</option>
                                <option value="đã xác nhận">đã xác nhận</option>
                            </select>
                            <input type="submit" name="update_order" value="cập nhật" class="option-btn">
                            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('xóa đơn hàng này?');">Xóa</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Không có sản phẩm được đặt hàng!</p>';
            }
            ?>
        </div>

    </section>


    <script src="js/admin_script.js"></script>

</body>

</html>