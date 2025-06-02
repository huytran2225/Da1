<?php
session_start();
// Đây là file chạy chính (Là nơi chúng require các file)
require_once "../common/env.php";    // Chứa các biến môi trường
require_once "../common/function.php";   // Chứa các hàm dùng chung

// require các controller mà route trỏ tới
require_once "./controllers/AdminDanhMucController.php";
require_once "./controllers/AdminSanPhamController.php";
require_once "./controllers/AdminDonHangController.php";
require_once"./controllers/AdminTaiKhoanController.php";
// require Các model mà controller muốn sử dụng
require_once "./models/AdminDanhMuc.php";
require_once "./models/AdminSanPham.php";
require_once "./models/AdminDonHang.php";
require_once "./models/AdminTaikhoan.php";
// Route (Điều hướng)
$act = $_GET['act'] ?? '/';

match ($act) {
  //route báo cáo - trang chủ
  
  // router danh mục
  'danh-muc' =>(new AdminDanhMucController())->danhSachDanhMuc(),
  'form-them-danh-muc' =>(new AdminDanhMucController())->formAddDanhMuc(),
  'them-danh-muc' =>(new AdminDanhMucController())->postAddDanhMuc(),
  'form-sua-danh-muc' =>(new AdminDanhMucController())->formEditDanhMuc(),
  'sua-danh-muc' =>(new AdminDanhMucController())->postEditDanhMuc(),
  'xoa-danh-muc' =>(new AdminDanhMucController())->deleteDanhMuc(),
//san pham
      'san-pham' =>(new AdminSanPhamController())->danhSachSanPham(),
     'form-them-san-pham' =>(new AdminSanPhamController())->formAddSanPham(),
     'them-san-pham' =>(new AdminSanPhamController())->postAddSanPham(),
     'form-sua-san-pham' =>(new AdminSanPhamController())->formEditSanPham(),
     'sua-san-pham' =>(new AdminSanPhamController())->postEditSanPham(),
     'xoa-san-pham' =>(new AdminSanPhamController())->deleteSanPham(),
'chi-tiet-san-pham' => (new AdminSanPhamController())->chiTietSanPham(),
'xoa-anh'=>(new AdminSanPhamController())->deleteImage(),
'them-anh-phu'=>(new AdminSanPhamController())->addGalleryImages(),

// route đơn hàng
'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
'chi-tiet-don-hang' => (new AdminDonHangController())->chiTietDonHang(),
'cap-nhat-trang-thai' => (new AdminDonHangController())->capNhatTrangThai(),
//
'tai-khoan-quan-tri' =>(new AdminTaiKhoanController())->danhSachTaiKhoan(),
'chi-tiet-tai-khoan'=>(new AdminTaiKhoanController())->chiTietTaiKhoan(),
};