<?php
// views/order_success.php
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message  = $_SESSION['message'] ?? "";
unset($_SESSION['message']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đặt hàng thành công</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/assets/css/templatemo.css">
    <link rel="stylesheet" href="views/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="views/assets/css/fontawesome.min.css">
    <!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>

    <?php

    include("header.php");
    ?>

    <body class="bg-light">
        <div class="container py-5 text-center">
            <div class="alert alert-success">
                <h1 class="mb-3">🎉 Đặt hàng thành công!</h1>
                <p><?= htmlspecialchars($message) ?></p>
                <p>Mã đơn hàng của bạn: <strong>#<?= $order_id ?></strong></p>
            </div>
            <a href="index.php" class="btn btn-primary">🛍️ Tiếp tục mua sắm</a>
            <a href="index.php?act=orders" class="btn btn-secondary">📋 Xem đơn hàng</a>
        </div>
    </body>

</html>