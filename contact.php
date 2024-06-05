<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/reset.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="contact">

        <div class="box-container">
            <div class="leftside">
                <div class="contact-header">
                    <div class="userimg">
                        <img src="./assets/image/logo.png" class="cover" alt="">
                    </div>
                    <ul class="nav_icons">
                        <li><i class="fa-regular fa-circle"></i></li>
                        <li><i class="fa-solid fa-message"></i></li>
                        <li><i class="fa-solid fa-ellipsis-vertical"></i></li>
                    </ul>
                </div>

                <div class="search_chat">
                    <div>
                        <input type="text" placeholder="Search or start new chat">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>

                <div class="chatlist">
                    <div class="block active">
                        <div class="imgbx">
                            4<img src="./assets/image/logo.png" alt="" class="cover">
                        </div>
                        <div class="details">
                            <div class="listHead">
                                <h4>Dang Thai Son</h4>
                                <p class="time">3:03</p>
                            </div>
                            <div class="Message_p">
                                <p>Deadline đến rồi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rightside">
                <div class="contact-header">
                    <div class="imgText">
                        <div class="userimg">
                            <img src="./assets/image/logo.png" class="cover" alt="">
                        </div>
                        <h4>Đặng Thái Sơn<br><span>online</span></h4>
                    </div>
                    <ul class="nav_icons">
                        <li><i class="fa-solid fa-magnifying-glass"></i></li>
                        <li><i class="fa-solid fa-ellipsis-vertical"></i></li>
                    </ul>
                </div>

                <div class="chatBox">
                    <div class="contact-message my_message">
                        <p>Hi<br><span>3:04</span></p>
                    </div>
                    <div class="contact-message frnd_message">
                        <p>Hello<br><span>3:05</span></p>
                    </div>
                    <div class="contact-message my_message">
                        <p>Hi<br><span>3:04</span></p>
                    </div>
                    <div class="contact-message frnd_message">
                        <p>Hello<br><span>3:05</span></p>
                    </div>
                    <div class="contact-message my_message">
                        <p>Hi<br><span>3:04</span></p>
                    </div>
                    <div class="contact-message frnd_message">
                        <p>Hello<br><span>3:05</span></p>
                    </div>
                    <div class="contact-message my_message">
                        <p>Hi<br><span>3:04</span></p>
                    </div>
                    <div class="contact-message frnd_message">
                        <p>Hello<br><span>3:05</span></p>
                    </div>
                </div>
                <div class="chatbox_input">
                    <i class="fa-solid fa-face-smile"></i>
                    <i class="fa-solid fa-paperclip-vertical"></i>
                    <input type="text" placeholder="Type a message">
                    <i class="fa-solid fa-microphone"></i>
                </div>
            </div>
        </div>

    </section>


    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>