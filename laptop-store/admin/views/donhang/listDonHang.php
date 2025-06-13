<!-- header? -->
<?php
require './views/layout/header.php'

?>
<!-- end header -->
<!-- sidebar -->
<?php
require './views/layout/sidebar.php'

?>

<?php
include './views/layout/navbar.php'
?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2>Quản lý đơn hàng</h2>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card-header -->

            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">


                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Khách hàng</th>
                      <th>Ngày đặt</th>
                      <th>Trạng thái</th>
                      <th>Trạng thái thanh toán</th>
                      <th>Tổng tiền</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($orders as $order):
                      $statusText = [
                        'pending' => '<span class="badge badge-warning">Chờ xử lý</span>',
                        'processing' => '<span class="badge badge-info">Đang xử lý</span>',
                        'completed' => '<span class="badge badge-success">Hoàn thành</span>',
                        'cancelled' => '<span class="badge badge-danger">Đã hủy</span>'
                      ];
                      $paymentStatusText = [
                        'unpaid' => '<span class="badge badge-warning">Chưa thanh toán</span>',
                        'paid' => '<span class="badge badge-success">Đã thanh toán</span>',
                        'pending' => '<span class="badge badge-info">Chờ xác nhận</span>'
                      ];
                    ?>
                      <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                        <td><?= $statusText[$order['status']] ?? $order['status'] ?></td>
                        <td><?= $paymentStatusText[$order['payment_status']] ?? htmlspecialchars($order['payment_status']) ?></td>
                        <td><?= number_format($order['total_price'], 0, ',', '.') ?> đ</td>
                        <td>
                          <a href="index.php?act=chi-tiet-don-hang&id=<?= $order['id'] ?>" class="btn btn-sm btn-info">Xem</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php
include './views/layout/footer.php'
?>
<!-- end footer -->

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>

</html>
