<!--header-->
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<?php include './views/layout/sidebar.php'; ?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Thêm danh sách sản phẩm</h1>
        </div>

      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
        <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Thêm sản phẩm</h3>
    </div>
    <form action="<?= 'http://localhost/Da1/laptop-store/admin/?act=them-san-pham' ?>" method="POST" enctype="multipart/form-data">
        <div class="card-body row">
            <div class="form-group col-12">
                <label >Tên sản phẩm</label>
                <input type="text" class="form-control"  name="product_name" placeholder="Nhập tên sản phẩm">
                <?php if(isset($errors['product_name'])){?>
                   <p class="text-danger"><?= $errors['product_name']?></p>
               <?php }?>
            </div>

            <div class="form-group col-6">
                <label >Danh mục</label>
                <select class="form-control" name="category_id" id="exampleFormControlSelect1">

                <option selected disabled>Chọn danh mục sản phẩm</option>
                <?php foreach($listDanhMuc as $danhmuc): ?>
                    <option value="<?= $danhmuc['id']?>"><?=$danhmuc['name']?></option>
                    <?php endforeach ?>
                </select>
                <?php if(isset($errors['category_id'])){?>
                   <p class="text-danger"><?= $errors['category_id']?></p>
               <?php }?>
            </div>


            <div class="form-group col-6">
                <label >Nhãn hiệu</label>
                <input type="text" class="form-control"  name="brand" placeholder="Nhập nhãn hiệu sản phẩm">
                <?php if(isset($errors['brand'])){?>
                   <p class="text-danger"><?= $errors['brand']?></p>
               <?php }?>
            </div>


            <div class="form-group col-6">
                <label >Giá sản phẩm</label>
                <input type="number" class="form-control"  name="price" placeholder="Nhập giá sản phẩm">
                <?php if(isset($errors['price'])){?>
                   <p class="text-danger"><?= $errors['price']?></p>
               <?php }?>
            </div>

            <div class="form-group col-6">
                <label >Số lượng sản phẩm</label>
                <input type="number" class="form-control"  name="stock" placeholder="Nhập số lượng sản phẩm">
                <?php if(isset($errors['stock'])){?>
                   <p class="text-danger"><?= $errors['stock']?></p>
               <?php }?>
            </div>

            <div class="form-group col-6">
    <label>Ảnh đại diện</label>
    <input type="file" class="form-control" name="thumbnail" accept="image/*" required>
    <?php if(isset($errors['thumbnail'])): ?>
        <p class="text-danger"><?= $errors['thumbnail'] ?></p>
    <?php endif; ?>
</div>

<div class="form-group col-6">
    <label>Ảnh phụ (Có thể chọn nhiều ảnh)</label>
    <input type="file" class="form-control" name="gallery[]" multiple accept="image/*">
    <div class="gallery-preview mt-2"></div>
</div>
           

            <div class="form-group col-12">
                <label >Mô tả</label>
                <textarea class="form-control" id="" name="description" rows="4" placeholder="Nhập mô tả"></textarea>
            </div>


        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
    </form>
</div>

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
  <strong>HuyTran22</strong> 
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
<script>
// Preview ảnh đại diện
document.querySelector('input[name="thumbnail"]').addEventListener('change', function(e) {
    if (e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const preview = this.parentElement.querySelector('.thumb-preview') || document.createElement('img');
            preview.src = event.target.result;
            preview.className = 'thumb-preview img-thumbnail mt-2';
            preview.style.maxHeight = '150px';
            if (!this.parentElement.querySelector('.thumb-preview')) {
                this.parentElement.appendChild(preview);
            }
        };
        reader.readAsDataURL(e.target.files[0]);
    }
});

// Preview ảnh phụ (add và edit)
function setupGalleryPreview(inputSelector, previewSelector) {
    const input = document.querySelector(inputSelector);
    if (input) {
        input.addEventListener('change', function(e) {
            const previewDiv = document.querySelector(previewSelector);
            if (previewDiv) {
                previewDiv.innerHTML = '';
                
                Array.from(e.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'img-thumbnail m-1';
                        img.style.maxHeight = '100px';
                        previewDiv.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    }
}

// Áp dụng cho cả 2 trang
setupGalleryPreview('input[name="gallery[]"]', '.gallery-preview');
setupGalleryPreview('input[name="new_gallery[]"]', '.new-gallery-preview');
</script>
</body>

</html>