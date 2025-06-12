<?php
//Controllers/UserController.php
require_once 'models/user.php'

class UserController {
    private $user_model;

    public function __construct()
    {
        $this->user_model = new User();
    }

    /**
     * Hiển thị form hoặc xử lý POST login
     */
    public function login()
    {
        // Nếu đã POST form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            // Nếu có redirect (ví dụ checkout)
            $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'home';

            $user = $this->user_model->login($email, $password);
            if ($user) {
                // Lưu session
                $_SESSION['user']    = $user;
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php?act=" . $redirect);
                exit;
            } else {
                $_SESSION['error'] = "Email hoặc mật khẩu không đúng.";
                header("Location: index.php?act=login&redirect=" . $redirect);
                exit;
            }
        }
        // Nếu GET: hiển thị form login
        $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'home';
        require_once 'views/login.php';
    }

    /**
     * Đăng xuất
     */
    public function logout()
    {
        unset($_SESSION['user'], $_SESSION['user_id']);
        header("Location: index.php");
        exit;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name            = trim($_POST['name']);
            $email           = trim($_POST['email']);
            $password        = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $phone           = trim($_POST['phone'] ?? '');
            $address         = trim($_POST['address'] ?? '');

            // 1. Kiểm tra password match
            if ($password !== $confirm_password) {
                $_SESSION['reg_error'] = "Mật khẩu và xác nhận không khớp.";
                header("Location: index.php?act=login"); // form đăng ký nằm cùng login
                exit;
            }

            // 2. Đăng ký
            $ok = $this->user_model->register($name, $email, $password, $phone, $address);
            if ($ok) {
                $_SESSION['reg_success'] = "Đăng ký thành công! Bạn có thể đăng nhập ngay.";
            } else {
                $_SESSION['reg_error'] = "Email đã tồn tại hoặc có lỗi. Vui lòng thử lại.";
            }
            header("Location: index.php?act=login");
            exit;
        }
        // Nếu GET: chuyển hướng về form (tab đăng ký) trong login.php
        header("Location: index.php?act=login");
        exit;
    }
}