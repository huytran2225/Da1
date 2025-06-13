<?php
require_once 'models/Admin.php';

class AdminAuthController {
    public function login() {
        include 'views/admin.login.php';
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: admin.php?controller=auth&action=login");
            exit();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $adminModel = new Admin();
        $admin = $adminModel -> getByUsername($username);

        if ($admin && $password === $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: http://localhost/Da1/laptop-store/admin/?act=danh-muc ");
            exit();
        } else {
            $_SESSION['error'] = "Tên đăng nhập hoặc mật khẩu không chính xác";
            header("Location: admin.php?controller=auth&action=login");
            exit();
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: admin.php?controller=auth&action=login");
        exit();
    }
}
?>