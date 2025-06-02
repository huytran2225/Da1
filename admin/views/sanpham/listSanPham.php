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
          <h1>Quản lý danh sách sản phẩm</h1>
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
            <div class="card-header">
              <a href="<?= 'http://localhost/Da1_N2/laptop-store/admin/?act=form-them-san-pham' ?>">
                <button class="btn btn-success">Thêm sản phẩm mới</button>
              </a>
            </div>
            <!-- /.card-header -->
            <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Tên sản phẩm</th>
                    <th>Tên danh mục</th>
                    <th>Nhãn hiệu</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th width="120px">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listSanPham as $sanpham): ?>
                    <tr>
                      <td><?= $sanpham['id'] ?></td> <!-- Id sản phẩm-->
                      <td><?= $sanpham['product_name'] ?></td> <!-- Tên sản phẩm-->
                      <td><?= $sanpham['category_name'] ?></td><!-- Tên danh mục sản phẩm-->
                      <td><?= $sanpham['brand'] ?></td> <!-- Nhãn hiệu-->
                      <td><?= number_format($sanpham['price'], 0, ',', '.') ?> VNĐ</td> <!-- Giá-->
                      <td><?= $sanpham['stock'] ?></td> <!-- Số lượng-->
                      <td>
                        <img src="<?= BASE_URL . $sanpham['image'] ?>" style="width:100px" alt=""
                          onerror="this.onerror=null;this.src= 'https://th.bing.com/th/id/R.a06540c84c354244a96450742a701b6f?rik=2NvE4t1PyzY%2fDg&riu=http%3a%2f%2fthuthuatphanmem.vn%2fuploads%2f2018%2f09%2f11%2fhinh-anh-dep-62_044135376.jpg&ehk=ybfSrFxYckpHrcejxmpSY9vzNC07Np4EBKUILpup0iU%3d&risl=1&pid=ImgRaw&r=0'">
                      </td> <!-- Ảnh sản phẩm-->
                      <td><?= $sanpham['description'] ?></td> <!--mô tả-->

                      
                      <td style="white-space: nowrap; text-align: center;">
                        <a href="<?= BASE_URL . 'admin/?act=chi-tiet-san-pham&id_san_pham=' . $sanpham['id'] ?>"
                          class="btn btn-sm btn-info">
                          <i class="fas fa-eye"></i>
                        </a>
                        
                      
                      <a href="<?= 'http://localhost/Da1_N2/laptop-store/admin/?act=form-sua-san-pham&id_san_pham=' . $sanpham['id'] ?>">
                        <button class="btn btn-warning">Sửa</button>
                      </a>
                      <a href="<?= 'http://localhost/Da1_N2/laptop-store/admin/?act=xoa-san-pham&id_san_pham=' . $sanpham['id'] ?>" onClick="return confirm('Bạn có đồng ý xóa hay không?')">
                        <button class="btn btn-danger">Xóa</button>
                      </a>
                      </td>
                    </tr>
                  <?php endforeach  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Tên sản phẩm</th>
                    <th>Tên danh mục</th>
                    <th>Nhãn hiệu</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th width="120px">Thao tác</th>
                  </tr>
                </tfoot>
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
<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="./assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./assets/plugins/jszip/jszip.min.js"></script>
<script src="./assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="./assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="./assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="./assets/dist/js/adminlte.min.js?v=3.2.0"></script>
<!-- AdminLTE for demo purposes -->
<script src="./assets/dist/js/demo.js"></script>
<!-- Page specific script -->

<!-- Footer-->
<?php include './views/layout/footer.php'; ?>
<!--EndEnd Footer-->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
</body>

</html>