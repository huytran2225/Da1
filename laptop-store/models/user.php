<?php
// models/User.php
require_once 'connection.php';

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new connection())->conn;
    }

    /**
     * Thử đăng nhập; trả về mảng user nếu thành công, false nếu không
     */
    public function login($email, $password)
    {
        // Lấy user theo email
        $email = $this->conn->real_escape_string($email);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $res = $this->conn->query($sql);
        if ($res && $row = $res->fetch_assoc()) {
            // Nếu password lưu dạng hash:
            if (password_verify($password, $row['password'])) {
                return $row;
            }
            // Nếu lưu dạng plain (chưa hash), bỏ comment dòng sau
            // if ($password === $row['password']) { return $row; }
        }
        return false;
    }

    /**
     * Lấy user theo ID
     */
    public function findById($id)
    {
        $id = intval($id);
        $sql = "SELECT * FROM users WHERE id = $id";
        $res = $this->conn->query($sql);
        return $res ? $res->fetch_assoc() : null;
    }


    public function register($name, $email, $password, $phone = '', $address = '')
    {
        // 1. Kiểm tra email đã tồn tại?
        $emailEsc = $this->conn->real_escape_string($email);
        $checkSql = "SELECT id FROM users WHERE email='$emailEsc' LIMIT 1";
        $res = $this->conn->query($checkSql);
        if ($res && $res->num_rows > 0) {
            return false;
        }

        // 2. Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 3. Insert vào DB
        $nameEsc    = $this->conn->real_escape_string($name);
        $phoneEsc   = $this->conn->real_escape_string($phone);
        $addressEsc = $this->conn->real_escape_string($address);
        $sql = "INSERT INTO users 
                (name, email, password, phone, address, role, status, created_at) 
                VALUES 
                ('$nameEsc', '$emailEsc', '$hash', '$phoneEsc', '$addressEsc', 'customer', 'active', NOW())";
        return $this->conn->query($sql);
    }
}