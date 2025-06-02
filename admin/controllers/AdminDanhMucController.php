<?php 
class AdminDanhMucController{
    public $modelDanhMuc;
    public function __construct()
  
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }
 
    public function danhSachDanhMuc(){
       
    $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();   
       require_once './views/danhmuc/listDanhmuc.php';
    }
    
    public function formAddDanhMuc(){
        //hien thi form nhap
        require_once './views/danhmuc/addDanhmuc.php';
    }
    public function postAddDanhMuc(){
        //Xu ly them du lieu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $ten_danh_muc = $_POST['name'];
           $mo_ta = $_POST['description'];

           //validate
           $errors = [];
           if (empty($ten_danh_muc)) {
            $errors['name'] = 'Không được để trống';
           }
           if(empty($errors)){
            
            
                $this->modelDanhMuc->insertDanhMuc( $ten_danh_muc,$mo_ta);
                header("Location: ".'http://localhost/Da1_N2/laptop-store/admin/?act=danh-muc');
                exit();
                
           }else{
            //neu loi tra ve form
            require_once './views/danhmuc/addDanhmuc.php';
           }
        }
    }
    public function formEditDanhMuc(){
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
       
       if ($danhMuc) {
        require_once './views/danhmuc/editDanhmuc.php';
       }else{
        
        header("Location: ".'http://localhost/Da1_N2/laptop-store/admin/?act=danh-muc');
       }
    }
    public function postEditDanhMuc(){
        //Xu ly them du lieu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
           $ten_danh_muc = $_POST['name'];
           $mo_ta = $_POST['description'];

           //validate
           $errors = [];
           if (empty($ten_danh_muc)) {
            $errors['name'] = 'Không được để trống';
           }
           if(empty($errors)){
            //k loi thi vao trang sua
            
                $this->modelDanhMuc->updateDanhMuc( $id,$ten_danh_muc,$mo_ta);
                header("Location: ".'http://localhost/Da1_N2/laptop-store/admin/?act=danh-muc');
                exit();
                
           }else{
            //neu loi tra ve form
            $danhMuc = ['id'=> $id, 'name'=>$ten_danh_muc,'description'=>$mo_ta];
            require_once './views/danhmuc/editDanhmuc.php';
           }
        }
    }

    public function deleteDanhMuc(){
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        
        if ($danhMuc) {
            $hasProducts = $this->modelDanhMuc->hasProducts($id);//Kiểm tra tồn tại
            
            if ($hasProducts) {
                $_SESSION['error'] = "Không thể xóa danh mục vì đang có sản phẩm thuộc danh mục này.";
            } else {
                $this->modelDanhMuc->destroyDanhMuc($id);
                $_SESSION['success'] = "Xóa danh mục thành công";
            }
    
            header("Location: http://localhost/Da1_N2/laptop-store/admin/?act=danh-muc");
            exit();
        }
    }
    

}
?>