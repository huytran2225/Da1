<?php
require_once 'models/Customer.php';

class AuthController {
    public function login() {
        include 'views/auth.login.php';
    }

    public function handleLogin(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $customerModel = new Customer();
        $customer = $customerModel -> getByEmail($email);

        if ($customer && password_verify($password, $customer['password'])) {
            $_SESSION['customer_id'] = $customer['id'];
            $_SESSION['customer_name'] = $customer['customer_name'];
            $_SESSION['customer_email'] = $customer['customer_email'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Email hoặc mật khẩu không chính xác";
            header("Location: index.php?controller=auth&action login");
            exit();
        }
    }

    public function register() {
        include 'views/auth/register.php';
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=auth&action=register");
            exit();
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['condrm_password'] ?? '';
        $phone = $_POST-['phone'] ?? '';
        $address = $_POST['address'] ?? '';

        //validate input
        $errors = [];
        if (empty($name)) $errors[] = "Vui lòng nhập họ tên";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] "Email không hợp lệ";
        if (strlen($password) < 6) $errors[] = "Mật khẩu phải có ít nhất 6 kí tự";
        if ($password !== $confirmPassword) $errors[] = "Mật khẩu xác nhận không khớp";
        if (empty($phone)) $errors[] = "Vui lòng nhập số điện thoại";

        $customerModel = new Customer();;
        if ($customerModel->emailExists($email)) {
            $errors[] = "Email đã được sử dụng";
        }

        if ($customerModel->creater($name, $email, $password, $phone, $address)) {
            $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập";
            exit();
        } else {
            $_SESSION['error'] = "Đăng ký không thành công. Vui lòng thử lại";
            header("Location: index.php?controller=auth&action=register");
            exit();
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>