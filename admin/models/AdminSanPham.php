<?php 
class AdminSanPham{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
   public function getAllSanPham(){
    try{
      $sql= 'SELECT 
        p.id,
        p.product_name,  
        p.category_id,
        c.name AS category_name,
        p.brand,
        p.price,
        p.stock,
        p.image,
        p.description
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id';
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
   catch (Exception $e){
echo "Loi" .$e->getMessage();
   }
}

public function insertSanPham($name, $category_id, $brand, $price, $stock, $image, $description){
    try {
        $sql = 'INSERT INTO products ( product_name, category_id, brand, price, stock, image, description)
                VALUES (:product_name, :category_id, :brand, :price, :stock, :image, :description)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'product_name' => $name,
            ':category_id' => $category_id,
            ':brand' => $brand,
            ':price' => $price,
            ':stock' => $stock,
            ':image' => $image,
            ':description' => $description
        ]);
        return $stmt->rowCount(); 
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}



public function getDetailSanPham($id) {
    try {
        $sql = 'SELECT * FROM products WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

public function updateSanPham($id, $name, $category_id, $brand, $price, $stock, $image, $description) {
    try {
        $sql = 'UPDATE products SET 
                product_name = :product_name, 
                category_id = :category_id, 
                brand = :brand, 
                price = :price, 
                stock = :stock, 
                image = :image, 
                description = :description 
                WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':product_name' => $name,
            ':category_id' => $category_id,
            ':brand' => $brand,
            ':price' => $price,
            ':stock' => $stock,
            ':image' => $image,
            ':description' => $description,
            ':id' => $id
        ]);
        return $stmt->rowCount();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

public function destroySanPham($id) {
    try {
        $sql = 'DELETE FROM products WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

public function isProductInOrder($id_san_pham) {
    try {
        $sql =  "SELECT COUNT(*) as total FROM order_details WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_san_pham ]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    } catch (Exception $e) {
        error_log("Lỗi khi kiểm tra đơn hàng: " . $e->getMessage());
        return false;
    }
}

}
?>