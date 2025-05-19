<?php
// Chứa tất cả các hàm dùng chung trong hệ thống

// Hàm kết nối CSDL
function connectDB()
{
    $host       = DB_HOST;
    $dbname     = DB_NAME;

    // Kết nối đến CSDL
    try {
        // Tạo kết nối bằng PDO
        $conn = new PDO(
            "mysql:host=$host; dbname=$dbname",
            DB_USERNAME,
            DB_PASSWORD
        );

        // Thiết lập cơ chế lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Cài đặt chế độ hiển thị dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
        // echo "Kết nối thành công";
    } catch (PDOException $e) {
        echo "Lỗi kết nối CSDL: " . $e->getMessage();
    }


}
//Them file

function uploadFile($file, $folderUpload) {
    // Thêm dấu '/' cuối thư mục nếu chưa có
    $folderUpload = rtrim($folderUpload, '/') . '/';
    
    $fileName = time() . '_' . preg_replace('/\s+/', '_', basename($file['name'])); // Thay thế khoảng trắng
    $relativePath = $folderUpload . $fileName; // Đường dẫn tương đối (để lưu DB)
    $absolutePath = PATH_ROOT . $relativePath; // Đường dẫn vật lý
    
    if(move_uploaded_file($file['tmp_name'], $absolutePath)) {
        return './' . $relativePath; // Thêm './' để nhất quán
    }
    return false;
}
//xoa file
function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;
    if(file_exists($pathDelete)){
          unlink($pathDelete);
    }

}
//Xử lý nhiều ảnh
function uploadMultipleFiles($files, $folderUpload = 'public/uploads/') {
    $uploadedPaths = [];
    $folderUpload = rtrim($folderUpload, '/') . '/';
    
    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists(PATH_ROOT . $folderUpload)) {
        mkdir(PATH_ROOT . $folderUpload, 0755, true);
    }

    foreach ($files['name'] as $key => $name) {
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = time() . '_' . preg_replace('/[^\w\.]/', '_', $name);
            $relativePath = $folderUpload . $fileName;
            $absolutePath = PATH_ROOT . $relativePath;
            
            if (move_uploaded_file($files['tmp_name'][$key], $absolutePath)) {
                $uploadedPaths[] = './' . $relativePath;
            }
        }
    }
    return $uploadedPaths;

    
}