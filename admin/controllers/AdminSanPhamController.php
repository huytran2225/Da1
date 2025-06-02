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
    public function postAddSanPham() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['product_name'];
            $category_id = $_POST['category_id'];
            $brand = $_POST['brand'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $thumbnail = $_FILES['thumbnail'] ?? null; // Sửa từ 'image' sang 'thumbnail'
            $description = $_POST['description'];
        }
             $errors = [];
            if (empty($name)) $errors['product_name'] = 'Không được để trống';
            if (empty($category_id)) $errors['category_id'] = 'Không được để trống';
            if (empty($brand)) $errors['brand'] = 'Không được để trống';
            if (empty($price) || $price <= 0) $errors['price'] = 'Giá phải là số dương';
            if (empty($stock) || $stock <= 0) $errors['stock'] = 'Số lượng phải là số dương';
            if (!$thumbnail || $thumbnail['error'] !== UPLOAD_ERR_OK) {
                $errors['thumbnail'] = 'Vui lòng chọn ảnh đại diện';
            }
    
            if(empty($errors)){
                $file_thumb = uploadFile($thumbnail, './uploads/');
                if($file_thumb){
                    $product_id= $this->modelSanPham->insertSanPham($name, $category_id, $brand, $price, $stock, $file_thumb, $description);
                    if($product_id){
                        // Xử lý upload ảnh phụ nếu có
                        if (!empty($_FILES['gallery']['name'][0])) {
                            $galleryPaths = uploadMultipleFiles($_FILES['gallery'], './uploads/');
                            foreach ($galleryPaths as $path) {
                                $this->modelSanPham->addProductImage($product_id, $path);
                            }
                        }
                        
                        $_SESSION['success'] = "Thêm sản phẩm thành công";
                        header("Location: ".BASE_URL.'admin/?act=san-pham');
                        exit();
                    }
                }
                $errors['thumbnail'] = 'Upload ảnh thất bại';
            
            
            // Nếu có lỗi, hiển thị lại form
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
            require_once './views/sanpham/addSanPham.php';
            }
}

public function formEditSanPham() {
    $id = $_GET['id_san_pham'];
    $sanPham = $this->modelSanPham->getDetailSanPham($id);
    
    if ($sanPham) {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        $product_images = $this->modelSanPham->getProductImages($id);
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
        $image = $_FILES['image'] ?? null;  // Sửa từ 'image' sang 'thumbnail'
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
            // Xử lý ảnh đại diện
            if($image && $image['error'] === UPLOAD_ERR_OK) {
                $file_thumb = uploadFile($image, './uploads/');
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
                    // Xử lý ảnh phụ nếu có
                    if (!empty($_FILES['new_gallery']['name'][0])) {
                        $galleryPaths = uploadMultipleFiles($_FILES['new_gallery'], './uploads/');
                        foreach ($galleryPaths as $path) {
                            $this->modelSanPham->addProductImage($id, $path);
                        }
                    }
                    
                    $_SESSION['success'] = "Cập nhật sản phẩm thành công";
                    header("Location: ".BASE_URL_ADMIN.'?act=san-pham');
                    exit();
                } else {
                    $_SESSION['error'] = "Cập nhật sản phẩm thất bại";
                    header("Location: ".BASE_URL_ADMIN.'?act=sua-san-pham&id_san_pham='.$id);
                    exit();
            }
        }
    }
        // Nếu có lỗi, hiển thị lại form
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $product_images = $this->modelSanPham->getProductImages($id);
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
        $product_images = $this->modelSanPham->getProductImages($id);
        require_once './views/sanpham/chiTietSanPham.php';
    } else {
        $_SESSION['error'] = 'Sản phẩm không tồn tại';
        header("Location: ".BASE_URL.'admin/?act=san-pham');
        exit();
    }
}
public function deleteImage() {
    $image_id = $_GET['id'];
    $product_id = $_GET['product_id'];
    
    if ($this->modelSanPham->deleteProductImage($image_id)) {
        $_SESSION['success'] = "Xóa ảnh thành công";
    } else {
        $_SESSION['error'] = "Xóa ảnh thất bại";
    }
    
    // Redirect về trang chi tiết sản phẩm
    header("Location: ".BASE_URL_ADMIN.'?act=chi-tiet-san-pham&id_san_pham='.$product_id);
    exit();
}

public function addGalleryImages() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_id = $_POST['product_id'];
        $gallery_images = $_FILES['new_gallery'];
        
        if (!empty($gallery_images['name'][0])) {
            $uploaded_paths = uploadMultipleFiles($gallery_images, './uploads/');
            
            foreach ($uploaded_paths as $path) {
                $this->modelSanPham->addProductImage($product_id, $path);
            }
            
            $_SESSION['success'] = "Thêm ảnh phụ thành công";
        }
        
        header("Location: ".BASE_URL.'admin/?act=sua-san-pham&id_san_pham='.$product_id);
        exit();
    }
}
}