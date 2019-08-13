<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Редактирование пользователя</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                  <li class="breadcrumb-item"><a href="<?=ADMIN;?>/users/"><i class="fas fa-users"></i> Пользователи</a></li>
                    <li class="breadcrumb-item">Редактирование</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-4">
            <div class="card card-users card-success">
              <form action="<?=ADMIN;?>/users/edit/" method="post" data-toggle="validator">
                <div class="card-header">
                  <h3 class="card-title">Пользователь <?=$user['login'];?></h3>
                  <!-- /.card-header -->
                </div>
                <div class="card-body">
                <div class="form-group has-feedback">
                  <label for="login" class="control-label">Логин</label>
                  <input type="text" class="form-control" maxlength="30" id="login" name="login" value="<?=hsc($user['login']);?>" placeholder="Логин" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback">
                  <label for="password" class="control-label">Пароль</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback">
                  <label for="name" class="control-label">Имя</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?=hsc($user['name']);?>" placeholder="Имя" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback">
                  <label for="email" class="control-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?=hsc($user['email']);?>" placeholder="Email" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback">
                  <label for="address" class="control-label">Адрес</label>
                  <input type="text" class="form-control" id="address" name="address" value="<?=hsc($user['address']);?>" placeholder="Адрес">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                  <label for="role">Роль</label>
                  <select class="form-control" id="role" name="role">
                    <option value="user" <?php if($user['role'] == 'user') echo 'selected'?>>Пользователь</option>
                    <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'?>>Администратор</option>
                  </select>
                </div>
                <!-- /.card-body -->
              </div>
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?=$user['id'];?>">
                  <button type="submit" class="btn btn-success">Обновить информацию</button>
                </div>
              </form>

              </form>
            </div>
            <!-- /.col -->
        </div>
        <div class="col-8">
        <div class="card card-users_orders card-info">
          <div class="card-header">
            <h3 class="card-title">Заказы пользователя <?=$user['login'];?></h3>
          </div>
          <!-- /.card-header -->
          <?php if($user_orders): ?>
            <div class="card-body">
              <table id="" class="table table-orders table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Сумма</th>
                  <th>Дата создания</th>
                  <th>Дата изменения</th>
                  <th>Статус(s)</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($user_orders as $order): ?>
                    <?php $class = $order['status'] ? 'success' : ''; ?>
                  <tr class="<?=$class; ?>">
                    <td><?=$order['id'];?></td>
                    <td><?=$order['sum'] . ' ' . $order['currency'];?></td>
                    <td><?=$order['date'];?></td>
                    <td><?=$order['update_at'];?></td>
                    <td class="status"><?=$order['status'] ? 'Завершён' : 'Новый';?></td>
                    <td><a href="<?=ADMIN;?>/orders/view?id=<?=$order['id'];?>" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Цена</th>
                  <th>Дата создания</th>
                  <th>Дата изменения</th>
                  <th>Статус(s)</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
          <?php else: ?>
            <div class="card-body d-flex text-center align-items-center">
              <span class="display-4 text-muted mx-auto">Заказов не найдено</span>
              <!-- /.card-body -->
            </div>
          <?php endif; ?>

          <div class="card-footer d-flex align-items-center">
                <?$curCountOrders = ($pagination->currentPage - 1) * $pagination->perpage + count($user_orders) ?>
              <span>Показан(ы) <?=$curCountOrders ;?> из <?=$order_count;?> товаров</span>
                <?php if($pagination->countPages > 1): ?>
                  <div class="text-center ml-auto">
                      <?=$pagination?>
                  </div>
                <?php endif; ?>
          </div>
          </form>
        </div>
        <!-- /.col -->
      </div>
        <!-- /.row -->
</section>
<!-- /.content -->
<!-- /.content -->