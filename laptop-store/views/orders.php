<?php
// views/orders.php
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đơn hàng của tôi</title>
    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">📋 Đơn hàng của bạn</h2>

        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Mã đơn: #<?= $order['id'] ?></strong> - Ngày: <?= $order['created_at'] ?> - Trạng thái: <?= $order['status'] ?>
                    </div>
                    <div class="card-body">
                        <p><strong>Tổng tiền:</strong> <?= number_format($order['total_price'], 0, ',', '.') ?> đ</p>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['details'] as $item): ?>
                                    <tr>
                                        <td><img src="<?= $item['product_image'] ?>" width="60"></td>
                                        <td><?= $item['product_name'] ?? 'Sản phẩm' ?></td>
                                        <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">Bạn chưa có đơn hàng nào.</div>
        <?php endif; ?>
    </div>
</body>

</html>