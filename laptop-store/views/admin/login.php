<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập Quản trị</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .login-box {
      max-width: 420px;
      margin: 80px auto;
      padding: 30px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
  </style>
</head>>
<body>
    <div class="container">
  <div class="login-box">
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <h3 class="text-center mb-4">Đăng nhập Admin</h3>
    <form action="admin.php?controller=auth&action=handleLogin" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Tên đăng nhập</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>
    <div class="text-center mt-3">
      <a href="../index.php">← Quay về trang người dùng</a>
    </div>
  </div>
</div>
</body>
</html>