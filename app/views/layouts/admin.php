<!DOCTYPE html>
<html>
<head>
  <base href="/admin/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php echo $this->getMeta(); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="icon" type="image/png" href="star.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <!-- custom stylesheet -->
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=ADMIN;?>/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=PATH;?>" class="nav-link" target="_blank">Shop</a>
      </li>
    </ul>

    <?php if(isset($_SESSION['success'])): ?>
      <span class="admin-nonify text-bold text-success ml-3">
        <?php echo $_SESSION['success']; unset($_SESSION['success']);?>
      </span>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
      <span class="admin-nonify text-bold text-danger ml-3">
      <?php echo $_SESSION['error']; unset($_SESSION['error']);?>
    </span>
    <?php endif; ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Logout -->
      <li class="nav-item">
        <a class="nav-link"href="<?=PATH . '/user/logout/';?>" title="Logout">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/admin.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/" class="d-block"><?=$_SESSION['user']['name'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=ADMIN;?>/" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Главная
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=ADMIN;?>/orders/" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart "></i>
              <p>
                Заказы
                <?php $newOrders = \R::count('order', "status = '0'");?>
                <span class="badge badge-info right"><?=$newOrders;?></span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Категории
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=ADMIN;?>/category/" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>Список категорий</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=ADMIN;?>/category/add/" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Добавить категорию</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Товары
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=ADMIN;?>/product/" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>Список товаров</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=ADMIN;?>/product/add/" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Добавить товар</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Пользователи
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=ADMIN;?>/users/" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>Список пользователей</p>
                </a>


              <li class="nav-item">
                <a href="<?=ADMIN;?>/users/add/" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Добавить пользователя</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?=ADMIN; ?>/cache/" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Кэширование
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?=$content;?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-beta.1
    </div>
    <div class="">
        <?php
        $logs = \R::getDatabaseAdapter()
            ->getDatabase()
            ->getLogger();

        debug( $logs->grep( 'SELECT' ) );
        ?>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AjaxUpload -->
<script src="/js/ajaxupload.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.js"></script>
<!-- Validator -->
<script src="/js/validator.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.min.js"></script>
<!-- Custom js -->
<script src="dist/js/custom.js"></script>
</body>
</html>
