<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-center order-control">
                <h1>Заказ №<?=$order['id'];?></h1>
                <form class="ml-3" action="<?=ADMIN;?>/orders/change/?id=<?=$order['id'];?>" method="post">
                    <?php if(!$order['status']): ?>
                      <button class="btn btn-success" name="status" value="1">Одобрить</button>
                    <?php else: ?>
                      <button class="btn btn-warning" name="status" value="0">Вернуть на доработку</button>
                    <?php endif; ?>
                </form>
                <form class="ml-3" action="<?=ADMIN;?>/orders/delete?id=<?=$order['id'];?>" method="post">
                    <button class="btn btn-danger" name="delete" value="1">Удалить заказ</button>
                </form>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><a href="<?=ADMIN . '/orders/';?>"><i class="fas fa-shopping-cart "></i> Заказы</a></li>
                    <li class="breadcrumb-item">№ <?=$order['id'];?></li>
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
                    <h3 class="card-title">Общая информация</h3>
                    <!-- /.card-header -->
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td>Номер заказа</td>
                            <td><?=$order['id'];?></td>
                        </tr>
                        <tr>
                            <td>Дата заказа</td>
                            <td><?=$order['date'];?></td>
                        </tr>
                        <tr>
                            <td>Дата изменения</td>
                            <td><?=$order['update_at'];?></td>
                        </tr>
                        <tr>
                            <td>Кол-во позиций в заказе</td>
                            <td><?=count($order_products);?></td>
                        </tr>
                        <tr>
                            <td>Сумма заказа</td>
                            <td><?=$order['sum'] . ' ' . $order['currency'];?></td>
                        </tr>
                        <tr>
                            <td>Имя заказчика</td>
                            <td><?=$order['name'];?></td>
                        </tr>
                        <tr>
                            <td>Статус</td>
                            <td><?=$order['status'] ? 'Завершен' : 'Новый';?></td>
                        </tr>
                        <tr>
                            <td>Комментарий</td>
                            <td><?=$order['note'];?></td>
                        </tr>
                        </tbody>
                        <!-- /.table -->
                    </table>
                    <!-- accordion -->
                    <div class="accordion" id="accordionExample">
                            <div id="orderDetail" class="py-1">
                                <h2 class="d-flex justify-content-between mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      <i class="fas fa-hand-pointer"></i> Детали заказа:
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="orderDetail" data-parent="#accordionExample">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID товара</th>
                                            <th>Наименование</th>
                                            <th>Количество</th>
                                            <th>Цена</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $qty = 0; foreach ($order_products as $product): ?>
                                        <tr>
                                            <td><?=$product['id'];?></td>
                                            <td><?=$product['title'];?> <a href="<?=PATH . '/product/' . $product['alias'] . '/';?>" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                                            <td><?=$product['qty']; $qty += $product['qty']; ?></td>
                                            <td><?=$product['price'];?></td>
                                        </tr>

                                        <?php endforeach; ?>
                                        <tr class="active">
                                            <td colspan="2">
                                                <b>Итого:</b>
                                            </td>
                                          <td><b><?=$qty; ?></b></td>
                                            <td><b><?=$order['sum'] . ' ' . $order['currency']; ?></b></td>
                                        </tr>
                                        </tbody>
                                        <!-- /.table -->
                                    </table>
                            </div>
                            <!-- /.accordion -->
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