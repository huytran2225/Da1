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
        return $this->conn->lastInsertId();
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
public function addProductImage($product_id, $image_path, $is_thumbnail = 0) {
    try {
        $sql = 'INSERT INTO product_images (product_id, image_path, is_thumbnail) 
                VALUES (:product_id, :image_path, :is_thumbnail)';
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':product_id' => $product_id,
            ':image_path' => $image_path,
            ':is_thumbnail' => $is_thumbnail
        ]);
    } catch (Exception $e) {
        error_log("Lỗi thêm ảnh sản phẩm: " . $e->getMessage());
        return false;
    }
}
public function getProductImages($product_id) {
    try {
        $sql = 'SELECT * FROM product_images WHERE product_id = :product_id ORDER BY is_thumbnail DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':product_id' => $product_id]);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        error_log("Lỗi lấy ảnh sản phẩm: " . $e->getMessage());
        return [];
    }
}

public function deleteProductImage($image_id) {
    try {
        // Lấy đường dẫn ảnh trước khi xóa
        $sql = 'SELECT image_path FROM product_images WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $image_id]);
        $image = $stmt->fetch();
        
        if ($image) {
            // Xóa từ database
            $sql = 'DELETE FROM product_images WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $image_id]);
            
            // Xóa file vật lý
            deleteFile($image['image_path']);
            return true;
        }
        return false;
    } catch (Exception $e) {
        error_log("Lỗi xóa ảnh sản phẩm: " . $e->getMessage());
        return false;
    }
}
}