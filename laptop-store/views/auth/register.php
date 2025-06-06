<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .error {
        color: red;
        margin-top: 5px;
    }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['errors'])): ?>
                <div class="alert alert-danger">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <form method="POST" action="index.php?controller=auth&action=handleRegister"
                    class="card p-4 shadow-sm bg-white">
                    <h2 class="text-center mb-4">Đăng ký khách hàng</h2>

                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= $_SESSION['old_input']['name'] ?? '' ?>" required>
                        <?php unset($_SESSION['old_input']['name']); ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Địa chỉ Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= $_SESSION['old_input']['email'] ?? '' ?>" required>
                        <?php unset($_SESSION['old_input']['email']); ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu (ít nhất 6 ký tự)</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="<?= $_SESSION['old_input']['phone'] ?? '' ?>" required>
                        <?php unset($_SESSION['old_input']['phone']); ?>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <textarea class="form-control" id="address"
                            name="address"><?= $_SESSION['old_input']['address'] ?? '' ?></textarea>
                        <?php unset($_SESSION['old_input']['address']); ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Đăng ký</button>

                    <div class="text-center mt-3">
                        Đã có tài khoản? <a href="index.php?controller=auth&action=login">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>