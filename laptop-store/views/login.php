<?php
// views/login.php
$redirect = $_GET['redirect'] ?? 'home';
// Login messages
$loginError = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
// Register messages
$regError   = $_SESSION['reg_error'] ?? '';
$regSuccess = $_SESSION['reg_success'] ?? '';
unset($_SESSION['reg_error'], $_SESSION['reg_success']);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>LaptopTech – Đăng nhập / Đăng ký</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="views/assets/img/apple-icon.png">
    <link rel="shortcut icon" href="views/assets/img/favicon.ico">

    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/assets/css/templatemo.css">
    <link rel="stylesheet" href="views/assets/css/custom.css">
    <link rel="stylesheet" href="views/assets/css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">
    <?php

    include("header.php");
    ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                            type="button" role="tab">Đăng nhập</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                            type="button" role="tab">Đăng ký</button>
                    </li>
                </ul>

                <div class="tab-content" id="authTabContent">
                    <!-- Login Form -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <?php if ($loginError): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
                        <?php endif; ?>
                        <form action="index.php?act=login" method="post">
                            <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div class="tab-pane fade" id="register" role="tabpanel">
                        <?php if ($regError): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($regError) ?></div>
                        <?php elseif ($regSuccess): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($regSuccess) ?></div>
                        <?php endif; ?>
                        <form action="index.php?act=register" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ & Tên</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="reg_email" class="form-label">Email</label>
                                <input type="email" id="reg_email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="reg_password" class="form-label">Mật khẩu</label>
                                <input type="password" id="reg_password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <textarea id="address" name="address" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="views/assets/js/jquery-1.11.0.min.js"></script>
    <script src="views/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>