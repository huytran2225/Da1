<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chi tiết sản phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/assets/css/templatemo.css">
    <link rel="stylesheet" href="views/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="views/assets/css/fontawesome.min.css">
    <!--
    


-->
</head>

<body>
    <?php

    include("header.php");
    ?>



    <style>
        :root {
            --primary: #2c7be5;
            --primary-hover: #1b6bd6;
            --light-bg: #f9f9f9;
            --border-radius: 12px;
        }

        body {
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .product-images {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-img {
            width: 100%;
            max-height: 450px;
            object-fit: contain;
            background: var(--light-bg);
            padding: 10px;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: zoom-in;
        }

        .main-img:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .thumbs {
            margin-top: 12px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .thumb-img,
        .thumb-reset {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border: 2px solid transparent;
            border-radius: 6px;
            opacity: 0.8;
            transition: all 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .thumb-img:hover,
        .thumb-reset:hover {
            opacity: 1;
            transform: scale(1.1);
            border-color: var(--primary);
        }

        .thumb-img.active {
            border-color: var(--primary);
            opacity: 1;
        }

        .thumb-reset i {
            font-size: 1.2rem;
            color: #555;
        }

        .thumb-reset:hover i {
            color: var(--primary);
        }

        .btn-reset {
            background-color: #fff;
            color: #444;
            border: 1px solid #ddd;
            padding: 6px 12px;
            font-size: 0.9rem;
            border-radius: 6px;
            transition: background 0.2s ease, color 0.2s ease;
            margin-bottom: 8px;
        }

        .btn-cart {
            background: linear-gradient(135deg, var(--primary), #4bb4e6);
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: var(--border-radius);
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-cart:hover {
            background: linear-gradient(135deg, var(--primary-hover), #38a0d8);
            transform: translateY(-2px);
        }

        h1,
        h2,
        h3 {
            color: #222;
        }

        .product-info p {
            margin: 8px 0;
        }

        .form-group label {
            font-weight: 500;
        }
    </style>



    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Chi tiết sản phẩm</h1>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Cột Ảnh -->
            <div class="col-md-6">
                <div class="product-images">
                    <img id="mainImage" src="<?php echo htmlspecialchars($product['image']); ?>"
                        class="main-img mb-3" alt="Ảnh chính">
                    <input type="hidden" id="originalImage" value="<?php echo htmlspecialchars($product['image']); ?>">

                    <div class="thumbs">
                        <!-- Icon reload đặt đầu -->
                        <div class="thumb-reset" onclick="resetImage()">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <!-- Các ảnh thumbnail -->
                        <?php foreach ($images as $img): ?>
                            <img src="<?php echo htmlspecialchars($img['image_path']); ?>"
                                class="thumb-img"
                                alt="Ảnh phụ"
                                onclick="changeImage(this)">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Cột Thông tin sản phẩm -->
            <div class="col-md-6 product-info">
                <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>
                <p><strong>Giá:</strong> <?php echo number_format($product['price'], 0, ',', '.'); ?> ₫</p>
                <p><strong>Mô tả:</strong> <?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <p><strong>Cập nhật lúc:</strong> <?php echo htmlspecialchars($product['updated_at']); ?></p>

                <!-- Form thêm vào giỏ hàng -->
                <form action="?act=cart&xuli=add" method="POST" class="mt-3">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <div class="form-group mb-2">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1"
                            class="form-control" style="width: 100px;">
                    </div>
                    <button type="submit" class="btn-cart">🛒 Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        const thumbs = document.querySelectorAll('.thumb-img');
        thumbs.forEach(img => img.addEventListener('click', function() {
            document.getElementById('mainImage').src = this.src;
            thumbs.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        }));

        function resetImage() {
            const original = document.getElementById('originalImage').value;
            document.getElementById('mainImage').src = original;
            thumbs.forEach(i => i.classList.remove('active'));
        }
    </script>








    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <!-- Thông tin liên hệ -->
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">LaptopTech Store</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            123 Đường Công Nghệ, Quận 1, TP.HCM
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:090-123-4567">090-123-4567</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:support@laptoptech.vn">support@laptoptech.vn</a>
                        </li>
                    </ul>
                </div>

                <!-- Danh mục sản phẩm -->
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Sản phẩm</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Laptop Gaming</a></li>
                        <li><a class="text-decoration-none" href="#">Laptop Văn Phòng</a></li>
                        <li><a class="text-decoration-none" href="#">MacBook</a></li>
                        <li><a class="text-decoration-none" href="#">Laptop Đồ Họa</a></li>
                        <li><a class="text-decoration-none" href="#">Phụ kiện Laptop</a></li>
                        <li><a class="text-decoration-none" href="#">Màn hình</a></li>
                    </ul>
                </div>

                <!-- Điều hướng thêm -->
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Thông tin thêm</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Trang chủ</a></li>
                        <li><a class="text-decoration-none" href="#">Giới thiệu</a></li>
                        <li><a class="text-decoration-none" href="#">Hệ thống cửa hàng</a></li>
                        <li><a class="text-decoration-none" href="#">Chính sách bảo hành</a></li>
                        <li><a class="text-decoration-none" href="#">Liên hệ</a></li>
                    </ul>
                </div>

            </div>

            <!-- Social + Đăng ký Email -->
            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Địa chỉ email của bạn">
                        <div class="input-group-text btn-success text-light">Đăng ký</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light mb-0">
                            &copy; 2025 LaptopTech Store. Thiết kế bởi <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


    <!-- Start Script -->
    <script src="views/assets/js/jquery-1.11.0.min.js"></script>
    <script src="views/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="views/assets/js/bootstrap.bundle.min.js"></script>
    <script src="views/assets/js/templatemo.js"></script>
    <script src="views/assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>