<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Список пользователей</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><i class="fas fa-users"></i> Пользователи</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-users">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-orders table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Имя</th>
                            <th>Адрес</th>
                            <th>Роль</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr">
                                <td><?=$user['id'];?></td>
                                <td><a href="<?=PATH;?>/user/profile?id=<?=$user['id'];?>" target="_blank" title="Профиль"><?=$user['login'];?><a/></td>
                                <td><?=$user['email'];?></td>
                                <td><?=$user['name'];?></td>
                                <td><?=$user['address'];?></td>
                                <td><?=$user['role'];?></td>
                                <td>
                                    <a href="<?=ADMIN;?>/users/edit?id=<?=$user['id'];?>" title="Редактирование"><i class="fas fa-user-edit"></i></a>
                                    <a href="<?=ADMIN;?>/users/delete?id=<?=$user['id'];?>" class="delete" title="Удаление"><i class="fas fa-times text-danger"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Имя</th>
                            <th>Адрес</th>
                            <th>Роль</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-between my-3">
                        <?$curCountUsers = ($pagination->currentPage - 1) * $pagination->perpage + count($users) ?>
                        <span>Показан(ы) <?=$curCountUsers ;?> из <?=$count;?> пользователей</span>
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