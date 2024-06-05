<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, md5($filter_password));
    
    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
       $row = mysqli_fetch_assoc($select_user);

       if($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
       } elseif($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        }
    } else {
        $message[] = 'sai tai` khoan hoac mat khau!';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/reset.css">
</head>

<body>
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

    <section class="form-container">
        <form action="" method="POST">
            <h3>Đăng nhập</h3>
            <div class="form-field">
                <input type="text" name="email" class="form-input" placeholder=" " require>
                <label for="name" class="form-label">Email</label>
            </div>
            <div class="form-field">
            <input type="password" name="password" class="form-input" placeholder=" " require>
                <label for="name" class="form-label">Mật khẩu</label>
            </div>
            <input type="submit" class="btn" name="submit" value="Đăng nhập">
            <p>Chưa có tài khoản? <a href="register.php">Đăng kí ngay</a></p>
        </form>
    </section>
</body>

</html>