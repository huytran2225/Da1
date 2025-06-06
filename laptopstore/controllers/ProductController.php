<?php
require_once 'models/Product.php';

class ProductController
{
    public function shop()
    {
        $productModel = new ProductModel();

        $search = $_GET['search'] ?? '';
        $page = $_GET['page'] ?? 1;
        $limit = 8; // số sản phẩm mỗi trang

        $offset = ($page - 1) * $limit;
        $products = $productModel->getProducts($search, $limit, $offset);
        $totalProducts = $productModel->countProducts($search);
        $totalPages = ceil($totalProducts / $limit);

        include 'views/shop.php';
    }
}