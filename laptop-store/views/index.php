<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laptoptech StoreStore</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/assets/css/templatemo.css">
    <link rel="stylesheet" href="views/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="views/assets/css/fontawesome.min.css">
    <!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>

    <?php

    include("header.php");
    ?>

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="views/assets/img/banner1.png" alt="Laptop cao cấp">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>TechStore</b> Laptop</h1>
                                <h3 class="h2">Laptop chính hãng - Giá tốt mỗi ngày</h3>
                                <p>
                                    Cung cấp các dòng laptop cao cấp từ ASUS, Dell, HP, Lenovo... Phù hợp cho học tập,
                                    làm việc và giải trí. Giao hàng nhanh, bảo hành uy tín.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="views/assets/img/banner2.png" alt="Laptop văn phòng">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Laptop cho dân văn phòng</h1>
                                <h3 class="h2">Hiệu suất ổn định - Thiết kế mỏng nhẹ</h3>
                                <p>
                                    Dòng laptop phù hợp cho công việc văn phòng, học tập từ xa, với thiết kế hiện đại,
                                    thời lượng pin dài và giá cả phải chăng.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="views/assets/img/banner3.png" alt="Laptop gaming">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Laptop Gaming Đỉnh Cao</h1>
                                <h3 class="h2">Trải nghiệm hiệu năng vượt trội</h3>
                                <p>
                                    Trang bị card đồ họa rời, màn hình tần số quét cao và hệ thống tản nhiệt tối ưu –
                                    hoàn hảo cho game thủ và dân thiết kế đồ họa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->



    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Sản phẩm mới nhất</h1>
                <p>
                    Các sản phẩm laptop mới nhất được cập nhật tại đây
                </p>
            </div>
        </div>
        <style>
        .product-card {
            border: 1px solid #e0e0e0;
            border-radius: 16px;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fefefe;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #222;
            margin-top: 15px;
            text-align: center;
            min-height: 3em;
        }

        .product-price {
            text-align: center;
            color: #2c7be5;
            /* Màu xanh hiện đại */
            font-weight: 600;
            font-size: 1rem;
            margin-top: 8px;
        }

        .product-description {
            font-size: 0.95rem;
            color: #555;
            margin-top: 10px;
            min-height: 4em;
            text-align: justify;
        }

        .product-btn {
            text-align: center;
            margin-top: 20px;
        }

        .product-btn a {
            background: linear-gradient(135deg, #2c7be5, #4bb4e6);
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .product-btn a:hover {
            background: linear-gradient(135deg, #1b6bd6, #38a0d8);
            transform: scale(1.03);
        }
        </style>

        <div class="row">
            <?php foreach ($dataSanphammoi as $sp) : ?>
            <div class="col-12 col-md-4 p-3 d-flex">
                <div class="product-card w-100">
                    <img src="<?= $sp['image'] ?>" class="product-image" alt="<?= $sp['product_name'] ?>">
                    <div class="product-name"><?= $sp['product_name'] ?></div>
                    <div class="product-price"><?= number_format($sp['price'], 0, ',', '.') ?> ₫</div>
                    <div class="product-description">
                        <?= $sp['description'] ? htmlspecialchars($sp['description']) : "Chưa có mô tả cho sản phẩm này." ?>
                    </div>
                    <div class="product-btn">
                        <a href="index.php?act=detail&id=<?= $sp['id'] ?>">Xem chi tiết</a>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Sản phẩm hot</h1>
                    <p>
                        Các sản phẩm laptop được lựa chọn mua nhiều nhất được cập nhật tại đây
                    </p>
                </div>
            </div>

            <div class="row">
                <?php foreach ($dataSanphammoi as $sp) : ?>
                <div class="col-12 col-md-4 p-3 d-flex">
                    <div class="product-card w-100">
                        <img src="<?= $sp['image'] ?>" class="product-image" alt="<?= $sp['product_name'] ?>">
                        <div class="product-name"><?= $sp['product_name'] ?></div>
                        <div class="product-price"><?= number_format($sp['price'], 0, ',', '.') ?> ₫</div>
                        <div class="product-description">
                            <?= $sp['description'] ? htmlspecialchars($sp['description']) : "Chưa có mô tả cho sản phẩm này." ?>
                        </div>
                        <div class="product-btn">
                            <a href="index.php?act=detail&id=<?= $sp['id'] ?>">Xem chi tiết</a>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>


        </div>
    </section>
    <!-- End Featured Product -->

    <?php

    include("footer.php");
    ?>

</body>

</html>