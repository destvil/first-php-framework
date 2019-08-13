<?php

namespace app\controllers\admin;

use app\models\User;

class LoginController extends AppController
{
    public function indexAction()
    {
        if (User::isAdmin()) {
            redirect(ADMIN . '/');
        }
        $this->layout = 'empty';
        $this->setMeta('Авторизация | Luxury Watches');
        if (!empty($_POST)) {
            $user = new User();
            if ($user->login(true)) {
                $_SESSION['success'] = 'Вы успешно авторизованы';
            } else {
                $_SESSION['error'] = 'Неверные данные';
            }
            if (User::isAdmin()) {
                redirect(ADMIN . '/');
            } else {
                redirect();
            }
        }
    }
}