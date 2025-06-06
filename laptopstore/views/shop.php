<!DOCTYPE html>
<html lang="en">

<head>
    <title>LaptopTech StoreStore</title>
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

    <style>
    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        min-height: 50px;
    }

    .card-text {
        font-size: 1rem;
        color: #e63946;
    }

    .btn-outline-success {
        border-radius: 30px;
        transition: all 0.2s;
    }

    .btn-outline-success:hover {
        background-color: #198754;
        color: white;
    }

    .pagination .page-link {
        border-radius: 50px;
        margin: 0 5px;
        color: #198754;
    }

    .pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
        color: #fff;
    }

    input[name="search"] {
        border-radius: 30px;
        padding: 0.5rem 1rem;
        border: 1px solid #ced4da;
        transition: border-color 0.3s;
    }

    input[name="search"]:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, .25);
    }

    h2 {
        font-weight: bold;
    }
    </style>

    <div class="container py-5">
        <h2 class="mb-4 text-center">🛍 Tất cả sản phẩm</h2>

        <!-- Form tìm kiếm -->
        <form class="mb-4 text-center" method="GET" action="index.php">
            <input type="hidden" name="act" value="shop">
            <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                placeholder="Tìm sản phẩm..." class="form-control d-inline w-50">
            <button class="btn btn-success mt-2 mt-md-0">Tìm kiếm</button>
        </form>

        <!-- Danh sách sản phẩm -->
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['product_name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['product_name'] ?></h5>
                        <p class="card-text text-danger fw-bold"><?= number_format($product['price'], 0, ',', '.') ?>₫
                        </p>
                        <a href="index.php?act=detail&id=<?= $product['id'] ?>"
                            class="btn btn-outline-success w-100">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Phân trang -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link"
                        href="index.php?act=shop&search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>


    <?php

    include("footer.php");
    ?>

</body>

</html>