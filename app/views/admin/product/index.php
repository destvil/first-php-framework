<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Список товаров</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><i class="nav-icon fas fa-cubes"></i> Товары</li>
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
                    <table id="" class="table table-product table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Категория</th>
                            <th>Наименование</th>
                            <th>Цена</th>
                            <th>Хит</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?=$product['id'];?></td>
                                <td><?=$product['cat'];?></td>
                                <td><a href="<?=PATH;?>/product/<?=$product['alias'];?>" target="_blank" title="Просмотр"><?=$product['title'];?></a></td>
                                <td><?=$product['price'];?></td>
                                <td><?=$product['hit'] ? "<i class='fas text-success fa-check'></i>" : "<i class='fas text-danger fa-times-circle'></i>";?></td>
                                <td><?=$product['status'] ? 'Активен' : 'Неактивен';?></td>
                                <td>
                                    <a href="<?=ADMIN;?>/product/edit?id=<?=$product['id'];?>" title="Редактирование"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Категория</th>
                            <th>Наименование</th>
                            <th>Цена</th>
                            <th>Хит</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-between my-3">
                        <?$curCount = ($pagination->currentPage - 1) * $pagination->perpage + count($product) ?>
                        <span>Показан(ы) <?=$curCount ;?> из <?=$count;?> товаров</span>
                        <?php if($pagination->countPages > 1): ?>
                            <div class="text-center">
                                <?=$pagination?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->
<!-- /.content -->