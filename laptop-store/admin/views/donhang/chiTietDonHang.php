<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết đơn hàng #<?= $order['id'] ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= BASE_URL . 'admin/?act=don-hang' ?>" class="btn btn-secondary">
                        Quay lại
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Thông tin khách hàng</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Họ tên</th>
                                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= htmlspecialchars($order['customer_email']) ?></td>
                                </tr>
                                <tr>
                                    <th>Điện thoại</th>
                                    <td><?= htmlspecialchars($order['customer_phone']) ?></td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td><?= htmlspecialchars($order['address']) ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày đặt</th>
                                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <?php
                                        $statusText = [
                                            'pending' => '<span class="badge badge-warning">Chờ xử lý</span>',
                                            'processing' => '<span class="badge badge-info">Đang xử lý</span>',
                                            'completed' => '<span class="badge badge-success">Hoàn thành</span>',
                                            'cancelled' => '<span class="badge badge-danger">Đã hủy</span>'
                                        ];
                                        echo $statusText[$order['status']] ?? $order['status'];
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- Form cập nhật trạng thái -->
                    <div class="card mt-3">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Cập nhật trạng thái đơn hàng</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>admin/?act=cap-nhat-trang-thai" method="POST" class="form-inline">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <div class="form-group mr-2">
                                    <select name="status" class="form-control">
                                        <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                        <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Đang xử lý</option>
                                        <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                        <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>



                </div>
                <div class="card mt-4">
                    <div class="card-header bg-success">
                        <h3 class="card-title">Danh sách sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <h2>Chi tiết đơn hàng</h2>
                        <table border="1">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                            <?php foreach ($order_details as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                                    <td>
                                        <?php if ($item['image']): ?>
                                            <img src="../<?= ($item['image']) ?>" width="100">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td><?= number_format($item['price']) ?> VNĐ</td>
                                    <td><?= number_format($item['quantity'] * $item['price']) ?> VNĐ</td>
                                    <td><?= ($item['status']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" align="right">Tổng cộng:</td>
                                <td><?= number_format($order['total_price']) ?> VNĐ</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>

</div>

<?php include './views/layout/footer.php'; ?>
