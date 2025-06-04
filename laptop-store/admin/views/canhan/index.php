<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thông Tin Cá Nhân</title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&display=swap">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper -->
  <div class="content-wrapper pt-4">
    <div class="container">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Thông tin cá nhân</h3>
        </div>
        <div class="card-body">
          
          <?php if (isset($_SESSION['update_success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['update_success']; unset($_SESSION['update_success']); ?></div>
          <?php endif; ?>

          <?php if (isset($_SESSION['update_error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['update_error']; unset($_SESSION['update_error']); ?></div>
          <?php endif; ?>

          <form action="?act=cap-nhat-thong-tin" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Họ và tên</label>
                  <input type="text" name="name" class="form-control" id="name"
                         value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email"
                         value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Số điện thoại</label>
                  <input type="tel" name="phone" class="form-control" id="phone"
                         value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">Địa chỉ</label>
                  <input type="text" name="address" class="form-control" id="address"
                         value="<?= htmlspecialchars($user['address'] ?? '') ?>">
                </div>
              </div>
            </div>

            <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Cập nhật thông tin
              </button>
              <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
