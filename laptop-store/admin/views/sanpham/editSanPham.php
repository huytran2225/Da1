<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa sản phẩm</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa sản phẩm</h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=sua-san-pham' ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $sanPham['id'] ?>">
                            <div class="card-body row">
                                <div class="form-group col-12">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name"
                                        value="<?= $sanPham['product_name'] ?>" placeholder="Nhập tên sản phẩm">
                                    <?php if (isset($errors['product_name'])) { ?>
                                        <p class="text-danger"><?= $errors['product_name'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Danh mục</label>
                                    <select class="form-control" name="category_id">
                                        <option disabled>Chọn danh mục sản phẩm</option>
                                        <?php foreach ($listDanhMuc as $danhmuc): ?>
                                            <option value="<?= $danhmuc['id'] ?>"
                                                <?= $danhmuc['id'] == $sanPham['category_id'] ? 'selected' : '' ?>>
                                                <?= $danhmuc['name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <?php if (isset($errors['category_id'])) { ?>
                                        <p class="text-danger"><?= $errors['category_id'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Nhãn hiệu</label>
                                    <input type="text" class="form-control" name="brand"
                                        value="<?= $sanPham['brand'] ?>" placeholder="Nhập nhãn hiệu sản phẩm">
                                    <?php if (isset($errors['brand'])) { ?>
                                        <p class="text-danger"><?= $errors['brand'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="price"
                                        value="<?= $sanPham['price'] ?>" placeholder="Nhập giá sản phẩm">
                                    <?php if (isset($errors['price'])) { ?>
                                        <p class="text-danger"><?= $errors['price'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Số lượng sản phẩm</label>
                                    <input type="number" class="form-control" name="stock"
                                        value="<?= $sanPham['stock'] ?>" placeholder="Nhập số lượng sản phẩm">
                                    <?php if (isset($errors['stock'])) { ?>
                                        <p class="text-danger"><?= $errors['stock'] ?></p>
                                    <?php } ?>
                                </div>
<!-- Thêm vào trong form -->
<div class="form-group col-6">
    <label>Ảnh đại diện</label>
    <input type="file" class="form-control" name="image" accept="image/*">
    <?php if(isset($errors['thumbnail'])): ?>
        <p class="text-danger"><?= $errors['thumbnail'] ?></p>
    <?php endif; ?>
    <?php if(!empty($sanPham['image'])): ?>
        <div class="mt-2">
            <img src="<?= BASE_URL . str_replace('./', '', $sanPham['image']) ?>" 
                 class="img-thumbnail" 
                 style="max-height: 150px;">
        </div>
    <?php endif; ?>
</div>
                              <!-- Hiển thị ảnh phụ hiện có -->
<div class="form-group col-12">
    <label>Ảnh phụ hiện có</label>
    <div class="d-flex flex-wrap">
        <?php if (!empty($product_images)): ?>
            <?php foreach ($product_images as $image): ?>
                <?php if (!$image['is_thumbnail']): ?>
                    <div class="position-relative m-2">
                        <img src="<?= BASE_URL.$image['image_path'] ?>" width="100" class="img-thumbnail">
                        <a href="?act=xoa-anh&id=<?= $image['id'] ?>&product_id=<?= $sanPham['id'] ?>" 
                           class="btn btn-danger btn-sm position-absolute top-0 end-0"
                           onclick="return confirm('Bạn chắc chắn muốn xóa?')">×</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Chưa có ảnh phụ nào</p>
        <?php endif; ?>
    </div>
</div>

                                <div class="form-group col-12">
                                    <label>Thêm ảnh phụ mới</label>
                                    <input type="file" class="form-control" name="new_gallery[]" multiple accept="image/*">
                                    <div class="new-gallery-preview mt-2"></div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" name="description" rows="4"
                                        placeholder="Nhập mô tả"><?= $sanPham['description'] ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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