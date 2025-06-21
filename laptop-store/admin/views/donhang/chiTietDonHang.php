<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<pre>
<?php
    echo 'Trạng thái hiện tại: ';
    var_dump($order['status']);
    echo 'Các trạng thái có thể chuyển tới: ';
    print_r($available_statuses);
?>
</pre>

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
                <div class="col-md-6">
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
                                        <span class="badge <?= $this->model->getStatusBadgeClass($order['status']) ?>">
                                            <?= $this->model->getAllStatusList()[$order['status']] ?? $order['status'] ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái thanh toán</th>
                                    <td>
                                        <?php
                                        $paymentStatusText = [
                                            'unpaid' => '<span class="badge badge-warning">Chưa thanh toán</span>',
                                            'paid' => '<span class="badge badge-success">Đã thanh toán</span>',
                                            'pending' => '<span class="badge badge-info">Chờ xác nhận</span>'
                                        ];
                                        echo $paymentStatusText[$order['payment_status']] ?? htmlspecialchars($order['payment_status']);
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Form cập nhật trạng thái -->
                    <?php if (!empty($available_statuses)): ?>
                    <div class="card mt-3">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Cập nhật trạng thái đơn hàng</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>admin/?act=cap-nhat-trang-thai" method="POST">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <div class="form-group">
                                    <label>Trạng thái mới</label>
                                    <select name="status" class="form-control">
                                        <?php foreach ($available_statuses as $key => $label): ?>
                                            <option value="<?= $key ?>">
                                                <?= $label ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <textarea name="note" class="form-control" rows="3" placeholder="Nhập ghi chú (nếu có)"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Form cập nhật trạng thái thanh toán -->
                    <?php $available_payment_statuses = $this->model->getAvailablePaymentStatuses($order['payment_status']); ?>
                    <?php if (!empty($available_payment_statuses)): ?>
                        <div class="card mt-3">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Cập nhật trạng thái thanh toán</h3>
                            </div>
                            <div class="card-body">
                                <form action="<?= BASE_URL ?>admin/?act=cap-nhat-trang-thai-thanh-toan" method="POST">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <div class="form-group">
                                        <label>Trạng thái thanh toán mới</label>
                                        <select name="payment_status" class="form-control">
                                            <?php foreach ($available_payment_statuses as $key => $label): ?>
                                                <option value="<?= $key ?>">
                                                    <?= $label ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card mt-3">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Cập nhật trạng thái thanh toán</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-secondary mb-0">Đã ở trạng thái thanh toán cuối cùng.</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <!-- Lịch sử trạng thái -->
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Lịch sử trạng thái</h3>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <?php foreach ($status_history as $history): ?>
                                <div class="time-label">
                                    <span class="bg-info">
                                        <?= date('d/m/Y H:i', strtotime($history['created_at'])) ?>
                                    </span>
                                </div>
                                <div>
                                    <i class="fas fa-info bg-info"></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="fas fa-clock"></i> 
                                            <?= date('H:i', strtotime($history['created_at'])) ?>
                                        </span>
                                        <h3 class="timeline-header">
                                            Chuyển sang trạng thái:
                                            <span class="badge <?= $this->model->getStatusBadgeClass($history['status']) ?>">
                                                <?= $this->model->getAllStatusList()[$history['status']] ?? $history['status'] ?>
                                            </span>
                                        </h3>
                                        <?php if ($history['note']): ?>
                                        <div class="timeline-body">
                                            <?= nl2br(htmlspecialchars($history['note'])) ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="timeline-footer">
                                            Cập nhật bởi: <?= htmlspecialchars($history['updated_by_name'] ?? 'Hệ thống') ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title">Danh sách sản phẩm</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order_details as $item): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                                            <td>
                                                <?php if ($item['image']): ?>
                                                    <img src="../<?= $item['image'] ?>" width="100">
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= number_format($item['price']) ?> VNĐ</td>
                                            <td><?= number_format($item['quantity'] * $item['price']) ?> VNĐ</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" align="right"><strong>Tổng cộng:</strong></td>
                                        <td><strong><?= number_format($order['total_price']) ?> VNĐ</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>