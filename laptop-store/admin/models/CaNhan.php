<?php
class CaNhan {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
  
    // Lấy thông tin user theo ID
    public function getById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Lỗi khi lấy thông tin user: " . $e->getMessage());
            return false;
        }

        
    }

    public function update($id, $data) {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET 
                                        name = :name, 
                                        email = :email, 
                                        phone = :phone, 
                                        address = :address 
                                        WHERE id = :id");
            
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Lỗi khi cập nhật thông tin user: " . $e->getMessage());
            return false;
        }
    }
   
}
?>
