<?php
session_start();
// Đây là file chạy chính (Là nơi chúng require các file)
require_once "../common/env.php";    // Chứa các biến môi trường
require_once "../common/function.php";   // Chứa các hàm dùng chung

// require các controller mà route trỏ tới
require_once "./controllers/AdminDanhMucController.php";

// require Các model mà controller muốn sử dụng
require_once "./models/AdminDanhMuc.php";


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
};