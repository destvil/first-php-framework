<!-- Main content -->
<!-- Content Header (Page header) -->
<?php unset($_SESSION['single'],$_SESSION['old_single'],$_SESSION['multi']);?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Редактирование товара: <?=$product->title;?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>/product/"><i class="fas fa-cubes"></i> Товары</a></li>
                    <li class="breadcrumb-item"><i class="fa fa-edit"></i> Редактировать товар</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form class="w-100" action="<?=ADMIN;?>/product/edit/" method="post" enctype="multipart/form-data" role="form" data-toggle="validator">
        <div class="row align-content-stretch">
            <div class="col-md-6">
                <div class="card card-product card-info">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация</h3>
                        <!-- /.card-header -->
                    </div>
                    <div class="card-body card-light">
                        <div class="form-group has-feedback">
                            <label for="title" class="control-label">Наименование товара</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Наименование категории" value="<?=hsc($product->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Родительская категория</label>
                            <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/select.php',
                                'container' => 'select',
                                'cache' => 0,
                                'cacheKey' => 'admin_select',
                                'class' => 'form-control',
                                'attrs' => [
                                    'name' => 'category_id',
                                    'id' => 'category_id'
                                ],
                                'prepend' => '<option>Выберите категорию</option>'
                            ]); ?>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="keywords" class="control-label">Ключевые слова</label>
                            <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Ключевые слова" value="<?=hsc($product->keywords);?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="description" class="control-label">Описание</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Описание" value="<?=hsc($product->description);?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group d-flex align-items-center my-4">

                            <div class="input-group has-feedback d-flex justify-content-between col-4 pl-0">
                                <input type="text" id="price" pattern="^[0-9.]{1,}$" name="price" class="form-control" placeholder="Цена" value="<?=$product->price;?>" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="input-group-append">
                                    <div class="input-group-text">USD</div>
                                </div>
                            </div>

                            <div class="input-group has-feedback d-flex justify-content-between col-4 pl-0 ml-3">
                                <input type="text" id="old_price" pattern="^[0-9.]{1,}$" name="old_price" class="form-control" placeholder="Старая цена" value="<?=$product->old_price;?>">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="input-group-append">
                                    <div class="input-group-text">USD</div>
                                </div>
                            </div>

                            <div class="form-check ml-3">
                                <input class="form-check-input" type="checkbox" name="hit" id="hit" <?php if($product->hit) echo 'checked' ?>>
                                <label class="form-check-label" for="hit">
                                    Хит продаж
                                </label>
                            </div>

                            <div class="form-check ml-4">
                                <input class="form-check-input" type="checkbox" name="status" id="status" <?php if($product->status) echo 'checked' ?>>
                                <label class="form-check-label" for="status">
                                    Активен
                                </label>
                            </div>

                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="bs_editor" name="content" rows="6"><?=$product->content;?></textarea>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card-footer">
                        <input type="hidden" name="id" value="<?=$product->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить изменения</button>
                    </div>
                </div>
                <!-- /.col -->
            </div>

            <div class="col-md-5">
                <div class="card card-product_filter card-info">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link pb-3 active" id="advanced-info-tab" data-toggle="tab" href="#advanced-info" role="tab" aria-controls="advanced-info" aria-selected="true">Дополнительная информация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pb-3" id="product-images-tab" data-toggle="tab" href="#product-images" role="tab" aria-controls="product-images" aria-selected="false">Изображения</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body card-light">
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="advanced-info" role="tabpanel" aria-labelledby="advanced-info-tab">
                                <?php new \app\widgets\filter\Filter($filter,APP . '/widgets/filter/filter_tpl/admin_filter.php'); ?>
                                <div class="form-group mb-4">
                                    <label for="related">Связанные товары</label>
                                    <select name="related[]" class="form-control select2" id="related" multiple>
                                        <?php if(!empty($related_product)): ?>
                                            <?php foreach ($related_product as $item): ?>
                                                <option value="<?=$item['related_id'];?>" selected><?=$item['title'];?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="product-images" role="tabpanel" aria-labelledby="product-images-tab">
                                <div class="form-group mb-4">

                                    <div class="col-md-6 mx-auto">
                                        <div class="card file-upload text-center">
                                            <div class="card-header">
                                                <h3 class="card-title">Основное изображение</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="single">
                                                        <div class="img-block">
                                                            <?php if($product->img == 'no_image.jpg'): ?>
                                                            <?php $_SESSION['old_single'] = null;?>
                                                            <img src="/images/products/<?=$product->img;?>" style="max-height: 150px;">
                                                            <?php else: ?>
                                                            <?php $_SESSION['single'] = $product->img; $_SESSION['old_single'] = $product->img;?>
                                                            <img src="/images/products/<?=$product->id . '/' . $product->img;?>" style="max-height: 150px;">
                                                            <a href="" class="del-img">
                                                                <i class="far fa-times-circle"></i>
                                                            </a>
                                                            <?php endif; ?>
                                                        </div>
                                                </div>
                                                <button class="btn btn-primary my-2" id="single" data-url="product/add-image/" data-name="single">Выбрать основное изображение</button>
                                                <p class="d-flex flex-column m-0">
                                                    <small>Рекомендуемые размеры: 125х200</small>
                                                    <small class="text-error text-danger">Для ошибок</small>
                                                </p>
                                            </div>
                                            <!-- /.card-body -->
                                            <!-- Loading (remove the following to stop the loading)-->
                                            <div class="overlay">
                                                <i class="fas fa-sync-alt"></i>
                                            </div>
                                            <!-- end loading -->
                                        </div>
                                        <!-- /.card -->
                                    </div>

                                </div>

                                <div class="form-group mb-4">

                                    <div class="col-md-12 mx-auto">
                                        <div class="card file-upload text-center">
                                            <div class="card-header">
                                                <h3 class="card-title">Картинки галереи</h3>
                                            </div>
                                            <div class="card-body">
                                                <button class="btn btn-outline-primary mb-2" id="multi" data-url="product/add-image/" data-name="multi">Выбрать файл</button>
                                                <p class="d-flex flex-column m-0">
                                                    <small>Рекомендуемые размеры: 762x1100</small>
                                                    <small class="text-error text-danger">Для ошибок</small>
                                                </p>
                                                <div class="multi">
                                                    <?php if(isset($gallery)): ?>
                                                        <?php foreach ($gallery as $img): ?>
                                                            <?php $_SESSION['multi'][] = $img;?>
                                                            <div class="img-block">
                                                                <img src="/images/products/<?=$product->id . '/' . $img;?>" style="max-height: 150px;">
                                                                <a href="" class="del-img">
                                                                    <i class="far fa-times-circle"></i>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                            <!-- Loading (remove the following to stop the loading)-->
                                            <div class="overlay">
                                                <i class="fas fa-sync-alt"></i>
                                            </div>
                                            <!-- end loading -->
                                        </div>
                                        <!-- /.card -->
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </form>
</section>
<!-- /.content -->
<!-- /.content -->