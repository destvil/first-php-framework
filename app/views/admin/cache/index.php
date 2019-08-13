<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Кэширование</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=ADMIN;?>"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="breadcrumb-item"><i class="fas fa-database"></i> Кэширование</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card cache-card">
                <div class="card-header">
                    <h3 class="card-title">Управление кэшированием данных</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-orders table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Длительность</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Категории</td>
                                <td>Меню категорий на сайте</td>
                                <td>1 час</td>
                                <td>
                                    <a class="delete" href="<?=ADMIN;?>/cache/delete/?key=category">
                                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Фильтры</td>
                                <td>Кэш фильтров и групп фильтров</td>
                                <td>1 час</td>
                                <td>
                                    <a class="delete" href="<?=ADMIN;?>/cache/delete/?key=filter">
                                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Длительность</th>
                            <th>Действия</th>
                        </tr>
                        </tfoot>
                    </table>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->
<!-- /.content -->