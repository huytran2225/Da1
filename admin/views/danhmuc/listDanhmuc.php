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
          <h1>Quản lý danh mục sản phẩm</h1>
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
            <a href="<?='http://localhost/Da1_N2N2/laptop-store/admin/?act=form-them-danh-muc' ?>">
              <button class="btn btn-success">Thêm danh mục</button>
            </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
              <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listDanhMuc as $key => $danhmuc): ?>
                    <tr>
                      <td><?= $danhmuc['id'] ?></td>
                      <td><?= $danhmuc['name'] ?></td>
                      <td><?= $danhmuc['description'] ?></td>
                      <td>
                        <a href="<?='http://localhost/Da1_N2/laptop-store/admin/?act=form-sua-danh-muc&id_danh_muc='.$danhmuc['id']?>">
                        <button class="btn btn-warning">Sửa</button>
                        </a>
                        <a href="<?='http://localhost/Da1_N2/laptop-store/admin/?act=xoa-danh-muc&id_danh_muc='.$danhmuc['id']?>" onClick="return confirm('Bạn có đồng ý xóa hay không?')">
                        <button class="btn btn-danger">Xóa</button>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
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