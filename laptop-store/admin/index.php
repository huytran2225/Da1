<?php
session_start();
// Đây là file chạy chính (Là nơi chúng require các file)
require_once "../common/env.php";    // Chứa các biến môi trường
require_once "../common/function.php";   // Chứa các hàm dùng chung

// require các controller mà route trỏ tới
require_once "./controllers/AdminDanhMucController.php";
require_once "./controllers/AdminSanPhamController.php";
require_once "./controllers/AdminDonHangController.php";
require_once "./controllers/AdminTaiKhoanController.php";
require_once "./controllers/KhachHangController.php";
require_once "./controllers/LoginAdminController.php";
require_once "./controllers/AdminBaoCaoThongKeController.php";
require_once "./controllers/CaNhanController.php";

// require Các model mà controller muốn sử dụng
require_once "./models/AdminDanhMuc.php";
require_once "./models/AdminSanPham.php";
require_once "./models/AdminTaiKhoan.php";
require_once "./models/KhachHang.php";
require_once "./models/AdminDonHang.php";
require_once "./models/AdminDangNhap.php";
require_once "./models/AdminThongKe.php";
require_once "./models/CaNhan.php";


// Route (Điều hướng)
$act = $_GET['act'] ?? '/';

match ($act) {
  //route báo cáo - trang chủ
  '/'=>(new AdminBaoCaoThongKeController())->trangChu(),
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
'cap-nhat-trang-thai-thanh-toan' => (new AdminDonHangController())->capNhatTrangThaiThanhToan(),

//ca nhan
'tai-khoan-ca-nhan' => (new CaNhanController())->index(),
'ca-nhan' => (new CaNhanController())->index(),
'cap-nhat-thong-tin' => (new CaNhanController())->update(),

//quan tri
'tai-khoan-quan-tri' =>(new AdminTaiKhoanController())->danhSachTaiKhoan(),
'chi-tiet-tai-khoan'=>(new AdminTaiKhoanController())->chiTietTaiKhoan(),

//khách hàng
'tai-khoan-khach-hang' =>(new KhachHangController())->danhSachTaiKhoan(),
'chi-tiet-khach-hang'=>(new KhachHangController())->chiTietTaiKhoan(),


'dang-nhap' => (new LoginAdminController())->dangNhap(),
'dang-xuat' => (new LoginAdminController())->dangXuat(),
};