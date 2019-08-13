<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Список заказов</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><i class="fas fa-shopping-cart "></i> Заказы</li>
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
                    <table id="" class="table table-orders table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Покупатель</th>
                            <th>Сумма</th>
                            <th>Дата создания</th>
                            <th>Дата изменения</th>
                            <th>Статус(s)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                        <?php $class = $order['status'] ? 'success' : ''; ?>
                        <tr class="<?=$class; ?>">
                            <td><?=$order['id'];?></td>
                            <td><?=$order['name'];?></td>
                            <td><?=$order['sum'] . ' ' . $order['currency'];?></td>
                            <td><?=$order['date'];?></td>
                            <td><?=$order['update_at'];?></td>
                            <td class="status"><?=$order['status'] ? 'Завершён' : 'Новый';?></td>
                            <td><a href="<?=ADMIN;?>/orders/view?id=<?=$order['id'];?>"><i class="fas fa-external-link-alt"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Покупатель</th>
                            <th>Цена</th>
                            <th>Дата создания</th>
                            <th>Дата изменения</th>
                            <th>Статус(s)</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-between my-3">
                        <?$curCountOrders = ($pagination->currentPage - 1) * $pagination->perpage + count($orders) ?>
                        <span>Показан(ы) <?=$curCountOrders ;?> из <?=$order_count;?> товаров</span>
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