<?php

@include 'config.php';

if (isset($_POST['submit'])) {
    // there two lines are very important for extra security purpose in form

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);
    $nameErr = $emailErr = " ";

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, md5($filter_password));
    $filter_passwordc = filter_var($_POST['passwordc'], FILTER_SANITIZE_STRING);
    $passwordc = mysqli_real_escape_string($conn, md5($filter_passwordc));

    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
        $message[] = 'tài khoản đã tồn tại!';
    } else {
        if ($password != $passwordc) {
            $message[] = 'mật khẩu không trùng khớp!';
        } else {
            mysqli_query($conn, "INSERT INTO `user`(name, email, password) VALUES ('$name', '$email', '$password')") or die('query failed');
            $message[] = 'đã đăng ký thành công!';
            header('location:login.php');
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font-awsome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- css style link  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/reset.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
                <div class="message">
                    <span>' .$message. '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                ';
        }
    }
    ?>

    <section class="form-container">
        <form action="" method="POST">
            <h3 class="signup__heading">Đăng ký tài khoản</h3>
            <div class="form-field">
                <input type="text" name="name" placeholder=" " class="form-input" require>
                <label for="name" class="form-label">Tên tài khoản</label>
            </div>
            <div class="form-field">
                <input type="text" name="email" placeholder=" " class="form-input" require>
                <label for="name" class="form-label">Email</label>
            </div>
            <div class="form-field">
                <input type="password" name="password" placeholder=" " class="form-input" require>
                <label for="name" class="form-label">mật khẩu</label>
            </div>
            <div class="form-field">
                <input type="password" name="passwordc" placeholder=" " class="form-input" require>
                <label for="name" class="form-label">nhập lại mật khẩu</label>
            </div>
            <input type="submit" class="btn" name="submit" value="Đăng ký">
            <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        </form>
    </section>
</body>

</html>