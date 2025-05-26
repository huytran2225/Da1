<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết sản phẩm</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= BASE_URL.'admin/?act=san-pham' ?>" class="btn btn-secondary">
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
                            <h3 class="card-title">Thông tin cơ bản</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">ID</th>
                                    <td><?= $sanPham['id'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <td><?= htmlspecialchars($sanPham['product_name']) ?></td>
                                </tr>
                                <tr>
                                    <th>Danh mục</th>
                                    <td>
                                        <?php 
                                        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($sanPham['category_id']);
                                        echo htmlspecialchars($danhMuc['name'] ?? '');
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nhãn hiệu</th>
                                    <td><?= htmlspecialchars($sanPham['brand']) ?></td>
                                </tr>
                                <tr>
                                    <th>Giá</th>
                                    <td><?= number_format($sanPham['price'], 0, ',', '.') ?> VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Số lượng tồn</th>
                                    <td><?= $sanPham['stock'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Mô tả sản phẩm</h3>
                        </div>
                        <div class="card-body">
                            <?= nl2br(htmlspecialchars($sanPham['description'])) ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title">Hình ảnh đại diện</h3>
                        </div>
                        <div class="card-body text-center">
                        <?php if (!empty($sanPham['image'])): 
    $imagePath = str_replace('./', '', $sanPham['image']); // Xóa './' đầu đường dẫn
    $absolutePath = PATH_ROOT . $imagePath;
    if (file_exists($absolutePath)): ?>
        <img src="<?= BASE_URL . $imagePath ?>" 
             class="img-fluid mb-3" 
             alt="<?= htmlspecialchars($sanPham['product_name']) ?>"
             style="max-height: 300px;">
    <?php else: ?>
                                <div class="text-danger">Ảnh không tồn tại </div>
                                <div class="text-muted small">Đường dẫn: <?= htmlspecialchars($absolutePath) ?></div>
                            <?php endif; ?>
                            <?php else: ?>
                                <div class="text-muted">Không có hình ảnh đại diện</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Phần hiển thị ảnh phụ -->
                    <div class="card mt-3">
    <div class="card-header bg-secondary">
        <h3 class="card-title">Ảnh phụ</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <?php 
            $product_images = $this->modelSanPham->getProductImages($sanPham['id']);
            if (!empty($product_images)): 
                foreach ($product_images as $image): 
                   
                    if (!$image['is_thumbnail']):
                        $galleryPath = str_replace(['./', '\\'], ['', '/'], $image['image_path']);
                        $absolutePath = realpath(PATH_ROOT . $galleryPath);
                        
                        if ($absolutePath && file_exists($absolutePath)):
                            $webPath = BASE_URL . $galleryPath;
            ?>
                            <div class="col-md-6 mb-3">
                                <img src="<?= $webPath ?>" 
                                     class="img-thumbnail" 
                                     alt="Ảnh phụ sản phẩm">
                                <div class="mt-2">
                                   <a href="?act=xoa-anh&id=<?= $image['id'] ?>&product_id=<?= $sanPham['id'] ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Xóa ảnh này?')">
                                        Xóa
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-12 text-danger small">
                                Ảnh phụ không tồn tại: <?= htmlspecialchars($absolutePath) ?>
                            </div>
                        <?php endif; 
                    endif;
                endforeach; 
            else: 
            ?>
                <div class="col-12 text-muted">Không có ảnh phụ</div>
            <?php endif; ?>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>