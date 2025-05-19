<?php 
class AdminDanhMuc{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
   public function getAllDanhMuc(){
    try{
        $sql ='SELECT * FROM categories';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
   catch (Exception $e){
echo "Loi" .$e->getMessage();
   }
}

public function insertDanhMuc($ten_danh_muc, $mo_ta){
    try {
        $sql ='INSERT INTO categories (name, description) VALUES (:name, :description)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $ten_danh_muc,
            ':description' => $mo_ta
        ]);
        return $stmt->rowCount(); 
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

public function getDetailDanhMuc($id){
    try {
        $sql ='SELECT * FROM categories where id = :id ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
         ':id'=> $id
        ]);
        return $stmt->fetch(); 
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}


public function updateDanhMuc($id,$ten_danh_muc, $mo_ta){
    try {
        $sql = 'UPDATE categories SET name = :name, description = :description WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $ten_danh_muc,
            ':description' => $mo_ta,
            ':id'=>$id
        ]);
        return $stmt->rowCount(); 
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

public function destroyDanhMuc($id){
    try {
        $sql = 'DELETE FROM categories  WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id'=>$id
        ]);
        return true; 
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

public function hasProducts($id_danh_muc) {
    try {
        $sql = "SELECT COUNT(*) as total FROM products WHERE category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_danh_muc ]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    } catch (Exception $e) {
        error_log("Lỗi khi kiểm tra sản phẩm: " . $e->getMessage());
        return false;
    }
}




}
?>