<!-- Header -->
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- Sidebar -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chi tiết tài khoản</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Thông tin tài khoản</h3>
        </div>

        <div class="card-body">
          <dl class="row">
            <dt class="col-sm-3">Tên</dt>
            <dd class="col-sm-9"><?= $account['name'] ?></dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9"><?= $account['email'] ?></dd>

            <dt class="col-sm-3">Điện thoại</dt>
            <dd class="col-sm-9"><?= $account['phone'] ?></dd>

            <dt class="col-sm-3">Địa chỉ</dt>
            <dd class="col-sm-9"><?= $account['address'] ?></dd>

            <dt class="col-sm-3">Vai trò</dt>
            <dd class="col-sm-9">
              <?php if ($account['role'] === 'admin'): ?>
                <span class="badge badge-danger">Quản trị viên</span>
              <?php else: ?>
                <span class="badge badge-primary">Khách hàng</span>
              <?php endif; ?>
            </dd>
          </dl>
        </div>

        <div class="card-footer">
    
          <a href="?act=tai-khoan-quan-tri" class="btn btn-secondary">Quay lại</a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Footer -->
<?php include './views/layout/footer.php'; ?>
