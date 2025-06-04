<?php 


class AdminBaoCaoThongKeController {

    
    private $modelThongKe;
    
    public function __construct() {
        $this->modelThongKe = new AdminThongKe();
    }

     public function trangChu() {

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: ".BASE_URL_ADMIN.'?act=dang-nhap');
            exit();
        }

        $stats = [
            'total_products' => $this->modelThongKe->layTongSanPham(),
            'total_orders' => $this->modelThongKe->layTongDonHang(),
            'total_users' => $this->modelThongKe->layTongNguoiDung(),
            'revenue' => $this->modelThongKe->layTongDoanhThu(),
            'recent_orders' => $this->modelThongKe->layDonHangMoiNhat(5),
            'recent_products' => $this->modelThongKe->laySanPhamMoiNhat(5)
        ];
        
        require_once './views/home.php';
    }
}
