<?php if (!empty($_SESSION['success'])): ?>
    <div id="toast-success" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 200px;">
        <div class="alert alert-success p-2 m-0" style="box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    </div>
    <script>
        setTimeout(function() {
            var toast = document.getElementById('toast-success');
            if (toast) toast.style.display = 'none';
        }, 2000);
    </script>
<?php endif; ?>

  <!-- Start Top Nav -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
      <div class="container text-light">
          <div class="w-100 d-flex justify-content-between">
              <div>
                  <i class="fa fa-envelope mx-2"></i>
                  <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                  <i class="fa fa-phone mx-2"></i>
                  <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
              </div>
              <div>
                  <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                  <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                  <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                  <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
              </div>
          </div>
      </div>
  </nav>
  <!-- Close Top Nav -->


  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light shadow">
      <div class="container d-flex justify-content-between align-items-center">
          <a class="navbar-brand text-success logo h1" href="index.php">
              LaptopTech
          </a>
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
              <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                  <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                  <li class="nav-item"><a class="nav-link" href="index.php?act=about">Giới thiệu</a></li>
                  <li class="nav-item"><a class="nav-link" href="index.php?act=shop">Cửa hàng</a></li>
                  <li class="nav-item"><a class="nav-link" href="index.php?act=contact">Liên hệ</a></li>
              </ul>
              <div class="navbar align-self-center d-flex">
                  <a class="nav-icon position-relative text-decoration-none" href="?act=cart">
                      <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                      <?php $count = array_sum(array_values($_SESSION['cart'] ?? [])); ?>
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
                          <?= $count ?>
                      </span>
                  </a>

                  <!-- Nếu đã đăng nhập -->
                  <?php if (isset($_SESSION['user'])): ?>
                      <div class="dropdown">
                          <a class="nav-icon position-relative text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-fw fa-user text-dark mr-3"></i>
                              <?= htmlspecialchars($_SESSION['user']['name']) ?>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="userDropdown">
                              <li><a class="dropdown-item" href="index.php?act=orders">Lịch sử đơn hàng</a></li>
                              <li><a class="dropdown-item" href="index.php?act=logout">Đăng xuất</a></li>
                          </ul>
                      </div>
                  <?php else: ?>
                      <!-- Nếu chưa đăng nhập -->
                      <a class="nav-icon position-relative text-decoration-none" href="index.php?act=login">
                          <i class="fa fa-fw fa-user text-dark mr-3"></i> Đăng nhập
                      </a>
                  <?php endif; ?>


              </div>
          </div>
      </div>
  </nav>