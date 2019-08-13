<?php


namespace app\models\admin;


class Users extends \app\models\User
{

    public $attributes = [
        'id' => '',
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
        'role' => ''
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['name'],
            ['email'],
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['login', 3],
            ['password', 6]
        ]
    ];

    public $labels = [
        'login' => 'Логин',
        'password' => 'Пароль',
        'name' => 'Имя',
        'email' => 'Электронная почта',
        'address' => 'Адрес'
    ];

    public function checkUnique()
    {
        $user = \R::findOne('user', '(login = ? OR email = ?) AND id <> ?', [$this->attributes['login'], $this->attributes['email'], $this->attributes['id']]);
        if($user) {
            if($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = 'Этот логин уже занят';
            }
            if($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = 'Этот email уже зарегистрирован';
            }
            return false;
        }
        return true;
    }

}