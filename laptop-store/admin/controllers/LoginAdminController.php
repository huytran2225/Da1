
<?php

require_once 'models/AdminDangNhap.php';

class LoginAdminController {
    private $model;

    public function __construct() {
        $this->model = new TaiKhoan();
    }

      public function dangNhap() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->model->getByEmail($email);
            if ($user && $password === $user['password']) {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location:  ".BASE_URL_ADMIN.'');
                } else {
                    header("Location: ".BASE_URL.'index.php');
                }
                exit();
            } else {
                $error = "Sai tài khoản hoặc mật khẩu";
                include 'views/dangnhap/dang_nhap.php';
            }
        } else {
            include 'views/dangnhap/dang_nhap.php';
        }
    }

    public function dangXuat() {
        // Xóa tất cả session
        session_unset();
        session_destroy();
        
        // Chuyển hướng về trang đăng nhập admin
        header("Location: ".BASE_URL_ADMIN.'?act=dang-nhap');
        exit();
    }
}