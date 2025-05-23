<?php 
class AdminSanPhamController{
    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
  
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc= new AdminDanhMuc();
    }
 
    public function danhSachSanPham(){
       
    $listSanPham = $this->modelSanPham->getAllSanPham();   
       require_once './views/sanpham/listSanPham.php';
    }
    
    public function formAddSanPham(){
         //hien thi form nhap
         $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
         require_once './views/sanpham/addSanPham.php';
         

     }
     public function postAddSanPham(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['product_name'];
            $category_id = $_POST['category_id'];
            $brand = $_POST['brand'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $hinh_anh = $_FILES['image'];
            $description = $_POST['description'];
            
            // Validate dữ liệu
            $errors = [];
            if (empty($name)) $errors['product_name'] = 'Không được để trống';
            if (empty($category_id)) $errors['category_id'] = 'Không được để trống';
            if (empty($brand)) $errors['brand'] = 'Không được để trống';
            if (empty($price) || $price <= 0) $errors['price'] = 'Giá phải là số dương';
            if (empty($stock) || $stock <= 0) $errors['stock'] = 'Số lượng phải là số dương';
    
            if(empty($errors)){
                $file_thumb = uploadFile($hinh_anh,'./uploads/');
                if($file_thumb){
                    $result = $this->modelSanPham->insertSanPham($name, $category_id, $brand, $price, $stock, $file_thumb, $description);
                    if($result){
                        header("Location: ".BASE_URL.'admin/?act=san-pham');
                        exit();
                    }
                }
                $errors['image'] = 'Upload ảnh thất bại';
            }
            
            // Nếu có lỗi, hiển thị lại form
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
            require_once './views/sanpham/addSanPham.php';
        }
    }
        
    // Thêm vào class AdminSanPhamController trong file AdminSanPhamController.php

public function formEditSanPham() {
    $id = $_GET['id_san_pham'];
    $sanPham = $this->modelSanPham->getDetailSanPham($id);
    
    if ($sanPham) {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/editSanPham.php';
    } else {
        header("Location: ".BASE_URL.'admin/?act=san-pham');
    }
}

public function postEditSanPham() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $hinh_anh = $_FILES['image'];
        $description = $_POST['description'];
        
        // Validate dữ liệu
        $errors = [];
        if (empty($name)) $errors['product_name'] = 'Không được để trống';
        if (empty($category_id)) $errors['category_id'] = 'Không được để trống';
        if (empty($brand)) $errors['brand'] = 'Không được để trống';
        if (empty($price) || $price <= 0) $errors['price'] = 'Giá phải là số dương';
        if (empty($stock) || $stock <= 0) $errors['stock'] = 'Số lượng phải là số dương';

        if(empty($errors)){
            $file_thumb = null;
            // Nếu có upload ảnh mới
            if($hinh_anh['size'] > 0) {
                $file_thumb = uploadFile($hinh_anh,'./uploads/');
                if(!$file_thumb) {
                    $errors['image'] = 'Upload ảnh thất bại';
                }
            } else {
                // Lấy ảnh cũ nếu không upload ảnh mới
                $sanPham = $this->modelSanPham->getDetailSanPham($id);
                $file_thumb = $sanPham['image'];
            }

            if(empty($errors)) {
                $result = $this->modelSanPham->updateSanPham($id, $name, $category_id, $brand, $price, $stock, $file_thumb, $description);
                if($result) {
                    header("Location: ".BASE_URL.'admin/?act=san-pham');
                    exit();
                }
            }
        }
        
        // Nếu có lỗi, hiển thị lại form
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/editSanPham.php';
    }
}

public function deleteSanPham() {
    $id = $_GET['id_san_pham'];
    $sanPham = $this->modelSanPham->getDetailSanPham($id);
    
    if ($sanPham) {
        if ($this->modelSanPham->isProductInOrder($id)) {
            $_SESSION['error'] = "Không thể xóa sản phẩm vì đã tồn tại trong đơn hàng.";
        } else {
            $result = $this->modelSanPham->destroySanPham($id);
            if($result) {
                $_SESSION['success'] = "Xóa sản phẩm thành công";
            } else {
                $_SESSION['error'] = "Xóa sản phẩm thất bại";
            }
        }
    }
    header("Location: ".BASE_URL.'admin/?act=san-pham');
    exit();
}
public function chiTietSanPham() {
    $id = $_GET['id_san_pham'];
    $sanPham = $this->modelSanPham->getDetailSanPham($id);
    
    if ($sanPham) {
        require_once './views/sanpham/chiTietSanPham.php';
    } else {
        $_SESSION['error'] = 'Sản phẩm không tồn tại';
        header("Location: ".BASE_URL.'admin/?act=san-pham');
        exit();
    }
}

}
?>