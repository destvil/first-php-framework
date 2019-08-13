<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Главная</a></li>
                <li>Регистрация</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12">
                <div class="product-one signup">
                    <div class="register-top heading">
                        <h2>REGISTER</h2>
                    </div>

                    <div class="register-main">
                        <div class="col-md-5 account-left">
                            <form method="post" action="/user/signup/" id="form-signup" role="form">

                                <div class="form-group has-feedback">
                                    <label for="login" class="control-label">Логин</label>
                                    <input type="text" pattern="^[_A-z0-9]{1,}$" maxlength="15" name="login" class="form-control" id="login" placeholder="Login" value="<?=isset($_SESSION['form_data']['login'])? $_SESSION['form_data']['login'] :'';?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="password" class="control-label">Пароль</label>
                                    <input type="password" name="password" class="form-control" id="password" data-minlength="6" placeholder="Password" required>
                                    <div class="help-block">Минимальная длина 6 символов</div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="password-confirm">Повторите пароль</label>
                                    <input type="password" name="password-confirm" class="form-control" id="password-confirm" data-match="#password" data-match-error="Пароли не совпадают" placeholder="Password" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Имя" value="<?=isset($_SESSION['form_data']['name'])? $_SESSION['form_data']['name'] :'';?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" data-error="Введённый email является некорректным" value="<?=isset($_SESSION['form_data']['email'])? $_SESSION['form_data']['email'] :'';?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="address">Адрес</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?=isset($_SESSION['form_data']['address'])? $_SESSION['form_data']['address'] :'';?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <button type="submit" class="btn btn-default">Зарегистрировать</button>
                            </form>
                          <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->