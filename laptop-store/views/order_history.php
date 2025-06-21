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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
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
    <div class="container py-5">
        <h2 class="mb-4">🧾 Lịch sử đơn hàng của bạn</h2>
        
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'cancellation_requested') {
            echo '<div class="alert alert-success">Gửi yêu cầu hủy đơn hàng thành công. Vui lòng chờ quản trị viên xác nhận.</div>';
        }
        if (isset($_GET['error'])) {
            $error_messages = [
                'invalid_order' => 'Mã đơn hàng không hợp lệ.',
                'not_found' => 'Không tìm thấy đơn hàng hoặc bạn không có quyền truy cập.',
                'request_failed' => 'Gửi yêu cầu hủy thất bại. Vui lòng thử lại.',
                'cannot_request_cancellation' => 'Không thể yêu cầu hủy đơn hàng ở trạng thái này.'
            ];
            $error_key = $_GET['error'];
            $message = $error_messages[$error_key] ?? 'Đã có lỗi xảy ra.';
            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
        ?>

        <?php if (empty($orders)): ?>
            <p>Không có đơn hàng nào.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày tạo</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['id'] ?></td>
                            <td><?= $order['created_at'] ?></td>
                            <td><?= number_format($order['total_price'], 0, ',', '.') ?>₫</td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <td>
                                <?php if ($order['status'] == 'pending' || $order['status'] == 'processing'): ?>
                                    <a href="index.php?act=request_cancellation&id=<?= $order['id'] ?>"
                                       class="btn btn-warning btn-sm"
                                       onclick="return confirm('Bạn có chắc chắn muốn gửi yêu cầu hủy đơn hàng này không?');">
                                        Yêu cầu hủy
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php

    include("footer.php");
    ?>

</body>

</html>