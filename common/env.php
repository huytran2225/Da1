<?php
// File chứa các biến môi trường trong hệ thống
// Khai báo các biến dưới dạng HẰNG SỐ để ko phải sử dụng $GLOBALS
//Đường dẫn cilent
define('BASE_URL' , 'http://localhost/Da1_N2/laptop-store/');
//Đường dẫn admin
define('BASE_URL_ADMIN' , 'http://localhost/Da1_N2/laptop-store/admin/');

define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'laptop_store'); // Tên database

define('PATH_ROOT', __DIR__ . '/../');
