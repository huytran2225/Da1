<?php


class KhachHangController {
    
    public $modelTaiKhoanCustomer;

    public function __construct() {
        
        $this->modelTaiKhoanCustomer= new KhachHang();
    }

    public function danhSachTaiKhoan() {
        
        $accounts = $this->modelTaiKhoanCustomer->getAllCustomer();
        include 'views/khachhang/danh_sach.php';
    }
    
    
    /**
     * Xem chi tiết tài khoản
     */
    public function chiTietTaiKhoan() {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header("Location: ".BASE_URL_ADMIN.'?act=tai-khoan-khach-hang');
            exit();
        }
        
        $account = $this->modelTaiKhoanCustomer->getByIdCustomer($id);
        if (!$account || $account['role'] != 'customer') {
            header("Location:".BASE_URL_ADMIN.'?act=tai-khoan-khach-hang');
            exit();
        }
        
        include 'views/khachhang/chi_tiet.php';
    }
}