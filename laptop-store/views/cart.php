<?php
// views/cart.php
// Biết trước: $items (mảng các sản phẩm trong giỏ) được controller truyền vào
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Giỏ hàng của bạn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="views/assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="views/assets/img/favicon.ico">

    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/assets/css/templatemo.css">
    <link rel="stylesheet" href="views/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="views/assets/css/fontawesome.min.css">
</head>

<body>
    
<?php

include("header.php");
?>
    <!-- Start Cart Section -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Giỏ hàng của bạn</h1>
        </div>
    </div>

    <?php if (empty($items)): ?>
        <div class="text-center mt-4">
            <p class="fs-5">Giỏ hàng của bạn đang trống.</p>
            <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive mt-4">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Xoá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $grandTotal = 0; ?>
                    <?php foreach ($items as $it): ?>
                        <?php $grandTotal += $it['subtotal']; ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($it['image']) ?>" width="60" alt=""></td>
                            <td><?= htmlspecialchars($it['product_name']) ?></td>
                            <td><?= number_format($it['price'], 0, ',', '.') ?> ₫</td>
                            <td>
                                <form action="index.php?act=update_cart" method="post" class="d-flex align-items-center justify-content-center">
                                    <input type="hidden" name="product_id" value="<?=$it['id'] ?>">
                                    <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm">-</button>
                                    <input type="text" name="quantity" value="<?= $it['quantity'] ?>" class="form-control text-center mx-2" style="width: 50px;" readonly>
                                    <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm">+</button>
                               
                               
                                </form>
                            </td>
                            <td><?= number_format($it['subtotal'], 0, ',', '.') ?> ₫</td>

                            <td>
    <a href="index.php?act=remove_cart_item&id=<?= $it['id'] ?>" 
       onclick="return confirm('Bạn có chắc chắn muốn xoá sản phẩm này?');"
       class="btn btn-sm btn-danger">
        <i class="fas fa-trash-alt"></i>
    </a>
</td>
                        </tr>
                    <?php endforeach; ?>

                 
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Tổng cộng:</th>
                        <th><?= number_format($grandTotal, 0, ',', '.') ?> ₫</th>
                    </tr>
                </tfoot>
               
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
            </a>
            <div class="text-end mt-3">
                <a href="index.php?act=checkout" class="btn btn-success">
                    🛒 Tiến hành thanh toán
                </a>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger text-center">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>

    
<?php endif; ?>


    <?php if (!empty($_SESSION['error1'])): ?>
    <div class="alert alert-danger text-center">
        <?= print_r( $_SESSION['error1']); unset($_SESSION['error1']); ?>
    </div>

    
<?php endif; ?>

</section>
<!-- End Cart Section -->



    
    <?php

include("footer.php");
?>

    <!-- Start Script -->
    <script src="views/assets/js/jquery-1.11.0.min.js"></script>
    <script src="views/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="views/assets/js/bootstrap.bundle.min.js"></script>
    <script src="views/assets/js/templatemo.js"></script>
    <script src="views/assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>