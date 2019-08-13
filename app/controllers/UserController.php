<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController
{
    public function signupAction()
    {
        if(!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($user->attributes) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if ($user->save('user')) {

                    if (User::isAdmin()) {
                        $_SESSION['success'] = 'Пользователь добавлен';
                        redirect(ADMIN . '/users/');
                    } else {
                        $_SESSION['success'] = 'Вы успешно зарегистрировались!';
                        redirect(PATH . '/user/login');
                    }

                } else {

                    if (User::isAdmin()) {
                        $_SESSION['error'] = 'Произошла ошибка';
                        redirect(ADMIN . '/users/');
                    } else {
                        $_SESSION['error'] = 'Произошла ошибка!';
                        redirect();
                    }

                }
            }
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction()
    {
        if(isset($_SESSION['user'])) {
            redirect(PATH);
        }
        if(!empty($_POST)) {
            $user = new User();
            if($user->login()) {
                $_SESSION['success'] = 'Вы успешно авторизовались!';
                redirect(PATH);
            } else {
                $_SESSION['error'] = 'Логин/пароль введены не верно';
                redirect();
            }
        }
        $this->setMeta('Авторизация');

    }

    public function logoutAction()
    {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            redirect();
        }
    }

}