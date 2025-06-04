<?php
require_once 'models/CaNhan.php';

class CaNhanController {
    private $caNhanModel;

    public function __construct() {
        $this->caNhanModel = new CaNhan();
    }

    // Hiển thị trang cá nhân
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: '.BASE_URL_ADMIN.'?act=dang-nhap');
            exit();
        }

        $user = $this->caNhanModel->getById($_SESSION['user']['id']);
        require_once 'views/canhan/index.php';
    }

  
    // Cập nhật thông tin cá nhân
    public function update() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user'])) {
            header('Location:'.BASE_URL_ADMIN.'?act=dang-nhap');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user']['id'];
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? ''
            ];

            // Validate dữ liệu
            if (empty($data['name']) || empty($data['email']) || empty($data['phone'])) {
                $_SESSION['update_error'] = 'Vui lòng điền đầy đủ thông tin bắt buộc';
                header('Location:'.BASE_URL_ADMIN.'?act=tai-khoan-ca-nhan');
                exit();
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['update_error'] = 'Email không hợp lệ';
                header('Location: '.BASE_URL_ADMIN.'?act=tai-khoan-ca-nhan');
                exit();
            }

            // Cập nhật thông tin
            if ($this->caNhanModel->update($id, $data)) {
                $_SESSION['update_success'] = 'Cập nhật thông tin thành công';
                // Cập nhật thông tin user trong session
                $_SESSION['user'] = array_merge($_SESSION['user'], $data);
            } else {
                $_SESSION['update_error'] = 'Có lỗi xảy ra khi cập nhật thông tin';
            }

            header('Location: '.BASE_URL_ADMIN.'?act=tai-khoan-ca-nhan');
            exit();
        }
    }
}
