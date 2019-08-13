<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Редактирование категории</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>/"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>/category/"><i class="fas fa-bars"></i> Категории</a></li>
                    <li class="breadcrumb-item"><i class="fas fa-plus-circle"></i> Редактирование категории</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-4 ml-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Редактирование: <?=hsc($category->title);?></h3>
                    <!-- /.card-header -->
                </div>
                <form action="<?=ADMIN;?>/category/edit/" method="post" role="form" data-toggle="validator">
                    <div class="card-body">
                        <div class="form-group has-feedback">
                            <label for="title" class="control-label">Наименование категории</label>
                            <input type="text" maxlength="30" id="title" name="title" class="form-control" placeholder="Наименование категории" value="<?=hsc($category->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родительская категория</label>
                            <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/select.php',
                                'container' => 'select',
                                'cache' => 0,
                                'cacheKey' => 'admin_select',
                                'class' => 'form-control',
                                'attrs' => [
                                    'name' => 'parent_id',
                                    'id' => 'parent_id'
                                ],
                                'prepend' => '<option value="0">Самостоятельная категория</option>'
                            ]); ?>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="keywords" class="control-label">Ключевые слова</label>
                            <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Ключевые слова" value="<?=hsc($category->keywords);?>" required>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="description" class="control-label">Описание</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Описание" value="<?=hsc($category->description);?>" required>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card-footer">
                        <input type="hidden" name="id" value="<?=$category->id; ?>">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->
<!-- /.content -->