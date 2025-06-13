<?php
require_once("models/home.php");
class HomeController {
    var $home_model;
    public function __construct() {
        $this->home_model = new Home();
    }

    function list()
    {
        $dataSanphammoi = $this->home_model->sanphammoi();

        require_once('views/index.php');
    }

    function detail()
    {
        $id = $_GET['id']; // Lấy ID sản phẩm từ URL
        $product = $this->home_model->getProductById($id);
        $images = $this->home_model->getProductImages($id);

        require_once('views/product_detail.php');
    }
}