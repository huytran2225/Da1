<?php


class AdminTaiKhoanController {
    public $modelTaiKhoan;

    public function __construct() {
        $this->modelTaiKhoan= new AdminTaiKhoan();
    }
     public function danhSachTaiKhoan() {
        // Kiểm tra quyền admin ở đây nếu cần
        $accounts = $this->modelTaiKhoan->getAllAdmins();
        include 'views/admin/danh_sach.php';
    }
   
    
    /**
     * Xem chi tiết tài khoản
     */
    public function chiTietTaiKhoan() {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header("Location: ".BASE_URL_ADMIN.'?act=tai-khoan-quan-tri');
            exit();
        }
        
        $account = $this->modelTaiKhoan->getById($id);
        if (!$account || $account['role'] != 'admin') {
            header("Location:".BASE_URL_ADMIN.'?act=tai-khoan-quan-tri');
            exit();
        }
        
        include 'views/admin/chi_tiet.php';
    }
}