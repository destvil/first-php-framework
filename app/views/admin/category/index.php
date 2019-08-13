<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Список категорий</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><i class="fas fa-bars"></i> Категории</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="category-helper">
                        <div class="category-helper__block">
                            <div class="category-helper__item category-helper__square"></div>
                            <span class="category-helper__text"> - главная категория</span>
                        </div>
                        <div class="category-helper__block">
                            <div class="category-helper__item"><i class="fas fa-trash-alt text-dark"></i></div>
                            <span class="category-helper__text"> - категорию невозможно удалить, т.к в ней есть подкатегории/товары</span>
                        </div>
                        <div class="category-helper__block">
                            <div class="category-helper__item"><i class="fas fa-trash-alt text-danger"></i></div>
                          <span class="category-helper__text"> - удаление категории</span>
                        </div>
                    </div>
                    <?php new \app\widgets\menu\Menu([
                        'tpl' => WWW . '/menu/category_admin.php',
                        'container' => 'div',
                        'cache' => 0,
                        'cacheKey' => 'admin_cat',
                        'class' => 'list-group list-group-root well'
                    ]); ?>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->
<!-- /.content -->