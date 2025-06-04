<?php include 'views/layout/header.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-sign-in-alt"></i> Đăng nhập hệ thống(Dành cho admin)</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-check"></i> Thông tin đăng nhập</h3>
                        </div>
                        <!-- /.card-header -->
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger ml-3 mr-3 mt-3">
                                <i class="icon fas fa-exclamation-triangle"></i> <?= $error ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success ml-3 mr-3 mt-3">
                                <i class="icon fas fa-check"></i> <?= $_SESSION['success'] ?>
                                <?php unset($_SESSION['success']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- form start -->
                        <form action="?act=dang-nhap" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email đăng nhập" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="password"><i class="fas fa-lock"></i> Mật khẩu</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                        <label class="custom-control-label" for="remember"><i class="fas fa-memory"></i> Ghi nhớ đăng nhập</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Đăng nhập
                                </button>

                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    
                    
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php include 'views/layout/footer.php'; ?>
