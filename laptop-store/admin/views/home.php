<!--header-->
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Báo cáo thống kê</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          
            <div>
        <span style="margin-right: 15px;">Xin chào, <?= $_SESSION['user']['name'] ?? 'Admin' ?></span>
        <a href="?act=dang-xuat" class="btn btn-danger">Đăng xuất</a>
    </div>
        </div>
          </ol>
       
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $stats['total_products'] ?></h3>
              <p>Sản phẩm</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="?act=san-pham" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $stats['total_orders'] ?></h3>
              <p>Đơn hàng</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="?act=chi-tiet-don-hang" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $stats['total_users'] ?></h3>
              <p>Người dùng</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="?act=tai-khoan-khach-hang" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= number_format($stats['revenue']) ?>đ</h3>
              <p>Doanh thu</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Đơn hàng mới -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Đơn hàng mới nhất</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($stats['recent_orders'] as $order): ?>
                  <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td><?= number_format($order['total_price']) ?>đ</td>
                    <td>
                      <?php switch ($order['status']) {
                        case 'pending': echo '<span class="badge bg-warning">Chờ xử lý</span>'; break;
                        case 'processing': echo '<span class="badge bg-info">Đang xử lý</span>'; break;
                        case 'completed': echo '<span class="badge bg-success">Hoàn thành</span>'; break;
                        case 'cancelled': echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                      } ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        
        <!-- Right col -->
        <section class="col-lg-5 connectedSortable">
          <!-- Sản phẩm mới -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sản phẩm mới nhất</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($stats['recent_products'] as $product): ?>
                  <tr>
                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                    <td><?= number_format($product['price']) ?>đ</td>
                    <td><?= $product['stock'] ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Right col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer-->
<?php include './views/layout/footer.php'; ?>
<!--End Footer-->

</body>
</html>