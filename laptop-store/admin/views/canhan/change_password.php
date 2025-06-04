<?php include 'views/layout/header.php'; ?>

<div class="container mt-5">
    <h3>Đổi mật khẩu</h3>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=ca_nhan&action=change_password">
        <div class="form-group">
            <label>Mật khẩu hiện tại</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nhập lại mật khẩu mới</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Xác nhận</button>
        <a href="index.php?controller=ca_nhan&action=index" class="btn btn-secondary mt-3">Quay lại</a>
    </form>
</div>

<?php include 'views/layout/footer.php'; ?>
<?php include 'views/layout/header.php'; ?>

<div class="container mt-5">
    <h3>Đổi mật khẩu</h3>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=ca_nhan&action=change_password">
        <div class="form-group">
            <label>Mật khẩu hiện tại</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nhập lại mật khẩu mới</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Xác nhận</button>
        <a href="index.php?controller=ca_nhan&action=index" class="btn btn-secondary mt-3">Quay lại</a>
    </form>
</div>

<?php include 'views/layout/footer.php'; ?>
